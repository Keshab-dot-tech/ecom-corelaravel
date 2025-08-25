<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ... index() and store() methods remain the same ...
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();
        return view('user.cart', compact('cartItems'));
    }

    public function store(Request $request, Product $product)
    {
        // Your existing store logic
    }

    /**
     * Update all cart items at once.
     */
    public function updateAll(Request $request)
    {
        dd($request->all());
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1', // Validate each item in the array
        ]);

        $quantities = $request->input('quantities');

        foreach ($quantities as $cartId => $quantity) {
            // Find the cart item that belongs to the CURRENT user to prevent unauthorized updates
            $cartItem = Cart::where('id', $cartId)
                            ->where('user_id', auth()->id())
                            ->first();

            if ($cartItem) {
                $cartItem->update(['quantity' => $quantity]);
            }
        }

        return redirect()->route('cart')->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove an item from the cart.
     */
    public function destroy(Cart $cart)
    {
        // Authorization check
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $cart->delete();

        return redirect()->route('cart')->with('success', 'Item removed!');
    }
}