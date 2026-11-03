<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\category;
use App\Models\category_product;
use App\Models\product;
use App\Models\product_attributes;
use App\Models\package;
use App\Models\package_attribute;
use App\Models\product_media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Log;

class ProductController extends Controller
{
    public function create()
    {
        $categories = category::with('attributes:id,category_id,key,type')->get();

        $categoriesData = $categories->mapWithKeys(function ($category) {
            return [
                $category->id => [
                    'name' => $category->title,
                    'attributes' => $category->attributes->map(function ($attribute) {
                        return [
                            'id' => $attribute->id,
                            'key' => $attribute->key,
                            'type' => $attribute->type,
                        ];
                    })->values(),
                ],
            ];
        });

        $setting = homeSetting::document();

        return view('admin.product.create', [
            'categories' => $categories,
            'categoriesData' => $categoriesData,
            'setting' => $setting,
        ]);
    }

    public function store(Request $request)
    {
        // ============================================
        // 1. اعتبارسنجی اطلاعات محصول و پکیج‌ها
        // ============================================

        $validator = Validator::make($request->all(), [
            // اطلاعات اصلی محصول
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'summary' => ['nullable', 'string'],
            'count' => ['required', 'integer', 'min:0'],
            'primary_price' => ['nullable', 'numeric', 'min:0'],
            'secondary_price' => ['nullable', 'numeric', 'min:0'],
            'show_in_home' => ['nullable', 'boolean'],
            // دسته‌بندی‌ها
            'category_ids' => ['required', 'array', 'min:1'],
            'category_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:categories,id',
            ],
            // تصویر اصلی محصول
            'mainImage' => ['required', 'image', 'max:5120'],
            // تصاویر گالری
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:5120'],
            // ویژگی‌های عمومی محصول
            'attributes' => ['nullable', 'array'],
            'attributes.*.attribute_id' => [
                'required',
                'integer',
                'exists:attributes,id',
            ],
            'attributes.*.input_type' => [
                'required',
                'string',
                'in:text,number,color,date,select,checkbox',
            ],
            'attributes.*.values' => ['nullable', 'array'],
            'attributes.*.values.*' => [
                'nullable',
                'string',
                'max:255',
            ],
            // پکیج‌ها
            'packages' => ['nullable', 'array'],
            'packages.*.title' => [
                'required',
                'string',
                'max:255',
            ],
            'packages.*.count' => [
                'required',
                'integer',
                'min:1',
            ],
            'packages.*.primary_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'packages.*.secondary_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'packages.*.image' => [
                'nullable',
                'image',
                'max:5120',
            ],
            'packages.*.summary' => ['nullable', 'string'],
            'packages.*.description' => ['nullable', 'string'],
            'packages.*.show_in_home' => ['nullable', 'boolean'],
            // ویژگی‌های پکیج
            'packages.*.attributes' => ['nullable', 'array'],
            'packages.*.attributes.*.attribute_id' => [
                'required',
                'integer',
                'exists:attributes,id',
            ],
            'packages.*.attributes.*.input_type' => [
                'required',
                'string',
                'in:text,number,color,date,select,checkbox',
            ],
            'packages.*.attributes.*.values' => ['nullable', 'array'],
            'packages.*.attributes.*.values.*' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $validated = $validator->validate();

        // ============================================
        // 2. آماده‌سازی مدیریت فایل‌ها و تراکنش
        // ============================================

        $uploadedFiles = [];

        // DB::beginTransaction();

        try {
            // ========================================
            // 3. ذخیره اطلاعات اصلی محصول
            // ========================================

            $productId = product::insertGetId([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'summary' => $validated['summary'] ?? null,
                'count' => $validated['count'],
                'primary_price' => $validated['primary_price'] ?? null,
                'secondary_price' => $validated['secondary_price'] ?? null,
                'show_in_home' => $validated['show_in_home'] ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // ========================================
            // 4. اتصال محصول به دسته‌بندی‌ها
            // ========================================

            $categoryIds = $validated['category_ids'];

            $categoryRows = [];

            foreach ($categoryIds as $categoryId) {
                $categoryRows[] = [
                    'product_id' => $productId,
                    'category_id' => $categoryId,
                ];
            }

            category_product::insert($categoryRows);

            // ========================================
            // 5. ذخیره تصویر اصلی محصول
            // ========================================

            if ($request->hasFile('mainImage')) {
                $mainImagePath = $request
                    ->file('mainImage')
                    ->store('products', 'public');

                $uploadedFiles[] = $mainImagePath;

                DB::table('product_media')->insert([
                    'product_id' => $productId,
                    'media_path' => $mainImagePath,
                    'media_type' => 'image',
                    'is_main' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // ========================================
            // 6. ذخیره تصاویر گالری محصول
            // ========================================

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $galleryImage) {
                    if (!$galleryImage) {
                        continue;
                    }

                    $galleryImagePath = $galleryImage
                        ->store('products/gallery', 'public');

                    $uploadedFiles[] = $galleryImagePath;

                    product_media::insert([
                        'product_id' => $productId,
                        'media_path' => $galleryImagePath,
                        'media_type' => 'image',
                        'is_main' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // ========================================
            // 7. ذخیره ویژگی‌های عمومی محصول
            // ========================================

            foreach ($validated['attributes'] ?? [] as $attribute) {
                $attributeId = $attribute['attribute_id'];

                $inputType = $attribute['input_type'];

                $values = $attribute['values'] ?? [];

                foreach ($values as $value) {
                    // جلوگیری از ذخیره مقدار خالی
                    if ($value === null || $value === '') {
                        continue;
                    }

                    product_attributes::insert([
                        'product_id' => $productId,
                        'attribute_id' => $attributeId,
                        'input_type' => $inputType,
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // ========================================
            // 8. ذخیره پکیج‌های محصول
            // ========================================

            foreach ($validated['packages'] ?? [] as $packageIndex => $packageData) {
                // ------------------------------------
                // تصویر پکیج
                // ------------------------------------

                $packageImagePath = null;

                if ($request->hasFile("packages.$packageIndex.image")) {
                    $packageImagePath = $request
                        ->file("packages.$packageIndex.image")
                        ->store('products/packages', 'public');

                    $uploadedFiles[] = $packageImagePath;
                }

                // ------------------------------------
                // ایجاد پکیج
                // ------------------------------------

                $packageId = package::insertGetId([
                    'product_id' => $productId,
                    'image' => $packageImagePath,
                    'title' => $packageData['title'],
                    'description' => $packageData['description'] ?? null,
                    'summary' => $packageData['summary'] ?? null,
                    'count' => $packageData['count'],
                    'primary_price' => $packageData['primary_price'] ?? null,
                    'secondary_price' => $packageData['secondary_price'] ?? null,
                    'show_in_home' => $packageData['show_in_home'] ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // ====================================
                // 9. ذخیره ویژگی‌های پکیج
                // ====================================

                foreach ($packageData['attributes'] ?? [] as $packageAttribute) {
                    $attributeId = $packageAttribute['attribute_id'];

                    $inputType = $packageAttribute['input_type'];

                    $values = $packageAttribute['values'] ?? [];

                    foreach ($values as $value) {
                        // جلوگیری از ذخیره مقدار خالی
                        if ($value === null || $value === '') {
                            continue;
                        }

                        package_attribute::insert([
                            'product_id' => $productId,
                            'package_id' => $packageId,
                            'attribute_id' => $attributeId,
                            'input_type' => $inputType,
                            'value' => $value,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            // ========================================
            // 10. ثبت موفق عملیات
            // ========================================

            // DB::commit();

            return redirect()
                ->route('product.adminIndex')
                ->with('success', 'محصول با موفقیت ایجاد شد.');
        } catch (\Throwable $exception) {
            // ========================================
            // 11. بازگردانی تراکنش در صورت خطا
            // ========================================

            // DB::rollBack();

            // حذف تمام فایل‌هایی که در این درخواست آپلود شده‌اند
            foreach ($uploadedFiles as $filePath) {
                Storage::disk('public')->delete($filePath);
            }

            // ارسال خطا برای بررسی در محیط توسعه
            throw $exception;
        }
    }

    public function adminIndex()
    {
        $products = product::with('media')->with('categories')->get();
        foreach ($products as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media['is_main']) {
                        $product['mainImg'] = $media['media_path'];
                        break;
                    } else {
                        $product['mainImg'] = 'default.jpg';
                    }
                }
            } else {
                $product['mainImg'] = 'default.jpg';
            }
        }
        $setting = homeSetting::document();
        return view('admin.product.index', ['products' => $products, 'setting' => $setting]);
    }

    public function edit(Request $request)
    {
        $catIds = product::find($request['id'])->categories->pluck('id');
        $product = product::find($request['id'])->load('attributes')->load('categories');
        $categories = category::select(['id', 'title'])->get();
        if ($product->media->isNotEmpty()) {
            foreach ($product->media as $media) {
                $media->media_path = asset('storage/' . $media['media_path']);
            }
        }
        return response()->json(['product' => $product, 'cats' => $categories, 'catIds' => $catIds]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => ['required'],
                'gallery.*' => ['max:500'],
                'category_ids' => ['required'],
            ],
            [
                'title.required' => 'پر کردن فیلد عنوان الزامی است.',
                'gallery.*.max' => 'حجم کل فایل ها نباید بیشتر از 500 کیلوبایت باشد.',
                'category_ids.required' => 'حداقل یک دسته بندی برای محصول انتخاب کنید.',
            ]
        );
        $product = product::find($request['product_id']);
        $title = $product->title;
        $product->title = $request['title'];
        $product->description = $request['description'];
        $product->summary = $request['summary'];
        $product->primary_price = $request['primary_price'];
        $product->secondary_price = $request['secondary_price'];
        $product->count = $request['count'];
        $product->show_in_home = $request['show_in_home'] ?? 0;
        category_product::where('product_id', $product['id'])->delete();
        foreach ($request['category_ids'] as $catId) {
            category_product::create([
                'product_id' => $product['id'],
                'category_id' => $catId,
            ]);
        }
        if (isset($request['removedAttrs'])) {
            foreach ($request['removedAttrs'] as $attrId) {
                product_attributes::find($attrId)->delete();
            }
        }
        if (isset($request['removedImgs'])) {
            if (isset($request['removedImgs']['mainImg'])) {
                Storage::disk('public')->delete($request['removedImgs']['mainImg']);
                product_media::where('media_path', $request['removedImgs']['mainImg'])->delete();
            }
            if (isset($request['removedImgs']['gallery'])) {
                foreach ($request['removedImgs']['gallery'] as $media) {
                    Storage::disk('public')->delete($media);
                    product_media::where('media_path', $media)->delete();
                }
            }
        }
        if (isset($request['mainImage'])) {
            foreach ($product->media as $media) {
                if ($media['is_main']) {
                    Storage::disk('public')->delete($media['media_path']);
                    product_media::where('media_path', $media['media_path'])->delete();
                }
            }
            $newImgType = $request->mainImage->getClientOriginalExtension();
            $newImgPath = $request->mainImage->store('productImgs', 'public');
            product_media::create([
                'product_id' => $product['id'],
                'media_type' => $newImgType,
                'media_path' => $newImgPath,
                'is_main' => 1
            ]);
        }
        if (isset($request['gallery'])) {
            foreach ($request['gallery'] as $file) {
                $newImgType = $file->getClientOriginalExtension();
                $newImgPath = $file->store('productImgs', 'public');
                product_media::create([
                    'product_id' => $product['id'],
                    'media_type' => $newImgType,
                    'media_path' => $newImgPath,
                    'is_main' => 0
                ]);
            }
        }
        if (isset($request['attributes'])) {
            if (isset($request['attributes']['oldAttrs'])) {
                foreach ($request['attributes']['oldAttrs']['attribute_key'] as $id => $key) {
                    $oldProAtt = product_attributes::find($id);
                    $oldProAtt->attribute_key = $key;
                    $oldProAtt->attribute_value = $request['attributes']['oldAttrs']['attribute_value'][$id];
                    $oldProAtt->save();
                }
            }
            if (isset($request['attributes']['newAttrs'])) {
                foreach ($request['attributes']['newAttrs']['attribute_key'] as $index => $key) {
                    product_attributes::create([
                        'product_id' => $product['id'],
                        'attribute_key' => $key,
                        'attribute_value' => $request['attributes']['newAttrs']['attribute_value'][$index]
                    ]);
                }
            }
        }
        $product->save();
        return to_route('product.adminIndex')->with('message', ' محصول ' . $title . ' به روز رسانی شد. ');
    }

    public function delete($id)
    {
        $product = product::find($id);
        if ($product) {
            foreach ($product->media as $media) {
                Storage::disk('public')->delete($media['media_path']);
            }
            $product->media()->delete();
            $product->attributes()->delete();
            $product->categories()->detach();
            $product->delete();
        } else {
            return to_route('product.adminIndex')->with('message', ' چنین محصولی وجود ندارد.');
        }
        return to_route('product.adminIndex')->with('message', ' محصول ' . $product['title'] . ' حذف شد. ');
    }

    public function show(product $product)
    {
        $categories = category::with('products')->has('products')->get();
        if ($product->media->isNotEmpty()) {
            foreach ($product->media as $media) {
                if ($media['is_main']) {
                    $product['mainImg'] = $media['media_path'];
                    break;
                } else {
                    $product['mainImg'] = 'default.jpg';
                }
            }
        } else {
            $product['mainImg'] = 'default.jpg';
        }
        $allCartCount = 0;
        $proIds = [];
        if (isset($allCarts)) {
            foreach ($allCarts as $pro) {
                $proIds[] = $pro->product_id;
            }
        }
        $setting = homeSetting::document();
        $cartProIds = null;
        if (Auth::check()) {
            Auth::user()->load(['carts' => function ($query) {
                $query->whereNull('order_id');
            }])->pluck('id')->toArray();
            $cartProIds = Auth::user()->carts()->whereNull('order_id')->pluck('product_id')->toArray();

            $product->load(['carts' => function ($q) {
                $q->where('user_id', Auth::id())->whereNull('order_id')->first();
            }]);
        }
        // dd(Auth::user(), in_array($product->id, $cartProIds), $product->id);
        $setting = homeSetting::document();
        return view('admin.product.single', [
            'product' => $product,
            'setting' => $setting,
            'categories' => $categories,
            'allCartCount' => $allCartCount,
            'proIds' => $proIds,
            'cartProIds' => $cartProIds,
        ]);
    }

    public function index()
    {
        $categories = category::with('products')->has('products')->get();
        $products = product::all();
        foreach ($products as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media->is_main) {
                        $product->image = $media->media_path;
                        break;
                    } else {
                        $product->image = 'default.jpg';
                    }
                }
            } else {
                $product->image = 'default.jpg';
            }
        }
        $cartCount = 0;
        $cart = null;
        $setting = homeSetting::document();
        // $allCartCount = 0;
        // if (Auth::check()) {
        //     $allCarts = carts::select('user_id', 'order_id', 'quantity')->where('user_id', Auth::id())->where('order_id', null)->get();
        //     if (count($allCarts)) {
        //         foreach ($allCarts as $allCart) {
        //             $allCartCount += $allCart->quantity;
        //         }
        //     }
        // }
        return view('user.product.index', [
            'categories' => $categories,
            'products' => $products,
            'cartCount' => $cartCount,
            'setting' => $setting,
        ]);
    }

    public function filter(Request $request)
    {
        if (isset($request['all'])) {
            return to_route('product.index');
        }
        $category_products = category_product::whereIn('category_id', $request['selectedCats'])->get();
        $products = [];
        foreach ($category_products as $catPro) {
            $products[] = product::find($catPro['product_id']);
        }
        // $logo = logo::first();
        // $services = service::all();
        $categories = category::with('products')->has('products')->get();
        foreach ($products as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media['is_main']) {
                        $product['mainImg'] = $media['media_path'];
                        break;
                    } else {
                        $product['mainImg'] = 'default.jpg';
                    }
                }
            } else {
                $product['mainImg'] = 'default.jpg';
            }
        }
        $setting = homeSetting::document();
        return view('user.product.index', [
            'categories' => $categories,
            'products' => $products,
            'catIds' => $request['selectedCats'],
            'setting' => $setting
        ]);
    }

    public function search(Request $request)
    {
        $products = product::where('title', 'like', '%' . $request['title'] . '%')->with('media')->get();
        return response()->json($products);
    }

    public function searchResult(Request $request)
    {
        $products = product::where('title', 'like', '%' . $request['searchedValue'] . '%')->get();
        $categories = category::with('products')->has('products')->get();
        foreach ($products as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media['is_main']) {
                        $product['mainImg'] = $media['media_path'];
                        break;
                    } else {
                        $product['mainImg'] = 'default.jpg';
                    }
                }
            } else {
                $product['mainImg'] = 'default.jpg';
            }
        }
        $setting = homeSetting::document();
        return view('user.product.index', [
            'categories' => $categories,
            'products' => $products,
            'setting' => $setting
        ]);
    }

    public function findProduct(product $product)
    {
        if ($product->media->isNotEmpty()) {
            foreach ($product->media as $media) {
                if ($media['is_main']) {
                    $product['mainImg'] = $media['media_path'];
                    break;
                } else {
                    $product['mainImg'] = 'default.jpg';
                }
            }
        } else {
            $product['mainImg'] = 'default.jpg';
        }
        return response()->json($product);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'required|image|max:2048',
        ]);

        $uploadedFiles = [];

        foreach ($request->file('files') as $file) {
            $path = $file->store(
                'articles',
                'public'
            );

            $uploadedFiles[] = [
                'name' => $file->getClientOriginalName(),
                'url' => asset('storage/' . $path),
            ];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'files' => $uploadedFiles,
            ],
        ]);
    }
}
