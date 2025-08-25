<x-layouts.app>

  <!-- Hero Section-->
  <section class="hero hero-page gray-bg padding-small">
    <div class="container">
      <div class="row d-flex">
        <div class="col-lg-9 order-2 order-lg-1">
          <h1>Shop</h1>
          <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
            incididunt.</p>
        </div>
        <div class="col-lg-3 text-right order-1 order-lg-2">
          <ul class="breadcrumb justify-content-lg-end">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Shop</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <main>
    <div class="container">
      <div class="row">
        <!-- Sidebar-->
        <div class="sidebar col-xl-3 col-lg-4 sidebar">
          <form action="{{route('category')}}" method="GET">
            <div class="block">
              <h6 class="text-uppercase">Product Categories</h6>

              <ul class="list-unstyled">
                @foreach($categories as $category)
                  <li>
                    <a href="{{ request()->fullUrlWithQuery(['category' => $category->category_name, 'page' => 1]) }}">
                      {{ $category->category_name }}
                    </a>

                    @if($category->children->isNotEmpty())
                      <ul class="list-unstyled ml-3">
                        @foreach($category->children as $child)
                          <li>
                            <a href="{{ request()->fullUrlWithQuery(['category' => $child->category_name, 'page' => 1]) }}">
                              {{ $child->category_name }}
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    @endif
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="block">
              <h6 class="text-uppercase">Filter By Price</h6>
              <!-- Add hidden inputs for the price slider to populate -->
              {{-- <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price', 0) }}">
              <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price', 1000) }}"> --}}
              <input type="number" id="min_price" name="min_price" value="{{ request('min_price', 0) }}"
                class="form-control">

              <input type="number" id="max_price" name="max_price" value="{{ request('max_price', 1000) }}"
                class="form-control">

              <div id="slider-snap"></div>
              <div class="value d-flex justify-content-between">
                {{-- <div class="min">From $<span id="min_up slider-snap-value-lower"></span></div>
                <div class="max">To $<span id="max_up slider-snap-value-upper"></span></div> --}}
                {{-- <div class="value d-flex justify-content-between"> --}}
                  <div class="min">From $<span class="min_up" id="slider-snap-value-lower"></span></div>
                  <div class="max">To $<span class="max_up" id="slider-snap-value-upper"></span></div>
                {{-- </div> --}}

              </div>
            </div>

            {{-- <div class="block">
              <h6 class="text-uppercase">Brands</h6>

              @foreach($brands as $brand)
              <div class="form-group mb-1">
                @php $checked = in_array($brand->brand_name, (array) request('brands', [])); @endphp
                <input id="brand{{ $brand->id }}" type="checkbox" name="brands[]" value="{{ $brand->brand_name }}"
                  class="checkbox-template" {{ $checked ? 'checked' : '' }}>
                <label for="brand{{ $brand->id }}">{{ $brand->brand_name }}</label>
              </div>
              @endforeach
            </div> --}}

            <div class="block">
              <h6 class="text-uppercase">Brands</h6>
              @foreach($brands as $brand)
                <div class="form-group mb-1">
                  @php $checked = in_array($brand->brand_name, (array) request('brands', [])); @endphp
                  <input id="brand{{ $brand->id }}" type="checkbox" name="brands[]" value="{{ $brand->brand_name }}"
                    class="checkbox-template" {{ $checked ? 'checked' : '' }}>
                  <label for="brand{{ $brand->id }}">{{ $brand->brand_name }}</label>
                </div>
              @endforeach
            </div>


            <div class="block">
              <h6 class="text-uppercase">Size</h6>



              @foreach($sizes as $size)
                <div class="form-group mb-1">

                  <input id="size{{ $size->id }}" type="checkbox" name="sizes[]" value="{{ $size->id }}"
                    class="checkbox-template" {{ in_array($size->id, (array) request('sizes', [])) ? 'checked' : '' }}>
                  <label for="size{{ $size->id }}">{{ $size->size }}</label>

                </div>
              @endforeach
            </div>


            <button type="submit" class="btn btn-primary btn-block">Filter</button>
            <a href="{{ route('category') }}" class="btn btn-secondary btn-block mt-2">Clear Filters</a>
          </form>
        </div>




        <div class="products-grid col-xl-9 col-lg-8 sidebar-left">

          <div class="row">

            @forelse ($products as $product)


              <x-product-card :product='$product' />

            @empty
              <div class="col-12">
                <p>No products found.</p>
              </div>
            @endforelse

            <div class="flex justify-center mt-6 ml-100">
              {{ $products->links() }}
            </div>





          </div>
          <!-- / Grid End-->
        </div>
      </div>
  </main>
  <!-- Overview Popup    -->
  {{-- <div id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade overview">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
              class="icon-close"></i></span></button>
        <div class="modal-body">
          <div class="ribbon-primary text-uppercase">Sale</div>
          <div class="row d-flex align-items-center">
            <div class="image col-lg-5"><img src="img/shirt.png" alt="..." class="img-fluid d-block"></div>
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
      </div> --}}
      {{--
    </div> --}}
  </div>
</x-layouts.app>





<script>

  let min_val = document.getElementById("min_price");
  let max_val = document.getElementById("max_price");

  let min_update_val = document.querySelector(".min_up");
  let max_update_val = document.querySelector(".max_up");

  min_update_val.innerText = min_val.value;
  max_update_val.innerText = max_val.value;


</script>