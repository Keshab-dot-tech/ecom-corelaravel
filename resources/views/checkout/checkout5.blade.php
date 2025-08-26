<x-layouts.app>
<section class="hero hero-page gray-bg padding-small">
      <div class="container">
        <div class="row d-flex">
          <div class="col-lg-9 order-2 order-lg-1">
            <h1>Order confirmed</h1>
          </div>
          <div class="col-lg-3 text-right order-1 order-lg-2">
            <ul class="breadcrumb justify-content-lg-end">
              <li class="breadcrumb-item"><a href={{route("category")}}>Home</a></li>
              <li class="breadcrumb-item active">Order confirmed</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- Checout Forms-->
    <section class="checkout">
      <div class="container">
        <div class="confirmation-icon"><i class="fa fa-check"></i></div>
        <h2>Thank you, {{Auth()->user()->name}}. Your order is confirmed.</h2>
        <p class="mb-5">Your order hasn't shipped yet but we will send you ane email when it does.</p>
        <p> <a href="{{route("order_detail")}}" class="btn btn-template wide">View or manage your order</a></p>
      </div>
    </section>
    </x-layouts.app>




{{--  --}}

    {{-- <h4>Billing Address</h4>
@if(!empty($address))
    <p>{{ $address['name'] }}</p>
    <p>{{ $address['email'] }}</p>
    <p>{{ $address['address'] }}, {{ $address['city'] }}, {{ $address['state_name'] }} - {{ $address['zip_code'] }}</p>
    <p>{{ $address['country_name'] }}</p>
    <p>{{ $address['phone'] }}</p>
@endif

@if(!empty($shipping))
    <h4>Shipping Address</h4>
    <p>{{ $shipping['shipping_first_name'] }} {{ $shipping['shipping_last_name'] }}</p>
    <p>{{ $shipping['shipping_email'] }}</p>
    <p>{{ $shipping['shipping_address'] }}, {{ $shipping['shipping_city'] }}, {{ $shipping['shipping_state'] }} - {{ $shipping['shipping_zip'] }}</p>
    <p>{{ $shipping['shipping_country'] }}</p>
    <p>{{ $shipping['shipping_phone_number'] }}</p>
@endif --}}
