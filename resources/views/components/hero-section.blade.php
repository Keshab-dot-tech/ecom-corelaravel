<section class="hero hero-page gray-bg padding-small">
    <div class="container">
        <div class="row d-flex">
            <div class="col-lg-9 order-2 order-lg-1">
                <h1>Checkout</h1>
                <p class="lead">You currently have 3 item(s) in your basket</p>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
                <ul class="breadcrumb justify-content-lg-end">
                    <li class="breadcrumb-item"><a href="{{route("category")}}">Home</a></li>
                    <li class="breadcrumb-item active">{{ collect(request()->segments())->last() }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>