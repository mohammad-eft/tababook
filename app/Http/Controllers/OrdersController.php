<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\orders;
use App\Models\carts;
use App\Models\category;
use App\Models\product;
use App\Models\User;
use App\Models\address;
use Hekmatinasser\Verta\Verta;
use App\classes\homeSetting;

class OrdersController extends Controller
{
    public function create(){
        $setting = homeSetting::document();
        return view('user.order.create', ['setting'=>$setting]);
    }
    // public function store(Request $request)
    // {
    //     $name = $request->input('name');
    //     $family = $request->input('family');
    //     $cityId = $request->input('cityId');
    //     $address = $request->input('address');
    //     $postalCode = $request->input('postalCode');
    //     $phoneNumber = $request->input('phoneNumber');
    //     $email = $request->input('email');
    //     $nationalCode = $request->input('nationalCode');
    //     $descriptoin = $request->input('descriptoin');
    //     $onlinePayment = $request->input('onlinePayment');
    //     $products = json_decode($request->products);

    //     User::upsert([
    //         'name'=>$name,
    //         'family'=>$family,
    //         'phoneNumber'=>$phoneNumber,
    //         'email'=>$email,
    //         'nationalCode'=>$nationalCode,
    //     ], ['phoneNumber'], ['name', 'family', 'email', 'nationalCode']);

    //     $user = User::where('phoneNumber', $phoneNumber)->first();

    //     $address = address::create([
    //         'user_id'=>$user->id,
    //         'address'=>$address,
    //         'city_id'=>$cityId,
    //         'postalCode'=>$postalCode
    //     ]);

    //     $dateTime = explode(' ', verta());
    //     $date = implode('/', explode('-', $dateTime[0]));
    //     $currentTime = explode(':', $dateTime[1]);
    //     unset($currentTime[count($currentTime)-1]);
    //     $time = implode(':', $currentTime);
        
    //     $order = orders::create([
    //         'user_id'=>$user->id,
    //         'description'=>$descriptoin,
    //         'onlinePayment'=>$onlinePayment,
    //         'date'=>$date,
    //         'time'=>$time,
    //     ]);

    //     $order_code = "100" . $order->id;
    //     orders::where('id', $order->id)->update(['order_code'=>$order_code]);

    //     foreach($products as $product){
    //         carts::create([
    //             'product_id'=>$product->id,
    //             'user_id'=>$user->id,
    //             'order_id'=>$order->id,
    //             'quantity'=>$product->quantity
    //         ]);
    //     }
    //     // $user_id = Auth::id();
    //     // if (isset($request->user_id)) {
    //     //     $user_id = $request->user_id;
    //     // }

    //     // // همه آیتم‌های سبد خرید کاربر که هنوز سفارش نشدن
    //     // $cartItems = carts::where('user_id', $user_id)
    //     //     ->where('order_id', null)
    //     //     ->get();

    //     // if ($cartItems->isEmpty()) {
    //     //     return response()->json(['message' => 'سبد خرید خالی است'], 400);
    //     // }
    //     // $address_id = address::create([
    //     //     'user_id'=>Auth::id(),
    //     //     'address'=>$request->address
    //     // ]);
    //     // $createdOrders = [];
    //     // $dateTime = explode(' ', verta());
    //     // $date = implode('/', explode('-', $dateTime[0]));
    //     // $time = $dateTime[1];
    //     // $order_id = orders::insertGetId([
    //     //     'address_id' => $address_id,
    //     //     'user_id' => $user_id,
    //     //     'order_status_id' => 1,
    //     //     'date'=>$date,
    //     //     'time'=>$time
    //     // ]);
    //     // foreach ($cartItems as $cartItem) {

    //     //     $order_code = "100" . $order_id;
    //     //     orders::where('id', $order_id)->update(['order_code' => $order_code]);

    //     //     $cartItem->order_id = $order_id;
    //     //     $cartItem->save();

    //     //     $createdOrders[] = [
    //     //         'order_id' => $order_id,
    //     //         'product_id' => $cartItem->product_id,
    //     //     ];
    //     // }

    //     // return response()->json($createdOrders);
    //     return to_route('home');
    // }
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

        User::upsert([
            'name'=>$name,
            'family'=>$family,
            'phoneNumber'=>$phoneNumber,
            'email'=>$email,
            'nationalCode'=>$nationalCode,
        ], ['phoneNumber'], ['name', 'family', 'email', 'nationalCode']);

        $user = User::where('phoneNumber', $phoneNumber)->first();

        $address = address::create([
            'user_id'=>$user->id,
            'address'=>$addressText,
            'city_id'=>$cityId,
            'postalCode'=>$postalCode
        ]);

        $dateTime = explode(' ', verta());
        $date = implode('/', explode('-', $dateTime[0]));
        $currentTime = explode(':', $dateTime[1]);
        unset($currentTime[count($currentTime)-1]);
        $time = implode(':', $currentTime);
        
        $order = orders::create([
            'user_id'=>$user->id,
            'description'=>$descriptoin,
            'onlinePayment'=>$onlinePayment,
            'date'=>$date,
            'time'=>$time,
        ]);

        $order_code = "100" . $order->id;
        orders::where('id', $order->id)->update(['order_code'=>$order_code]);

        foreach($products as $product){
            carts::create([
                'product_id'=>$product->id,
                'user_id'=>$user->id,
                'order_id'=>$order->id,
                'quantity'=>$product->quantity
            ]);
        }
       
        return redirect('/')->with('clearStorage', true);
    }

    public function index(){
        $orders = orders::orderBy('date', 'desc')->orderBy('time', 'desc')->get();
        $categories = category::with('products')->has('products')->get();
        $products = product::where('show_in_home', 1)->get();
   
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
        $setting = homeSetting::document();
        return view('admin.order.index', [
            'categories' => $categories,
            'products' => $products,
            'orders'=>$orders,
            'setting'=>$setting
        ]);
    }

    public function showItems(orders $order){
        $order->load(['carts'=>function($query){
            $query->with(['product'=>function($q){
                $q->with(['media'=>function($qr){
                    $qr->where('is_main', 1)->get();
                }]);
            }]);
        }]);
        return response()->json($order);
    }

    public function cancelAll(User $user){
        carts::where('user_id', $user->id)->whereNull('order_id')->delete();
        return response()->json('ok');
    }
}
