{{-- resources/views/category/details.blade.php --}}
<x-layouts.app>
    <!-- Hero Section -->
    <section class="hero hero-page gray-bg padding-small">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-9 order-2 order-lg-1">
                    <h1>{{ $product->name }}</h1>
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

    <!-- Product Details -->
    <section class="product-details">
        <div class="container">
            <div class="row">
                <!-- Images -->
                <div class="product-images col-lg-6">
                    @if($product->is_on_sale)
                        <div class="ribbon-primary text-uppercase">Sale</div>
                    @endif

                    <div data-slider-id="1" class="owl-carousel items-slider owl-drag">
                        {{-- @forelse($product->image_path as $image)
                        <div class="item">
                            <img src="{{ asset('img/' . $image) }}" alt="{{ $product->name }}">
                        </div>
                        @endforeach --}}
                        {{-- @empty --}}
                        {{-- @if($product->images->count())
                        @foreach($product->image_path as $image)
                        <div class="item">

                            <img src="{{ asset(" img/hoodie-woman-2.png") }}" alt="{{ $product->name }}"
                                class="img-fluid">
                        </div>
                        @endforeach
                        @else --}}
                        <div class="item">
                            {{-- <img src="{{ asset('images/no-image.png') }}" alt="No image available"> --}}
                            {{-- <img src="{{ asset(" img/shirt.png") }}" alt="{{ $product->name }}" class="img-fluid">
                            --}}
                            {{-- <img src="{{asset('img/').{{$product->image_path}}}}" alt="Image not available"> --}}
                            {{-- <img src="{{ asset('img/' . $product->image_path) }}" alt="{{ $product->name }}"> --}}
                        </div>
                        {{-- @endif --}}
                    </div>






                    <div data-slider-id="1" class="owl-thumbs">
                        {{-- @foreach($product->images as $image)
                        <button class="owl-thumb-item">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}">
                        </button>
                        @endforeach --}}
                        {{-- <img src="{{ asset(" img/hoodie-woman-2.png") }}" alt="{{ $product->name }}"
                            class="img-fluid"> --}}
                        <img src="{{ asset('img/' . $product->image_path) }}" alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Info -->
                <div class="details col-lg-6">
                    <ul class="price list-inline no-margin">
                        <li class="list-inline-item current">${{ $product->price }}</li>
                        {{-- @if($product->original_price)
                        <li class="list-inline-item original">${{ $product->original_price }}</li>
                        @endif --}}
                    </ul>

                    <p>{{ $product->description }}</p>

                    {{-- <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                        <div class="quantity d-flex align-items-center">
                            <div class="dec-btn">-</div>
                            <input type="text" value="1" class="quantity-no">
                            <div class="inc-btn">+</div>
                        </div>
                        <select id="product-size" class="bs-select">
                            @foreach($product->sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                    </div> --}}




                    <ul class="CTAs list-inline">
                        <li class="list-inline-item">
                            {{-- <a href="#" class="btn btn-template wide">
                                <i class="icon-cart"></i>Add to Cart
                            </a> --}}
                            {{-- product->id --}}
                            <form action="{{ route('cart.store', $product->id) }}" method="POST" id="add-to-cart-form">
                                @csrf

                                <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
        <div class="quantity d-flex align-items-center">
            <div class="dec-btn">-</div>
            <!-- Add name="quantity" so it submits -->
            <input type="text" name="quantity" value="1" class="quantity-no">
            <div class="inc-btn">+</div>
        </div>
        <select id="product-size" class="bs-select">
            @foreach($product->sizes as $size)
                <option value="{{ $size->id }}">{{ $size->size }}</option>
            @endforeach
        </select>
    </div>




                                {{-- <input type="hidden" name="quantity" value="1"> --}}
                                <button type="submit" class="btn btn-template wide">
                                    <i class="icon-cart"></i> Add to Cart
                                </button>
                            </form>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-template-outlined wide">
                                <i class="fa fa-heart-o"></i>Add to wishlist
                            </a>
                        </li>
                    </ul>

                    <div class="dropdown-item CTA d-flex"><a href="{{route('cart')}}" class="btn btn-template wide">View
                            Cart</a></div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Tabs -->
    <section class="product-description no-padding">
        <div class="container">
            <ul role="tablist" class="nav nav-tabs flex-column flex-sm-row">
                <li class="nav-item"><a data-toggle="tab" href="#description" role="tab"
                        class="nav-link active">Description</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#additional-information" role="tab"
                        class="nav-link">Additional Information</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#reviews" role="tab" class="nav-link">Reviews</a></li>
            </ul>
            <div class="tab-content">
                <div id="description" role="tabpanel" class="tab-pane active">
                    <p>{{ $product->description }}</p>
                </div>
                <div id="additional-information" role="tabpanel" class="tab-pane">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Brand:</th>
                                <td>{{ optional($product->brand)->brand_name }}</td>
                            </tr>
                            <tr>
                                <th>Category:</th>
                                <td>{{ $product->category }}</td>
                            </tr>
                            <tr>
                                <th>Style:</th>
                                <td>{{ $product->Style ?? "Casual" }}</td>
                            </tr>
                            <tr>
                                <th>Material:</th>
                                <td>{{ $product->material ?? "Cotton" }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="reviews" role="tabpanel" class="tab-pane">


                    {{-- @if($product->reviews->count())
                    @foreach($product->reviews as $review)
                    <div class="review">
                        <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>
                        - {{ $review->rating ?? '0' }}/5
                        <p>{{ $review->comment ?? '' }}</p>
                    </div>
                    @endforeach
                    @else
                    <p>No reviews yet.</p>
                    @endif --}}




                    {{-- @foreach($product->reviews as $review)
                    <div class="review">
                        <strong>{{ $review->user->name }}</strong> - {{ $review->rating }}/5
                        <p>{{ $review->comment }}</p>
                    </div>
                    @endforeach --}}
                </div>
            </div>
        </div>


        <x-share />

    </section>

    <!-- Related Products -->
    <section class="related-products">
        <div class="container">
            <header class="text-center">
                <h2><small>Similar Items</small>You may also like</h2>
            </header>
            <div class="row">
                @foreach($related_products as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>




<script>
    document.addEventListener("DOMContentLoaded", function () {
        const decBtn = document.querySelector(".dec-btn");
        const incBtn = document.querySelector(".inc-btn");
        const quantityInput = document.querySelector(".quantity-no");

        incBtn.addEventListener("click", function () {
            let value = parseInt(quantityInput.value) || 0;
            quantityInput.value = value + 1;
        });

        decBtn.addEventListener("click", function () {
            let value = parseInt(quantityInput.value) || 0;
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });
    });
</script>