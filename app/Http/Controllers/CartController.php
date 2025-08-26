<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();
        return view('user.cart', compact('cartItems'));
    }

    public function store(Request $request, Product $product)
    {
        // $cartItem = Cart::where('user_id', auth()->id())
        //     ->where('product_id', $product->id)
        //     ->first();

        // if ($cartItem) {
        //     $cartItem->increment('quantity', $request->input('quantity', 1));
        // } else {
        //     Cart::create([
        //         'user_id'    => auth()->id(),
        //         'product_id' => $product->id,
        //         'quantity'   => $request->input('quantity', 1),
        //         'price'      => $product->price,
        //     ]);
        // }


        if (Auth::check()) {
            $cartItem = Cart::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $request->input('quantity', 1));
            } else {
                Cart::create([
                    'user_id'    => auth()->id(),
                    'product_id' => $product->id,
                    'quantity'   => $request->input('quantity', 1),
                    'price'      => $product->price,
                    'session_id' => session()->getId()
                ]);
            }
        }
        else{

            $cart = $request->session()->get('cart' , []);
            $productId = $product->id();
            if(isset($cart[$productId])){
                $cart[$productId]['quantity'] += $request->input('quantity', 1);
            }
            else{
                $cart[$productId] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'quantity'   => $request->input('quantity', 1),
            ];
            }

            $request->session()->put('cart' , $cart);
            
            // $session_id = Session::getId();
            // $carts = Cart::where('session_id' , $session_id)->get();

            // if($carts){
            //     $carts->increment('quantity',$request->input('quantity',1));
            // }
            // else{
            //     Cart::create([
            //         'user_id' => $session_id,
            //         'product_id' => $product->id,
            //         'quantity'   => $request->input('quantity', 1),
            //         'price'      => $product->price,
            //         'session_id' => $session_id,
            //     ]);
            // }
        }

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }


    public function manageCart(Request $request)
    {

        if ($request->has('delete_item')) {
            $cartIdToDelete = $request->input('delete_item');

            Cart::where('id', $cartIdToDelete)
                ->where('user_id', auth()->id())
                ->delete();

            return redirect()->route('cart')->with('success', 'Item removed!');
        }


        if ($request->has('update_cart')) {
            $request->validate([
                'quantities'   => 'required|array',
                'quantities.*' => 'required|integer|min:1'
            ]);

            foreach ($request->input('quantities') as $cartId => $quantity) {
                Cart::where('id', $cartId)
                    ->where('user_id', auth()->id())
                    ->update(['quantity' => $quantity]);
            }
            return redirect()->route('cart')->with('success', 'Cart updated successfully!');
        }

        // If neither button was clicked, just return to the cart
        return redirect()->route('cart');
    }
}
