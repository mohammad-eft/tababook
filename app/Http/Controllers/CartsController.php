<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\carts;
use App\Models\category;
use App\Models\pack;
use App\Models\product;
use App\Models\ProductFeatureValue;
use App\Models\province_cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartsController extends Controller
{
    /**
     * شناسه کاربر را از نشست یا درخواست دریافت می‌کند.
     * در این نسخه، ساختار فعلی user_id حفظ شده و guest_token استفاده نمی‌شود؛
     * چون مایگریشن ارسالی برای carts ستون guest_token ایجاد نکرده است.
     */
    private function resolveUserId(Request $request): ?int
    {
        if (Auth::check()) {
            return (int) Auth::id();
        }

        $userId = $request->input('user_id', $request->input('userId'));

        return $userId ? (int) $userId : null;
    }

    /**
     * قیمت معتبر محصول/ترکیب را از دیتابیس برمی‌گرداند.
     */
    private function resolveProductPrice(product $product, ?ProductFeatureValue $featureValue): int
    {
        if ($featureValue) {
            if ($featureValue->special_price !== null) {
                return (int) $featureValue->special_price;
            }

            if ($featureValue->original_price !== null) {
                return (int) $featureValue->original_price;
            }
        }

        if ($product->secondary_price !== null && (int) $product->secondary_price > 0) {
            return (int) $product->secondary_price;
        }

        return (int) ($product->primary_price ?? 0);
    }

    /**
     * مسیر ویژگی‌ها را از مقدار انتخاب‌شده استخراج می‌کند.
     * این داده صرفاً برای snapshot سفارش/سبد است.
     */
    private function buildFeatureSnapshot(ProductFeatureValue $value): array
    {
        $snapshot = [];
        $current = $value;
        $visited = [];

        while ($current && !in_array($current->id, $visited, true)) {
            $visited[] = $current->id;

            $feature = $current->feature;
            if (!$feature) {
                break;
            }

            array_unshift($snapshot, [
                'feature_id' => (int) $feature->id,
                'feature_name' => (string) $feature->name,
                'value_id' => (int) $current->id,
                'value_name' => (string) $current->name,
            ]);

            $current = $feature->parentValue;
        }

        return $snapshot;
    }

    /**
     * افزودن محصول ساده یا یک ترکیب محصول به سبد خرید.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
            'feature_value_id' => ['nullable', 'integer', 'exists:product_feature_values,id'],
            'user_id' => ['nullable', 'integer'],
            'selected_features' => ['nullable', 'array'],
        ]);

        $userId = $this->resolveUserId($request);
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'برای ثبت سبد خرید، شناسه کاربر لازم است.',
            ], 422);
        }

        $quantity = (int) ($validated['quantity'] ?? 1);

        $cart = DB::transaction(function () use ($validated, $userId, $quantity) {
            $product = product::query()
                ->lockForUpdate()
                ->findOrFail($validated['product_id']);

            $featureValue = null;
            $featureValueId = $validated['feature_value_id'] ?? null;

            if ($featureValueId) {
                $featureValue = ProductFeatureValue::query()
                    ->with(['feature.parentValue.feature'])
                    ->lockForUpdate()
                    ->findOrFail($featureValueId);

                if (!$featureValue->feature || (int) $featureValue->feature->product_id !== (int) $product->id) {
                    throw ValidationException::withMessages([
                        'feature_value_id' => 'ترکیب انتخاب‌شده متعلق به این محصول نیست.',
                    ]);
                }
            }

            $unitPrice = $this->resolveProductPrice($product, $featureValue);
            $stock = $featureValue
                ? (int) $featureValue->count
                : (int) ($product->count ?? 0);

            $cartQuery = carts::query()
                ->where('user_id', $userId)
                ->where('product_id', $product->id)
                ->whereNull('pack_id')
                ->whereNull('order_id');

            if ($featureValueId) {
                $cartQuery->where('feature_value_id', $featureValueId);
            } else {
                $cartQuery->whereNull('feature_value_id');
            }

            $cart = $cartQuery->lockForUpdate()->first();

            $currentQuantity = (int) ($cart->quantity ?? 0);
            if ($stock < ($currentQuantity + $quantity)) {
                throw ValidationException::withMessages([
                    'quantity' => 'موجودی این محصول یا ترکیب برای تعداد درخواستی کافی نیست.',
                ]);
            }

            $snapshotOptions = $featureValue
                ? $this->buildFeatureSnapshot($featureValue)
                : null;

            if ($cart) {
                $cart->quantity = $currentQuantity + $quantity;
                $cart->unit_price = $unitPrice;
                $cart->line_total = $cart->quantity * $unitPrice;
                $cart->snapshot_title = $product->title;
                $cart->snapshot_options = $snapshotOptions;
                $cart->save();
            } else {
                $cart = carts::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'feature_value_id' => $featureValueId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $quantity * $unitPrice,
                    'snapshot_title' => $product->title,
                    'snapshot_options' => $snapshotOptions,
                ]);
            }

            return $cart->load(['product', 'featureValue']);
        });

        return response()->json([
            'success' => true,
            'message' => 'محصول به سبد خرید اضافه شد.',
            'cart' => $cart,
        ]);
    }

    /**
     * حذف یک ردیف مشخص از سبد خرید.
     * cart_id اولویت دارد؛ برای سازگاری با درخواست‌های قدیمی product_id نیز پذیرفته می‌شود.
     */
    public function delete(Request $request)
    {
        $userId = $this->resolveUserId($request);

        $query = carts::query()
            ->where('user_id', $userId)
            ->whereNull('order_id');

        if ($request->filled('cart_id')) {
            $query->whereKey((int) $request->input('cart_id'));
        } else {
            $request->validate([
                'product_id' => ['required', 'integer'],
                'feature_value_id' => ['nullable', 'integer'],
            ]);

            $query->where('product_id', $request->input('product_id'))
                ->whereNull('pack_id');

            if ($request->filled('feature_value_id')) {
                $query->where('feature_value_id', $request->input('feature_value_id'));
            } else {
                $query->whereNull('feature_value_id');
            }
        }

        $cart = $query->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'ردیف موردنظر در سبد خرید پیدا نشد.',
            ], 404);
        }

        $cart->delete();

        $remainingItems = carts::where('user_id', $userId)
            ->whereNull('order_id')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'محصول از سبد خرید حذف شد.',
            'cart_id' => $cart->id,
            'count' => $remainingItems->sum('quantity'),
        ]);
    }

    /**
     * تغییر تعداد یک ردیف سبد خرید.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'cart_id' => ['nullable', 'integer'],
            'product_id' => ['nullable', 'integer'],
            'feature_value_id' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $userId = $this->resolveUserId($request);

        $query = carts::query()
            ->where('user_id', $userId)
            ->whereNull('order_id')
            ->whereNull('pack_id');

        if (!empty($validated['cart_id'])) {
            $query->whereKey($validated['cart_id']);
        } else {
            if (empty($validated['product_id'])) {
                throw ValidationException::withMessages([
                    'cart_id' => 'شناسه ردیف سبد خرید یا شناسه محصول لازم است.',
                ]);
            }

            $query->where('product_id', $validated['product_id']);

            if (!empty($validated['feature_value_id'])) {
                $query->where('feature_value_id', $validated['feature_value_id']);
            } else {
                $query->whereNull('feature_value_id');
            }
        }

        $cart = $query->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'ردیف موردنظر در سبد خرید پیدا نشد.',
            ], 404);
        }

        $stock = $cart->feature_value_id
            ? (int) optional($cart->featureValue)->count
            : (int) optional($cart->product)->count;

        if ($validated['quantity'] > $stock) {
            throw ValidationException::withMessages([
                'quantity' => 'تعداد درخواستی بیشتر از موجودی است.',
            ]);
        }

        $cart->quantity = (int) $validated['quantity'];
        $cart->line_total = (int) ($cart->unit_price ?? 0) * $cart->quantity;
        $cart->save();

        return response()->json([
            'success' => true,
            'cart' => $cart->load(['product', 'featureValue']),
        ]);
    }

    /**
     * دریافت اقلام سبد خرید.
     */
    public function showCarts(Request $request)
    {
        $userId = $this->resolveUserId($request);

        $carts = carts::query()
            ->with(['product.media', 'featureValue'])
            ->where('user_id', $userId)
            ->whereNull('order_id')
            ->get();

        $totalPrice = 0;
        $cartData = [];

        foreach ($carts as $cart) {
            if ($cart->product_id && $cart->product) {
                $product = $cart->product;

                $unitPrice = $cart->unit_price !== null
                    ? (int) $cart->unit_price
                    : $this->resolveProductPrice($product, $cart->featureValue);

                $mainImage = 'default.jpg';
                foreach ($product->media as $media) {
                    if ($media->is_main) {
                        $mainImage = $media->media_path;
                        break;
                    }
                }

                $options = $cart->snapshot_options;
                if (!$options && $cart->featureValue) {
                    $options = $this->buildFeatureSnapshot($cart->featureValue);
                }

                $lineTotal = $unitPrice * (int) $cart->quantity;
                $totalPrice += $lineTotal;

                $cartData[] = [
                    'id' => $cart->id,
                    'cart_id' => $cart->id,
                    'product_id' => $cart->product_id,
                    'feature_value_id' => $cart->feature_value_id,
                    'cart_key' => $cart->feature_value_id
                        ? $cart->product_id . ':' . $cart->feature_value_id
                        : 'product:' . $cart->product_id,
                    'summary' => $product->summary,
                    'user_id' => $cart->user_id,
                    'product_name' => $cart->snapshot_title ?: $product->title,
                    'selected_features' => $options ?? [],
                    'quantity' => (int) $cart->quantity,
                    'price' => $unitPrice,
                    'total' => $lineTotal,
                    'count' => $cart->feature_value_id
                        ? (int) optional($cart->featureValue)->count
                        : (int) ($product->count ?? 0),
                    'img' => $mainImage,
                ];
            } elseif ($cart->pack_id && $cart->pack) {
                $pack = $cart->pack;
                $unitPrice = $pack->secondary_price
                    ? (int) $pack->secondary_price
                    : (int) $pack->primary_price;

                $lineTotal = $unitPrice * (int) $cart->quantity;
                $totalPrice += $lineTotal;

                $cartData[] = [
                    'id' => $cart->id,
                    'cart_id' => $cart->id,
                    'pack_id' => $cart->pack_id,
                    'product_name' => $pack->title ?? $pack->name ?? 'پکیج',
                    'quantity' => (int) $cart->quantity,
                    'price' => $unitPrice,
                    'total' => $lineTotal,
                    'img' => $pack->image ?: 'default.jpg',
                ];
            }
        }

        return response()->json([
            'success' => true,
            'carts' => $cartData,
            'total_price' => $totalPrice,
            'count' => $carts->sum('quantity'),
        ]);
    }

    public function list()
    {
        $categories = category::all();
        $setting = homeSetting::document();

        return view('user.cart.cart', [
            'categories' => $categories,
            'setting' => $setting,
        ]);
    }

    public function packStore(Request $request)
    {
        $validated = $request->validate([
            'packId' => ['required', 'integer', 'exists:packs,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
            'userId' => ['nullable', 'integer'],
        ]);

        $userId = $this->resolveUserId($request);
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'برای ثبت سبد خرید، شناسه کاربر لازم است.',
            ], 422);
        }

        $packId = (int) $validated['packId'];
        $quantity = (int) ($validated['quantity'] ?? 1);

        $cart = carts::where('user_id', $userId)
            ->where('pack_id', $packId)
            ->whereNull('order_id')
            ->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            $cart = carts::create([
                'pack_id' => $packId,
                'user_id' => $userId,
                'quantity' => $quantity,
            ]);
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ]);
    }

    public function packUpdate(Request $request)
    {
        $request->validate([
            'cart_id' => ['nullable', 'integer'],
            'packId' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $userId = $this->resolveUserId($request);

        $query = carts::where('user_id', $userId)
            ->whereNull('order_id')
            ->whereNotNull('pack_id');

        if ($request->filled('cart_id')) {
            $query->whereKey($request->input('cart_id'));
        } else {
            $query->where('pack_id', $request->input('packId'));
        }

        $cart = $query->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'پکیج در سبد خرید پیدا نشد.',
            ], 404);
        }

        $cart->quantity = (int) $request->input('quantity');
        $cart->save();

        return response()->json([
            'success' => true,
            'cart' => $cart->load('pack'),
        ]);
    }

    public function packDelete(Request $request)
    {
        $request->validate([
            'cart_id' => ['nullable', 'integer'],
            'packId' => ['nullable', 'integer'],
        ]);

        $userId = $this->resolveUserId($request);

        $query = carts::where('user_id', $userId)
            ->whereNull('order_id')
            ->whereNotNull('pack_id');

        if ($request->filled('cart_id')) {
            $query->whereKey($request->input('cart_id'));
        } else {
            $query->where('pack_id', $request->input('packId'));
        }

        $cart = $query->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'پکیج در سبد خرید پیدا نشد.',
            ], 404);
        }

        $cartId = $cart->id;
        $cart->delete();

        $remainingItems = carts::where('user_id', $userId)
            ->whereNull('order_id')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'پکیج از سبد خرید حذف شد.',
            'cart_id' => $cartId,
            'count' => $remainingItems->sum('quantity'),
        ]);
    }

    public function checkout()
    {
        $categories = category::all();
        $setting = homeSetting::document();
        $provinces = province_cities::where('parent', 0)->get();
        $cities = province_cities::where('parent', 1)->get();

        return view('user.cart.checkout', [
            'categories' => $categories,
            'setting' => $setting,
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }

    public function showCities(Request $request)
    {
        $request->validate([
            'provinceId' => ['required', 'integer'],
        ]);

        $cities = province_cities::where('parent', $request->input('provinceId'))->get();

        return response()->json($cities);
    }
}
