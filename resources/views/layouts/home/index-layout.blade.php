<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inner Page - Bootslander Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="landing/img/favicon.png" rel="icon">
  <link href="landing/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Font Awesome -->
<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="landing/vendor/aos/aos.css" rel="stylesheet">
  <link href="landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="landing/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="landing/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="landing/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="landing/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="landing/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="landing/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bootslander - v4.10.0
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  @stack('css')
</head>

<body>

  <!-- ======= Header ======= -->
  @include('layouts/home/navbar-layout')
  <!-- End Header -->

  	<main id="main">

		  @yield('content')

  	</main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('layouts/home/footer-layout')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="landing/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="landing/vendor/aos/aos.js"></script>
  <script src="landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="landing/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="landing/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="landing/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="landing/js/main.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  @stack('js')

</body>

</html>