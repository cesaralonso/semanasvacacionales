<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title ng-bind="title"></title>
    <base href="/">

    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700|Montserrat:400,700|Muli:200,300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    {{--  <link rel="stylesheet" href="{{ URL::to('assets/libs/OwlCarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/libs/OwlCarousel/dist/assets/owl.theme.default.min.css') }}">  --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/landing.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/main-carousel.css') }}">
    
    <link rel="stylesheet" href="{{ URL::to('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/owl.theme.green.min.css')}}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css')}}">

    <style>
      .owl-nav {
        display         : flex;
        justify-content : center;
        margin-top      : 1em;
      } 

      .owl-theme .owl-dots .owl-dot span {
          background: #6daaab;

      }

    </style>

    <!-- ngToast -->
    {{--  <link rel="stylesheet" href="vendor/ng-toast/dist/ngToast.min.css">  --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ URL::to('assets/js/code.jquery-2.2.4.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>    
    <script src="{{ URL::to('js/before-load.js') }}"></script>    

  </head>
  <body ng-app="app">
  
    @include('layouts.message')
    <section class="bienvenidos" style="{{ !\Request::is('/') ? 'height: 50vh !important': ''}}">
        @include('layouts.header')    
    </section>
    @yield('content')

    @include('layouts.footer')

    <a data-scroll class="ir-arriba" ></a>    
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/wow.min.js') }}"></script> 
    <script src="{{ URL::to('assets/js/wow.min.js') }}"></script> 
    <script src="{{ URL::to('assets/js/smooth-scroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/main.js') }}"></script>
    <script src="{{ URL::to('js/membresia-form.js') }}"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    {{--   Agular JS Libraries  --}}
    <script src="//code.angularjs.org/1.4.0/angular.js"></script>
    <script src="{{URL::to('js/angular/app.js')}}"></script>

    

    <script src="{{URL::to('js/table-images.js')}}"></script>
    <script src="{{URL::to('js/helper-functions.js')}}"> </script>

    <script>
        new WOW().init()
    </script>
    
    <script src="{{URL::to('js/float-button.js')}}"></script>

    <script src="{{URL::to('assets/js/owl.carousel.min.js')}}"></script>

    <script src="{{URL::to('js/path.js')}}"></script>

    <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAbAjqtjoZv3JPUupkEWkQ2Xbqx5ZlwXU8&callback=initMap'></script>
    <script src="{{URL::to('assets/js/locationpicker.jquery.js')}}"></script>
    <script src="{{URL::to('js/map.js')}}"> </script>
    <script src="{{URL::to('js/promocion-destacada.js')}}"> </script>
  </body>
</html>
