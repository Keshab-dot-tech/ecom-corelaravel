<x-layouts.app>
  <section class="hero hero-page gray-bg padding-small">
    <div class="container">
      <div class="row d-flex">
        <div class="col-lg-9 order-2 order-lg-1">
          <h1>Order #1735</h1>
          <p class="lead">Order #1735 was placed on <strong>26/08/2025</strong> and is currently <strong>Being
              prepared</strong>.</p>
          <p class="text-muted">If you have any questions, please feel free to <a href="{{route("contact")}}">contact us</a>,
            our customer service center is working for you 24/7.</p>
        </div>
        <div class="col-lg-3 text-right order-1 order-lg-2">
          <ul class="breadcrumb justify-content-lg-end">
            <li class="breadcrumb-item"><a href="{{route("category")}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route("all_orders")}}">Orders</a></li>
            <li class="breadcrumb-item active">Order #1735</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="padding-small">
    <div class="container">
      <div class="row">
        <!-- Customer Sidebar-->
        <div class="customer-sidebar col-xl-3 col-lg-4 mb-md-5">
          <div class="customer-profile"><a href="#" class="d-inline-block"><img src="{{asset("img/person-3.jpg")}}"
                class="img-fluid rounded-circle customer-image"></a>
            <h5>{{Auth::user()->name}}</h5>
            <p class="text-muted text-small">{{Auth::user()->state_name}},{{Auth::user()->country_name}}</p>
          </div>
          <nav class="list-group customer-nav">
            <a href="#" class="active list-group-item d-flex justify-content-between align-items-center"><span><span
                  class="icon icon-bag"></span>Orders</span><small class="badge badge-pill badge-primary">5</small></a>
            <a href="{{ route("user_account") }}"
              class="list-group-item d-flex justify-content-between align-items-center"><span><span
                  class="icon icon-profile"></span>Profile</span></a>
            <a href="{{route("user_address")}}"
              class=" list-group-item d-flex justify-content-between align-items-center"><span><span
                  class="icon icon-map"></span>Addresses</span></a>


            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
              class="list-group-item d-flex justify-content-between align-items-center"><span><span
                  class="fa fa-sign-out"></span>Log out</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
              @csrf
            </form>
          </nav>
        </div>
        {{-- <x-user_card /> --}}
        <div class="col-lg-8 col-xl-9 pl-lg-3">
          <div class="basket basket-customer-order">
            <div class="basket-holder">
              <div class="basket-header">
                <div class="row">
                  <div class="col-6">Product</div>
                  <div class="col-2">Price</div>
                  <div class="col-2">Quantity</div>
                  <div class="col-2 text-right">Total</div>
                </div>
              </div>
              <div class="basket-body">
                @forelse($cartItems as $item)
                  <div class="item">
                    <div class="row d-flex align-items-center">
                      <div class="col-6">
                        <div class="d-flex align-items-center">
                          <img src="{{ asset('img/' . $item->product->image_path) }}" alt="..." class="img-fluid">
                          <div class="title">
                            <h5>{{ $item->product->name }}</h5>
                          </div>
                        </div>
                      </div>
                      <div class="col-2"><span>${{ $item->price }}</span></div>
                      <div class="col-2 text-center">
                        <span>{{ $item->quantity }}</span>


                      </div>
                      <div class="col-2 text-center">
                        <span>${{ $item->price * $item->quantity }}.00</span>
                      </div>

                    </div>
                  </div>
                @empty
                  <div class="p-4 text-center">
                    <p>Your shopping cart is empty.</p>
                  </div>
                @endforelse
                <div class="basket-footer">
                  <div class="item">
                    <div class="row">
                      <div class="offset-md-6 col-4"> <strong>Order subtotal</strong></div>
                      <div class="col-2 text-right">
                        <strong>${{$cartItems->sum(fn($i) => $i->price * $i->quantity)}}.00</strong>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="row">
                      <div class="offset-md-6 col-4"> <strong>Shipping and handling</strong></div>
                      <div class="col-2 text-right"><strong>$10.00</strong></div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="row">
                      <div class="offset-md-6 col-4"> <strong>Tax</strong></div>
                      <div class="col-2 text-right"><strong>$0.00</strong></div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="row">
                      <div class="offset-md-6 col-4"> <strong>Total</strong></div>
                      <div class="col-2 text-right">
                        <strong>${{$cartItems->sum(fn($i) => $i->price * $i->quantity) + 10}}.00</strong>
                      </div>
                    </div>
                  </div>
                </div>


                {{-- <x-order-summary :cartItems="$cartItems" /> --}}


                <div class="row addresses">
                  <div class="col-sm-6">
                    <div class="block-header">
                      <h6 class="text-uppercase">Invoice address</h6>
                    </div>
                    <div class="block-body">
                      {{-- <p>{{session('invoice.name') ??
                        'Keshab'}}<br>{{session('invoice.email')}}<br>{{session('invoice.street')}}<br>{{session('invoice.state')}}<br>
                        {{session('invoice.country')}}<br>{{session('invoice.zip_code')}}<br>{{session('invoice.phone')}}
                      </p> --}}
                      @if(!empty($address))
                        <p>{{ $address['name'] }}</p>
                        <p>{{ $address['email'] }}</p>
                        <p>{{ $address['address'] }},{{ $address['state_name'] }} -
                          {{ $address['zip_code'] }}
                        </p>
                        <p>{{ $address['country_name'] }}</p>
                        <p>{{ $address['phone'] }}</p>
                      @endif
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="block-header">
                      <h6 class="text-uppercase">Shipping address</h6>
                    </div>
                    <div class="block-body">
                    {{-- @if ($shipping['shipping_first_name'] == null) --}}
                      @if(!empty($address))
                        <p>{{ $address['name'] }}</p>
                        <p>{{ $address['email'] }}</p>
                        <p>{{ $address['address'] }},{{ $address['state_name'] }} -
                          {{ $address['zip_code'] }}
                        </p>
                        <p>{{ $address['country_name'] }}</p>
                        <p>{{ $address['phone'] }}</p>
                      @endif

                      {{-- @endif --}}
                      @if(!empty($shipping))
                        <p>{{ $shipping['shipping_first_name'] }} {{ $shipping['shipping_last_name'] }} </p>
                        <p>{{ $shipping['shipping_email'] }}</p>
                        <p>{{ $shipping['shipping_address'] }} {{ $shipping['shipping_city'] }}
                          {{ $shipping['shipping_state'] }}  {{ $shipping['shipping_zip'] }}
                        </p>
                        <p>{{ $shipping['shipping_country'] }}</p>
                        <p>{{ $shipping['shipping_phone_number'] }}</p>
                      @endif
                      



                    </div>
                  </div>
                </div>
                <!-- /.addresses                           -->
              </div>
            </div>
          </div>
  </section>
</x-layouts.app>