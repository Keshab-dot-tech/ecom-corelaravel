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

//cart controller

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function create()
    {
        return view('user.user_login');
    }

    protected function itemAdding(Request $request, $user)
    {
        $sessionCart = Session::get('cart', []);

        if (!empty($sessionCart)) {
            foreach ($sessionCart as $item) {
                // Check if item already exists in user's cart
                $cartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $item['product_id'])
                    ->first();

                if ($cartItem) {
                    // Item exists, increment quantity
                    $cartItem->increment('quantity', $item['quantity']);
                } else {
                    // Item doesn't exist, create new cart item
                    Cart::create([
                        'user_id' => $user->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'session_id' => Session::getId(), // Store current session ID
                    ]);
                }
            }
            
            // Clear the session cart after merging
            Session::forget('cart');
        }
    }

    public function store(Request $request)
    {
        $credentials = $request->validateWithBag('login', [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            // Merge session cart with database cart
            $this->itemAdding($request, Auth::user());
            
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
    }
}
//login controller
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


 //order controller

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

//checkout controller