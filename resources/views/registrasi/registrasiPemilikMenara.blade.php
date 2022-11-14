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
          <h1>Registrasi Akun Pemilik Menara</h1>
        </div>
        <form action="{{ route('insertRegistrasiPemilikMenara') }}" method="post">
          @csrf
          <div class=" card-body mx-5" >
            <div class="row">
              <div class="col-lg-10 col-sm-12">
                <div class="form-group mb-3">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" placeholder="Nama" name="Nama">
                </div>
              </div>
              <div class="col-lg-2 col-sm-12">
                <div class="form-group">
                  <label for="kewarganegaraan" class="text-white">.</label>
                  <select class="form-control select2" name="Kewarganegaraan" data-placeholder="Kewarganegaraan" style="width: 100%;">
                    <option value="WNI">WNI</option>
                    <option value="WNA">WNA</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-sm-12">
                <div class="form-group mb-3">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" placeholder="Email" name="Email">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-sm-12">
                <div class="form-group mb-3">
                  <label for="NoKTP">No KTP</label>
                  <input type="text" class="form-control" placeholder="No KTP" name="NoKTP">
                </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <div class="form-group mb-3">
                  <label for="NoTelp">Nomer Telfon</label>
                  <input type="text" class="form-control" placeholder="No Telfon" name="NoTelp">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-sm-12">
                <div class="form-group mb-3">
                  <label for="NPWP">NPWP</label>
                  <input type="text" class="form-control" placeholder="NPWP" name="NPWP">
                </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <div class="form-group mb-3">
                  <label for="KodePos">Kode Pos</label>
                  <input type="text" class="form-control" placeholder="Kode Pos" name="KodePos">
                </div>
              </div>
            </div>
            <label for="alamat">Alamat</label>
            <div class="row">
              <div class="col-lg-3 col-sm-12">
                <div class="form-group mb-3">
                  <select class="form-control select2" name="Provinsi" data-placeholder="id_kecamatan" style="width: 100%;">
                    <option value="1">provinsi</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-12">
                <div class="form-group mb-3">
                  <select class="form-control select2" name="Kabupaten" data-placeholder="id_desa" style="width: 100%;">
                    <option value="1">kabupaten</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-12">
                <div class="form-group">
                  <select class="form-control select2" name="Kecamatan" data-placeholder="id_kecamatan" style="width: 100%;">
                    <option value="1">kecamatan</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-12">
                <div class="form-group">
                  <select class="form-control select2" name="Desa" data-placeholder="id_desa" style="width: 100%;">
                    <option value="1">desa</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <input type="text" class="form-control" placeholder="Alamat Lengkap" name="Alamat">
            </div>
            <div class="form-group mb-3">
              <label for="username">Username</label>
              <input type="text" class="form-control" placeholder="username" name="Username">
            </div>
            <div class="form-group mb-3">
              <label for="password">Password</label>
              <input type="text" class="form-control" placeholder="password" name="Password">
            </div>
          </div>
          <div class="justify-content-between row ml-2 mb-2 mx-auto">
            <div class="col-3">
              <a href="{{ route('loginForm') }}" class="btn btn-primary btn-block center-block" >Kembali</a>
            </div>
            <div class="col-3">
              <button type="submit" class="btn btn-primary btn-block center-block" >Registrasi</button>
            </div>
          </div>
        </form>
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