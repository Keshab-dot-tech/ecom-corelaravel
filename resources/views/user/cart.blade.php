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





{{-- cart.blade.php --}}

<x-layouts.app>
    {{-- ... (your hero section HTML remains the same) ... --}}

    <section class="shopping-cart">
        <div class="container">
            {{-- THE SINGLE FORM STARTS HERE --}}
            <form action="{{ route('cart.update.all') }}" method="POST">
                @csrf
                <div class="basket">
                    <div class="basket-holder">
                        <div class="basket-header">
                            {{-- ... (header row HTML remains the same) ... --}}
                        </div>
                        <div class="basket-body">
                            @foreach($cartItems as $item)
                            <div class="item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5">
                                        {{-- ... (product info HTML remains the same) ... --}}
                                    </div>
                                    <div class="col-2"><span>${{ $item->price }}</span></div>
                                    <div class="col-2">
                                        <div class="d-flex align-items-center">
                                            {{-- NOTE: The individual form is GONE --}}
                                            <button type="button" class="dec-btn btn btn-light">-</button>
                                            
                                            {{-- CRITICAL CHANGE: The input name is now an array --}}
                                            <input type="text" name="quantities[{{ $item->id }}]" class="quantity-no form-control text-center" value="{{ $item->quantity }}" style="width: 50px;">
                                            
                                            <button type="button" class="inc-btn btn btn-light">+</button>
                                        </div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <span class="line-total">${{ $item->price * $item->quantity }}</span>
                                    </div>
                                    <div class="col-2">
                                        {{-- This still needs its own form for individual deletion --}}
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
                        
                        {{-- CRITICAL CHANGE: This is now a submit button for the main form --}}
                        <button type="submit" class="btn btn-template wide">Update Cart</button>
                    </div>
                </div>

            </form> {{-- THE SINGLE FORM ENDS HERE --}}
        </div>
    </section>

    {{-- ... (rest of your blade file) ... --}}

</x-layouts.app>

{{-- The JavaScript can now be much simpler --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    // This logic now ONLY handles the visual +/- buttons, not submission.
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

    // We NO LONGER need the ".update_btn" click listener to submit forms.
    // The <button type="submit"> handles it automatically.
});
</script>