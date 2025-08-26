<x-layouts.app>
    <section class="hero hero-page gray-bg padding-small">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-9 order-2 order-lg-1">
                    <h1>Your orders</h1>
                    <p class="lead">Your orders in one place.</p>
                </div>
                <div class="col-lg-3 text-right order-1 order-lg-2">
                    <ul class="breadcrumb justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="{{route("category")}}">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                        <h5>{{auth()->user()->name}}</h5>
                        <p class="text-muted text-small">{{Auth::user()->state_name}},{{Auth::user()->country_name}}</p>
                        <p class="text-muted text-small">{{Auth::user()->zip_code}}</p>
                    </div>
                    {{-- <nav class="list-group customer-nav"><a href="{{route("all_orders")}}"
                            class="active list-group-item d-flex justify-content-between align-items-center"><span><span
                                    class="icon icon-bag"></span>Orders</span><small
                                class="badge badge-pill badge-light">5</small></a><a href="customer-account.html"
                            class="list-group-item d-flex justify-content-between align-items-center"><span><span
                                    class="icon icon-profile"></span>Profile</span></a><a href="{{route("user_account")}}"
                            class="list-group-item d-flex justify-content-between align-items-center"><span><span
                                    class="icon icon-map"></span>Addresses</span></a><a href="{{route("user_address")}}"
                            class="list-group-item d-flex justify-content-between align-items-center"><span><span
                                    class="fa fa-sign-out"></span>Log out</span></a>
                    </nav> --}}

                     <nav class="list-group customer-nav">
                        <a href="{{route("all_orders")}}"
                            class="active list-group-item d-flex justify-content-between align-items-center"><span><span
                                    class="icon icon-bag"></span>Orders</span><small
                                class="badge badge-pill badge-primary">5</small></a>
                        <a href="{{ route("user_account") }}"
                            class="list-group-item d-flex justify-content-between align-items-center"><span><span
                                    class="icon icon-profile"></span>Profile</span></a>
                        <a href="{{route("user_address")}}"
                            class="list-group-item d-flex justify-content-between align-items-center"><span><span
                                    class="icon icon-map"></span>Addresses</span></a>

                      
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="list-group-item d-flex justify-content-between align-items-center"><span><span
                                    class="fa fa-sign-out"></span>Log out</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                            @csrf
                        </form>
                    </nav>
                </div>
                <div class="col-lg-8 col-xl-9 pl-lg-3">
                    <table class="table table-hover table-responsive-md">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>

                                {{-- orderCartItems --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($orderCartItems as $items)
                                <tr>
                                    <th>#{{$items->id}}</th>
                                    <td>{{$items->created_at}}</td>
                                    
                                    <td>${{$items->price}}</td>
                                    <td><span class="badge badge-info">Being prepared</span></td>
                                    <td><a href="{{route("order_detail")}}" class="btn btn-primary btn-sm">View</a></td>
                                </tr>


                                {{-- <th># 1735</th>
                  <td>22/6/2017</td>
                  <td>$150.00</td>
                  <td><span class="badge badge-info">Being prepared</span></td>
                  <td><a href="customer-order.html" class="btn btn-primary btn-sm">View</a></td> --}}


                            @endforeach



                            {{-- <tr>
                                <th># 1735</th>
                                <td>22/6/2017</td>
                                <td>$150.00</td>
                                <td><span class="badge badge-info">Being prepared</span></td>
                                <td><a href="customer-order.html" class="btn btn-primary btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <th># 1734</th>
                                <td>7/5/2017</td>
                                <td>$150.00</td>
                                <td><span class="badge badge-warning">Action needed</span></td>
                                <td><a href="customer-order.html" class="btn btn-primary btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <th># 1730</th>
                                <td>30/9/2016</td>
                                <td>$150.00</td>
                                <td><span class="badge badge-success">Received</span></td>
                                <td><a href="customer-order.html" class="btn btn-primary btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <th># 1705</th>
                                <td>22/6/2016</td>
                                <td>$150.00</td>
                                <td><span class="badge badge-danger">Cancelled</span></td>
                                <td><a href="customer-order.html" class="btn btn-primary btn-sm">View</a></td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>