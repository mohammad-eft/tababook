<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\carts;
use App\Models\category;

class CartsController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth::id();
        if (!Auth::check()) {
            $user_id = $request->input('user_id');
        }
        $cart = carts::create([
            'product_id' => $request->product_id,
            'user_id' => $user_id,
            'quantity' => $request->quantity ? $request->quantity : 1,
        ]);

        return response()->json($cart);
    }
    public function delete(Request $request)
    {
        $cart = carts::where('user_id', $request->user_id)->where('product_id', $request->product_id)->where('order_id', null)->first();
        $data = $cart;
        if ($cart) {
            $cart->delete();
        }
        $remainingItems = carts::where('user_id', $request->user_id)->where('order_id', null)->get();
        $count = $remainingItems->sum('quantity');
        return response()->json([
            'message' => 'محصول از سبد خرید حذف شد',
            'data' => $data,
            'count' => $count
        ]);
    }
    function update(Request $request)
    {
        $user_id = $request->input('user_id');
        if (Auth::check()) {
            $user_id = Auth::id();
        }
        $cart = carts::where(['product_id' => $request->product_id, 'user_id' => $user_id, 'order_id' => null])->first();
        $cart->quantity = $request->quantity ? $request->quantity : 1;
        $cart->save();

        return response()->json($cart);
    }
    public function showCarts(Request $request)
    {
        $carts = carts::where('user_id', $request->user_id)->where('order_id', null)->get();
        $total_price = 0;
        $cartData = [];
        foreach ($carts as $cart) {
            $product = $cart->product;
            $price = $cart->product->secondary_price ? $cart->product->secondary_price : $cart->product->primary_price;
            $total_price += $price * $cart->quantity;

           
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
            

            $cartData[] = [
                'summary' => $cart->product->summary,
                'user_id' => $cart->user_id,
                'id' => $cart->id,
                'product_id' => $cart->product_id,
                'product_name' => $cart->product->title ?? 'محصول',
                'quantity' => $cart->quantity,
                'price' => $price,
                'total' => $price * $cart->quantity,
                'img' => $product->mainImg
            ];
        }

        return response()->json([
            'success' => true,
            'carts' => $cartData,
            'total_price' => $total_price,
            'count' => $carts->sum('quantity')
        ]);
    }
    public function list(){
        $categories = category::all();
        $setting = homeSetting::document();
       
        Auth::user()->load(['carts'=>function($query){
            $query->whereNull('order_id')->with(['product'=>function($query){
                $query->get();
            }]);
        }]);
        $totalPrice = 0;
        $totalDiscount = 0;
        foreach(Auth::user()->carts as $cart){
            if($cart->product->secondary_price){
                $totalPrice += $cart->product->secondary_price;
                $totalDiscount += $cart->product->primary_price - $cart->product->secondary_price;
            } else {
                $totalPrice += $cart->product->primary_price;
            }
            if ($cart->product->media->isNotEmpty()) {
                foreach ($cart->product->media as $media) {
                    if ($media->is_main) {
                        $cart->product->image  = $media->media_path;
                        break;
                    } else {
                        $cart->product->image = 'default.jpg';
                    }
                }
            } else {
                $cart->product->image = 'default.jpg';
            }
        }
        return view('user.cart.cart', ['categories'=>$categories, 'setting'=>$setting, 'totalPrice'=>$totalPrice, 'totalDiscount'=>$totalDiscount]);
    }
}
