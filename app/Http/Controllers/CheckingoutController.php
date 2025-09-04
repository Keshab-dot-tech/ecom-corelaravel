<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CheckingoutController extends Controller
{
     
    private function getCartItems()
    {
        if (Auth::check()) {
            return Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $sessionCart = Session::get('cart', []);
            return collect($sessionCart)->map(function ($item) {
                $mockItem = new \stdClass();
                $mockItem->id = $item['product_id'];
                $mockItem->quantity = $item['quantity'];
                $mockItem->price = $item['price'];

                $mockProduct = new \stdClass();
                $mockProduct->id = $item['product_id'];
                $mockProduct->name = $item['name'];
                $mockProduct->image_path = $item['image_path'] ?? 'default.jpg';

                $mockItem->product = $mockProduct;
                return $mockItem;
            });
        }
    }

    public function index_checkout1()
    {
        $cartItems = $this->getCartItems();
         
        $invoiceAddress = Session::get('checkout.address', Auth::check() ? [
            'name'  => Auth::user()->name,
            'email' => Auth::user()->email,
        ] : []);
        $useDifferentShipping = Session::get('checkout.use_different_shipping', false);

        return view('checking.checkout1', compact('cartItems', 'invoiceAddress', 'useDifferentShipping'));
    }

    public function index_checkout2()
    {
         
        if (!Session::has('checkout.address')) {
            return redirect()->route('checkout_address')->with('error', 'Please complete the address step first.');
        }

        $cartItems = $this->getCartItems();
        $shippingAddress = Session::get('checkout.shipping', []);
        $useDifferentShipping = Session::get('checkout.use_different_shipping', false);
         
        if (!$useDifferentShipping && Session::has('checkout.address')) {
            $invoice = Session::get('checkout.address');
            $shippingAddress = [
                'shipping_first_name' => $invoice['name'] ?? '',
                'shipping_last_name' => '',  
                'shipping_email' => $invoice['email'] ?? '',
                'shipping_address' => $invoice['address'] ?? '',
                'shipping_city' => $invoice['city'] ?? '',
                'shipping_zip' => $invoice['zip_code'] ?? '',
                'shipping_state' => $invoice['state_name'] ?? '',
                'shipping_country' => $invoice['country_name'] ?? '',
                'shipping_phone_number' => $invoice['phone'] ?? '',
                'shipping_company' => $invoice['company'] ?? '',
            ];
        }


        return view('checking.checkout2', compact('cartItems', 'shippingAddress', 'useDifferentShipping'));
    }

    public function index_checkout_delivery()  
    {
         
        if (!Session::has('checkout.address') || !Session::has('checkout.shipping')) {
            return redirect()->route('checkout_address')->with('error', 'Please complete the address steps first.');
        }

        $cartItems = $this->getCartItems();
        $deliveryMethod = Session::get('checkout.delivery_method');
        return view('checking.checkout3', compact('cartItems', 'deliveryMethod'));
    }

    public function index_checkout_payment()  
    {
        
        if (!Session::has('checkout.address') || !Session::has('checkout.shipping') || !Session::has('checkout.delivery_method')) {
            return redirect()->route('checkout_address')->with('error', 'Please complete previous steps first.');
        }

        $cartItems = $this->getCartItems();
        $paymentMethod = Session::get('checkout.payment_method');
        return view('checking.checkout_payment', compact('cartItems', 'paymentMethod'));
    }


    public function index_checkout3()
    {
         
        if (!Session::has('checkout.address') || !Session::has('checkout.shipping') || !Session::has('checkout.delivery_method') || !Session::has('checkout.payment_method')) {
            return redirect()->route('checkout_address')->with('error', 'Please complete all previous steps before reviewing your order.');
        }

        $cartItems = $this->getCartItems();
        $invoiceAddress = Session::get('checkout.address');
        $shippingAddress = Session::get('checkout.shipping');
        $deliveryMethod = Session::get('checkout.delivery_method');
        $paymentMethod = Session::get('checkout.payment_method');

        return view('checking.checkout4', compact('cartItems', 'invoiceAddress', 'shippingAddress', 'deliveryMethod', 'paymentMethod'));
    }


     
    public function destroy($id)
    {
        if (Auth::check()) {
            Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->delete();
        } else {
            $cart = Session::get('cart', []);
        
            foreach ($cart as $key => $item) {
                if ($item['product_id'] == $id) {
                    unset($cart[$key]);
                    break;
                }
            }
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item Removed!');
    }

    public function save_address(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'address'     => 'required|string',
            'city'        => 'required|string',
            'zip_code'    => 'required|string',
            'state_name'  => 'required|string',
            'country_name' => 'required|string',
            'phone'       => 'required|string',
            'company'     => 'nullable|string',
        ]);

        Session::put('checkout.address', $validated);

        return redirect()->route('checkout_shipping_address'); 
    }

    public function save_shipping_address(Request $request)
    {
        $validated = $request->validate([
            'shipping_first_name' => 'required|string|max:255',
            'shipping_last_name' => 'nullable|string|max:255',
            'shipping_email' => 'required|email',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_zip' => 'required|string',
            'shipping_state' => 'required|string',
            'shipping_country' => 'required|string',
            'shipping_phone_number' => 'required|string',
            'shipping_company' => 'nullable|string',
        ]);

        Session::put('checkout.shipping', $validated);

        return redirect()->route('checkout_delivery');
    }

    public function save_delivery_method(Request $request)
    {
        $validated = $request->validate([
            'delivery_method' => 'required|string|in:standard,express', 
        ]);

        Session::put('checkout.delivery_method', $validated['delivery_method']);

        return redirect()->route('checkout_payment');
    }

    public function save_payment_method(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|string|in:credit_card,paypal,bank_transfer', // Example values
        ]);

        Session::put('checkout.payment_method', $validated['payment_method']);

        return redirect()->route('checkout_order_review');
    }


    public function placeOrder(Request $request)
    {
         
        if (!Session::has('checkout.address') || !Session::has('checkout.delivery_method') || !Session::has('checkout.payment_method')) {
            return redirect()->route('checkout_order_review')->with('error', 'Missing order details. Please review your order.');
        }

        $invoiceAddress  = Session::get('checkout.address');
        $shippingAddress = Session::get('checkout.shipping', $invoiceAddress);
        $deliveryMethod = Session::get('checkout.delivery_method');
        $paymentMethod = Session::get('checkout.payment_method');


         
        $totalPrice = 0;
        $cartItems = $this->getCartItems();  
        $totalPrice = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });


        $order = new Order();
        if (Auth::check()) {
            $order->user_id = Auth::id();
        } else {
             
            $order->user_id = null;  
        }

        $order->invoice_address = $invoiceAddress;  
        $order->shipping_address = $shippingAddress;  
        $order->status = 'pending';  
        $order->price = $totalPrice;
        $order->payment_method = $paymentMethod;  
        $order->save();

         
        Session::forget('checkout');
        Session::forget('cart');  

        return redirect()->route('checkout_order_confirm')
            ->with('success', 'Order placed successfully! Your order number is #' . $order->id);
    }

    public function orderConfirmation()
    {
        
        return view('checking.checkout_confirm');
    }
}