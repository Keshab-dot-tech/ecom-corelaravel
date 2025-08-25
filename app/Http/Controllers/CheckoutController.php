<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index_checkout1(){
        $cartItems = Cart::with('product')
        ->where('user_id' , auth()->id())
        ->get();

        return view('checkout.checkout1' , compact('cartItems'));
    }

    public function index_checkout2(){
        $cartItems = Cart::with('product')
        ->where('user_id' , auth()->id())
        ->get();

        return view('checkout.checkout2' , compact('cartItems'));
    }

    public function index_checkout3(){
        $cartItems = Cart::with('product')
        ->where('user_id' , auth()->id())
        ->get();

        return view('checkout.checkout3' , compact('cartItems'));
    }

    public function index_checkout4(){
        $cartItems = Cart::with('product')
        ->where('user_id' , auth()->id())
        ->get();

        return view('checkout.checkout4' , compact('cartItems'));
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
}
