<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{

    public function create()
    {
        return view('user.user_login');
    }

    protected function itemAdding(Request $request , $user)
    {
        $sessionCart = $request->session()->get('cart', []);

        if (!empty($sessionCart)) {
            foreach ($sessionCart as $item) {
                $cartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $item['product_id'])
                    ->first();

                if ($cartItem) {
                    $cartItem->increment('quantity', $item['quantity']);
                } else {
                    Cart::create([
                        'user_id' => $user->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }
            }
           
        }
        

        $request->session()->forget('cart');
    }

    public function store(Request $request)
    {
    
        $credentials = $request->validateWithBag('login', [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {



            
            $this->itemAdding($request,Auth::user());
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ])->errorBag('login');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("user_login")->with('success', 'You have been successfully logged out.');
        // return redirect("user_login");

    }
}
