<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Rental Mobil</title>

  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller d-flex">
    @include('layout.sidebar')

    <div class="container-fluid page-body-wrapper">
      @include('layout.navbar')
      <div class="main-panel">
        <div class="content-wrapper">
       @yield('content')
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between py-2 px-4">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
              Copyright &copy; {{ date('Y') }} Rental Mobil
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
              Dashboard admin untuk monitoring operasional rental
            </span>
          </div>
        </footer>
      </div>
    </div>
   
  </div>

  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
  
</body>

</html>
