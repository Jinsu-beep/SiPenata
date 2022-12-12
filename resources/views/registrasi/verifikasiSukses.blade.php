<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem SiPenata| Registrasi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  {{-- @include('layouts.dashboard.style') --}}
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  
  <style>
    body {
      background-image: url('');
      background-repeat: no-repeat;
      background-attachment: fixed;  
      background-size: cover;
      background-position: center;
    }
  </style>
</head>

<body>
  <div class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-12">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a class="h1">Verifikasi Sukses</a>
        </div>
        <div class="card-body mx-5" >
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <a>Verifikasi Berhasil. kembali ke Menu </a>
                    <a href="/">Login</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 4 -->
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()
  
      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })
    })
  </script>
</body>
</html>