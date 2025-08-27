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
        
        return view('user.cart', compact('cartItems'));
    }

    public function store(Request $request, Product $product)
    {
        if (Auth::check()) {
            // User is logged in - store in database
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $request->input('quantity', 1));
            } else {
                Cart::create([
                    'user_id'    => Auth::id(),
                    'product_id' => $product->id,
                    'quantity'   => $request->input('quantity', 1),
                    'price'      => $product->price,
                    'session_id' => Session::getId()
                ]);
            }
        } else {
            // User is guest - store in session
            $cart = Session::get('cart', []);
            $productId = $product->id;
            
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $request->input('quantity', 1);
            } else {
                $cart[$productId] = [
                    'product_id' => $product->id,
                    'name'       => $product->name,
                    'price'      => $product->price,
                    'quantity'   => $request->input('quantity', 1),
                    'image_path' => $product->image_path ?? 'default.jpg',
                ];
            }

            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function manageCart(Request $request)
    {
        if (Auth::check()) {
            // User is logged in - manage database cart
            if ($request->has('delete_item')) {
                $cartIdToDelete = $request->input('delete_item');
                Cart::where('id', $cartIdToDelete)
                    ->where('user_id', Auth::id())
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
                        ->where('user_id', Auth::id())
                        ->update(['quantity' => $quantity]);
                }
                return redirect()->route('cart')->with('success', 'Cart updated successfully!');
            }
        } else {
            // User is guest - manage session cart
            if ($request->has('delete_item')) {
                $productIdToDelete = $request->input('delete_item');
                $cart = Session::get('cart', []);
                unset($cart[$productIdToDelete]);
                Session::put('cart', $cart);
                return redirect()->route('cart')->with('success', 'Item removed!');
            }

            if ($request->has('update_cart')) {
                $request->validate([
                    'quantities'   => 'required|array',
                    'quantities.*' => 'required|integer|min:1'
                ]);

                $cart = Session::get('cart', []);
                foreach ($request->input('quantities') as $productId => $quantity) {
                    if (isset($cart[$productId])) {
                        $cart[$productId]['quantity'] = $quantity;
                    }
                }
                Session::put('cart', $cart);
                return redirect()->route('cart')->with('success', 'Cart updated successfully!');
            }
        }

        return redirect()->route('cart');
    }
}
