<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SiPenata | @yield('title')</title>

  @include('layouts.dashboard.style')
  @stack('css')
	{{-- <link rel="stylesheet" href="{{ url('index-template/css/main.css')}}"> --}}
  <link href="images/logo_krasem.png" rel="icon">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader-->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}
  
  
  <!-- Navbar -->
  @include('layouts.dashboard.topbar')
  <!-- /.navbar -->

  @include('layouts.dashboard.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.dashboard.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

{{-- <script src="{{ url("index-template/js/main.js")}}"></script> --}}

@include('layouts.dashboard.script')
@stack('js')
</body>
</html>