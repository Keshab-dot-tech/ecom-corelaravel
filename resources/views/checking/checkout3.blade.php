<x-layouts.app>
    <x-hero-section />
    <!-- Checkout Forms-->
    <section class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="{{route("checkout_address")}}" class="nav-link">Address</a>
                        </li>
                        <li class="nav-item"><a href="{{route("checkout_shipping_address")}}" class="nav-link">Shipping Address </a></li>
                        <li class="nav-item"><a href="{{route("checkout_delivery")}}" class="nav-link active">Delivery Method </a></li>
                        <li class="nav-item"><a href="#" class="nav-link disabled">Payment Method </a></li>
                        <li class="nav-item"><a href="#" class="nav-link disabled">Order Review</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="delivery-method" class="active tab-block">
                            <form action="{{ route('save_delivery_method') }}" method="POST">
                                @csrf
                                <div class="block-header mb-5">
                                    <h6>Choose your delivery method</h6>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <div class="form-check custom-radio">
                                            <input type="radio" id="delivery_standard" name="delivery_method" class="form-check-input" value="standard" {{ old('delivery_method', $deliveryMethod) == 'standard' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="delivery_standard">
                                                <strong>Standard Delivery</strong> - 3-5 business days (Free)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <div class="form-check custom-radio">
                                            <input type="radio" id="delivery_express" name="delivery_method" class="form-check-input" value="express" {{ old('delivery_method', $deliveryMethod) == 'express' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="delivery_express">
                                                <strong>Express Delivery</strong> - 1-2 business days ($10.00)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('delivery_method')
                                    <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror

                                <div class="CTAs d-flex justify-content-between flex-column flex-lg-row">
                                    <a href="{{ Session::get('checkout.use_different_shipping') ? route('checkout_shipping_address') : route('checkout_address') }}" class="btn btn-template-outlined wide prev"><i class="fa fa-angle-left"></i>Back</a>
                                    <button type="submit" class="btn btn-template wide next">
                                        Choose payment method <i class="fa fa-angle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <x-order-summary :cartItems="$cartItems" />
            </div>
        </div>
    </section>
</x-layouts.app>