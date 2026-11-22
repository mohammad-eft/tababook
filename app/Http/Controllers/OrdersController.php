<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\address;
use App\Models\carts;
use App\Models\category;
use App\Models\orders;
use App\Models\product;
use App\Models\ProductFeatureValue;
use App\Models\User;
use App\Models\role_user;
use App\Models\order_status;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrdersController extends Controller
{
    public function create()
    {
        $setting = homeSetting::document();

        return view('user.order.create', [
            'setting' => $setting,
        ]);
    }

    /**
     * تبدیل محصولات ارسالی checkout به آرایه.
     * ورودی فعلی پروژه به‌صورت JSON string ارسال می‌شود؛
     * برای سازگاری، آرایه مستقیم نیز پذیرفته می‌شود.
     */
    private function decodeCheckoutItems($items, string $field): array
    {
        if (is_string($items)) {
            $items = json_decode($items, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw ValidationException::withMessages([
                    $field => 'اطلاعات اقلام سفارش معتبر نیست.',
                ]);
            }
        }

        if ($items === null || $items === '') {
            return [];
        }

        if (!is_array($items)) {
            throw ValidationException::withMessages([
                $field => 'ساختار اقلام سفارش معتبر نیست.',
            ]);
        }

        return $items;
    }

    /**
     * ساخت snapshot مسیر ویژگی‌ها از leaf تا ریشه.
     * این اطلاعات بعداً حتی با تغییر نام ویژگی‌ها در پنل حفظ می‌شود.
     */
    private function buildFeatureSnapshot(ProductFeatureValue $value): array
    {
        $snapshot = [];
        $current = $value;
        $visited = [];

        while ($current && !in_array((int) $current->id, $visited, true)) {
            $visited[] = (int) $current->id;

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
     * قیمت نهایی معتبر را از دیتابیس می‌خواند.
     * قیمت ارسالی از مرورگر مبنای محاسبه سفارش نیست.
     */
    private function resolveOrderUnitPrice(product $product, ?ProductFeatureValue $featureValue): int
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'family' => ['required', 'string', 'max:191'],
            'phoneNumber' => ['required', 'string', 'max:30'],
            'cityId' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'postalCode' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:191'],
            'nationalCode' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:6'],
            'receipt' => ['required', 'file', 'max:5120'],
            'products' => ['required'],
            'packs' => ['nullable'],
            'descriptoin' => ['nullable', 'string'],
        ]);

        $products = $this->decodeCheckoutItems($request->input('products'), 'products');
        $packs = $this->decodeCheckoutItems($request->input('packs'), 'packs');

        if (count($products) === 0 && count($packs) === 0) {
            throw ValidationException::withMessages([
                'products' => 'سبد خرید خالی است.',
            ]);
        }

        $receipt = $request->file('receipt');
        $receiptName = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $receipt->getClientOriginalName());
        $receiptPath = $receipt->storeAs('receipts', $receiptName, 'public');

        $name = $request->input('name');
        $family = $request->input('family');
        $cityId = $request->input('cityId');
        $addressText = $request->input('address');
        $postalCode = $request->input('postalCode');
        $phoneNumber = $request->input('phoneNumber');
        $email = $request->input('email');
        $nationalCode = $request->input('nationalCode');
        $description = $request->input('descriptoin');

        $password = $request->filled('password')
            ? Hash::make($request->input('password'))
            : null;

        DB::transaction(function () use (
            $name,
            $family,
            $cityId,
            $addressText,
            $postalCode,
            $phoneNumber,
            $email,
            $nationalCode,
            $description,
            $password,
            $receiptPath,
            $products,
            $packs
        ) {
            $userData = [
                'name' => $name,
                'family' => $family,
                'phoneNumber' => $phoneNumber,
                'email' => $email,
                'nationalCode' => $nationalCode,
            ];

            if ($password) {
                $userData['password'] = $password;
            }

            User::upsert(
                [$userData],
                ['phoneNumber'],
                $password
                    ? ['name', 'family', 'email', 'nationalCode', 'password']
                    : ['name', 'family', 'email', 'nationalCode']
            );

            $user = User::where('phoneNumber', $phoneNumber)->firstOrFail();

            if ($user->roles->isNotEmpty()) {
                $userRoleIds = $user->roles->pluck('id')->toArray();

                if (!in_array(1, $userRoleIds, true) && !in_array(2, $userRoleIds, true)) {
                    role_user::firstOrCreate([
                        'role_id' => 2,
                        'user_id' => $user->id,
                    ]);
                }
            }

            $address = address::firstOrCreate([
                'user_id' => $user->id,
                'address' => $addressText,
                'city_id' => $cityId,
                'postalCode' => $postalCode,
            ]);

            $dateTime = explode(' ', verta());
            $date = implode('/', explode('-', $dateTime[0]));
            $currentTime = explode(':', $dateTime[1]);
            unset($currentTime[count($currentTime) - 1]);
            $time = implode(':', $currentTime);

            $order = orders::create([
                'user_id' => $user->id,
                'description' => $description,
                'receipt' => $receiptPath,
                'onlinePayment' => 0,
                'address_id' => $address->id,
                'order_status_id' => 1,
                'date' => $date,
                'time' => $time,
            ]);

            $orderCode = '100' . $order->id;
            $order->update([
                'order_code' => $orderCode,
            ]);

            /*
             * ثبت محصولات و کسر موجودی:
             * - محصول ساده: products.count
             * - محصول دارای ترکیب: product_feature_values.count
             */
            foreach ($products as $item) {
                $productId = (int) ($item['product_id'] ?? $item['id'] ?? 0);
                $quantity = (int) ($item['quantity'] ?? 0);
                $featureValueId = !empty($item['feature_value_id'])
                    ? (int) $item['feature_value_id']
                    : null;

                if ($productId < 1 || $quantity < 1) {
                    throw ValidationException::withMessages([
                        'products' => 'شناسه یا تعداد یکی از محصولات سفارش معتبر نیست.',
                    ]);
                }

                $dbProduct = product::query()
                    ->lockForUpdate()
                    ->find($productId);

                if (!$dbProduct) {
                    throw ValidationException::withMessages([
                        'products' => 'یکی از محصولات سفارش دیگر وجود ندارد.',
                    ]);
                }

                $featureValue = null;

                if ($featureValueId) {
                    $featureValue = ProductFeatureValue::query()
                        ->with(['feature.parentValue.feature'])
                        ->lockForUpdate()
                        ->find($featureValueId);

                    if (
                        !$featureValue ||
                        !$featureValue->feature ||
                        (int) $featureValue->feature->product_id !== (int) $dbProduct->id
                    ) {
                        throw ValidationException::withMessages([
                            'products' => 'ترکیب انتخاب‌شده برای یکی از محصولات معتبر نیست.',
                        ]);
                    }

                    $availableCount = (int) $featureValue->count;

                    if ($quantity > $availableCount) {
                        throw ValidationException::withMessages([
                            'products' => "موجودی ترکیب «{$featureValue->name}» برای محصول «{$dbProduct->title}» کافی نیست.",
                        ]);
                    }

                    $featureValue->decrement('count', $quantity);
                } else {
                    $availableCount = (int) ($dbProduct->count ?? 0);

                    if ($quantity > $availableCount) {
                        throw ValidationException::withMessages([
                            'products' => "موجودی محصول «{$dbProduct->title}» کافی نیست.",
                        ]);
                    }

                    $dbProduct->decrement('count', $quantity);
                }

                $unitPrice = $this->resolveOrderUnitPrice($dbProduct, $featureValue);
                $snapshotOptions = $featureValue
                    ? $this->buildFeatureSnapshot($featureValue)
                    : null;

                carts::create([
                    'product_id' => $dbProduct->id,
                    'feature_value_id' => $featureValue?->id,
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'quantity' => $quantity,
                    'snapshot_title' => $dbProduct->title,
                    'snapshot_options' => $snapshotOptions,
                    'snapshot_sku' => null,
                    'unit_price' => $unitPrice,
                    'line_total' => $unitPrice * $quantity,
                ]);
            }

            /*
             * پکیج‌ها مانند قبل ثبت می‌شوند؛ قیمت در صورت وجود از دیتابیس snapshot می‌شود.
             */
            foreach ($packs as $item) {
                $packId = (int) ($item['pack_id'] ?? $item['id'] ?? 0);
                $quantity = (int) ($item['quantity'] ?? 0);

                if ($packId < 1 || $quantity < 1) {
                    throw ValidationException::withMessages([
                        'packs' => 'شناسه یا تعداد یکی از پکیج‌ها معتبر نیست.',
                    ]);
                }

                $pack = \App\Models\pack::find($packId);

                if (!$pack) {
                    throw ValidationException::withMessages([
                        'packs' => 'یکی از پکیج‌های سفارش دیگر وجود ندارد.',
                    ]);
                }

                $unitPrice = $pack->secondary_price
                    ? (int) $pack->secondary_price
                    : (int) ($pack->primary_price ?? 0);

                carts::create([
                    'pack_id' => $pack->id,
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'quantity' => $quantity,
                    'snapshot_title' => $pack->title ?? $pack->name ?? 'پکیج',
                    'unit_price' => $unitPrice,
                    'line_total' => $unitPrice * $quantity,
                ]);
            }
        });

        return redirect('/')->with('clearStorage', true);
    }

    public function index()
    {
        $orders = orders::orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        $categories = category::with('products')->has('products')->get();
        $products = product::where('show_in_home', 1)->get();

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

        return view('admin.order.index', [
            'categories' => $categories,
            'products' => $products,
            'orders' => $orders,
            'setting' => $setting,
        ]);
    }

    public function userOrders()
    {
        $orders = Auth::user()->orders()
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        $categories = category::with('products')->has('products')->get();
        $products = product::where('show_in_home', 1)->get();

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

        return view('admin.order.userOrders', [
            'categories' => $categories,
            'products' => $products,
            'orders' => $orders,
            'setting' => $setting,
        ]);
    }

    public function showItems(orders $order)
    {
        $order->load([
            'carts' => function ($query) {
                $query->with([
                    'product' => function ($q) {
                        $q->with([
                            'media' => function ($qr) {
                                $qr->where('is_main', 1);
                            },
                        ]);
                    },
                    'pack',
                    'featureValue.feature.parentValue.feature',
                ]);
            },
        ]);

        $order->state;

        return response()->json($order);
    }

    public function cancelAll(User $user)
    {
        carts::where('user_id', $user->id)
            ->whereNull('order_id')
            ->delete();

        return response()->json('ok');
    }

    public function acceptOrder(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'integer'],
            'status' => ['required', 'integer'],
        ]);

        $order = orders::with(['state', 'carts.product', 'carts.featureValue'])
            ->findOrFail($request->order_id);

        if ((int) $request->status === 1) {
            $order->order_status_id = 2;
        }

        if ((int) $request->status === 2) {
            $order->order_status_id = 3;
        }

        if ((int) $request->status === 3) {
            $order->order_status_id = 4;
        }

        $order->save();
        $order->load('state');

        return response()->json($order);
    }
}
