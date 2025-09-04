<x-layouts.app>
    <x-hero-section />
    <!-- Checkout Forms-->
    <section class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="{{route("checkout_address")}}" class="nav-link active">Address</a>
                        </li>
                         <li class="nav-item"><a href="{{route("checkout_shipping_address")}}" class="nav-link">Shipping Address </a></li>
                        <li class="nav-item"><a href="#" class="nav-link disabled">Delivery Method </a></li>
                        <li class="nav-item"><a href="#" class="nav-link disabled">Payment Method </a></li>
                        <li class="nav-item"><a href="#" class="nav-link disabled">Order Review</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="address" class="active tab-block">
                            <form action="{{route("save_address")}}" method="POST" class="address_form" id="myForm">
                                @csrf

                                <!-- Invoice Address-->
                                <div class="block-header mb-5">
                                    <h6>Invoice address </h6>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $invoiceAddress['name'] ?? '') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input id="email" type="email" name="email"
                                            placeholder="enter your email address" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $invoiceAddress['email'] ?? '') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="street" class="form-label">Street</label>
                                        <input id="street" type="text" name="address" placeholder="Your street name"
                                            class="form-control @error('address') is-invalid @enderror" value="{{old('address', $invoiceAddress['address'] ?? '')}}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="city" class="form-label">City</label>
                                        <input id="city" type="text" name="city" placeholder="Your city"
                                            class="form-control @error('city') is-invalid @enderror" value="{{old('city', $invoiceAddress['city'] ?? '')}}">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="zip" class="form-label">ZIP</label>
                                        <input id="zip" type="text" name="zip_code" placeholder="ZIP code"
                                            class="form-control @error('zip_code') is-invalid @enderror" value="{{old('zip_code', $invoiceAddress['zip_code'] ?? '')}}">
                                        @error('zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="state" class="form-label">State</label>
                                        <input id="state" type="text" name="state_name" placeholder="Your state"
                                            class="form-control @error('state_name') is-invalid @enderror"
                                            value="{{old('state_name', $invoiceAddress['state_name'] ?? '')}}">
                                        @error('state_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input id="country" type="text" name="country_name" placeholder="Your country"
                                            class="form-control @error('country_name') is-invalid @enderror"
                                            value="{{old('country_name', $invoiceAddress['country_name'] ?? '')}}">
                                        @error('country_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone-number" class="form-label">Phone Number</label>
                                        <input id="phone-number" type="tel" name="phone" placeholder="Your phone number"
                                            class="form-control @error('phone') is-invalid @enderror" value="{{old('phone', $invoiceAddress['phone'] ?? '')}}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="company" class="form-label">Company</label>
                                        <input id="company" type="text" name="company" placeholder="Your company name"
                                            class="form-control @error('company') is-invalid @enderror" value="{{old('company', $invoiceAddress['company'] ?? '')}}">
                                        @error('company')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-12 mt-3 ml-3">
                                        <input id="another-address" type="checkbox" name="another_address" class="checkbox-template" {{ $useDifferentShipping ? 'checked' : '' }}>
                                        <label for="another-address">Use different shipping address</label>
                                    </div> --}}
                                </div>
                                <!-- /Invoice Address-->
                                <div class="CTAs d-flex justify-content-between flex-column flex-lg-row">
                                    <a href="{{route("cart")}}" class="btn btn-template-outlined wide prev"> <i class="fa fa-angle-left"></i>Back to basket</a>
                                    <button type="submit" class="btn btn-template wide next">
                                        Next Step<i class="fa fa-angle-right"></i>
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