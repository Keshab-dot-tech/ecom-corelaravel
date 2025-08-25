<x-layouts.app>
    <section class="hero hero-page gray-bg padding-small">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-9 order-2 order-lg-1">
                    <h1>Shopping-Cart</h1>
                    <p class="lead">You currently have {{sizeof($cartItems)}} item(s) in your basket</p>
                </div>
                <div class="col-lg-3 text-right order-1 order-lg-2">
                    <ul class="breadcrumb justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="{{route("category")}}">Home</a></li>
                        <li class="breadcrumb-item active">{{ collect(request()->segments())->last() }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="shopping-cart">
        <div class="container">
            <div class="basket">
                <div class="basket-holder">
                    <div class="basket-header">
                        <div class="row">
                            <div class="col-5">Product</div>
                            <div class="col-2">Price</div>
                            <div class="col-2">Quantity</div>
                            <div class="col-1">Total</div>
                            <div class="col-2">Remove</div>
                        </div>
                    </div>
                    <div class="basket-body">

                        @foreach($cartItems as $item)
                        <div class="item product-price" data-id="{{ $item->id }}" data-price="{{ $item->price }}">


                            <div class="row d-flex align-items-center">
                                <div class="col-5">
                                    <div class="d-flex align-items-center"><img src={{asset("img/" .
                                            $item->product->image_path)}} alt="..."
                                        class="img-fluid">
                                        <div class="title"><a href="{{route("category" , '$item' )}}">
                                                <h5>{{$item->product->name}}</h5><span class="text-muted">Size:
                                                    Large</span>
                                            </a></div>
                                    </div>
                                </div>
                                <div class="col-2"><span>{{ '$'.$item->price }}</span></div>

                                <div class="col-2">
                                    <div class="d-flex align-items-center mr-3">
                                        <div class="item quantity d-flex align-items-center" data-id="{{ $item->id }}"
                                            data-price="{{ $item->price }}">

                                            


                                            <form action="{{route("cart.update" , $item->id)}}" method="POST"
                                                class="update_form d-flex align-items-center">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="dec-btn">-</button>
                                                <input type="text" name="quantity" class="quantity-no"
                                                    value="{{ $item->quantity }}">
                                                <button type="button" class="inc-btn">+</button>
                                            </form>
                                       </div>
                                    </div>
                                </div>

                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <span class="line-total">${{ $item->price * $item->quantity }}</span>
                                </div>



                                {{-- <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')

                                    <button class="btn btn-primary border-0"><i class="delete fa fa-trash"></i></button>
                                </form> --}}
                                <a href="{{route("cart.destroy" , $item->id)}}" class="update_btn btn btn-template wide"><i class="delete fa fa-trash"></i></a>



                            </div>
                        </div>
                        @endforeach

                        {{-- @foreach($cartItems as $item)
                            <div class="item product-price" data-id="{{ $item->id }}" data-price="{{ $item->price }}">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('img/' . $item->product->image_path) }}" class="img-fluid">
                                            <div class="title">
                                                <h5>{{ $item->product->name }}</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2"><span>${{ $item->price }}</span></div>

                                   
                                    <div class="col-2">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                            class="update_form d-flex align-items-center">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="dec-btn">-</button>
                                            <input type="text" name="quantity" class="quantity-no"
                                                value="{{ $item->quantity }}">
                                            <button type="button" class="inc-btn">+</button>
                                        </form>
                                    </div>

                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                        <span class="line-total">${{ $item->price * $item->quantity }}</span>
                                    </div>

                                     
                                    <div class="col-2">
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-primary border-0"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}

                        {{-- <div class="container">
                            <div class="CTAs d-flex justify-content-end">
                                <a href="{{ route('category') }}" class="btn btn-template-outlined wide">Continue
                                    Shopping</a>
                                <a href="#" class="update_btn btn btn-template wide">Update Cart</a>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div
                class="CTAs d-flex align-items-center justify-content-center justify-content-md-end flex-column flex-md-row">
                <a href="{{route("category")}}" class="btn btn-template-outlined wide">Continue Shopping</a><a
                    href="{{route("cart.update", $item->product->id)}}" class="update_btn btn btn-template wide">Update
                    Cart</a>
            </div>
             
        </div>

    </section>

































    <!-- Order Details Section-->
    <section class="order-details no-padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="block">
                        <div class="block-header">
                            <h6 class="text-uppercase">Coupon Code</h6>
                        </div>
                        <div class="block-body">
                            <p>If you have a coupon code, please enter it in the box below</p>
                            <form action="#">
                                <div class="form-group d-flex">
                                    <input type="text" name="coupon">
                                    <button type="submit" class="cart-black-button">Apply coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-header">
                            <h6 class="text-uppercase">Instructions for seller</h6>
                        </div>
                        <div class="block-body">
                            <p>If you have some information for the seller you can leave them in the box below</p>
                            <form action="#">
                                <textarea name="instructions"></textarea>
                            </form>
                        </div>
                    </div>
                </div>
                <x-order-summary :cartItems='$cartItems' class="order-summary" />
                {{-- <div class="order-summary">
                    <x-order-summary :cartItems='$cartItems' />
                </div> --}}
                <div class="col-lg-12 text-center CTAs"><a href="{{route("checkout_address")}}"
                        class="btn btn-template btn-lg wide">Proceed to checkout<i
                            class="fa fa-long-arrow-right"></i></a></div>
            </div>
        </div>
    </section>
</x-layouts.app>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".update_form").forEach(function (form) {
            let decBtn = form.querySelector(".dec-btn");
            let incBtn = form.querySelector(".inc-btn");
            let input = form.querySelector(".quantity-no");
            let saveBtn = form.querySelector(".save-btn");

            decBtn.addEventListener("click", function () {
                let val = parseInt(input.value) || 1;
                if (val > 1) input.value = val - 1;
                saveBtn.classList.remove("d-none");
            });

            incBtn.addEventListener("click", function () {
                let val = parseInt(input.value) || 1;
                input.value = val + 1;
                saveBtn.classList.remove("d-none");
            });
        });

        document.querySelector('.update_btn').addEventListener('click', function (e) {
            e.preventDefault();

            // Submit each update form
            document.querySelectorAll('.update_form').forEach(form => {
                form.submit();
            });


        });








    });

