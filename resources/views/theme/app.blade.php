<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

  <title>Monitoreo FFAA</title>

  <!-- Bootstrap -->
  <link href="{{ asset('theme/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('theme/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ asset('theme/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{ asset('theme/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="{{ asset('theme/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
  <!-- JQVMap -->
  <link href="{{ asset('theme/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="{{ asset('theme/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ asset('theme/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body" id="app">
    @if (Auth::check())
    <div class="main_container">
      {{-- sidebar --}}
      @include('theme.sections.sidebar')
      <!-- top navigation -->
      @include('theme.sections.navbar')
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <app></app>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      @include('theme.sections.footer')
      <!-- /footer content -->
    </div>
    @else
      <Auth ruta="{{route('basepath')}}"></Auth>
    @endif
  </div>
  <script src="{{ asset('theme/vendors/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <!-- jQuery -->
  
  <!-- Bootstrap -->
  <script src="{{ asset('theme/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('theme/vendors/fastclick/lib/fastclick.js') }}"></script>
  <!-- NProgress -->
  <script src="{{ asset('theme/vendors/nprogress/nprogress.js') }}"></script>
  <!-- Chart.js -->
  <script src="{{ asset('theme/vendors/Chart.js/dist/Chart.min.js') }}"></script>
  <!-- gauge.js -->
  <script src="{{ asset('theme/vendors/gauge.js/dist/gauge.min.js') }}"></script>
  <!-- bootstrap-progressbar -->
  <script src="{{ asset('theme/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{ asset('theme/vendors/iCheck/icheck.min.js') }}"></script>
  <!-- Skycons -->
  <script src="{{ asset('theme/vendors/skycons/skycons.js') }}"></script>
  <!-- Flot -->
  <script src="{{ asset('theme/vendors/Flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('theme/vendors/Flot/jquery.flot.pie.js') }}"></script>
  <script src="{{ asset('theme/vendors/Flot/jquery.flot.time.js') }}"></script>
  <script src="{{ asset('theme/vendors/Flot/jquery.flot.stack.js') }}"></script>
  <script src="{{ asset('theme/vendors/Flot/jquery.flot.resize.js') }}"></script>
  <!-- Flot plugins -->
  <script src="{{ asset('theme/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
  <script src="{{ asset('theme/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
  <script src="{{ asset('theme/vendors/flot.curvedlines/curvedLines.js') }}"></script>
  <!-- DateJS -->
  <script src="{{ asset('theme/vendors/DateJS/build/date.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('theme/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
  <script src="{{ asset('theme/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('theme/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="{{ asset('theme/vendors/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('theme/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

  <!-- Custom Theme Scripts -->
  <script src="{{ asset('theme/build/js/custom.min.js') }}"></script>

</body>

</html>
