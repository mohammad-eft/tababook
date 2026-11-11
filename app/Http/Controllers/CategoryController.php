<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\attribute;
use App\Models\category;
use App\Models\package_attribute;
use App\Models\product;
use App\Models\product_attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;
use Log;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = category::select('id', 'title')->get();
        $setting = homeSetting::document();
        return view('admin.category.create', [
            'categories' => $categories,
            'setting' => $setting
        ]);
    }

    public function store(Request $request)
    {
        $this->normalizeParent($request);
        $this->normalizeAttributes($request);
        $data = $request->validate($this->rules(), $this->messages());
        array_unshift($data['attributes'], ['id' => null, 'key' => 'رنگ']);

        $imgPath = null;
        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $fullName = time() . '_' . $name;
            $imgPath = $request->file('image')->storeAs('categoryImgs', $fullName, 'public');
        }

        $category = category::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'parent_id' => $data['parent_id'] ?? 0,  // ۰ = بدون والد (مثل قبل)
            'image' => $imgPath,
        ]);

        $this->syncAttributes($category, $data['attributes'] ?? []);

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

        category::whereIn('id', $ids)->delete();
        return back()->with('message', 'دسته‌بندی‌های انتخاب‌شده حذف شدند.');
    }

    public function adminIndex()
    {
        $cats = category::all();
        $setting = homeSetting::document();
        return view('admin.category.index', [
            'categories' => $cats,
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

    public function adminShow(Request $request)
    {
        $category = category::with(['parent', 'children', 'attributes'])->findOrFail($request->id);
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

    public function edit(Request $request)
    {
        $cat = category::findOrFail($request->id);

        return response()->json([
            'cat' => $cat,
            'attributes' => $cat
                ->attributes()
                ->where('key', '!=', 'رنگ')
                ->get(['id', 'key']),
            'cats' => category::where('id', '!=', $cat->id)->get(['id', 'title']),
        ]);
    }

    public function update(Request $request)
    {
        $this->normalizeParent($request);
        $this->normalizeAttributes($request);

        $data = $request->validate($this->rules(), $this->messages());

        $category = category::findOrFail($request->input('cat_id'));

        // تصویر
        $img_path = $category->image;
        if ($request->filled('removedImg') && $category->image) {
            Storage::disk('public')->delete($category->image);
            $img_path = null;
        }
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $img_path = $request->file('image')->store('categoryImgs', 'public');
        }

        $category->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'parent_id' => $data['parent_id'] ?? 0,
            'image' => $img_path,
        ]);

        $attributes = $data['attributes'] ?? [];

        $colorId = $category->attributes()->where('key', 'رنگ')->value('id');

        // اگه کاربر خودش «رنگ» فرستاده، تکراری نشه
        $attributes = array_values(array_filter(
            $attributes,
            fn($a) => trim((string) ($a['key'] ?? '')) !== 'رنگ'
        ));

        array_unshift($attributes, ['id' => $colorId, 'key' => 'رنگ']);

        $this->syncAttributes($category, $attributes);

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

    private function normalizeParent(Request $request): void
    {
        if ($request->parent_id == 0) {
            $request->merge(['parent_id' => null]);
        }
    }

    private function normalizeAttributes(Request $request): void
    {
        $raw = $request->input('attributes', []);
        if (!is_array($raw)) {
            $raw = [];
        }

        $clean = [];
        foreach ($raw as $item) {
            if (is_string($item)) {
                $item = ['id' => null, 'key' => $item];
            }
            if (!is_array($item)) {
                continue;
            }

            $key = trim((string) ($item['key'] ?? ''));
            if ($key === '') {
                continue;
            }

            $id = $item['id'] ?? null;
            $clean[] = [
                'id' => ($id === '' || $id === null) ? null : $id,
                'key' => $key,
            ];
        }

        $request->merge(['attributes' => $clean]);
    }

    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
            'attributes' => ['nullable', 'array'],
            'attributes.*.id' => ['nullable', 'integer'],
            'attributes.*.key' => ['nullable', 'string', 'max:255'],
            // 'attributes.*.type' => ['nullable', 'in:text,color'],
        ];
    }

    private function messages(): array
    {
        return [
            'title.required' => 'پر کردن این فیلد الزامی است.',
            'title.max' => 'عنوان نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.max' => 'حجم فایل نباید بیشتر از ۲ مگابایت باشد.',
            'parent_id.exists' => 'دسته والد انتخاب‌شده معتبر نیست.',
            // 'attributes.*.type.in' => 'نوع ویژگی فقط می‌تواند متن یا رنگ باشد.',
        ];
    }

    /**
     * ویژگی‌های دسته رو با id سینک می‌کنه:
     *  - ردیف با id موجود  → آپدیت (id ثابت می‌مونه و مقدارهای ثبت‌شده توی محصول‌ها سالم می‌مونن)
     *  - ردیف بدون id      → ساخت
     *  - ردیف حذف‌شده      → حذف همراه با مقدارهای وابسته (چون cascade نداریم)
     */
    private function syncAttributes(category $category, array $items): void
    {
        $rows = collect($items)
            ->map(fn($i) => [
                'id' => $i['id'] ?? null,
                'key' => trim((string) ($i['key'] ?? '')),
            ])
            ->filter(fn($i) => $i['key'] !== '')
            ->unique('key')
            ->values();

        $keep = [];
        foreach ($rows as $row) {
            $attr = $category->attributes()->updateOrCreate(
                ['id' => $row['id'] ?: null],
                ['key' => $row['key']]
            );
            $keep[] = $attr->id;
        }

        $removedIds = $category->attributes()->whereNotIn('id', $keep)->pluck('id');
        if ($removedIds->isNotEmpty()) {
            package_attribute::whereIn('attribute_id', $removedIds)->delete();
            product_attributes::whereIn('attribute_id', $removedIds)->delete();
            attribute::whereIn('id', $removedIds)->delete();
        }
    }
}
