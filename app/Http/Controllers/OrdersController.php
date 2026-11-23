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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

    /**
     * ثبت سفارش بر اساس ساختار فعلی محصول:
     * - محصول ساده: product_id + quantity
     * - محصول متغیر: product_id + feature_value_id (مقدار نهایی/برگ)
     * - پکیج: pack_id + quantity
     * قیمت و موجودی همیشه از دیتابیس خوانده می‌شوند.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'family' => ['required', 'string', 'max:191'],
            'phoneNumber' => ['required', 'string', 'max:30'],
            'cityId' => ['required', 'integer', 'exists:province_cities,id'],
            'address' => ['required', 'string', 'max:2000'],
            // در فرم فعلی کدپستی اختیاری است.
            'postalCode' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:191'],
            'nationalCode' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:6'],
            'receipt' => ['required', 'image', 'max:5120'],
            'products' => ['nullable'],
            'packs' => ['nullable'],
            'description' => ['nullable', 'string'],
            'descriptoin' => ['nullable', 'string'], // سازگاری با فرم‌های قدیمی
        ], [
            'name.required' => 'وارد کردن نام ضروری است.',
            'family.required' => 'وارد کردن نام خانوادگی ضروری است.',
            'phoneNumber.required' => 'وارد کردن شماره تلفن ضروری است.',
            'cityId.required' => 'انتخاب شهر ضروری است.',
            'address.required' => 'وارد کردن آدرس ضروری است.',
            'receipt.required' => 'بارگذاری رسید پرداخت ضروری است.',
            'receipt.image' => 'فایل رسید باید تصویر باشد.',
            'receipt.max' => 'حجم تصویر رسید نباید بیشتر از ۵ مگابایت باشد.',
        ]);

        $products = $this->decodeCheckoutItems($request->input('products'), 'products');
        $packs = $this->decodeCheckoutItems($request->input('packs'), 'packs');

        if (empty($products) && empty($packs)) {
            throw ValidationException::withMessages([
                'products' => 'سبد خرید خالی است. لطفاً ابتدا محصولی به سبد خرید اضافه کنید.',
            ]);
        }

        // نرمال‌سازی ورودی‌های قدیمی و جدید سبد خرید
        $products = array_values(array_map(function ($item) {
            if (!is_array($item)) return [];

            return [
                'product_id' => (int) ($item['product_id'] ?? $item['id'] ?? 0),
                'feature_value_id' => !empty($item['feature_value_id'])
                    ? (int) $item['feature_value_id']
                    : null,
                'quantity' => (int) ($item['quantity'] ?? 0),
            ];
        }, $products));

        $packs = array_values(array_map(function ($item) {
            if (!is_array($item)) return [];

            return [
                'pack_id' => (int) ($item['pack_id'] ?? $item['id'] ?? 0),
                'quantity' => (int) ($item['quantity'] ?? 0),
            ];
        }, $packs));

        foreach ($products as $item) {
            if ($item['product_id'] < 1 || $item['quantity'] < 1) {
                throw ValidationException::withMessages([
                    'products' => 'شناسه یا تعداد یکی از محصولات سبد خرید معتبر نیست.',
                ]);
            }
        }

        foreach ($packs as $item) {
            if ($item['pack_id'] < 1 || $item['quantity'] < 1) {
                throw ValidationException::withMessages([
                    'packs' => 'شناسه یا تعداد یکی از پکیج‌های سبد خرید معتبر نیست.',
                ]);
            }
        }

        $receipt = $request->file('receipt');
        $receiptName = now()->format('YmdHis') . '_' . Str::uuid() . '.' . $receipt->getClientOriginalExtension();
        $receiptPath = $receipt->storeAs('receipts', $receiptName, 'public');

        if (!$receiptPath) {
            return back()->withInput()->withErrors([
                'receipt' => 'ذخیره فایل رسید انجام نشد. لطفاً دوباره تلاش کنید.',
            ]);
        }

        $name = $request->input('name');
        $family = $request->input('family');
        $cityId = (int) $request->input('cityId');
        $addressText = $request->input('address');
        $postalCode = $request->input('postalCode');
        $phoneNumber = $request->input('phoneNumber');
        $email = $request->input('email');
        $nationalCode = $request->input('nationalCode');
        $description = $request->input('description', $request->input('descriptoin'));
        $password = $request->filled('password')
            ? Hash::make($request->input('password'))
            : null;

        try {
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

                if ($password !== null) {
                    $userData['password'] = $password;
                }

                User::upsert(
                    [$userData],
                    ['phoneNumber'],
                    $password !== null
                        ? ['name', 'family', 'email', 'nationalCode', 'password']
                        : ['name', 'family', 'email', 'nationalCode']
                );

                $user = User::where('phoneNumber', $phoneNumber)->firstOrFail();
                $userRoleIds = $user->roles->pluck('id')->map(fn ($id) => (int) $id)->all();

                if (!in_array(1, $userRoleIds, true) && !in_array(2, $userRoleIds, true)) {
                    role_user::firstOrCreate([
                        'role_id' => 2,
                        'user_id' => $user->id,
                    ]);
                }

                $address = address::firstOrCreate([
                    'user_id' => $user->id,
                    'address' => $addressText,
                    'city_id' => $cityId,
                    'postalCode' => $postalCode,
                ]);

                $dateTime = explode(' ', (string) verta());
                $date = isset($dateTime[0])
                    ? implode('/', explode('-', $dateTime[0]))
                    : now()->format('Y/m/d');
                $time = isset($dateTime[1])
                    ? implode(':', array_slice(explode(':', $dateTime[1]), 0, 2))
                    : now()->format('H:i');

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

                $order->update(['order_code' => '100' . $order->id]);

                foreach ($products as $item) {
                    $dbProduct = product::query()
                        ->lockForUpdate()
                        ->find($item['product_id']);

                    if (!$dbProduct) {
                        throw ValidationException::withMessages([
                            'products' => 'یکی از محصولات سبد خرید دیگر وجود ندارد.',
                        ]);
                    }

                    $hasVariableFeatures = DB::table('product_features')
                        ->where('product_id', $dbProduct->id)
                        ->whereNull('parent_value_id')
                        ->exists();

                    $featureValue = null;
                    $featureValueId = $item['feature_value_id'];

                    if ($hasVariableFeatures && !$featureValueId) {
                        throw ValidationException::withMessages([
                            'products' => "برای محصول «{$dbProduct->title}» باید یک ترکیب نهایی انتخاب شود.",
                        ]);
                    }

                    if (!$hasVariableFeatures && $featureValueId) {
                        throw ValidationException::withMessages([
                            'products' => "محصول «{$dbProduct->title}» ساده است و ترکیب ویژگی ندارد.",
                        ]);
                    }

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
                                'products' => "ترکیب انتخاب‌شده برای محصول «{$dbProduct->title}» معتبر نیست.",
                            ]);
                        }

                        // فقط مقدار نهایی (leaf) باید به سفارش ارسال شود.
                        $hasChildren = DB::table('product_features')
                            ->where('parent_value_id', $featureValue->id)
                            ->exists();

                        if ($hasChildren) {
                            throw ValidationException::withMessages([
                                'products' => "برای محصول «{$dbProduct->title}» باید آخرین زیرمقدار ویژگی انتخاب شود.",
                            ]);
                        }

                        $availableCount = (int) $featureValue->count;
                        if ($item['quantity'] > $availableCount) {
                            throw ValidationException::withMessages([
                                'products' => "موجودی ترکیب «{$featureValue->name}» برای محصول «{$dbProduct->title}» کافی نیست.",
                            ]);
                        }

                        $featureValue->decrement('count', $item['quantity']);
                    } else {
                        $availableCount = (int) ($dbProduct->count ?? 0);
                        if ($item['quantity'] > $availableCount) {
                            throw ValidationException::withMessages([
                                'products' => "موجودی محصول «{$dbProduct->title}» کافی نیست.",
                            ]);
                        }

                        $dbProduct->decrement('count', $item['quantity']);
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
                        'quantity' => $item['quantity'],
                        'snapshot_title' => $dbProduct->title,
                        'snapshot_options' => $snapshotOptions,
                        'snapshot_sku' => null,
                        'unit_price' => $unitPrice,
                        'line_total' => $unitPrice * $item['quantity'],
                    ]);
                }

                foreach ($packs as $item) {
                    $pack = \App\Models\pack::query()
                        ->lockForUpdate()
                        ->find($item['pack_id']);

                    if (!$pack) {
                        throw ValidationException::withMessages([
                            'packs' => 'یکی از پکیج‌های سبد خرید دیگر وجود ندارد.',
                        ]);
                    }

                    $unitPrice = $pack->secondary_price !== null && (int) $pack->secondary_price > 0
                        ? (int) $pack->secondary_price
                        : (int) ($pack->primary_price ?? 0);

                    carts::create([
                        'pack_id' => $pack->id,
                        'user_id' => $user->id,
                        'order_id' => $order->id,
                        'quantity' => $item['quantity'],
                        'snapshot_title' => $pack->title ?? $pack->name ?? 'پکیج',
                        'unit_price' => $unitPrice,
                        'line_total' => $unitPrice * $item['quantity'],
                    ]);
                }
            });
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($receiptPath);
            throw $exception;
        }

        return redirect('/')->with('clearStorage', true)->with('message', 'سفارش شما با موفقیت ثبت شد.');
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
