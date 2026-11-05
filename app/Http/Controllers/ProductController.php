<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\category;
use App\Models\category_product;
use App\Models\package;
use App\Models\package_attribute;
use App\Models\product;
use App\Models\product_attributes;
use App\Models\product_media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Log;

class ProductController extends Controller
{
    // ============================================================
    // توابع کمکی
    // ============================================================

    /**
     * ساختار دسته‌بندی‌ها و ویژگی‌هایشان برای JavaScript
     * (window.CATEGORIES در فرم)
     */
    private function buildCategoriesData($categories)
    {
        return $categories->mapWithKeys(function ($category) {
            return [
                $category->id => [
                    'name' => $category->title,
                    'attributes' => $category->attributes->map(function ($attribute) {
                        return [
                            'id' => $attribute->id,
                            'key' => $attribute->key,
                            'type' => $attribute->type ?? null,
                        ];
                    })->values(),
                ],
            ];
        });
    }

    /**
     * قوانین اعتبارسنجی مشترک بین ساخت و ویرایش
     */
    private function productRules(bool $isUpdate): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'summary' => ['nullable', 'string'],
            'count' => ['required', 'integer', 'min:0'],
            'primary_price' => ['nullable', 'numeric', 'min:0'],
            'secondary_price' => ['nullable', 'numeric', 'min:0'],
            'show_in_home' => ['nullable', 'boolean'],
            'category_ids' => ['required', 'array', 'min:1'],
            'category_ids.*' => ['required', 'integer', 'distinct', 'exists:categories,id'],
            'mainImage' => [$isUpdate ? 'nullable' : 'required', 'image', 'max:5120'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['required', 'image', 'max:500'],
            'attributes' => ['nullable', 'array'],
            'attributes.*' => ['required', 'array'],
            'attributes.*.attribute_id' => ['required', 'integer', 'exists:attributes,id'],
            'attributes.*.values' => ['nullable', 'array'],
            'attributes.*.values.*' => ['nullable', 'string', 'max:255'],
            'packages' => ['nullable', 'array'],
            'packages.*' => ['required', 'array'],
            'packages.*.count' => ['required', 'integer', 'min:1'],
            'packages.*.primary_price' => ['nullable', 'numeric', 'min:0'],
            'packages.*.secondary_price' => ['nullable', 'numeric', 'min:0'],
            'packages.*.attributes' => ['nullable', 'array'],
            'packages.*.attributes.*' => ['required', 'array'],
            'packages.*.attributes.*.attribute_id' => ['required', 'integer', 'exists:attributes,id'],
            'packages.*.attributes.*.values' => ['nullable', 'array'],
            'packages.*.attributes.*.values.*' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function productMessages(): array
    {
        return [
            'title.required' => 'پر کردن فیلد عنوان الزامی است.',
            'category_ids.required' => 'حداقل یک دسته بندی برای محصول انتخاب کنید.',
            'category_ids.min' => 'حداقل یک دسته بندی برای محصول انتخاب کنید.',
            'mainImage.required' => 'انتخاب عکس اصلی الزامی است.',
            'gallery.*.max' => 'حجم کل فایل ها نباید بیشتر از 500 کیلوبایت باشد.',
        ];
    }

    /**
     * ذخیره یک تصویر (اصلی یا گالری) و ثبت آن در جدول product_media
     */
    private function storeMedia(int $productId, $file, bool $isMain, array &$uploadedFiles): void
    {
        $path = $file->store('productImgs', 'public');

        $uploadedFiles[] = $path;

        product_media::insert([
            'product_id' => $productId,
            'media_type' => $file->getClientOriginalExtension(),
            'media_path' => $path,
            'is_main' => $isMain ? 1 : 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * ذخیره ویژگی‌های عمومی محصول
     * هر مقدار یک ردیف است
     */
    private function saveProductAttributes(int $productId, array $attributes): void
    {
        $rows = [];

        foreach ($attributes as $attribute) {
            foreach ($attribute['values'] ?? [] as $value) {
                if ($value === null || $value === '') {
                    continue;
                }

                $rows[] = [
                    'product_id' => $productId,
                    'attribute_id' => $attribute['attribute_id'],
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if ($rows) {
            product_attributes::insert($rows);
        }
    }

    /** ذخیره پکیج‌ها و ویژگی‌های هر پکیج */

    /**
     * ذخیره پکیج‌ها و ویژگی‌های هر پکیج
     */
    private function savePackages(int $productId, array $packages): void
    {
        foreach ($packages as $packageData) {
            // ایجاد پکیج
            $packageId = package::insertGetId([
                'product_id' => $productId,
                'count' => $packageData['count'],
                'primary_price' => $packageData['primary_price'] ?? null,
                'secondary_price' => $packageData['secondary_price'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // ویژگی‌های این پکیج
            $rows = [];

            foreach ($packageData['attributes'] ?? [] as $attribute) {
                $attributeId = $attribute['attribute_id'] ?? null;

                if (!$attributeId) {
                    continue;
                }

                // جلوگیری از ثبت یک ویژگی تکراری برای همین پکیج
                $value = collect($attribute['values'] ?? [])
                    ->filter(fn($value) => $value !== null && $value !== '')
                    ->unique()
                    ->first();

                if ($value === null) {
                    continue;
                }

                $rows[] = [
                    'product_id' => $productId,
                    'package_id' => $packageId,
                    'attribute_id' => $attributeId,
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // ثبت ویژگی‌های پکیج
            if (!empty($rows)) {
                package_attribute::insert($rows);
            }
        }
    }

    /**
     * تبدیل ردیف‌های ویژگی (هر مقدار یک ردیف) به ساختار فرم:
     * [{ attribute_id, values: [...] }]
     */
    private function groupAttributes($rows)
    {
        return $rows->groupBy('attribute_id')->map(function ($items, $attributeId) {
            return [
                'attribute_id' => (int) $attributeId,
                'values' => $items->pluck('value')->values(),
            ];
        })->values();
    }

    // ============================================================
    // ساخت محصول
    // ============================================================

    public function create()
    {
        $categories = category::with('attributes')->get();

        $setting = homeSetting::document();

        return view('admin.product.create', [
            'categories' => $categories,
            'categoriesData' => $this->buildCategoriesData($categories),
            'setting' => $setting,
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validated = $request->validate(
            $this->productRules(false),
            $this->productMessages()
        );

        $uploadedFiles = [];

        DB::beginTransaction();

        try {
            $productId = product::insertGetId([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'summary' => $validated['summary'] ?? null,
                'count' => $validated['count'],
                'primary_price' => $validated['primary_price'] ?? null,
                'secondary_price' => $validated['secondary_price'] ?? null,
                'show_in_home' => $request->boolean('show_in_home') ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $categoryRows = [];
            foreach ($validated['category_ids'] as $categoryId) {
                $categoryRows[] = [
                    'product_id' => $productId,
                    'category_id' => $categoryId,
                ];
            }
            category_product::insert($categoryRows);

            $this->storeMedia($productId, $validated['mainImage'], true, $uploadedFiles);

            foreach ($validated['gallery'] ?? [] as $galleryImage) {
                $this->storeMedia($productId, $galleryImage, false, $uploadedFiles);
            }

            $this->saveProductAttributes($productId, $validated['attributes'] ?? []);
            $this->savePackages($productId, $validated['packages'] ?? []);

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            foreach ($uploadedFiles as $filePath) {
                Storage::disk('public')->delete($filePath);
            }

            throw $exception;
        }

        return to_route('product.adminIndex')
            ->with('message', 'محصول ' . $validated['title'] . ' ایجاد شد.');
    }

    // ============================================================
    // لیست محصولات (ادمین)
    // ============================================================

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

    // ============================================================
    // دریافت اطلاعات محصول برای پاپ‌آپ ویرایش (ajax)
    // ============================================================

    public function edit(Request $request)
    {
        $product = product::with(['media', 'categories'])->findOrFail($request['id']);

        // مسیر کامل تصاویر
        $product->media->each(function ($media) {
            $media->media_path = asset('storage/' . $media->media_path);
        });

        // ویژگی‌های عمومی (گروه‌بندی‌شده بر اساس ویژگی)
        $attributes = $this->groupAttributes(
            product_attributes::where('product_id', $product->id)->get()
        );

        // ویژگی‌های همه پکیج‌ها (یک بار کوئری، گروه‌بندی بر اساس پکیج)
        $packageAttributes = package_attribute::where('product_id', $product->id)
            ->get()
            ->groupBy('package_id');

        $packages = package::where('product_id', $product->id)->get()->map(
            function ($package) use ($packageAttributes) {
                return [
                    'count' => $package->count,
                    'primary_price' => $package->primary_price,
                    'secondary_price' => $package->secondary_price,
                    'attributes' => $this->groupAttributes(
                        $packageAttributes->get($package->id, collect())
                    ),
                ];
            }
        )->values();

        $productData = $product->toArray();
        $productData['attributes'] = $attributes;
        $productData['packages'] = $packages;

        $categories = category::with('attributes')->get();

        return response()->json([
            'product' => $productData,
            'cats' => $categories->map(fn($category) => [
                'id' => $category->id,
                'title' => $category->title,
            ])->values(),
            'catIds' => $product->categories->pluck('id'),
            'categoriesData' => $this->buildCategoriesData($categories),
        ]);
    }

    // ============================================================
    // به‌روزرسانی محصول
    // ============================================================

    public function update(Request $request)
    {
        $validated = $request->validate(
            $this->productRules(true),
            $this->productMessages()
        );

        $product = product::findOrFail($request->input('product_id'));
        $oldTitle = $product->title;

        $uploadedFiles = [];
        $filesToDelete = [];

        DB::beginTransaction();

        try {
            $product->title = $validated['title'];
            $product->description = $validated['description'] ?? null;
            $product->summary = $validated['summary'] ?? null;
            $product->count = $validated['count'];
            $product->primary_price = $validated['primary_price'] ?? null;
            $product->secondary_price = $validated['secondary_price'] ?? null;
            $product->show_in_home = $request->boolean('show_in_home') ? 1 : 0;
            $product->save();

            // جایگزینی دسته‌بندی‌ها
            category_product::where('product_id', $product->id)->delete();

            $categoryRows = [];
            foreach ($validated['category_ids'] as $categoryId) {
                $categoryRows[] = [
                    'product_id' => $product->id,
                    'category_id' => $categoryId,
                ];
            }
            category_product::insert($categoryRows);

            // حذف تصاویر انتخاب‌شده
            $removed = (array) $request->input('removedImgs', []);
            $removedPaths = array_filter(array_merge(
                [$removed['mainImg'] ?? null],
                (array) ($removed['gallery'] ?? [])
            ));

            foreach ($removedPaths as $path) {
                $query = product_media::where('product_id', $product->id)
                    ->where('media_path', $path);

                $filesToDelete = array_merge(
                    $filesToDelete,
                    $query->pluck('media_path')->all()
                );

                $query->delete();
            }

            // جایگزینی تصویر اصلی در صورت آپلود تصویر جدید
            if ($request->hasFile('mainImage')) {
                $oldMain = product_media::where('product_id', $product->id)
                    ->where('is_main', 1);

                $filesToDelete = array_merge(
                    $filesToDelete,
                    $oldMain->pluck('media_path')->all()
                );

                $oldMain->delete();

                $this->storeMedia(
                    $product->id,
                    $validated['mainImage'],
                    true,
                    $uploadedFiles
                );
            }

            // ذخیره تصاویر جدید گالری
            foreach ($validated['gallery'] ?? [] as $galleryImage) {
                $this->storeMedia(
                    $product->id,
                    $galleryImage,
                    false,
                    $uploadedFiles
                );
            }

            // حذف ویژگی‌ها و پکیج‌های قدیمی
            product_attributes::where('product_id', $product->id)->delete();
            package_attribute::where('product_id', $product->id)->delete();
            package::where('product_id', $product->id)->delete();

            // ثبت مجدد ویژگی‌ها و پکیج‌ها
            $this->saveProductAttributes($product->id, $validated['attributes'] ?? []);
            $this->savePackages($product->id, $validated['packages'] ?? []);

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            foreach ($uploadedFiles as $filePath) {
                Storage::disk('public')->delete($filePath);
            }

            throw $exception;
        }

        // حذف فایل‌های قدیمی پس از موفقیت تراکنش
        foreach (array_unique($filesToDelete) as $filePath) {
            Storage::disk('public')->delete($filePath);
        }

        return to_route('product.adminIndex')
            ->with('message', 'محصول ' . $oldTitle . ' به‌روزرسانی شد.');
    }

    // ============================================================
    // حذف محصول
    // ============================================================

    public function delete($id)
    {
        $product = product::find($id);
        if ($product) {
            foreach ($product->media as $media) {
                Storage::disk('public')->delete($media['media_path']);
            }
            $product->media()->delete();
            package_attribute::where('product_id', $product->id)->delete();
            package::where('product_id', $product->id)->delete();
            $product->attributes()->delete();
            $product->categories()->detach();
            $product->delete();
        } else {
            return to_route('product.adminIndex')->with('message', ' چنین محصولی وجود ندارد.');
        }
        return to_route('product.adminIndex')->with('message', ' محصول ' . $product['title'] . ' حذف شد. ');
    }

    // ============================================================
    // بخش کاربران (بدون تغییر)
    // ============================================================

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
