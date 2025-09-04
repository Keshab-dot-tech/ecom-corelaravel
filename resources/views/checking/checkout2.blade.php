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
                        <li class="nav-item"><a href="{{route("checkout_shipping_address")}}" class="nav-link active">Shipping Address </a></li>
                        <li class="nav-item"><a href="#" class="nav-link disabled">Delivery Method </a></li>
                        <li class="nav-item"><a href="#" class="nav-link disabled">Payment Method </a></li>
                        <li class="nav-item"><a href="#" class="nav-link disabled">Order Review</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="shipping_address_tab" class="active tab-block">
                            <form action="{{route("save_shipping_address")}}" method="POST" class="address_form" id="shippingAddressForm">
                                @csrf

                                {{-- @if ($useDifferentShipping) --}}
                                <!-- Shipping Address Form-->
                                <div class="block-header mb-5 mt-3">
                                    <h6>Shipping address</h6>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="shipping_first_name" class="form-label">First Name</label>
                                        <input id="shipping_first_name" type="text" name="shipping_first_name"
                                            placeholder="Enter your first name" class="form-control @error('shipping_first_name') is-invalid @enderror"
                                            value="{{ old('shipping_first_name', $shippingAddress['shipping_first_name'] ?? '') }}">
                                        @error('shipping_first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="shipping_last_name" class="form-label">Last Name</label>
                                        <input id="shipping_last_name" type="text" name="shipping_last_name"
                                            placeholder="Enter your last name" class="form-control @error('shipping_last_name') is-invalid @enderror"
                                            value="{{ old('shipping_last_name', $shippingAddress['shipping_last_name'] ?? '') }}">
                                        @error('shipping_last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="shipping_email" class="form-label">Email Address</label>
                                        <input id="shipping_email" type="email" name="shipping_email"
                                            placeholder="enter your email address" class="form-control @error('shipping_email') is-invalid @enderror"
                                            value="{{ old('shipping_email', $shippingAddress['shipping_email'] ?? '') }}">
                                        @error('shipping_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="shipping_street" class="form-label">Street</label>
                                        <input id="shipping_street" type="text" name="shipping_address"
                                            placeholder="Your street name" class="form-control @error('shipping_address') is-invalid @enderror"
                                            value="{{ old('shipping_address', $shippingAddress['shipping_address'] ?? '') }}">
                                        @error('shipping_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="shipping_city" class="form-label">City</label>
                                        <input id="shipping_city" type="text" name="shipping_city"
                                            placeholder="Your city" class="form-control @error('shipping_city') is-invalid @enderror"
                                            value="{{ old('shipping_city', $shippingAddress['shipping_city'] ?? '') }}">
                                        @error('shipping_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="shipping_zip" class="form-label">ZIP</label>
                                        <input id="shipping_zip" type="text" name="shipping_zip"
                                            placeholder="ZIP code" class="form-control @error('shipping_zip') is-invalid @enderror"
                                            value="{{ old('shipping_zip', $shippingAddress['shipping_zip'] ?? '') }}">
                                        @error('shipping_zip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="shipping_state" class="form-label">State</label>
                                        <input id="shipping_state" type="text" name="shipping_state"
                                            placeholder="Your state" class="form-control @error('shipping_state') is-invalid @enderror"
                                            value="{{ old('shipping_state', $shippingAddress['shipping_state'] ?? '') }}">
                                        @error('shipping_state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="shipping_country" class="form-label">Country</label>
                                        <input id="shipping_country" type="text" name="shipping_country"
                                            placeholder="Your country" class="form-control @error('shipping_country') is-invalid @enderror"
                                            value="{{ old('shipping_country', $shippingAddress['shipping_country'] ?? '') }}">
                                        @error('shipping_country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="shipping_phone-number" class="form-label">Phone Number</label>
                                        <input id="shipping_phone-number" type="tel" name="shipping_phone_number"
                                            placeholder="Your phone number" class="form-control @error('shipping_phone_number') is-invalid @enderror"
                                            value="{{ old('shipping_phone_number', $shippingAddress['shipping_phone_number'] ?? '') }}">
                                        @error('shipping_phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="shipping_company" class="form-label">Company</label>
                                        <input id="shipping_company" type="text" name="shipping_company"
                                            placeholder="Your company name" class="form-control @error('shipping_company') is-invalid @enderror"
                                            value="{{ old('shipping_company', $shippingAddress['shipping_company'] ?? '') }}">
                                        @error('shipping_company')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- @else
                                    <p>Your shipping address will be the same as your invoice address.</p>
                                    <p class="text-muted">You can go back to change it if needed.</p>
                                @endif --}}
                                <!-- /Shipping Address-->
                                <div class="CTAs d-flex justify-content-between flex-column flex-lg-row">
                                    <a href="{{route("checkout_address")}}" class="btn btn-template-outlined wide prev"> <i class="fa fa-angle-left"></i>Back to Address</a>
                                    <button type="submit" class="btn btn-template wide next">
                                        Choose delivery method <i class="fa fa-angle-right"></i>
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