<header class="header">
  <!-- Tob Bar-->
  <div class="top-bar">
    <div class="container-fluid">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 hidden-lg-down text-col">
          <ul class="list-inline">
            <li class="list-inline-item"><i class="icon-telephone"></i>020-800-456-747</li>
            <li class="list-inline-item">Free shipping on orders over $300</li>
          </ul>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
          <!-- Language Dropdown-->
          <div class="dropdown show"><a id="langsDropdown" href="https://example.com" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><img
                src="{{ asset('img/united-kingdom.svg') }}" alt="english">English</a>
            <div aria-labelledby="langsDropdown" class="dropdown-menu dropdown-menu-right"><a href="#"
                class="dropdown-item"><img src="{{ asset('img/germany.svg') }}" alt="german">German</a><a href="#"
                class="dropdown-item"> <img src="{{ asset('img/france.svg') }}" alt="french">French</a></div>
          </div>
          <!-- Currency Dropdown-->
          <div class="dropdown show"><a id="currencyDropdown" href="#" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false" class="dropdown-toggle">USD</a>
            <div aria-labelledby="currencyDropdown" class="dropdown-menu dropdown-menu-right"><a href="#"
                class="dropdown-item">EUR</a><a href="#" class="dropdown-item"> GBP</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg">
    <div class="search-area">
      <div class="search-area-inner d-flex align-items-center justify-content-center">
        <div class="close-btn"><i class="icon-close"></i></div>
        <form action="#">
          <div class="form-group">
            <input type="search" name="search" id="search" placeholder="What are you looking for?">
            <button type="submit" class="submit"><i class="icon-search"></i></button>
          </div>
        </form>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Navbar Header  --><a href="index.html" class="navbar-brand"><img src="{{ asset('img/logo.png') }}"
          alt="..."></a>
      <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
        aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i
          class="fa fa-bars"></i></button>
      <!-- Navbar Collapse -->
      <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item dropdown"><a id="navbarHomeLink" href="index.html" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false"
              class="nav-link {{ Request::is('home*') ? 'active' : '' }}">Home<i class="fa fa-angle-down"></i></a>
            <ul aria-labelledby="navbarDropdownHomeLink" class="dropdown-menu">
              <li><a href="{{route('home')}}" class="dropdown-item">Classic Home</a></li>
              <li><a href="{{route('home2')}}" class="dropdown-item">Parallax sections</a></li>
              <li><a href="{{route('home3')}}" class="dropdown-item">Video background</a></li>
            </ul>
          </li>
          {{-- <div class="navbar-nav"> --}}
            <li class="nav-item"><a href="{{route('category')}}"
                class="nav-link {{ Request::is('category*') ? 'active' : '' }}">Shop</a>
            </li>
            {{--
          </div> --}}


          <!-- Megamenu-->
          <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown"
              class="nav-link {{ Request::is('home*') ? 'active' : '' }}">Template<i class="fa fa-angle-down"></i></a>
            <div class="dropdown-menu megamenu">
              <div class="row">
                <div class="col-lg-9">
                  <div class="row">
                    <div class="col-lg-3"><strong class="text-uppercase">Home</strong>
                      <ul class="list-unstyled">
                        <li><a href="{{route('home')}}">Classic homepage</a></li>
                        <li><a href="{{route('home2')}}">Parallax sections <span
                              class="badge badge-success ml-2">New</span></a></li>
                        <li><a href="{{route('home3')}}">Video background <span
                              class="badge badge-success ml-2">New</span></a></li>
                      </ul><strong class="text-uppercase">Shop</strong>
                      <ul class="list-unstyled">
                        <li><a href="{{route('category')}}">Category - full</a></li>
                        <li><a href="{{route('category_right')}}">Category - right sidebar</a></li>
                        <li><a href="{{route('category_left')}}">Category - left width</a></li>
                        <li><a href="category-masonry.html">Category - Masonry layout <span
                              class="badge badge-success ml-2">New</span> </a></li>
                        <li><a href="detail.html">Product detail</a></li>
                      </ul>
                    </div>
                    <div class="col-lg-3"><strong class="text-uppercase">Order process</strong>
                      <ul class="list-unstyled">
                        <li><a href="{{route('cart')}}">Shopping cart</a></li>
                        <li><a href="checkout1.html">Checkout 1 - Address</a></li>
                        <li><a href="checkout2.html">Checkout 2 - Delivery</a></li>
                        <li><a href="checkout3.html">Checkout 3 - Payment</a></li>
                        <li><a href="checkout4.html">Checkout 4 - Review </a></li>
                        <li><a href="checkout5.html">Checkout 5 - Confirmation </a></li>
                      </ul><strong class="text-uppercase">Blog</strong>
                      <ul class="list-unstyled">
                        <li><a href="{{route('blog')}}">Blog</a></li>
                        <li><a href="post.html">Post </a></li>
                      </ul>
                    </div>
                    <div class="col-lg-3"><strong class="text-uppercase">Pages</strong>
                      <ul class="list-unstyled">
                        <li><a href="{{route('contact')}}">Contact</a></li>
                        <li><a href="{{route('about_us')}}">About us</a></li>
                        <li><a href="text.html">Text page</a></li>
                        <li><a href="faq.html">FAQ <span class="badge badge-success ml-2">New</span></a></li>
                        <li><a href="{{route('coming_soon')}}">Coming soon <span
                              class="badge badge-success ml-2">New</span></a>
                        </li>
                        <li><a href="{{route('pageNotFound')}}">Error 404</a></li>
                        <li><a href="500.html">Error 500</a></li>
                      </ul>
                    </div>
                    <div class="col-lg-3"><strong class="text-uppercase">Customer</strong>
                      <ul class="list-unstyled">
                        <li><a href="{{route("user_login")}}">Login/sign up</a></li>
                        <li><a href="#">Orders</a></li>
                        <li><a href="customer-order.html">Order detail</a></li>
                        <li><a href="{{route("user_address")}}">Addresses</a></li>
                        <li><a href="{{route("user_account")}}">Profile</a></li>
                      </ul>
                    </div>

                  </div>
                  <div class="row services-block">
                    <div class="col-xl-3 col-lg-6 d-flex">
                      <div class="item d-flex align-items-center">
                        <div class="icon"><i class="icon-truck text-primary"></i></div>
                        <div class="text"><span class="text-uppercase">Free shipping &amp; return</span><small>Free
                            Shipping over $300</small></div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 d-flex">
                      <div class="item d-flex align-items-center">
                        <div class="icon"><i class="icon-coin text-primary"></i></div>
                        <div class="text"><span class="text-uppercase">Money back guarantee</span><small>30 Days Money
                            Back</small></div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 d-flex">
                      <div class="item d-flex align-items-center">
                        <div class="icon"><i class="icon-headphones text-primary"></i></div>
                        <div class="text"><span class="text-uppercase">020-800-456-747</span><small>24/7 Available
                            Support</small></div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 d-flex">
                      <div class="item d-flex align-items-center">
                        <div class="icon"><i class="icon-secure-shield text-primary"></i></div>
                        <div class="text"><span class="text-uppercase">Secure Payment</span><small>Secure
                            Payment</small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 text-center product-col hidden-lg-down"><a href="detail.html"
                    class="product-image"><img src="{{ asset('img/shirt.png') }}" alt="..." class="img-fluid"></a>
                  <h6 class="text-uppercase product-heading"><a href="detail.html">Lose Oversized Shirt</a></h6>
                  <ul class="rate list-inline">
                    <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                    <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                    <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                    <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                    <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                  </ul><strong class="price text-primary">$65.00</strong><a href="#" class="btn btn-template wide">Add
                    to cart</a>
                </div>
              </div>
            </div>
          </li>
          <!-- /Megamenu end-->
          <!-- Multi level dropdown    -->
          <li class="nav-item dropdown"><a id="navbarDropdownMenuLink" href="http://example.com" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" class="nav-link">Dropdown<i class="fa fa-angle-down"></i></a>
            <ul aria-labelledby="navbarDropdownMenuLink" class="dropdown-menu">
              <li><a href="#" class="dropdown-item">Action</a></li>
              <li><a href="#" class="dropdown-item">Another action</a></li>
              <li class="dropdown-submenu"><a id="navbarDropdownMenuLink2" href="http://example.com"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">Dropdown link<i
                    class="fa fa-angle-down"></i></a>
                <ul aria-labelledby="navbarDropdownMenuLink2" class="dropdown-menu">
                  <li><a href="#" class="dropdown-item">Action</a></li>
                  <li class="dropdown-submenu"><a id="navbarDropdownMenuLink3" href="http://example.com"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">

                      Another action<i class="fa fa-angle-down"></i></a>
                    <ul aria-labelledby="navbarDropdownMenuLink3" class="dropdown-menu">
                      <li><a href="#" class="dropdown-item">Action</a></li>
                      <li><a href="#" class="dropdown-item">Action</a></li>
                      <li><a href="#" class="dropdown-item">Action</a></li>
                      <li><a href="#" class="dropdown-item">Action</a></li>
                    </ul>
                  </li>
                  <li><a href="#" class="dropdown-item">Something else here</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <!-- Multi level dropdown end-->
          <li class="nav-item"><a href="{{route('blog')}}"
              class="nav-link {{ Request::is('blog*') ? 'active' : '' }}">Blog </a>
          </li>
          <li class="nav-item"><a href="{{route('contact')}}"
              class="nav-link {{ Request::is('contact*') ? 'active' : '' }}">Contact</a>
          </li>
        </ul>
        @auth
          <div class="text-muted text-small">Welcome , {{Auth::user()->name}}</div>
        @endauth
        <div class="right-col d-flex align-items-lg-center flex-column flex-lg-row">
          <!-- Search Button-- class="icon-search" -->
          <div class="search"><i class="icon-search"></i></div>
          <!-- User Not Logged - link to login page     href="{{route("user_login")}}" -->

          {{-- <div class="user"> <a id="userdetails" class="user-link"><i class="icon-profile"></i></a></div> --}}


          <div class="user dropdown show">
            <a id="userdetails" href="{{route("user_login")}}" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false" class="dropdown-toggle"><i class="icon-profile"></i></a>
            <ul aria-labelledby="userdetails" class="dropdown-menu">
              <li class="dropdown-item">
                <a href="{{route("all_orders")}}">Orders</a>
              </li>
              <li class="dropdown-item">
                <a href="{{route("user_address")}}">Addresses</a>
              </li>
              <li class="dropdown-item">
                <a href="{{route("user_account")}}">Profile </a>
              </li>
              <li class="dropdown-divider"></li>
              {{-- @guest

              <a href="{{ route('user_login') }}">Login</a>
              @endguest --}}
              <li class="dropdown-item"><a href="{{route("logout")}}">Logout </a></li>
            </ul>
          </div>



          <!-- Cart Dropdown-->

          <div class="cart dropdown show"><a id="cartdetails" href="https://example.com" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="icon-cart"></i>
              <div class="cart-no">1</div>
            </a><a href="{{route('cart')}}" class="text-primary view-cart">View Cart</a>
            <div aria-labelledby="cartdetails" class="dropdown-menu">
              <!-- cart item-->
              <div class="dropdown-item cart-product">
                <div class="d-flex align-items-center">
                  <div class="img"><img src="{{ asset('img/hoodie-man-1.png') }}" alt="..." class="img-fluid"></div>
                  <div class="details d-flex justify-content-between">
                    <div class="text"> <a href="#"><strong>Collections</strong></a><small>Quantity:1
                      </small><span class="price"> </span></div><a href="#" class="delete"><i
                        class="fa fa-trash-o"></i></a>
                  </div>
                </div>
              </div>
              <!-- total price-->

              <div class="dropdown-item total-price d-flex justify-content-between"><span>Total</span><strong
                  class="text-primary">$1209.00</strong></div>
              <!-- call to actions-->
              <div class="dropdown-item CTA d-flex"><a href="{{route('cart')}}" class="btn btn-template wide">View
                  Cart</a><a href="{{route("checkout_address")}}" class="btn btn-template wide">Checkout</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  </header>

  <script>
    $(document).ready(function () {
      $('.navbar-nav .nav-link').on('click', function () {
        $('.navbar-nav').find('.active').removeClass('active');
        $(this).addClass('active');
      });
    });
  </script>