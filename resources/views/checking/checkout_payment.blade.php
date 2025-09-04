<x-layouts.app>
    <x-hero-section />
    <section class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="{{route("checkout_address")}}" class="nav-link">Address</a></li>
                         <li class="nav-item"><a href="{{route("checkout_shipping_address")}}" class="nav-link">Shipping Address </a></li>
                        <li class="nav-item"><a href="{{route("checkout_delivery")}}" class="nav-link">Delivery Method</a></li>
                        <li class="nav-item"><a href="{{route("checkout_payment")}}" class="nav-link active">Payment Method</a></li>
                        <li class="nav-item"><a href="{{route("checkout_order_review")}}" class="nav-link" tabindex="-1" aria-disabled="true">Order Review</a></li>
                         

                    </ul>

                    <div class="tab-content">
                        <div id="payment-method" class="active tab-block">
                            <form action="{{ route('save_payment_method') }}" method="POST">
                                @csrf
                                <div class="block-header mb-5">
                                    <h6>Choose your payment method</h6>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <div class="form-check custom-radio">
                                            <input type="radio" id="payment_credit" name="payment_method" class="form-check-input" value="credit_card" {{ old('payment_method', $paymentMethod) == 'credit_card' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="payment_credit">
                                                <strong>Credit Card</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <div class="form-check custom-radio">
                                            <input type="radio" id="payment_paypal" name="payment_method" class="form-check-input" value="paypal" {{ old('payment_method', $paymentMethod) == 'paypal' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="payment_paypal">
                                                <strong>PayPal</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <div class="form-check custom-radio">
                                            <input type="radio" id="payment_bank" name="payment_method" class="form-check-input" value="bank_transfer" {{ old('payment_method', $paymentMethod) == 'bank_transfer' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="payment_bank">
                                                <strong>Bank Transfer</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('payment_method')
                                    <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror

                                <div class="CTAs d-flex justify-content-between flex-column flex-lg-row">
                                    <a href="{{route("checkout_delivery")}}" class="btn btn-template-outlined wide prev"><i class="fa fa-angle-left"></i>Back</a>
                                    <button type="submit" class="btn btn-template wide next">
                                        Continue to review <i class="fa fa-angle-right"></i>
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

