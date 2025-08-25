<!-- Footer-->
<footer class="main-footer">
  <!-- Service Block-->
  <div class="services-block">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 d-flex justify-content-center justify-content-lg-start">
          <div class="item d-flex align-items-center">
            <div class="icon"><i class="icon-truck"></i></div>
            <div class="text">
              <h6 class="no-margin text-uppercase">Free shipping &amp; return</h6><span>Free Shipping over $300</span>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-center">
          <div class="item d-flex align-items-center">
            <div class="icon"><i class="icon-coin"></i></div>
            <div class="text">
              <h6 class="no-margin text-uppercase">Money back guarantee</h6><span>30 Days Money Back Guarantee</span>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-center">
          <div class="item d-flex align-items-center">
            <div class="icon"><i class="icon-headphones"></i></div>
            <div class="text">
              <h6 class="no-margin text-uppercase">020-800-456-747</h6><span>24/7 Available Support</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Main Block -->
  <div class="main-block">
    <div class="container">
      <div class="row">
        <div class="info col-lg-4">
          <div class="logo"><img src="{{ asset('img/logo-white.png') }}" alt="..."></div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
          <ul class="social-menu list-inline">
            <li class="list-inline-item"><a href="#" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a>
            </li>
            <li class="list-inline-item"><a href="#" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a>
            </li>
            <li class="list-inline-item"><a href="#" target="_blank" title="instagram"><i
                  class="fa fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="pinterest"><i
                  class="fa fa-pinterest"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="vimeo"><i class="fa fa-vimeo"></i></a></li>
          </ul>
        </div>
        <div class="site-links col-lg-2 col-md-6">
          <h5 class="text-uppercase">Shop</h5>
          <ul class="list-unstyled">
            <li> <a href="#">For Women</a></li>
            <li> <a href="#">For Men</a></li>
            <li> <a href="#">Stores</a></li>
            <li> <a href="#">Our Blog</a></li>
            <li> <a href="#">Shop</a></li>
          </ul>
        </div>
        <div class="site-links col-lg-2 col-md-6">
          <h5 class="text-uppercase">Company</h5>
          <ul class="list-unstyled">
            <li> <a href="#">Login</a></li>
            <li> <a href="#">Register</a></li>
            <li> <a href="#">Wishlist</a></li>
            <li> <a href="#">Our Products</a></li>
            <li> <a href="#">Checkouts</a></li>
          </ul>
        </div>
        <div class="newsletter col-lg-4">
          <h5 class="text-uppercase">Daily Offers & Discounts</h5>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque temporibus.</p>
          <form action="#" id="newsletter-form">
            <div class="form-group">
              <input type="email" name="subscribermail" placeholder="Your Email Address">
              <button type="submit"> <i class="fa fa-paper-plane"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="copyrights">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="text col-md-6">
          <p>&copy; 2025 <a href="https://bootstrapious.com" target="_blank">Bootstrapious</a> All rights reserved.</p>
        </div>
        <div class="payment col-md-6 clearfix">
          <ul class="payment-list list-inline-item pull-right">
            <li class="list-inline-item"><img src="{{ asset('img/visa.svg') }}" alt="..."></li>
            <li class="list-inline-item"><img src="{{ asset('img/mastercard.svg') }}" alt="..."></li>
            <li class="list-inline-item"><img src="{{ asset('img/paypal.svg') }}" alt="..."></li>
            <li class="list-inline-item"><img src="{{ asset('img/western-union.svg') }}" alt="..."></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Overview Popup    -->
<div id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade overview">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
            class="icon-close"></i></span></button>
      <div class="modal-body">
        <div class="ribbon-primary text-uppercase">Sale</div>
        <div class="row d-flex align-items-center">
          <div class="image col-lg-5"><img src="{{ asset('img/shirt.png') }}" alt="..." class="img-fluid d-block"></div>
          <div class="details col-lg-7">
            <h2>Lose Oversized Shirt</h2>
            <ul class="price list-inline">
              <li class="list-inline-item current">$65.00</li>
              <li class="list-inline-item original">$90.00</li>
            </ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
            <div class="d-flex align-items-center">
              <div class="quantity d-flex align-items-center">
                <div class="dec-btn">-</div>
                <input type="text" value="1" class="quantity-no">
                <div class="inc-btn">+</div>
              </div>
              <select id="size" class="bs-select">
                <option value="small">Small</option>
                <option value="meduim">Medium</option>
                <option value="large">Large</option>
                <option value="x-large">X-Large</option>
              </select>
            </div>
            <ul class="CTAs list-inline">
              <li class="list-inline-item"><a href="#" class="btn btn-template wide"> <i
                    class="fa fa-shopping-cart"></i>Add to Cart</a></li>
              <li class="list-inline-item"><a href="#" class="visit-product active btn btn-template-outlined wide"> <i
                    class="icon-heart"></i>Add to wishlist</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="scrollTop"><i class="fa fa-long-arrow-up"></i></div>