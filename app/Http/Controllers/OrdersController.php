<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\address;
use App\Models\carts;
use App\Models\category;
use App\Models\orders;
use App\Models\product;
use App\Models\User;
use App\Models\order_status;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function create()
    {
        $setting = homeSetting::document();
        return view('user.order.create', ['setting' => $setting]);
    }
    public function store(Request $request)
    {
        $name = $request->input('name');
        $family = $request->input('family');
        $cityId = $request->input('cityId');
        $addressText = $request->input('address');
        $postalCode = $request->input('postalCode');
        $phoneNumber = $request->input('phoneNumber');
        $email = $request->input('email');
        $nationalCode = $request->input('nationalCode');
        $descriptoin = $request->input('descriptoin');
        $onlinePayment = $request->input('onlinePayment');
        $products = json_decode($request->products);
        $packs = json_decode($request->packs);

        User::upsert([
            'name' => $name,
            'family' => $family,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'nationalCode' => $nationalCode,
        ], ['phoneNumber'], ['name', 'family', 'email', 'nationalCode']);

        $user = User::where('phoneNumber', $phoneNumber)->first();

        $address = address::firstOrCreate([
            'user_id' => $user->id,
            'address' => $addressText,
            'city_id' => $cityId,
            'postalCode' => $postalCode
        ]);

        $dateTime = explode(' ', verta());
        $date = implode('/', explode('-', $dateTime[0]));
        $currentTime = explode(':', $dateTime[1]);
        unset($currentTime[count($currentTime) - 1]);
        $time = implode(':', $currentTime);

        $order = orders::create([
            'user_id' => $user->id,
            'description' => $descriptoin,
            'onlinePayment' => $onlinePayment,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'date' => $date,
            'time' => $time,
        ]);

        $order_code = '100' . $order->id;
        orders::where('id', $order->id)->update(['order_code' => $order_code]);

        if ($products) {
            foreach ($products as $product) {
                carts::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'quantity' => $product->quantity
                ]);
            }
        }
        if ($packs) {
            foreach ($packs as $pack) {
                carts::create([
                    'pack_id' => $pack->id,
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'quantity' => $pack->quantity
                ]);
            }
        }

        return redirect('/')->with('clearStorage', true);
    }
    public function index()
    {
        $orders = orders::orderBy('date', 'desc')->orderBy('time', 'desc')->get();
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
            'setting' => $setting
        ]);
    }
    public function showItems(orders $order)
    {
        $order->load(['carts' => function ($query) {
            $query->with(['product' => function ($q) {
                $q->with(['media' => function ($qr) {
                    $qr->where('is_main', 1)->get();
                }]);
            }]);
            $query->with('pack');
        }]);
        $order->state;
        return response()->json($order);
    }
    public function cancelAll(User $user)
    {
        carts::where('user_id', $user->id)->whereNull('order_id')->delete();
        return response()->json('ok');
    }
   
}
