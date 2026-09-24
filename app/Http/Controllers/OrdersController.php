<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\orders;
use App\Models\carts;
use App\Models\category;
use App\Models\defaultComment;
use App\Models\logo;
use App\Models\product;
use App\Models\User;
use App\Models\header;
use App\Models\introduction;
use App\Models\service;
use Hekmatinasser\Verta\Verta;
use App\classes\homeSetting;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth::id();
        if (isset($request->user_id)) {
            $user_id = $request->user_id;
        }

        // همه آیتم‌های سبد خرید کاربر که هنوز سفارش نشدن
        $cartItems = carts::where('user_id', $user_id)
            ->where('order_id', null)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'سبد خرید خالی است'], 400);
        }

        $createdOrders = [];
        $dateTime = explode(' ', verta());
        $date = implode('/', explode('-', $dateTime[0]));
        $time = $dateTime[1];
        $order_id = orders::insertGetId([
            'address_id' => isset($request->address) ? $request->address : null,
            'user_id' => $user_id,
            'order_status_id' => 1,
            'date'=>$date,
            'time'=>$time
        ]);
        foreach ($cartItems as $cartItem) {

            $order_code = "100" . $order_id;
            orders::where('id', $order_id)->update(['order_code' => $order_code]);

            $cartItem->order_id = $order_id;
            $cartItem->save();

            $createdOrders[] = [
                'order_id' => $order_id,
                'product_id' => $cartItem->product_id,
            ];
        }

        return response()->json($createdOrders);
    }

    public function index(){
        $orders = orders::all();
        
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
