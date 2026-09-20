<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\category_product;
use App\Models\logo;
use App\Models\product;
use App\Models\carts;
use App\Models\product_attributes;
use App\Models\product_media;
use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Log;

class ProductController extends Controller
{
    public function create()
    {
        $logo = logo::first();
        $cats = category::all();
        return view('admin.product.create', ['logo' => $logo, 'categories' => $cats]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => ['required'],
                'mainImage' => ['max:100'],
                'gallery.*' => ['max:500'],
                'category_ids' => ['required'],
            ],
            [
                'title.required' => 'پر کردن این فیلد الزامی است.',
                'mainImage.max' => 'حجم فایل نباید بیشتر از 100 کیلوبایت باشد.',
                'gallery.*.max' => 'حجم کل فایل ها نباید بیشتر از 500 کیلوبایت باشد.',
                'category_ids.required' => 'پر کردن این فیلد الزامی است.',
            ]
        );
        $product = product::create([
            'title' => $request->title,
            'description' => $request->description,
            'summary' => $request->summary,
            'primary_price' => $request->primary_price,
            'secondary_price' => $request->secondary_price,
            'count' => $request->count,
            'show_in_home' => $request->show_in_home ?? 0,
        ]);
        if (isset($request['category_ids'])) {
            foreach ($request['category_ids'] as $cat_id) {
                category_product::create([
                    'product_id' => $product['id'],
                    'category_id' => $cat_id
                ]);
            }
        }
        if (isset($request['attributes'])) {
            foreach ($request['attributes']['attribute_key'] as $index => $key) {
                product_attributes::create([
                    'product_id' => $product['id'],
                    'attribute_key' => $key,
                    'attribute_value' => $request['attributes']['attribute_value'][$index]
                ]);
            }
        }
        if (isset($request['mainImage'])) {
            $img_type = $request->mainImage->getClientOriginalExtension();
            $img_path = $request->mainImage->store('productImgs', 'public');
            product_media::create([
                'product_id' => $product['id'],
                'media_type' => $img_type,
                'media_path' => $img_path,
                'is_main' => 1
            ]);
        }
        if (isset($request['gallery'])) {
            foreach ($request['gallery'] as $file) {
                $img_type = $file->getClientOriginalExtension();
                $img_path = $file->store('productImgs', 'public');
                product_media::create([
                    'product_id' => $product['id'],
                    'media_type' => $img_type,
                    'media_path' => $img_path,
                    'is_main' => 0
                ]);
            }
        }
        return to_route('product.create')->with('message', ' محصول ' . $product['title'] . ' ایجاد شد ');
    }
    public function adminIndex()
    {
        $logo = logo::first();
        $products = product::with('media')->with('categories')->get();
        foreach ($products as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media['is_main']) {
                        $product['mainImg']  = $media['media_path'];
                        break;
                    } else {
                        $product['mainImg'] = 'default.jpg';
                    }
                }
            } else {
                $product['mainImg'] = 'default.jpg';
            }
        }
        return view('admin.product.index', ['products' => $products, 'logo' => $logo]);
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
        // dd($product);
        $logo = logo::first();
        $services = service::all();
        $categories = category::with('products')->has('products')->get();
        if ($product->media->isNotEmpty()) {
            foreach ($product->media as $media) {
                if ($media['is_main']) {
                    $product['mainImg']  = $media['media_path'];
                    break;
                } else {
                    $product['mainImg'] = 'default.jpg';
                }
            }
        } else {
            $product['mainImg'] = 'default.jpg';
        }
        $cartCount = 0;
        $currentUser = null;
        $cart = null;
        $allCartCount = 0;
        if (Auth::check()) {
            $currentUser = Auth::user();
            $cartt = carts::where('product_id', $product->id)->where('user_id', Auth::id())->where('order_id', null)->first();
            foreach ($currentUser->carts as $cart) {
                if ($cart->order_id == null) {
                    $cartCount = $cart->quantity;
                    // $cartCount= 0;
                }
            }
            $allCarts = carts::select('user_id', 'order_id', 'quantity', 'product_id')->where('user_id', Auth::id())->where('order_id', null)->get();
            if (count($allCarts)) {
                foreach ($allCarts as $allCart) {
                    $allCartCount += $allCart->quantity;
                }
            }
        }
        $proIds = [];
        if (isset($allCarts)) {
            foreach ($allCarts as $pro) {
                $proIds[] = $pro->product_id;
            }
        }
        return view('user.product.show', [
            'product' => $product,
            'logo' => $logo,
            'services' => $services,
            'cartCount' => $cartCount,
            'cart' => isset($cartt) ? $cartt : null,
            'categories' => $categories,
            'allCartCount' => $allCartCount,
            'proIds' => $proIds
        ]);
    }
    public function index()
    {
        $logo = logo::first();
        $services = service::all();
        $categories = category::with('products')->has('products')->get();
        $products = product::all();
        foreach ($products as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media['is_main']) {
                        $product['mainImg']  = $media['media_path'];
                        break;
                    } else {
                        $product['mainImg'] = 'default.jpg';
                    }
                }
            } else {
                $product['mainImg'] = 'default.jpg';
            }
        }
        $cartCount = 0;
        $cart = null;
        $allCartCount = 0;
        if (Auth::check()) {
            $allCarts = carts::select('user_id', 'order_id', 'quantity')->where('user_id', Auth::id())->where('order_id', null)->get();
            if (count($allCarts)) {
                foreach ($allCarts as $allCart) {
                    $allCartCount += $allCart->quantity;
                }
            }
        }
        return view('user.product.index', [
            'logo' => $logo,
            'services' => $services,
            'categories' => $categories,
            'products' => $products,
            'cartCount' => $cartCount,
            'cart' => $cart,
            'allCartCount' => $allCartCount
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
        $logo = logo::first();
        $services = service::all();
        $categories = category::with('products')->has('products')->get();
        foreach ($products as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media['is_main']) {
                        $product['mainImg']  = $media['media_path'];
                        break;
                    } else {
                        $product['mainImg'] = 'default.jpg';
                    }
                }
            } else {
                $product['mainImg'] = 'default.jpg';
            }
        }
        return view('user.product.index', [
            'logo' => $logo,
            'services' => $services,
            'categories' => $categories,
            'products' => $products,
            'catIds' => $request['selectedCats']
        ]);
    }
    public function search(Request $request)
    {
        // $product = product::where('title', 'like', '%' . $request['title'] . '%')->orWhere('summary', 'like', '%' . $request['title'] . '%')->orWhere('description', 'like', '%' . $request['title'] . '%')->get();
        $products = product::where('title', 'like', '%' . $request['title'] . '%')->with('media')->get();
        return response()->json($products);
    }
    public function searchResult(Request $request)
    {
        $products = product::where('title', 'like', '%' . $request['searchedValue'] . '%')->get();
        $logo = logo::first();
        $services = service::all();
        $categories = category::with('products')->has('products')->get();
        foreach ($products as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media['is_main']) {
                        $product['mainImg']  = $media['media_path'];
                        break;
                    } else {
                        $product['mainImg'] = 'default.jpg';
                    }
                }
            } else {
                $product['mainImg'] = 'default.jpg';
            }
        }
        return view('user.product.index', [
            'logo' => $logo,
            'services' => $services,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
