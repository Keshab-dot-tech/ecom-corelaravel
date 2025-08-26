<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order_detail(){
        $cartItems = Cart::with('product')
        ->where('user_id' , Auth::id())
        ->get();

        

        $address = Session::get('checkout.address');
        $shipping = Session::get('checkout.shipping');

        return view("user.customer_order" , compact('cartItems', 'address', 'shipping'));
    }

    public function all_orders(){
        $orderCartItems = Order::where('user_id' , Auth::id())->get();

        return view('user.all_orders' , compact('orderCartItems'));
    }
}


 