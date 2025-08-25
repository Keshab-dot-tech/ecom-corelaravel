<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>clothsHub</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
  {{--
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> --}}
  <!-- Bootstrap Select-->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
  <!-- Price Slider Stylesheets -->
  <link rel="stylesheet" href="{{ asset('vendor/nouislider/nouislider.css') }}">
  <!-- Custom font icons-->
  <link rel="stylesheet" href="{{ asset('css/custom-fonticons.css') }}">


  <!-- Google fonts - Poppins-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700">
  <!-- owl carousel-->
  <link rel="stylesheet" href="{{ asset('vendor/owl.carousel/assets/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/owl.carousel/assets/owl.theme.default.css') }}">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="{{ asset('css/style.default.css') }}" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <!-- Favicon-->
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">


  <!-- In your main layout, e.g., layouts/app.blade.php -->
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>


  <!-- Modernizr-->
  <script src="{{ asset('js/modernizr.custom.79639.js') }}"></script>
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>

  {{-- @include('layouts.header') --}}
  <x-layouts.header />


  <main>
    {{-- @yield('content') --}}
    {{ $slot }}
  </main>

  {{-- @include('layouts.footer') --}}
  <x-layouts.footer />

  <!-- JavaScript files-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
  <script src="{{ asset('vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
  <script src="{{ asset('vendor/nouislider/nouislider.min.js') }}"></script>
  <script src="{{asset("vendor/jquery-parallax.js/parallax.min.js")}}"></script>
  <script src="{{ asset('vendor/jquery-countdown/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('vendor/masonry-layout/masonry.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <!-- masonry -->
  <script>
    $(function () {
      var $grid = $('.masonry-wrapper').masonry({
        itemSelector: '.item',
        columnWidth: '.item',
        percentPosition: true,
        transitionDuration: 0,
      });

      $grid.imagesLoaded().progress(function () {
        $grid.masonry();
      });
    })
    // Add this after your page loads
    $('.hero-slider').owlCarousel({
      items: 1,
      loop: true,
      autoplay: true,
      nav: true
    });
    $(document).ready(function () {
      $('.products-slider').owlCarousel({
        items: 4,
        loop: true,
        margin: 30,
        nav: true,
        dots: true,
        navText: [
          '<i class="fa fa-long-arrow-left"></i>',
          '<i class="fa fa-long-arrow-right"></i>'
        ],
        responsive: {
          0: { items: 1 },
          600: { items: 2 },
          1000: { items: 4 }
        }
      });
    });








    //category right
    // <script>
    var snapSlider = document.getElementById('slider-snap');

    noUiSlider.create(snapSlider, {
      start: [40, 110],
      snap: false,
      connect: true,
      step: 1,
      range: {
        'min': 0,
        'max': 250
      }
    });
    var snapValues = [
      document.getElementById('slider-snap-value-lower'),
      document.getElementById('slider-snap-value-upper')
    ];
    snapSlider.noUiSlider.on('update', function (values, handle) {
      snapValues[handle].innerHTML = values[handle];
    });


    // document.addEventListener("DOMContentLoaded" , function(){
    //   const dec = document.querySelector(".dec-btn");
    //   const inc = document.querySelector(".inc-btn");
    //   const quan = document.querySelector(".quantity-no");

    //   inc.addEventListener('click' , function(){
    //     let val = parseInt(quan.value) || 0;
    //     quan.value = value+1;
    //   })

    //   dec.addEventListener("click" , function(){
    //     let val = parseInt(quan.value) || 0;
    //     if(val > 1){
    //       quan.value = value-1;
    //     }
    //   })
    // })

 
  </script>
  <!-- Main Template File-->
  <script src="{{ asset('js/front.js') }}"></script>
</body>

</html>