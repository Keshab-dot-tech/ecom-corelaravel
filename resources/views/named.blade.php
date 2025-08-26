{{-- ✅ Implementation Approach
1. Store cart in session if guest

Instead of trying to insert into the DB with session_id, you can keep the cart items in Laravel’s session().

public function store(Request $request, Product $product)
{
    if (Auth::check()) {
        // Logged in user → store in DB
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
            ]);
        }
    } else {
        // Guest → store in session
        $cart = session()->get('cart', []);

        $productId = $product->id;
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$productId] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'quantity'   => $request->input('quantity', 1),
            ];
        }

        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Item added to cart!');
}

2. On login → merge session cart into DB

You can use Laravel’s Authenticated event (fires after login).

Create an event listener:

php artisan make:listener MergeCartAfterLogin


Inside MergeCartAfterLogin:

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Cart;

class MergeCartAfterLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;
        $sessionCart = session()->get('cart', []);

        foreach ($sessionCart as $productId => $item) {
            $cartItem = Cart::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $item['quantity']);
            } else {
                Cart::create([
                    'user_id'    => $user->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }
        }

        // Clear session cart after merging
        session()->forget('cart');
    }
}



{{-- protected function authenticated(Request $request, $user)
{
    // Get guest cart from session
    $sessionCart = session()->get('cart', []);

    if (!empty($sessionCart)) {
        foreach ($sessionCart as $item) {
            $cartItem = \App\Models\Cart::where('user_id', $user->id)
                ->where('product_id', $item['product_id'])
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $item['quantity']);
            } else {
                \App\Models\Cart::create([
                    'user_id'    => $user->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }
        }

        // clear guest session cart
        session()->forget('cart');
    }
} --}}


Laravel automatically calls authenticated() after login if you define it.

This way → when user logs in, the session cart gets merged into the DB.

🔹 2. Middleware approach

You can create a middleware like MergeCartMiddleware.

It checks if the user just logged in and there’s a session cart.

If yes → merge it into DB.

public function handle($request, Closure $next)
{
    if (auth()->check() && session()->has('cart')) {
        $sessionCart = session('cart');

        foreach ($sessionCart as $item) {
            $cartItem = \App\Models\Cart::where('user_id', auth()->id())
                ->where('product_id', $item['product_id'])
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $item['quantity']);
            } else {
                \App\Models\Cart::create([
                    'user_id'    => auth()->id(),
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }
        }

        session()->forget('cart');
    }

    return $next($request);
}


Then register middleware in app/Http/Kernel.php under web.
