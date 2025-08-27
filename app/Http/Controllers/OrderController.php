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
        if (Auth::check()) {
            // User is logged in - get cart from database
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            // User is guest - get cart from session
            $sessionCart = Session::get('cart', []);
            $cartItems = collect($sessionCart)->map(function ($item) {
                // Create a mock object structure for session cart items
                $mockItem = new \stdClass();
                $mockItem->id = $item['product_id']; // Use product_id as temporary id
                $mockItem->quantity = $item['quantity'];
                $mockItem->price = $item['price'];
                
                // Create mock product object
                $mockProduct = new \stdClass();
                $mockProduct->id = $item['product_id'];
                $mockProduct->name = $item['name'];
                $mockProduct->image_path = $item['image_path'] ?? 'default.jpg';
                
                $mockItem->product = $mockProduct;
                return $mockItem;
            });
        }

        $address = Session::get('checkout.address');
        $shipping = Session::get('checkout.shipping');

        return view("user.customer_order" , compact('cartItems', 'address', 'shipping'));
    }

    public function all_orders(){
        $orderCartItems = Order::where('user_id' , Auth::id())->get();

        return view('user.all_orders' , compact('orderCartItems'));
    }
}


 