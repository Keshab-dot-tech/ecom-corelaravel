<x-layouts.app>
    <!-- Hero Section-->
    <x-hero-section />
    <!-- Checout Forms-->
    <section class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="{{route("checkout_address")}}" class="nav-link">Address</a></li>
                        <li class="nav-item"><a href="{{route("checkout_shipping_address")}}" class="nav-link ">Shipping
                                Address </a></li>
                        <li class="nav-item"><a href="{{route("checkout_delivery")}}" class="nav-link">Delivery Method
                            </a>
                        </li>
                        <li class="nav-item"><a href="{{route("checkout_payment")}}" class="nav-link">Payment Method
                            </a>
                        </li>
                        <li class="nav-item"><a href="{{route("checkout_order_review")}}" class="nav-link active">Order
                                Review</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="order-review" class="tab-block">

                            <div class="basket-header"
                                style="font-size: 24px; font-weight: bold; margin-bottom: 15px; color: #333; text-align: center; padding: 10px; background-color: #f8f8f8; border-bottom: 2px solid #ddd;">
                                Review your Order
                            </div>
                            <div class="cart">
                                <div class="cart-holder">
                                    <div class="basket-header">

                                        <div class="row">
                                            <div class="col-6">Product</div>
                                            <div class="col-2">Price</div>
                                            <div class="col-2">Quantity</div>
                                            <div class="col-2">Unit Price</div>
                                        </div>
                                    </div>
                                    <div class="basket-body">

                                        @foreach($cartItems as $item)
                                            <div class="item">
                                                <div class="row d-flex align-items-center">


                                                    <div class="col-5">
                                                        <div class="d-flex align-items-center"><img src={{asset("img/" . $item->product->image_path)}} alt="..." class="img-fluid">
                                                            <div class="title"><a
                                                                    href="{{route("products.show", '$item')}}">
                                                                    <h5>Loose Oversised Shirt</h5><span
                                                                        class="text-muted">Size:
                                                                        Large</span>
                                                                </a></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2"><span>{{ $item->product->name }}</span></div>
                                                    <form action="" method="post" class="update_form">
                                                        <div class="col-2">
                                                            <div class="d-flex align-items-center">
                                                                <div class="quantity d-flex align-items-center">
                                                                    <div class="dec-btn">-</div>
                                                                    <input type="text" value="{{ $item->quantity }}"
                                                                        class="quantity-no">
                                                                    <div class="inc-btn">+</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="col-2"><span>${{ $item->price * $item->quantity }}</span>
                                                    </div>


                                                    {{-- <form action="{{ route('checkout_item_destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-primary border-0" name="delete_item"
                                                            title="Remove item"><i class="delete fa fa-trash"></i></button>
                                                    </form> --}}





                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="row mt-4">
                                            <div class="col-md-6 col-12">
                                                <h6 style="color: #888; font-weight: 600; font-size: 1rem;">Invoice
                                                    Address</h6>
                                                <p style="color: #bbb; font-size: 0.95rem;">
                                                    {{ $invoiceAddress['name'] ?? '' }}<br>
                                                    {{ $invoiceAddress['address'] ?? '' }}<br>
                                                    {{ $invoiceAddress['city'] ?? '' }},
                                                    {{ $invoiceAddress['state_name'] ?? '' }} -
                                                    {{ $invoiceAddress['zip_code'] ?? '' }}<br>
                                                    {{ $invoiceAddress['country_name'] ?? '' }}<br>
                                                    Phone: {{ $invoiceAddress['phone'] ?? '' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <h6 style="color: #888; font-weight: 600; font-size: 1rem;">Shipping
                                                    Address</h6>
                                                <p style="color: #bbb; font-size: 0.95rem;">
                                                    {{ $shippingAddress['shipping_first_name'] ?? '' }}
                                                    {{ $shippingAddress['shipping_last_name'] ?? '' }}<br>
                                                    {{ $shippingAddress['shipping_address'] ?? '' }}<br>
                                                    {{ $shippingAddress['shipping_city'] ?? '' }},
                                                    {{ $shippingAddress['shipping_state'] ?? '' }} -
                                                    {{ $shippingAddress['shipping_zip'] ?? '' }}<br>
                                                    {{ $shippingAddress['shipping_country'] ?? '' }}<br>
                                                    Phone: {{ $shippingAddress['shipping_phone_number'] ?? '' }}
                                                </p>
                                            </div>
                                        </div>






                                    </div>
                                </div>
                                <div class="total row"><span class="col-md-10 col-2">Total</span><span
                                        class="col-md-2 col-10 text-primary">${{ $cartItems->sum(fn($i) => $i->price * $i->quantity)}}</span>
                                </div>
                            </div>
                            <div class="CTAs d-flex justify-content-between flex-column flex-lg-row"><a
                                    href="{{route("checkout_payment")}}" class="btn btn-template-outlined wide prev"><i
                                        class="fa fa-angle-left"></i>Back to payment method</a>
                                {{-- <a href="{{route(" checkout_order_confirm")}}"
                                    class="btn btn-template wide next">Place
                                    an order<i class="fa fa-angle-right"></i></a> --}}
                                <form action="{{ route('checkout_place_order') }}" method="POST">
                                    @csrf


                                    <button type="submit" class="btn btn-success">
                                        Place Order
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <x-order-summary :cartItems='$cartItems' />
            </div>
        </div>

        {{-- <h3>Invoice Address</h3>
        <p>
            {{ $invoiceAddress['name'] ?? '' }}<br>
            {{ $invoiceAddress['street'] ?? '' }}<br>
            {{ $invoiceAddress['city'] ?? '' }}, {{ $invoiceAddress['state'] ?? '' }} -
            {{ $invoiceAddress['zip'] ?? '' }}<br>
            {{ $invoiceAddress['country'] ?? '' }}<br>
            Phone: {{ $invoiceAddress['phone'] ?? '' }}
        </p>

        <h3>Shipping Address</h3>
        <p>

            {{ $shippingAddress['shipping_first_name'] ?? '' }} {{ $shippingAddress['shipping_last_name'] ?? '' }}<br>
            {{ $shippingAddress['shipping_address'] ?? '' }}<br>
            {{ $shippingAddress['shipping_city'] ?? '' }}, {{ $shippingAddress['shipping_state'] ?? '' }} -
            {{ $shippingAddress['shipping_zip'] ?? '' }}<br>
            {{ $shippingAddress['shipping_country'] ?? '' }}<br>
            Phone: {{ $shippingAddress['shipping_phone_number'] ?? '' }} --}}
        </p>
        </p>

    </section>


</x-layouts.app>