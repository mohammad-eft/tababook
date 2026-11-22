<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\category;
use App\Models\category_product;
use App\Models\package;
use App\Models\publication;
use App\Models\brand;
use App\Models\package_attribute;
use App\Models\product;
use App\Models\product_attributes;
use App\Models\product_media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /*
     * |--------------------------------------------------------------------------
     * | تنظیمات و توابع کمکی
     * |--------------------------------------------------------------------------
     */

    private function getProductCategoryIds(array $categoryIds): array
    {
        if (!empty($categoryIds)) {
            return $categoryIds;
        }

        $category = category::firstOrCreate(
            [
                'title' => 'بدون دسته‌بندی',
                'parent_id' => 0,
            ],
            [
                'description' => null,
                'image' => null,
            ]
        );

        return [$category->id];
    }

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

    private function productRules(bool $isUpdate): array
    {
        return [
            // شناسه محصول فقط برای ویرایش
            'product_id' => $isUpdate
                ? ['required', 'integer', 'exists:products,id']
                : ['prohibited'],
            // اطلاعات عمومی
            'title' => ['required', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:255'],
            'writer' => ['nullable', 'string', 'max:255'],
            'publication' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'summary' => ['nullable', 'string'],
            // موجودی و قیمت
            'count' => ['nullable', 'integer', 'min:0'],
            'primary_price' => ['nullable', 'integer', 'min:0'],
            'secondary_price' => ['nullable', 'integer', 'min:0'],
            'show_in_home' => ['nullable', 'boolean'],
            // دسته‌بندی‌ها
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:categories,id',
            ],
            // تصاویر
            'mainImage' => ['nullable', 'image', 'max:5120'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:1024'],
            // ویژگی‌های عمومی
            'attributes' => ['nullable', 'array'],
            'attributes.*' => ['required', 'array'],
            'attributes.*.attribute_id' => [
                'required',
                'integer',
                'exists:attributes,id',
            ],
            'attributes.*.values' => ['nullable', 'array'],
            'attributes.*.values.*' => ['nullable', 'string', 'max:255'],
            // پکیج‌ها
            'packages' => ['nullable', 'array'],
            'packages.*' => ['required', 'array'],
            'packages.*.count' => ['required', 'integer', 'min:1'],
            'packages.*.primary_price' => ['nullable', 'integer', 'min:0'],
            'packages.*.secondary_price' => ['nullable', 'integer', 'min:0'],
            'packages.*.attributes' => ['nullable', 'array'],
            'packages.*.attributes.*' => ['required', 'array'],
            'packages.*.attributes.*.attribute_id' => [
                'required',
                'integer',
                'exists:attributes,id',
            ],
            'packages.*.attributes.*.values' => ['nullable', 'array'],
            'packages.*.attributes.*.values.*' => [
                'nullable',
                'string',
                'max:255',
            ],
            // درخت ویژگی‌های محصول
            'product_features' => ['nullable', 'array'],
        ];
    }

    private function productMessages(): array
    {
        return [
            'title.required' => 'وارد کردن نام محصول الزامی است.',
            'title.string' => 'نام محصول باید متن باشد.',
            'title.max' => 'نام محصول نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'product_id.required' => 'شناسه محصول برای ویرایش ارسال نشده است.',
            'product_id.exists' => 'محصول موردنظر پیدا نشد.',
            'count.integer' => 'موجودی باید عدد صحیح باشد.',
            'count.min' => 'موجودی نمی‌تواند منفی باشد.',
            'primary_price.integer' => 'قیمت اصلی باید عدد صحیح باشد.',
            'secondary_price.integer' => 'قیمت ویژه باید عدد صحیح باشد.',
            'category_ids.*.exists' => 'یکی از دسته‌بندی‌های انتخاب‌شده معتبر نیست.',
            'mainImage.image' => 'فایل تصویر اصلی باید یک تصویر معتبر باشد.',
            'mainImage.max' => 'حجم تصویر اصلی نباید بیشتر از ۵ مگابایت باشد.',
            'gallery.*.image' => 'فایل‌های گالری باید تصویر باشند.',
            'gallery.*.max' => 'حجم هر تصویر گالری نباید بیشتر از یک مگابایت باشد.',
            'packages.*.count.required' => 'تعداد هر محصول متغیر الزامی است.',
            'packages.*.count.min' => 'تعداد محصول متغیر باید حداقل یک باشد.',
        ];
    }

    /*
     * |--------------------------------------------------------------------------
     * | اعتبارسنجی ویژگی‌ها و درخت محصول
     * |--------------------------------------------------------------------------
     */

    private function validateProductRequest(
        Request $request,
        bool $isUpdate
    ): array {
        $validator = Validator::make(
            $request->all(),
            $this->productRules($isUpdate),
            $this->productMessages()
        );

        $validator->after(function ($validator) use ($request) {
            // دسته‌بندی‌های معتبر انتخاب‌شده
            $categoryIds = $request->input('category_ids', []);

            if (!is_array($categoryIds)) {
                $categoryIds = [];
            }

            $categoryIds = collect($categoryIds)
                ->filter(fn($id) => is_numeric($id))
                ->map(fn($id) => (int) $id)
                ->unique()
                ->values();

            // ویژگی‌های مجاز دسته‌بندی‌ها
            $allowedAttributeIds = DB::table('attributes')
                ->whereIn('category_id', $categoryIds)
                ->pluck('id')
                ->map(fn($id) => (int) $id)
                ->all();

            $allowedAttributeIds = array_flip($allowedAttributeIds);

            // ویژگی‌های عمومی
            $attributes = $request->input('attributes', []);

            if (is_array($attributes)) {
                foreach ($attributes as $index => $attribute) {
                    if (!is_array($attribute)) {
                        continue;
                    }

                    $attributeId = (int) ($attribute['attribute_id'] ?? 0);

                    if (!isset($allowedAttributeIds[$attributeId])) {
                        $validator->errors()->add(
                            "attributes.$index.attribute_id",
                            'این ویژگی متعلق به دسته‌بندی‌های انتخاب‌شده نیست.'
                        );
                    }
                }
            }

            // ویژگی‌های پکیج‌ها
            $packages = $request->input('packages', []);

            if (is_array($packages)) {
                foreach ($packages as $packageIndex => $package) {
                    if (!is_array($package)) {
                        continue;
                    }

                    $packageAttributes = $package['attributes'] ?? [];

                    if (!is_array($packageAttributes)) {
                        continue;
                    }

                    foreach ($packageAttributes as $attributeIndex => $attribute) {
                        if (!is_array($attribute)) {
                            continue;
                        }

                        $attributeId = (int) ($attribute['attribute_id'] ?? 0);

                        if (!isset($allowedAttributeIds[$attributeId])) {
                            $validator->errors()->add(
                                "packages.$packageIndex.attributes.$attributeIndex.attribute_id",
                                'این ویژگی متعلق به دسته‌بندی‌های انتخاب‌شده نیست.'
                            );
                        }
                    }
                }
            }

            // ویژگی‌های درختی
            $productFeatures = $request->input('product_features', []);

            if (!is_array($productFeatures)) {
                $validator->errors()->add(
                    'product_features',
                    'ساختار ویژگی‌های محصول معتبر نیست.'
                );

                return;
            }

            $this->validateFeatureNodes(
                $productFeatures,
                $allowedAttributeIds,
                $validator,
                'product_features',
                []
            );
        });

        return $validator->validate();
    }

    private function validateFeatureNodes(
        array $features,
        array $allowedAttributeIds,
        $validator,
        string $path,
        array $ancestors
    ): void {
        foreach ($features as $featureIndex => $feature) {
            $featurePath = "{$path}.{$featureIndex}";

            if (!is_array($feature)) {
                $validator->errors()->add(
                    $featurePath,
                    'ساختار ویژگی معتبر نیست.'
                );

                continue;
            }

            $attributeId = (int) ($feature['attribute_id'] ?? 0);

            if (
                !$attributeId ||
                !isset($allowedAttributeIds[$attributeId])
            ) {
                $validator->errors()->add(
                    "$featurePath.attribute_id",
                    'ویژگی انتخاب‌شده معتبر نیست یا به دسته‌بندی محصول تعلق ندارد.'
                );
            }

            if (in_array($attributeId, $ancestors, true)) {
                $validator->errors()->add(
                    "$featurePath.attribute_id",
                    'یک ویژگی نمی‌تواند دوباره در مسیر خودش استفاده شود.'
                );
            }

            if (
                empty($feature['name']) ||
                !is_string($feature['name']) ||
                mb_strlen($feature['name']) > 255
            ) {
                $validator->errors()->add(
                    "$featurePath.name",
                    'عنوان ویژگی معتبر نیست.'
                );
            }

            if (
                isset($feature['type']) &&
                !is_string($feature['type'])
            ) {
                $validator->errors()->add(
                    "$featurePath.type",
                    'نوع ویژگی معتبر نیست.'
                );
            }

            // مقادیر ویژگی
            $values = $feature['values'] ?? [];

            if (!is_array($values)) {
                $validator->errors()->add(
                    "$featurePath.values",
                    'مقادیر ویژگی باید به‌صورت آرایه ارسال شوند.'
                );

                continue;
            }

            $defaultValueCount = 0;

            foreach ($values as $valueIndex => $value) {
                $valuePath = "{$featurePath}.values.{$valueIndex}";

                if (!is_array($value)) {
                    $validator->errors()->add(
                        $valuePath,
                        'ساختار مقدار ویژگی معتبر نیست.'
                    );

                    continue;
                }

                if (
                    !isset($value['name']) ||
                    !is_string($value['name']) ||
                    trim($value['name']) === '' ||
                    mb_strlen($value['name']) > 255
                ) {
                    $validator->errors()->add(
                        "$valuePath.name",
                        'عنوان مقدار ویژگی الزامی است.'
                    );
                }

                // مقدار پیش‌فرض باید boolean باشد و در هر گروه فقط یک مقدار پیش‌فرض مجاز است.
                $isDefault = $value['is_default'] ?? false;

                if (!in_array($isDefault, [true, false, 0, 1, '0', '1'], true)) {
                    $validator->errors()->add(
                        "$valuePath.is_default",
                        'وضعیت پیش‌فرض مقدار ویژگی معتبر نیست.'
                    );
                }

                if (in_array($isDefault, [true, 1, '1'], true)) {
                    $defaultValueCount++;
                }

                // بررسی موجودی هر مقدار (موجودی واقعی فقط برای ترکیب‌های نهایی استفاده می‌شود)
                $count = $value['count'] ?? 0;

                if (
                    !is_numeric($count) ||
                    (string) (int) $count !== (string) $count ||
                    (int) $count < 0
                ) {
                    $validator->errors()->add(
                        "$valuePath.count",
                        'موجودی هر ترکیب باید عدد صحیح و بزرگ‌تر یا مساوی صفر باشد.'
                    );
                }

                // بررسی قیمت‌ها
                foreach (['original_price', 'special_price'] as $priceField) {
                    $price = $value[$priceField] ?? null;

                    if (
                        $price !== null &&
                        $price !== '' &&
                        (!is_numeric($price) || $price < 0)
                    ) {
                        $validator->errors()->add(
                            "$valuePath.$priceField",
                            'قیمت باید عددی و بزرگ‌تر یا مساوی صفر باشد.'
                        );
                    }
                }

                // زیرشاخه‌ها
                $children = $value['children'] ?? [];

                if (!is_array($children)) {
                    $validator->errors()->add(
                        "$valuePath.children",
                        'زیرشاخه‌ها باید به‌صورت آرایه ارسال شوند.'
                    );

                    continue;
                }

                if (!empty($children)) {
                    $this->validateFeatureNodes(
                        $children,
                        $allowedAttributeIds,
                        $validator,
                        "$valuePath.children",
                        [...$ancestors, $attributeId]
                    );
                } elseif (in_array($isDefault, [true, 1, '1'], true)) {
                    $validator->errors()->add(
                        "$valuePath.is_default",
                        'فقط مقادیری که زیرشاخه دارند می‌توانند پیش‌فرض باشند.'
                    );
                }
            }

            if ($defaultValueCount > 1) {
                $validator->errors()->add(
                    "$featurePath.values",
                    'در هر گروه از مقادیر، فقط یک مقدار می‌تواند پیش‌فرض باشد.'
                );
            }
        }
    }

    /*
     * |--------------------------------------------------------------------------
     * | ذخیره تصاویر
     * |--------------------------------------------------------------------------
     */

    private function storeMedia(
        int $productId,
        $file,
        bool $isMain,
        array &$uploadedFiles
    ): void {
        $path = $file->store('productImgs', 'public');

        if (!$path) {
            throw new \RuntimeException('ذخیره تصویر با خطا مواجه شد.');
        }

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

    private function normalizeMediaPath(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $path = urldecode($path);

        $urlPath = parse_url($path, PHP_URL_PATH);

        if ($urlPath) {
            $path = $urlPath;
        }

        $position = strpos($path, '/storage/');

        if ($position !== false) {
            return substr($path, $position + strlen('/storage/'));
        }

        return ltrim($path, '/');
    }

    /*
     * |--------------------------------------------------------------------------
     * | ذخیره ویژگی‌های عمومی محصول
     * |--------------------------------------------------------------------------
     */

    private function saveProductAttributes(
        int $productId,
        array $attributes
    ): void {
        $rows = [];

        foreach ($attributes as $attribute) {
            $attributeId = $attribute['attribute_id'] ?? null;

            foreach ($attribute['values'] ?? [] as $value) {
                if ($value === null || trim((string) $value) === '') {
                    continue;
                }

                $rows[] = [
                    'product_id' => $productId,
                    'attribute_id' => $attributeId,
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

    /*
     * |--------------------------------------------------------------------------
     * | ذخیره پکیج‌ها
     * |--------------------------------------------------------------------------
     */

    private function savePackages(
        int $productId,
        array $packages
    ): void {
        foreach ($packages as $packageData) {
            $packageId = package::insertGetId([
                'product_id' => $productId,
                'count' => $packageData['count'],
                'primary_price' => $packageData['primary_price'] ?? null,
                'secondary_price' => $packageData['secondary_price'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $rows = [];

            foreach ($packageData['attributes'] ?? [] as $attribute) {
                $attributeId = $attribute['attribute_id'] ?? null;

                $value = collect($attribute['values'] ?? [])
                    ->filter(fn($item) => $item !== null && $item !== '')
                    ->unique()
                    ->first();

                if ($value === null || !$attributeId) {
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

            if (!empty($rows)) {
                package_attribute::insert($rows);
            }
        }
    }

    private function groupAttributes($rows)
    {
        return $rows
            ->groupBy('attribute_id')
            ->map(function ($items, $attributeId) {
                return [
                    'attribute_id' => (int) $attributeId,
                    'values' => $items->pluck('value')->values(),
                ];
            })
            ->values();
    }

    /*
     * |--------------------------------------------------------------------------
     * | ذخیره درخت ویژگی‌های محصول متغیر
     * |--------------------------------------------------------------------------
     * |
     * | ساختار:
     * |
     * | Feature
     * |   └── Values
     * |         └── Child Features
     * |               └── Values
     * |
     */

    private function saveProductFeatures(
        int $productId,
        array $features,
        ?int $parentValueId = null
    ): void {
        foreach ($features as $featureIndex => $featureData) {
            $featureId = DB::table('product_features')->insertGetId([
                'product_id' => $productId,
                'attribute_id' => $featureData['attribute_id'],
                'parent_value_id' => $parentValueId,
                'name' => $featureData['name'],
                'type' => $featureData['type'] ?? null,
                'sort_order' => $featureIndex,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($featureData['values'] ?? [] as $valueIndex => $valueData) {
                $originalPrice = $valueData['original_price'] ?? null;
                $specialPrice = $valueData['special_price'] ?? null;

                $valueId = DB::table('product_feature_values')->insertGetId([
                    'product_feature_id' => $featureId,
                    'name' => $valueData['name'],
                    'original_price' => (
                        $originalPrice !== '' && $originalPrice !== null
                    ) ? $originalPrice : null,
                    'special_price' => (
                        $specialPrice !== '' && $specialPrice !== null
                    ) ? $specialPrice : null,
                    'count' => (int) ($valueData['count'] ?? 0),
                    'is_default' => filter_var(
                        $valueData['is_default'] ?? false,
                        FILTER_VALIDATE_BOOLEAN
                    ),
                    'sort_order' => $valueIndex,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $children = $valueData['children'] ?? [];

                if (!empty($children)) {
                    $this->saveProductFeatures(
                        $productId,
                        $children,
                        $valueId
                    );
                }
            }
        }
    }

    /*
     * |--------------------------------------------------------------------------
     * | بازیابی درخت ویژگی‌های محصول
     * |--------------------------------------------------------------------------
     */

    private function buildProductFeatureTree(int $productId): array
    {
        $features = DB::table('product_features')
            ->where('product_id', $productId)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $values = DB::table('product_feature_values')
            ->whereIn(
                'product_feature_id',
                $features->pluck('id')
            )
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return $this->buildFeatureNodes(
            $features,
            $values,
            null
        );
    }

    private function buildFeatureNodes(
        $features,
        $values,
        ?int $parentValueId
    ): array {
        return $features
            ->where('parent_value_id', $parentValueId)
            ->values()
            ->map(function ($feature) use ($features, $values) {
                $featureValues = $values
                    ->where('product_feature_id', $feature->id)
                    ->values()
                    ->map(function ($value) use ($features, $values) {
                        return [
                            'id' => (int) $value->id,
                            'name' => $value->name,
                            'original_price' => $value->original_price,
                            'special_price' => $value->special_price,
                            'count' => (int) ($value->count ?? 0),
                            'is_default' => (bool) ($value->is_default ?? false),
                            'children' => $this->buildFeatureNodes(
                                $features,
                                $values,
                                (int) $value->id
                            ),
                        ];
                    });

                return [
                    'attribute_id' => (int) $feature->attribute_id,
                    'name' => $feature->name,
                    'type' => $feature->type,
                    'values' => $featureValues,
                ];
            })
            ->all();
    }

    /*
     * |--------------------------------------------------------------------------
     * | حذف بازگشتی درخت ویژگی‌ها
     * |--------------------------------------------------------------------------
     * |
     * | ابتدا زیرشاخه‌ها حذف می‌شوند، سپس مقادیر و ویژگی والد.
     * | این ترتیب مانع تبدیل زیرشاخه‌ها به ویژگی ریشه می‌شود.
     * |
     */

    private function deleteFeatureTree(int $featureId): void
    {
        $values = DB::table('product_feature_values')
            ->where('product_feature_id', $featureId)
            ->pluck('id');

        foreach ($values as $valueId) {
            $childFeatureIds = DB::table('product_features')
                ->where('parent_value_id', $valueId)
                ->pluck('id');

            foreach ($childFeatureIds as $childFeatureId) {
                $this->deleteFeatureTree((int) $childFeatureId);
            }

            DB::table('product_feature_values')
                ->where('id', $valueId)
                ->delete();
        }

        DB::table('product_features')
            ->where('id', $featureId)
            ->delete();
    }

    private function deleteProductFeatureTree(int $productId): void
    {
        $rootFeatureIds = DB::table('product_features')
            ->where('product_id', $productId)
            ->whereNull('parent_value_id')
            ->pluck('id');

        foreach ($rootFeatureIds as $featureId) {
            $this->deleteFeatureTree((int) $featureId);
        }
    }

    /*
     * |--------------------------------------------------------------------------
     * | ساخت محصول
     * |--------------------------------------------------------------------------
     */

    public function create()
    {
        $categories = category::with('attributes')->get();
        $publications=publication::all();
        $brands=brand::all();
        return view('admin.product.create', [
            'categories' => $categories,
            'categoriesData' => $this->buildCategoriesData($categories),
            'setting' => homeSetting::document(),
            'publications' => $publications,
            'brands' => $brands,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProductRequest($request, false);

        $uploadedFiles = [];

        try {
            DB::transaction(function () use (
                $validated,
                $request,
                &$uploadedFiles
            ) {
                // ایجاد محصول
                $productId = product::insertGetId([
                    'title' => $validated['title'],
                    'description' => $validated['description'] ?? null,
                    'summary' => $validated['summary'] ?? null,
                    'count' => $validated['count'] ?? 0,
                    'primary_price' => $validated['primary_price'] ?? null,
                    'secondary_price' => $validated['secondary_price'] ?? null,
                    'writer' => $validated['writer'] ?? null,
                    'brand_id' => $validated['brand_id'] ?? null,
                    'publication_id' => $validated['publication_id'] ?? null,
                    'show_in_home' => $request->boolean('show_in_home'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // دسته‌بندی‌ها
                $categoryIds = $this->getProductCategoryIds(
                    $validated['category_ids'] ?? []
                );

                $categoryRows = [];

                foreach ($categoryIds as $categoryId) {
                    $categoryRows[] = [
                        'product_id' => $productId,
                        'category_id' => $categoryId,
                    ];
                }

                category_product::insert($categoryRows);

                // تصویر اصلی اختیاری
                if ($request->hasFile('mainImage')) {
                    $this->storeMedia(
                        $productId,
                        $request->file('mainImage'),
                        true,
                        $uploadedFiles
                    );
                }

                // گالری اختیاری
                foreach ($validated['gallery'] ?? [] as $image) {
                    $this->storeMedia(
                        $productId,
                        $image,
                        false,
                        $uploadedFiles
                    );
                }

                // ویژگی‌های عمومی
                $this->saveProductAttributes(
                    $productId,
                    $validated['attributes'] ?? []
                );

                // پکیج‌ها
                $this->savePackages(
                    $productId,
                    $validated['packages'] ?? []
                );

                // درخت ویژگی‌ها
                $this->saveProductFeatures(
                    $productId,
                    $validated['product_features'] ?? []
                );
            });
        } catch (\Throwable $exception) {
            // پاک کردن فایل‌های آپلودشده در صورت شکست تراکنش
            foreach ($uploadedFiles as $path) {
                Storage::disk('public')->delete($path);
            }

            throw $exception;
        }

        return to_route('product.adminIndex')
            ->with(
                'message',
                'محصول ' . $validated['title'] . ' با موفقیت ایجاد شد.'
            );
    }

    /*
     * |--------------------------------------------------------------------------
     * | فهرست محصولات مدیریت
     * |--------------------------------------------------------------------------
     */

    public function adminIndex()
    {
        $products = product::with([
            'media' => function ($query) {
                $query->where('is_main', 1);
            },
            'categories'
        ])->get();

        foreach ($products as $product) {
            $mainMedia = $product->media->first();

            $product->mainImg = $mainMedia
                ? $mainMedia->media_path
                : 'default.jpg';
        }

        $setting = homeSetting::document();
        return view('admin.product.index', [
            'products' => $products,
            'setting' => $setting,
        ]);
    }

    /*
     * |--------------------------------------------------------------------------
     * | دریافت اطلاعات محصول برای ویرایش
     * |--------------------------------------------------------------------------
     */

    public function edit(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $product = product::with([
            'media',
            'categories',
        ])->findOrFail($request->input('id'));

        $product->media->each(function ($media) {
            $media->url = asset('storage/' . $media->media_path);
            $media->media_path = $media->media_path;
        });

        // ویژگی‌های عمومی
        $attributes = $this->groupAttributes(
            product_attributes::where('product_id', $product->id)->get()
        );

        // ویژگی‌های پکیج‌ها
        $packageAttributes = package_attribute::where(
            'product_id',
            $product->id
        )->get()->groupBy('package_id');

        $packages = package::where('product_id', $product->id)
            ->get()
            ->map(function ($package) use ($packageAttributes) {
                return [
                    'count' => $package->count,
                    'primary_price' => $package->primary_price,
                    'secondary_price' => $package->secondary_price,
                    'attributes' => $this->groupAttributes(
                        $packageAttributes->get($package->id, collect())
                    ),
                ];
            })
            ->values();

        // درخت ویژگی‌های محصول
        $productFeatures = $this->buildProductFeatureTree($product->id);

        $productData = $product->toArray();

        $productData['attributes'] = $attributes;
        $productData['packages'] = $packages;
        $productData['product_features'] = $productFeatures;

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

    /*
     * |--------------------------------------------------------------------------
     * | به‌روزرسانی محصول
     * |--------------------------------------------------------------------------
     */

    public function update(Request $request)
    {
        $validated = $this->validateProductRequest($request, true);

        $product = product::findOrFail($validated['product_id']);

        $oldTitle = $product->title;

        $uploadedFiles = [];
        $filesToDelete = [];

        try {
            DB::transaction(function () use (
                $validated,
                $request,
                $product,
                &$uploadedFiles,
                &$filesToDelete
            ) {
                // اطلاعات اصلی محصول
                $product->title = $validated['title'];

                foreach ([
                    'description',
                    'summary',
                    'brand',
                    'writer',
                    'publication',
                    'count',
                    'primary_price',
                    'secondary_price',
                ] as $field) {
                    if (array_key_exists($field, $validated)) {
                        $product->{$field} = $validated[$field];
                    }
                }

                // اگر count ارسال نشده باشد، مقدار قبلی حفظ می‌شود.
                $product->show_in_home = $request->boolean('show_in_home');

                $product->save();

                // جایگزینی دسته‌بندی‌ها
                $categoryIds = $this->getProductCategoryIds(
                    $validated['category_ids'] ?? []
                );

                category_product::where(
                    'product_id',
                    $product->id
                )->delete();

                $categoryRows = [];

                foreach ($categoryIds as $categoryId) {
                    $categoryRows[] = [
                        'product_id' => $product->id,
                        'category_id' => $categoryId,
                    ];
                }

                category_product::insert($categoryRows);

                // حذف تصاویر گالری انتخاب‌شده
                $removed = $request->input('removedImgs', []);

                if (!is_array($removed)) {
                    $removed = [];
                }

                $removedGallery = $removed['gallery'] ?? [];

                if (is_array($removedGallery)) {
                    foreach ($removedGallery as $removedPath) {
                        $storedPath = $this->normalizeMediaPath(
                            is_string($removedPath) ? $removedPath : null
                        );

                        if (!$storedPath) {
                            continue;
                        }

                        $media = product_media::where(
                            'product_id',
                            $product->id
                        )
                            ->where('is_main', false)
                            ->where('media_path', $storedPath)
                            ->first();

                        if ($media) {
                            $filesToDelete[] = $media->media_path;
                            $media->delete();
                        }
                    }
                }

                // جایگزینی تصویر اصلی فقط در صورت آپلود تصویر جدید
                if ($request->hasFile('mainImage')) {
                    $oldMainImages = product_media::where(
                        'product_id',
                        $product->id
                    )
                        ->where('is_main', true)
                        ->get();

                    foreach ($oldMainImages as $oldImage) {
                        $filesToDelete[] = $oldImage->media_path;
                        $oldImage->delete();
                    }

                    $this->storeMedia(
                        $product->id,
                        $request->file('mainImage'),
                        true,
                        $uploadedFiles
                    );
                }

                // تصاویر جدید گالری
                foreach ($validated['gallery'] ?? [] as $image) {
                    $this->storeMedia(
                        $product->id,
                        $image,
                        false,
                        $uploadedFiles
                    );
                }

                // جایگزینی ویژگی‌های عمومی
                product_attributes::where(
                    'product_id',
                    $product->id
                )->delete();

                $this->saveProductAttributes(
                    $product->id,
                    $validated['attributes'] ?? []
                );

                // جایگزینی پکیج‌ها
                package_attribute::where(
                    'product_id',
                    $product->id
                )->delete();

                package::where(
                    'product_id',
                    $product->id
                )->delete();

                $this->savePackages(
                    $product->id,
                    $validated['packages'] ?? []
                );

                // جایگزینی کامل درخت ویژگی‌ها
                $this->deleteProductFeatureTree($product->id);

                $this->saveProductFeatures(
                    $product->id,
                    $validated['product_features'] ?? []
                );
            });
        } catch (\Throwable $exception) {
            // پاک کردن فایل‌های جدید در صورت شکست تراکنش
            foreach ($uploadedFiles as $path) {
                Storage::disk('public')->delete($path);
            }

            throw $exception;
        }

        // حذف فایل‌های قدیمی بعد از موفقیت تراکنش
        foreach (array_unique($filesToDelete) as $path) {
            Storage::disk('public')->delete($path);
        }

        return to_route('product.adminIndex')
            ->with(
                'message',
                'محصول ' . $oldTitle . ' با موفقیت به‌روزرسانی شد.'
            );
    }

    /*
     * |--------------------------------------------------------------------------
     * | حذف محصول
     * |--------------------------------------------------------------------------
     */

    private function deleteProductData(
        product $product,
        array &$filesToDelete
    ): void {
        $product->loadMissing('media');

        foreach ($product->media as $media) {
            $filesToDelete[] = $media->media_path;
        }

        // حذف درخت ویژگی‌ها
        $this->deleteProductFeatureTree($product->id);

        // حذف ویژگی‌های عمومی
        product_attributes::where(
            'product_id',
            $product->id
        )->delete();

        // حذف ویژگی‌های پکیج
        package_attribute::where(
            'product_id',
            $product->id
        )->delete();

        // حذف پکیج‌ها
        package::where(
            'product_id',
            $product->id
        )->delete();

        // حذف تصاویر
        $product->media()->delete();

        // حذف دسته‌بندی‌های مرتبط
        $product->categories()->detach();

        // حذف خود محصول
        $product->delete();
    }

    public function delete($id)
    {
        $product = product::find($id);

        if (!$product) {
            return to_route('product.adminIndex')
                ->with('message', 'چنین محصولی وجود ندارد.');
        }

        $filesToDelete = [];

        DB::transaction(function () use (
            $product,
            &$filesToDelete
        ) {
            $this->deleteProductData(
                $product,
                $filesToDelete
            );
        });

        foreach (array_unique($filesToDelete) as $path) {
            Storage::disk('public')->delete($path);
        }

        return to_route('product.adminIndex')
            ->with('message', 'محصول ' . $product->title . ' حذف شد.');
    }

    public function deleteAll(Request $request)
    {
        $validated = $request->validate([
            'products' => ['required', 'array', 'min:1'],
            'products.*' => [
                'required',
                'integer',
                'distinct',
                'exists:products,id',
            ],
        ]);

        $filesToDelete = [];

        DB::transaction(function () use (
            $validated,
            &$filesToDelete
        ) {
            $products = product::whereIn(
                'id',
                $validated['products']
            )->get();

            foreach ($products as $product) {
                $this->deleteProductData(
                    $product,
                    $filesToDelete
                );
            }
        });

        foreach (array_unique($filesToDelete) as $path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()
            ->back()
            ->with('message', 'محصولات انتخاب‌شده با موفقیت حذف شدند.');
    }

    /*
     * |--------------------------------------------------------------------------
     * | نمایش محصول
     * |--------------------------------------------------------------------------
     */

    public function show(product $product)
    {
        $product->load([
            'categories',
            'media',
            'productAttributes.attribute',
            'packages.packageAttributes.attribute',
            'carts',
        ]);

        $category = $product->categories->first();

        // درخت ویژگی‌ها همراه شناسه و موجودی هر مقدار برای انتخاب ترکیب در صفحه محصول
        $productFeatures = $this->buildProductFeatureTree((int) $product->id);

        $mainMedia = $product->media->firstWhere('is_main', true);

        $mainImage = $mainMedia
            ? asset('storage/' . $mainMedia->media_path)
            : asset('storage/images/noImage.png');

        $galleryMedia = $product->media->where('is_main', false);

        $hasSecondary = (bool) $product->secondary_price;

        $discountPercent = (
            $hasSecondary &&
            $product->primary_price > 0
        )
            ? (int) round(
                (1 - $product->secondary_price / $product->primary_price) * 100
            )
            : 0;

        $cart = Auth::check()
            ? $product
                ->carts
                ->where('user_id', Auth::id())
                ->whereNull('order_id')
                ->first()
            : null;

        $inCart = (bool) $cart;
        $cartQuantity = $cart?->quantity ?? 0;

        $attributes = [];
        $variants = [];

        foreach ($product->productAttributes as $attribute) {
            if (!$attribute->attribute) {
                continue;
            }

            $attributes[] = [
                'key' => $attribute->attribute->key,
                'value' => $attribute->value,
            ];
        }

        if ($product->productAttributes->isNotEmpty()) {
            $firstAttribute = $product->productAttributes->first();

            if ($firstAttribute->attribute) {
                $variants[] = [
                    'key' => $firstAttribute->attribute->key,
                    'value' => $firstAttribute->value,
                    'primary_price' => $product->primary_price,
                    'secondary_price' => $product->secondary_price,
                ];
            }
        }

        foreach ($product->packages as $package) {
            foreach ($package->packageAttributes as $packAttribute) {
                if (!$packAttribute->attribute) {
                    continue;
                }

                $variants[] = [
                    'key' => $packAttribute->attribute->key,
                    'value' => $packAttribute->value,
                    'primary_price' => $package->primary_price,
                    'secondary_price' => $package->secondary_price,
                ];
            }
        }

        $product->setAttribute('attributes', $attributes);
        $product->setAttribute('variants', $variants);
        $product->setAttribute('product_features', $productFeatures);

        return view('admin.product.single', [
            'product' => $product,
            'setting' => homeSetting::document(),
            'category' => $category,
            'mainImage' => $mainImage,
            'galleryMedia' => $galleryMedia,
            'discountPercent' => $discountPercent,
            'cartQuantity' => $cartQuantity,
            'hasSecondary' => $hasSecondary,
            'inCart' => $inCart,
        ]);
    }

    /*
     * |--------------------------------------------------------------------------
     * | صفحات عمومی محصولات
     * |--------------------------------------------------------------------------
     */

    public function index()
    {
        $categories = category::with('products')
            ->has('products')
            ->get();

        $products = product::with('media')->get();

        foreach ($products as $product) {
            $mainMedia = $product->media->firstWhere('is_main', true);

            $product->image = $mainMedia
                ? $mainMedia->media_path
                : 'default.jpg';
        }

        return view('user.product.index', [
            'categories' => $categories,
            'products' => $products,
            'cartCount' => 0,
            'setting' => homeSetting::document(),
        ]);
    }

    public function filter(Request $request)
    {
        if ($request->boolean('all')) {
            return to_route('product.index');
        }

        $validated = $request->validate([
            'selectedCats' => ['required', 'array'],
            'selectedCats.*' => [
                'required',
                'integer',
                'exists:categories,id',
            ],
        ]);

        $products = product::whereHas(
            'categories',
            function ($query) use ($validated) {
                $query->whereIn(
                    'categories.id',
                    $validated['selectedCats']
                );
            }
        )->with('media')->get();

        foreach ($products as $product) {
            $mainMedia = $product->media->firstWhere('is_main', true);

            $product->mainImg = $mainMedia
                ? $mainMedia->media_path
                : 'default.jpg';
        }

        return view('user.product.index', [
            'categories' => category::with('products')
                ->has('products')
                ->get(),
            'products' => $products,
            'catIds' => $validated['selectedCats'],
            'setting' => homeSetting::document(),
        ]);
    }

    /*
     * |--------------------------------------------------------------------------
     * | جست‌وجوی محصولات
     * |--------------------------------------------------------------------------
     */

    public function search(Request $request)
    {
        $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
        ]);

        $products = product::where(
            'title',
            'like',
            '%' . $request->input('title', '') . '%'
        )
            ->with('media')
            ->get();

        return response()->json($products);
    }

    public function searchResult(Request $request)
    {
        $request->validate([
            'searchedValue' => ['nullable', 'string', 'max:255'],
        ]);

        $products = product::where(
            'title',
            'like',
            '%' . $request->input('searchedValue', '') . '%'
        )
            ->with('media')
            ->get();

        foreach ($products as $product) {
            $mainMedia = $product->media->firstWhere('is_main', true);

            $product->mainImg = $mainMedia
                ? $mainMedia->media_path
                : 'default.jpg';
        }

        return view('user.product.index', [
            'categories' => category::with('products')
                ->has('products')
                ->get(),
            'products' => $products,
            'setting' => homeSetting::document(),
        ]);
    }

    public function findProduct(product $product)
    {
        $product->load('media');

        $mainMedia = $product->media->firstWhere('is_main', true);

        $product->mainImg = $mainMedia
            ? $mainMedia->media_path
            : 'default.jpg';

        // findProduct برای سبد خرید نیز باید اطلاعات درخت و ترکیب‌های محصول را برگرداند.
        $product->setAttribute(
            'product_features',
            $this->buildProductFeatureTree((int) $product->id)
        );

        return response()->json($product);
    }

    /*
     * |--------------------------------------------------------------------------
     * | آپلود تصاویر ویرایشگر
     * |--------------------------------------------------------------------------
     */

    public function uploadImage(Request $request)
    {
        $validated = $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['required', 'image', 'max:2048'],
        ]);

        $uploadedFiles = [];

        try {
            foreach ($validated['files'] as $file) {
                $path = $file->store('articles', 'public');

                if (!$path) {
                    throw new \RuntimeException(
                        'ذخیره تصویر با خطا مواجه شد.'
                    );
                }

                $uploadedFiles[] = [
                    'name' => $file->getClientOriginalName(),
                    'url' => asset('storage/' . $path),
                ];
            }
        } catch (\Throwable $exception) {
            foreach ($uploadedFiles as $uploadedFile) {
                $path = $this->normalizeMediaPath($uploadedFile['url']);

                if ($path) {
                    Storage::disk('public')->delete($path);
                }
            }

            throw $exception;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'files' => $uploadedFiles,
            ],
        ]);
    }
}