</script>

-------------------cart controller------------------------------
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

        // return view('cart.index', compact('cartItems'));
        return view('user.cart', compact('cartItems'));
    }



    public function store(Request $request, Product $product)
    {
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

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    // public function update(Request $request, Cart $cart)
    // {
    //     $cart->update(['quantity' => $request->input('quantity', 1)]);
    //     return redirect()->route('cart')->with('success', 'Cart updated!');
    // }


    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart')->with('success', 'Cart updated!');
    }



    public function update_cart(Request $request, $id)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $carts = Cart::where('user_id', $user_id)->get();

            foreach ($carts as $cart) {
                $product_id = $cart->product_id;
                $quantity = $request->product_id;
                if ($quantity > 0) {
                    $cart = Cart::where([
                        ['user_id', $user_id],
                        ['product_id', $product_id]
                    ])->update(['quantity' => $quantity]);
                } else {
                    $cart = Cart::where([
                        ['user_id', $user_id],
                        ['product_id', $product_id]
                    ])->delete();
                }
            }
        } else {
            $session_id = Session::getId();
            $carts = Cart::where('session_id', $session_id)->get();

            foreach ($carts as $cart) {
                $product_id = $cart->product_id;
                $quantity = $request->$product_id;
                if ($quantity > 0) {
                    $cart = Cart::where([
                        ['user_id', $session_id],
                        ['product_id', $product_id]
                    ])->update(['quantity' => $quantity]);
                } else {
                    $cart = Cart::where([
                        ['user_id', $session_id],
                        ['product_id', $product_id]
                    ])->delete();
                }
            }
        }

        return redirect()->route('cart');
    }


    public function destroy(Request $request,string $product_id)
    {
        // $item->delete();

        if (Auth::check()) {
            $user_id = Auth::id();

            $cart = Cart::where([
                ['user_id', $user_id],
                ['product_id', $product_id]
            ])->delete();
        } else {
            $session_id = Session::getId();

            $cart = Cart::where([
                ['session_id', $session_id],
                ['product_id', $product_id]
            ])->delete();
        }

        return redirect()->route('cart')->with('success', 'Item removed!');
    }
}
