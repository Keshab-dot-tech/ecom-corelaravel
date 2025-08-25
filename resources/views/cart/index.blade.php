{{-- {{-- <x-layouts.app>
    <section class="cart-page padding-small">
        <div class="container">
            <h2 class="mb-4">Your Shopping Cart</h2>

            @if($cartItems->isEmpty())
                <div class="alert alert-info">
                    Your cart is empty. <a href="{{ route('category') }}">Continue shopping</a>
                </div>
            @else
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                               min="1" class="form-control me-2" style="width: 80px;">
                                        <button class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                                <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end">
                    <h4>
                        Total: 
                        <span class="text-success">
                            ${{ number_format($cartItems->sum(fn($i) => $i->quantity * $i->price), 2) }}
                        </span>
                    </h4>
                    <a href="{{ route('checkout_address') }}" class="btn btn-success mt-3">Proceed to Checkout</a>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app> --}}


<x-layouts.app>
    <div class="container my-5">
        <h2>Your Cart</h2>

        @if($cartItems->isEmpty())
            <p>Your cart is empty. <a href="{{ route('category') }}">Shop now</a></p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>${{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->price * $item->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>
                Total: ${{ $cartItems->sum(fn($i) => $i->price * $i->quantity) }}
            </h4>
        @endif
    </div>
</x-layouts.app> --}}
