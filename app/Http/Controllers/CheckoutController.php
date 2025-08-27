<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index_checkout1()
    {
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

        return view('checkout.checkout1', compact('cartItems'));
    }

    public function index_checkout2()
    {
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

        return view('checkout.checkout2', compact('cartItems'));
    }

    public function index_checkout3()
    {
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

        return view('checkout.checkout3', compact('cartItems'));
    }

    public function index_checkout4()
    {
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

        return view('checkout.checkout4', compact('cartItems'));
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            // User is logged in - delete from database
            Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->delete();
        } else {
            // User is guest - delete from session
            $cart = Session::get('cart', []);
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item Removed!');
    }

    public function save_address(Request $request)
    {
        // session([
        //     'invoice' => [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'street' => $request->address,
        //         'city' => $request->city,
        //         'zip_code' => $request->zip_code,
        //         'state' => $request->state_name,
        //         'country' => $request->country_name,
        //         'phone' => $request->phone,
        //         'company' => $request->company,
        //     ],
        //     'shipping' => [
        //         'first_name' => $request->shipping_first_name,
        //         'last_name' => $request->shipping_last_name,
        //         'email' => $request->shipping_email,
        //         'street' => $request->shipping_address,
        //         'city' => $request->shipping_city,
        //         'zip_code' => $request->shipping_zip,
        //         'state' => $request->shipping_state,
        //         'country' => $request->shipping_country,
        //         'phone' => $request->shipping_phone_number,
        //         'company' => $request->shipping_company,
        //     ]
        // ]);

        // // Create order directly from request (store JSON properly)
        // $ord = Order::create([
        //     'user_id'         => auth()->id(),
        //     'shipping_address' => json_encode(session('shipping')),
        //     'invoice_address' => json_encode(session('invoice')),
        //     'price'           => 12121,
        // ]);

        // return redirect()->route('order_detail');




        // Validate incoming request
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

        // Store in session
        Session::put('checkout.address', $validated);

        // If shipping address provided
        if ($request->has('shipping_first_name')) {
            Session::put('checkout.shipping', $request->only([
                'shipping_first_name',
                'shipping_last_name',
                'shipping_email',
                'shipping_address',
                'shipping_city',
                'shipping_zip',
                'shipping_state',
                'shipping_country',
                'shipping_phone_number',
                'shipping_company'
            ]));
        }

        // Redirect to delivery method page
        return redirect()->route('checkout_delivery');
    }

    public function placeOrder(Request $request)
    {
        $address  = Session::get('checkout.address');
        $shipping = Session::get('checkout.shipping');

        // Calculate total price from cart
        $totalPrice = 0;
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $totalPrice = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });
        } else {
            $sessionCart = Session::get('cart', []);
            foreach ($sessionCart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }

        $order = new Order();
        if (Auth::check()) {
            $order->user_id = Auth::id();
        }
        $order->invoice_address = json_encode($address);
        $order->shipping_address = json_encode($shipping);
        $order->status = 'pending';
        $order->price = $totalPrice;
        $order->save();

        // Clear session after saving
        Session::forget('checkout');

        return redirect()->route('checkout_order_confirm')
            ->with('success', 'Order placed successfully!');
    }
}
