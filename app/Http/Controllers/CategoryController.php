<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\attribute;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Log;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = category::select('id', 'title')->get();
        // $logo = logo::first();
        $setting = homeSetting::document();
        return view('admin.category.create', [
            'categories' => $categories,
            'setting' => $setting
            // 'logo' => $logo
        ]);
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate(
    //         [
    //             'title' => ['required'],
    //             'image' => ['max:100']
    //         ],
    //         [
    //             'title.required' => 'پر کردن این فیلد الزامی است.',
    //             'image.max' => 'حجم فایل نباید بیشتر از 100 کیلوبایت باشد',
    //         ]
    //     );
    //     if ($request['image']) {
    //         $img_path = $request->image->store('categoryImgs', 'public');
    //     } else {
    //         $img_path = null;
    //     }
    //     $category = category::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'parent_id' => $request->parent_id,
    //         'image' => $img_path
    //     ]);
    //     if (isset($request->attributes)) {
    //         foreach ($request->attributes as $attribute) {
    //             attribute::create([
    //                 'category_id' => $category->id,
    //                 'key' => $attribute
    //             ]);
    //         }
    //     }
    //     return redirect()->back()->with('message', 'دسته ' . $category->title . ' با موفقیت ایجاد شد');
    // }

    public function store(Request $request)
    {
        if ($request->parent_id == 0) {
            $request->merge(['parent_id' => null]);
        }
        $validated = $request->validate(
            [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'parent_id' => ['nullable', 'exists:categories,id'],
                'image' => ['nullable', 'image', 'max:2048'],
                'attributes' => ['nullable', 'array'],
            ],
            [
                'title.required' => 'پر کردن این فیلد الزامی است.',
                'title.max' => 'عنوان نباید بیشتر از ۲۵۵ کاراکتر باشد.',
                'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
                'image.max' => 'حجم فایل نباید بیشتر از ۲ مگابایت باشد.',
                'parent_id.exists' => 'دسته والد انتخاب‌شده معتبر نیست.',
            ]
        );
        // تصویر
        $img_path = null;
        if ($request->hasFile('image')) {
            $img_path = $request->file('image')->store('categoryImgs', 'public');
        }

        // ایجاد دسته
        $category = Category::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'parent_id' => $validated['parent_id'] ?? 0,
            'image' => $img_path,
        ]);

        // ویژگی‌ها — فقط موارد غیرخالی
        if (!empty($validated['attributes'])) {
            $rows = collect($validated['attributes'])
                ->map(fn($v) => trim((string) $v))
                ->filter(fn($v) => $v !== '')
                ->map(fn($v) => ['key' => $v])
                ->values()
                ->all();
            if (!empty($rows)) {
                $category->attributes()->createMany($rows);
            }
        }

        return redirect()
            ->back()
            ->with('message', 'دسته «' . $category->title . '» با موفقیت ایجاد شد.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:categories,id',
        ])['ids'];

        Category::whereIn('id', $ids)->delete();
        return back()->with('message', 'دسته‌بندی‌های انتخاب‌شده حذف شدند.');
    }

    public function adminIndex()
    {
        $cats = category::all();
        // $logo = logo::first();
        $setting = homeSetting::document();
        return view('admin.category.index', [
            'categories' => $cats,
            // 'logo' => $logo
            'setting' => $setting
        ]);
    }

    public function showChildren($param)
    {
        $text = '<ul class="mr-5">';
        foreach ($param as $child) {
            $text .= '<li class="list-decimal list-inside"><span class="text-sm text-slate-500">' . $child['title'] . '</span></li>';
            if (count($child['children']) > 0) {
                $text .= $this->showChildren($child['children']);
            }
        }
        $text .= '</ul>';
        return $text;
    }

    // public function adminShow(Request $request)
    // {
    //     $category = category::find($request['id']);
    //     $category['subCats'] = $this->showChildren($category->children);
    //     $category->parent;
    //     if ($category->image) {
    //         $category->image = asset('storage/' . $category['image']);
    //     }
    //     return response()->json($category);
    // }

    public function adminShow(Request $request)
    {
        $category = Category::with(['parent', 'children', 'attributes'])->findOrFail($request->id);
        return response()->json([
            'title' => $category->title,
            'description' => $category->description,
            'image' => $category->image ? asset('storage/' . $category->image) : null,
            'parent' => $category->parent ? ['title' => $category->parent->title] : null,
            'subCats' => $category->children->map(
                fn($c) => '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs bg-amber-50 text-amber-700 border border-amber-100">'
                    . e($c->title) . '</span>'
            )->implode(''),
            'attributes' => $category->attributes->pluck('key'),  // ← key
        ]);
    }

    // public function edit(Request $request)
    // {
    //     $category = category::find($request['id']);
    //     $categories = category::all();
    //     if ($category->image) {
    //         $category->image = asset('storage/' . $category['image']);
    //     }
    //     return response()->json(['cat' => $category, 'cats' => $categories]);
    // }
    public function edit(Request $request)
    {
        $cat = Category::with('attributes')->findOrFail($request->id);

        return response()->json([
            'cat' => $cat,
            'attributes' => $cat->attributes->pluck('key')->values(),  // ← این خط
            'cats' => Category::where('id', '!=', $cat->id)->get(['id', 'title']),
        ]);
    }

    // public function update(Request $request)
    // {
    //     $validated = $request->validate(
    //         [
    //             'title' => ['required'],
    //             'image' => ['max:100'],
    //         ],
    //         [
    //             'title.required' => 'پر کردن این فیلد الزامی است.',
    //             'image.max' => 'حجم فایل نباید بیشتر از 100 کیلوبایت باشد.',
    //         ]
    //     );
    //     if (isset($request['removedImg'])) {
    //         Storage::disk('public')->delete($request['removedImg']);
    //         $category = category::where('image', $request['removedImg'])->first();
    //         $category->image = null;
    //         $category->save();
    //     }
    //     $category = category::find($request['cat_id']);
    //     if (isset($request['image'])) {
    //         if ($category['image']) {
    //             Storage::disk('public')->delete($category['image']);
    //         }
    //         $img_path = $request->image->store('categoryImgs', 'public');
    //     } else {
    //         $img_path = $category['image'];
    //     }
    //     $name = $category->title;
    //     $category->title = $request['title'];
    //     $category->description = $request['description'];
    //     $category->parent_id = $request['parent_id'];
    //     $category->image = $img_path;
    //     $category->save();
    //     return to_route('category.adminIndex')->with('message', 'دسته بندی ' . $name . ' به روزرسانی شد.');
    // }

    public function update(Request $request)
    {

        if ($request->parent_id == 0) {
            $request->merge(['parent_id' => null]);
        }
        
        $data = $request->validate([
            'cat_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
            'attributes' => ['nullable', 'array'],
            'attributes.*' => ['nullable', 'string', 'max:255'],
            'removedImg' => ['nullable', 'string'],
        ]);

        $category = category::findOrFail($data['cat_id']);

        // تصویر
        $img_path = $category->image;
        if ($request->filled('removedImg') && $category->image) {
            \Storage::disk('public')->delete($category->image);
            $img_path = null;
        }
        if ($request->hasFile('image')) {
            if ($category->image)
                \Storage::disk('public')->delete($category->image);
            $img_path = $request->file('image')->store('categoryImgs', 'public');
        }

        $category->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'parent_id' => $data['parent_id'] ?? 0,
            'image' => $img_path,
        ]);

        // ویژگی‌ها: پاک و درج مجدد
        if (!empty($data['attributes'])) {
            $category->attributes()->delete();
            $rows = collect($data['attributes'])
                ->map(fn($v) => trim((string) $v))
                ->filter(fn($v) => $v !== '')
                ->map(fn($v) => ['key' => $v])
                ->values()
                ->all();

            if (!empty($rows)) {
                $category->attributes()->createMany($rows);
            }
        }
        return redirect()->back()->with('message', 'دسته‌بندی به‌روزرسانی شد.');
    }

    public function delete($id)
    {
        $category = category::find($id);
        if ($category) {
            if ($category['image']) {
                Storage::disk('public')->delete($category['image']);
            }
            $name = $category['title'];
            $category->delete();
        } else {
            return to_route('category.adminIndex')->with('message', 'چنین دسته بندی وجود ندارد.');
        }
        return to_route('category.adminIndex')->with('message', 'دسته بندی ' . $name . ' حذف شد.');
    }

    public function relatedProducts(category $category)
    {
        // return $category;
        // $logo = logo::first();
        // $services = service::all();
        $categories = category::with('products')->has('products')->get();
        $products = $category->products;
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
            'currentCat' => $category,
            'categories' => $categories,
            'products' => $products,
            'setting' => $setting
        ]);
    }

    // public function showSubCats(Request $request)
    // {
    //     $category = category::find($request['catId'])->load('children');
    //     return response()->json($category);
    // }

    public function index()
    {
        $products = product::all();

        $user = Auth::user();
        $cats = category::all();
        $setting = homeSetting::document();
        return view('user.category.index', [
            'products' => $products,
            'setting' => $setting,
            'categories' => $cats,
            'user' => $user
        ]);
    }

    // public function show(category $category)
    // {
    //     $courses = course::all();
    //     $products = product::where('category_id', $category->id)->get();
    //     $products = $this->getProductMedias($products);
    //     $cats = category::all();
    //     $settings = settings::all();
    //     $logo = logo::first();
    //     $footer_columns = footer_column::whereIn('section_number', [1, 2, 3])->with('rows')->get();
    //     $footer_form_column = footer_column::where('section_number', 4)->with('images')->with('texts')->first();
    //     $user = Auth::user();
    //     return view('user.category.show', [
    //         'courses' => $courses,
    //         'products' => $products,
    //         'categories' => $cats,
    //         'settings' => $settings,
    //         'category' => $category,
    //         'logo' => $logo,
    //         'footerColumns' => $footer_columns,
    //         'footer_form_column' => $footer_form_column,
    //         'user' => $user
    //     ]);
    // }

    // public function deleteAll(Request $request)
    // {
    //     if (!isset($request->categories)) {
    //         return redirect()->back();
    //     }
    //     foreach ($request->categories as $category_id) {
    //         $category = category::find($category_id);
    //         $category->delete();
    //     }
    //     return redirect()->back();
    // }
}
