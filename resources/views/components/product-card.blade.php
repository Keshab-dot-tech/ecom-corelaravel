@props(['product'])

<div class="item col-xl-4 col-md-6">
    <div class="product is-gray">
        <div class="image d-flex align-items-center justify-content-center">
             
            <img src="{{ asset('img/'.$product->image_path)}}" alt="{{ $product->name }}" class="img-fluid" style="height:100%;max-height:600px;">
             
            
            <div class="hover-overlay d-flex align-items-center justify-content-center">
                <div class="CTA d-flex align-items-center justify-content-center">
                    <form action="{{ route('cart.store', $product) }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="add-to-cart" style="background: none; border: none; color: inherit; cursor: pointer;">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                    </form>
                    <a href="{{ route('products.show', $product) }}" class="visit-product active"><i class="icon-search"></i>View</a>
                    <a href="#" data-toggle="modal" data-target="#exampleModal" class="quick-view"><i class="fa fa-arrows-alt"></i></a>
                </div>
            </div>
        </div>
        <div class="title">
             
            <small class="text-muted">{{ $product->category }}</small>
            {{-- <a href="{{route("")}}"> --}}
                 
                <h3 class="h6 text-uppercase no-margin-bottom">{{ $product->name }}</h3>
            </a>
             
            <span class="price text-muted">${{ number_format($product->price, 2) }}</span>
        </div>
    </div>
</div>




