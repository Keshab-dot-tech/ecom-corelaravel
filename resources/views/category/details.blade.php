<x-layouts.app>

  <!-- Hero Section-->
  <section class="hero hero-page gray-bg padding-small">
    <div class="container">
      <div class="row d-flex">
        <div class="col-lg-9 order-2 order-lg-1">
          <h1>{{ $product->name }}</h1>
          <p class="lead text-muted">{{ $product->short_description }}</p>
        </div>
        <div class="col-lg-3 text-right order-1 order-lg-2">
          <ul class="breadcrumb justify-content-lg-end">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category') }}">Shop</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <main>
    <div class="container">
      <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6">
          <div class="product-images">
            {{-- Example Sale Ribbon --}}
            @if($product->is_on_sale)
              <div class="ribbon-primary text-uppercase">Sale</div>
            @endif
            {{-- Use your actual product image path --}}
            <img src="{{ asset("img/hoodie-woman-2.png") }}" alt="{{ $product->name }}" class="img-fluid">
          </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
          <div class="product-details">
            <h2 class="product-name">{{ $product->name }}</h2>
            <ul class="price list-inline">
              <li class="list-inline-item current">${{ $product->price }}</li>
              {{-- You can add an original price if the product is on sale --}}
              {{-- <li class="list-inline-item original">$90.00</li> --}}
            </ul>
            <p class="product-description">{{ $product->description }}</p>

            <div class="d-flex align-items-center">
              <div class="quantity d-flex align-items-center">
                <div class="dec-btn">-</div>
                <input type="text" value="1" class="quantity-no" name="quantity" id="quantity">
                <div class="inc-btn">+</div>
              </div>
              <select id="size" class="bs-select">
                {{-- Ideally, you'd populate these from product data --}}
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
                <option value="x-large">X-Large</option>
              </select>
            </div>
            <ul class="CTAs list-inline">
              <li class="list-inline-item">
                <form action="{{ route('cart.store', $product) }}" method="POST" style="display: inline;">
                  @csrf
                  <input type="hidden" name="quantity" value="1" id="quantity-hidden">
                  <button type="submit" class="btn btn-template wide">
                    <i class="fa fa-shopping-cart"></i>Add to Cart
                  </button>
                </form>
              </li>
              <li class="list-inline-item">
                <a href="#" class="visit-product active btn btn-template-outlined wide">
                  <i class="icon-heart"></i>Add to wishlist
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Product Description -->
      <div class="row mt-5">
        <div class="col-12">
            <h3 class="text-uppercase">Description</h3>
            <p>{{ $product->description }}</p>
        </div>
      </div>

      <!-- Related Products -->
      <div class="row mt-5">
        <div class="col-12">
          <h2 class="text-uppercase">You may also like</h2>
        </div>
        {{-- Loop through related products --}}
        @forelse ($related_products as $related_product)
            <x-product-card :product="$related_product" />
        @empty
            {{-- No related products found --}}
        @endforelse
      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const quantityInput = document.getElementById('quantity');
      const quantityHidden = document.getElementById('quantity-hidden');
      const decBtn = document.querySelector('.dec-btn');
      const incBtn = document.querySelector('.inc-btn');

      // Sync quantity input with hidden field
      function updateQuantity() {
        quantityHidden.value = quantityInput.value;
      }

      // Initial sync
      updateQuantity();

      // Update on input change
      quantityInput.addEventListener('input', updateQuantity);

      // Decrement button
      decBtn.addEventListener('click', function() {
        let currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) {
          quantityInput.value = currentQty - 1;
          updateQuantity();
        }
      });

      // Increment button
      incBtn.addEventListener('click', function() {
        let currentQty = parseInt(quantityInput.value);
        quantityInput.value = currentQty + 1;
        updateQuantity();
      });
    });
  </script>
</x-layouts.app>