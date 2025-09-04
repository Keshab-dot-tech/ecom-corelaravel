<x-layouts.app>
    <x-hero-section />
    <section class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="text-center p-5">
                        <h2 class="mb-3">Thank you for your order!</h2>
                        @if(session('success'))
                            <p class="text-success">{{ session('success') }}</p>
                        @else
                            <p>Your order has been placed successfully.</p>
                        @endif

                        <div class="mt-4 d-flex justify-content-center gap-2">
                            <a href="{{ route('category') }}" class="btn btn-template">Continue Shopping</a>
                            <a href="{{ route('all_orders') }}" class="btn btn-template-outlined">View My Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

