<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Mega Able bootstrap admin template</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any admin needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin admin, admin template, admin template, responsive" />
      <meta name="author" content="codedthemes" />
      <!-- Favicon icon -->
      <link rel="icon" href="{{ asset('static/admin/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{ asset('static/admin/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/admin/css/bootstrap/css/bootstrap.min.css') }}">
      <!-- themify icon -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/admin/icon/themify-icons/themify-icons.css') }}">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/admin/icon/font-awesome/css/font-awesome.min.css') }}">
      <!-- scrollbar.css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/admin/css/jquery.mCustomScrollbar.css') }}">
        <!-- am chart export.css -->
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/admin/css/style.css') }}">
      @stack('style')
  </head>

  <body>
  
    @include('components.admin.pre-loader')
    @include('components.admin.header')
    {{-- @include('components.admin.sidebar') --}}
    @include('components.admin.page-header')
    @yield('main')
    @include('components.admin.footer')
    

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('static/admin/js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/admin/js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/admin/js/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/admin/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/admin/pages/widget/excanvas.js') }}"></script>
    <!-- waves js -->
    <script src="{{ asset('static/admin/pages/waves/js/waves.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('static/admin/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('static/admin/js/modernizr/modernizr.js') }}"></script>
    <!-- slimscroll js -->
    <script type="text/javascript" src="{{ asset('static/admin/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('static/admin/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{ asset('static/admin/js/chart.js/Chart.js') }}"></script>
    <!-- amchart js -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js') }}"></script>
    <script src="{{ asset('static/admin/pages/widget/amchart/gauge.js') }}"></script>
    <script src="{{ asset('static/admin/pages/widget/amchart/serial.js') }}"></script>
    <script src="{{ asset('static/admin/pages/widget/amchart/light.js') }}"></script>
    <script src="{{ asset('static/admin/pages/widget/amchart/pie.min.js') }}"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <!-- menu js -->
    <script src="{{ asset('static/admin/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('static/admin/js/vertical-layout.min.js') }}"></script>
    <!-- custom js -->
    <script type="text/javascript" src="{{ asset('static/admin/js/script.js') }}"></script>
    
    @stack('script')
    <script src="{{ asset('static/admin/js/custom.js') }}"></script>
</body>

</html>
