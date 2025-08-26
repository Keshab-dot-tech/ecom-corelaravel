<x-layouts.app>
    <section class="hero hero-page gray-bg padding-small">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-9 order-2 order-lg-1">
                    <h1>Your profile</h1>
                </div>
                <div class="col-lg-3 text-right order-1 order-lg-2">
                    <ul class="breadcrumb justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                        <li class="breadcrumb-item active">Your profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-small">
        <div class="container">
            <div class="row">
                 
                <div class="customer-sidebar col-xl-3 col-lg-4 mb-md-5">
                    <div class="customer-profile"><a href="#" class="d-inline-block"><img src="{{asset("img/person-3.jpg")}}"
                                class="img-fluid rounded-circle customer-image"></a>
                        <h5>{{Auth::user()->name}}</h5>
                        <p class="text-muted text-small">{{Auth::user()->state_name}} , {{Auth::user()->country_name}}
                        </p>
                    </div>
                    
                    <nav class="list-group customer-nav">
                        <a href="{{route("all_orders")}}"
                            class="list-group-item d-flex justify-content-between align-items-center"><span><span
                                    class="icon icon-bag"></span>Orders</span><small
                                class="badge badge-pill badge-primary">5</small></a>
                        <a href="{{ route("user_account") }}"
                            class="active list-group-item d-flex justify-content-between align-items-center"><span><span
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

                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="block-header mb-5">
                        <h5>Change password </h5>
                    </div>

                     @if ($errors->updatePassword->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->updatePassword->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


        

 
                    <form class="content-block" action="{{ route('user_account.update_password') }}" method="POST">
                        @csrf
                        @method('PATCH')  
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="current_password" class="form-label">Old password</label>
                                    <input id="current_password" name="current_password" type="password"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">New password</label>
                                    <input id="password" name="password" type="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Retype new password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Change
                                password</button>
                        </div>
                    </form>




                    <div class="block-header mb-5">
                        <h5>Personal details</h5>
                    </div>
                    @if ($errors->updateDetails->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->updateDetails->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{--  --}}
                    <form class="content-block" action="{{ route('user_account.update_details') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            
                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                     
                                    <input id="name" name="name" type="text" class="form-control"
                                        value="{{ old('name', Auth::user()->name) }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" name="email" type="email" class="form-control"
                                        value="{{ old('email', Auth::user()->email) }}">
                                </div>
                            </div>
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="company" class="form-label">Company</label>
                                    <input id="company" type="text" class="form-control"
                                        value="{{old('company',Auth::user()->company)}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="street" class="form-label">Street</label>
                                    <input id="street" type="text" class="form-control"
                                    value="{{old('street',Auth::user()->street)}}">
                                </div>
                            </div>
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="city" class="form-label">City</label>
                                    <input id="city" type="text" class="form-control"
                                     value="{{old('state_name',Auth::user()->state_name)}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="zip" class="form-label">ZIP</label>
                                    <input id="zip" type="text" class="form-control"
                                    value="{{old('zip_code',Auth::user()->zip_code)}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="state" class="form-label">State</label>
                                    {{-- <select id="state" class="form-control"></select
                                         --}}
                                    <input id="state" name="state_name" type="text" class="form-control"
                                        value="{{old('state_name',Auth::user()->state_name)}}">

                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="country" class="form-label">Country</label>
                                    {{-- <select id="country" class="form-control"></select> --}}
                                    <input id="country_name" type="text"  class="form-control"
                                        value="{{old('country_name',Auth::user()->country_name)}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Telephone</label>
                                    <input id="phone" type="text" class="form-control"
                                    value="{{old('	phone',Auth::user()->phone)}}">
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="text" class="form-control">
                                </div>
                            </div> --}}
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save
                                    changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>