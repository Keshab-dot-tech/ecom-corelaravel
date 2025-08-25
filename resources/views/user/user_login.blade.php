<x-layouts.app>

  <section class="hero hero-page gray-bg padding-small">
    <div class="container">
      <div class="row d-flex">
        <div class="col-lg-9 order-2 order-lg-1">
          <h1>Customer zone</h1>
        </div>
        <div class="col-lg-3 text-right order-1 order-lg-2">
          <ul class="breadcrumb justify-content-lg-end">
            <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
            <li class="breadcrumb-item active">Customer zone</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- text page-->
  <section class="padding-small">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="block">
            <div class="block-header">
              <h5>Login</h5>
            </div>
            <div class="block-body">
               @if ($errors->login->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->login->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              <p class="lead">Already our customer?</p>
              <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
              <hr>
 
 
                 <form action="{{ route('user_login.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="login_email" class="form-label">Email</label>
                  
                  <input id="login_email" type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                  <label for="login_password" class="form-label">Password</label>
                   
                  <input id="login_password" type="password" name="password" class="form-control">
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="block">
            <div class="block-header">
              <h5>New account</h5>
            </div>
            <div class="block-body">
              @if ($errors->register->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->register->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <p class="lead">Not our registered customer yet?</p>
              <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The
                whole process will not take you more than a minute!</p>
              <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact
                  us</a>, our customer service center is working for you 24/7.</p>
              <hr>
 
                <form action="{{ route('user_register.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="register_name" class="form-label">Name</label>
 
                  <input id="register_name" type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                  <label for="register_email" class="form-label">Email</label>
    
                  <input id="register_email" type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                  <label for="register_password" class="form-label">Password</label>
     
                  <input id="register_password" type="password" name="password" class="form-control">
                </div>
                {{-- <div class="form-group">
                  <label for="password_confirmation" class="form-label">Confirm Password</label>
 
                  <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
                </div> --}}
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary"><i class="icon-profile"></i> Register </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</x-layouts.app>