<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index_checkout1()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('checkout.checkout1', compact('cartItems'));
    }

    public function index_checkout2()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('checkout.checkout2', compact('cartItems'));
    }

    public function index_checkout3()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('checkout.checkout3', compact('cartItems'));
    }

    public function index_checkout4()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('checkout.checkout4', compact('cartItems'));
    }

    //  $yourModel = new YourModelName();
    //         $yourModel->field1 = $validatedData['field1'];
    //         $yourModel->field2 = $validatedData['field2'];
    //         // ... assign other fields
    //         $yourModel->save();


    // public function store(Request $request){
    //     $request->validate([
    //         'name' => ['required' , 'string' ,'max:255'],
    //         'email' => ['required' , 'string' , 'max:255','unique:users'],
    //         'street' => ['string'],
    //         'zip_code' => ['min:4'],
    //         'state_name' => ['string'],
    //         'country_name' => ['string'],
    //         'phone' => ['min:10'],
    //         'company' => ['company']

    //     ]);

    //     $userModel = new User();
    //     // $userModel->name

    // }


    public function destroy($id)
    {
        Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

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

        $order = new Order();
        $order->user_id = auth()->id();
        $order->invoice_address = json_encode($address);
        $order->shipping_address = json_encode($shipping);
        $order->status = 'pending';
        $order->price = 100;
        $order->save();

        // clear session after saving
        // Session::forget('checkout');

        return redirect()->route('checkout_order_confirm')
            ->with('success', 'Order placed successfully!');
    }


    
}
