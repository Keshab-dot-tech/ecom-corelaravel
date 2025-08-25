{{-- <x-layouts.app>
 

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
                        <div class="item">
                            <div class="row d-flex align-items-center">
                                <div class="col-5">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('img/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="img-fluid">
                                        <div class="title">
                                            <a href="#"><h5>{{ $item->product->name }}</h5></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2"><span>${{ $item->price }}</span></div>
                                <div class="col-2">
                                    <div class="d-flex align-items-center">
                                    
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="update_form d-flex align-items-center">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="dec-btn btn btn-light">-</button>
                                            <input type="text" name="quantity" class="quantity-no form-control text-center" value="{{ $item->quantity }}" style="width: 50px;">
                                            <button type="button" class="inc-btn btn btn-light">+</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-1 text-center">
                                    <span class="line-total">${{ $item->price * $item->quantity }}</span>
                                </div>
                                <div class="col-2">
                             
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="CTAs d-flex justify-content-end pt-4">
                <a href="{{ route('category') }}" class="btn btn-template-outlined wide mr-2">Continue Shopping</a>
         
                <button type="button" class="update_btn btn btn-template wide">Update Cart</button>
            </div>
        </div>
    </section>

 
    <section class="order-details no-padding-top">
 
    </section>

</x-layouts.app>


<script>
document.addEventListener("DOMContentLoaded", function () {
    // Debugging: Check if this script block is running at all.
    // console.log("Cart script loaded.");

    const updateForms = document.querySelectorAll(".update_form");

    // Debugging: Check if we are finding the forms.
    // console.log(`Found ${updateForms.length} update forms.`);

    updateForms.forEach(function (form) {
        const decBtn = form.querySelector(".dec-btn");
        const incBtn = form.querySelector(".inc-btn");
        const quantityInput = form.querySelector(".quantity-no");

        
        if (decBtn && incBtn && quantityInput) {

            decBtn.addEventListener("click", function () {
                let currentValue = parseInt(quantityInput.value, 10);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            incBtn.addEventListener("click", function () {
                let currentValue = parseInt(quantityInput.value, 10);
                quantityInput.value = currentValue + 1;
            });

        } else {
           
        }
    });

    const updateCartButton = document.querySelector('.update_btn');

    if (updateCartButton) {
        updateCartButton.addEventListener('click', function (e) {
            e.preventDefault();
            
            document.querySelectorAll('.update_form').forEach(form => {
                form.submit();
            });
        });
    }
});
</script> --}}




{{--  

<x-layouts.app>
    

    <section class="shopping-cart">
        <div class="container">
           
            <form action="{{ route('cart.update.all') }}" method="POST">
                @csrf
                <div class="basket">
                    <div class="basket-holder">
                        <div class="basket-header">
                        
                        </div>
                        <div class="basket-body">
                            @foreach($cartItems as $item)
                            <div class="item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5">
                                       
                                    </div>
                                    <div class="col-2"><span>${{ $item->price }}</span></div>
                                    <div class="col-2">
                                        <div class="d-flex align-items-center">
                                           
                                            <button type="button" class="dec-btn btn btn-light">-</button>
                                            
                                          
                                            <input type="text" name="quantities[{{ $item->id }}]" class="quantity-no form-control text-center" value="{{ $item->quantity }}" style="width: 50px;">
                                            
                                            <button type="button" class="inc-btn btn btn-light">+</button>
                                        </div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <span class="line-total">${{ $item->price * $item->quantity }}</span>
                                    </div>
                                    <div class="col-2">
                               
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Remove item"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="container mt-4">
                    <div class="CTAs d-flex justify-content-end">
                        <a href="{{ route('category') }}" class="btn btn-template-outlined wide mr-2">Continue Shopping</a>
                        
                   
                        <button type="submit" class="btn btn-template wide">Update Cart</button>
                    </div>
                </div>

            </form>  
        </div>
    </section>

   
</x-layouts.app>

 
<script>
document.addEventListener("DOMContentLoaded", function () {
    
    document.querySelectorAll(".item").forEach(function (item) {
        const decBtn = item.querySelector(".dec-btn");
        const incBtn = item.querySelector(".inc-btn");
        const quantityInput = item.querySelector(".quantity-no");

        if (decBtn && incBtn && quantityInput) {
            decBtn.addEventListener("click", function () {
                let currentValue = parseInt(quantityInput.value, 10);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            incBtn.addEventListener("click", function () {
                let currentValue = parseInt(quantityInput.value, 10);
                quantityInput.value = currentValue + 1;
            });
        }
    });

 
});
</script> --}}






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
           
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

           
            <form action="{{ route('cart.manage') }}" method="POST">
                @csrf
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
                            @forelse($cartItems as $item)
                                <div class="item">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-5">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('img/' . $item->product->image_path) }}" alt="..." class="img-fluid">
                                                <div class="title">
                                                    <h5>{{ $item->product->name }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2"><span>${{ $item->price }}</span></div>
                                        <div class="col-2">
                                           
                                            <div class="d-flex align-items-center">
                                                <button type="button" class="dec-btn btn btn-sm btn-light">-</button>
                                                
                                                <input type="text" name="quantities[{{ $item->id }}]" class="quantity-no form-control form-control-sm text-center" value="{{ $item->quantity }}" style="width: 50px;">
                                                <button type="button" class="inc-btn btn btn-sm btn-light">+</button>
                                            </div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span>${{ $item->price * $item->quantity }}</span>
                                        </div>
                                        <div class="col-2">
                                           
                                            <button type="submit" name="delete_item" value="{{ $item->id }}" class="btn btn-danger btn-sm" title="Remove item">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center">
                                    <p>Your shopping cart is empty.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                @if($cartItems->isNotEmpty())
                <div class="container mt-4">
                    <div class="CTAs d-flex justify-content-end">
                        <a href="{{ route('category') }}" class="btn btn-template-outlined wide mr-2">Continue Shopping</a>
                        {{-- This button has a name to identify the update action --}}
                        <button type="submit" name="update_cart" value="true" class="btn btn-template wide">Update Cart</button>
                    </div>
                </div>
                @endif
            </form> 
        </div>
    </section>

     
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
               
                <div class="col-lg-12 text-center CTAs"><a href="{{route("checkout_address")}}"
                        class="btn btn-template btn-lg wide">Proceed to checkout<i
                            class="fa fa-long-arrow-right"></i></a></div>
            </div>
        </div>
    </section>


</x-layouts.app>

{{-- SIMPLIFIED AND CORRECTED SCRIPT --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".item").forEach(function (itemRow) {
            const decBtn = itemRow.querySelector(".dec-btn");
            const incBtn = itemRow.querySelector(".inc-btn");
            const input = itemRow.querySelector(".quantity-no");

            if (!decBtn || !incBtn || !input) return;

            decBtn.addEventListener("click", function () {
                let val = parseInt(input.value) || 1;
                if (val > 1) {
                    input.value = val - 1;
                }
            });

            incBtn.addEventListener("click", function () {
                let val = parseInt(input.value) || 0;
                input.value = val + 1;
            });
        });

        // The old, buggy script for submitting multiple forms is completely removed.
    });
</script>