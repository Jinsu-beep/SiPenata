<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem SiPenata| Registrasi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
</head>

<body>
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <h1>Registrasi Akun</h1>
                </div>
                <div class="card-body p-0">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step" data-target="#user-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="user-part" id="user-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">User</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#perusahaan-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="perusahaan-part" id="perusahaan-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Perusahaan</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#akun-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="akun-part" id="akun-part-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Perusahaan</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <div id="user-part" class="content" role="tabpanel" aria-labelledby="user-part-trigger">
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
                                <div class="row justify-content-between">
                                    <div class="col-1">
                                        <a href="{{ route('loginForm') }}" class="btn btn-primary btn-block center-block" >Back</a>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div id="perusahaan-part" class="content" role="tabpanel" aria-labelledby="perusahaan-part-trigger">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="nama_perusahaan">Nama Perusahaan</label>
                                            <input type="text" class="form-control" placeholder="Nama Perusahaan" name="nama_perusahaan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="email_perusahaan">Email Perusahaan</label>
                                            <input type="text" class="form-control" placeholder="Email Perusahaan" name="email_perusahaan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="no_telp_perusahaan">No Telepon Perusahaan</label>
                                            <input type="text" class="form-control" placeholder="No Telepon Perusahaan" name="no_telp_perusahaan">
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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="file_aktaPendirian">File Akta Pendiriian Perusahaan</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file_aktaPendirian" name="file_aktaPendirian">
                                                    <label class="custom-file-label" for="file_aktaPendirian">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="file_tandaDaftar">File Tanda Daftar Perusahaan</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file_tandaDaftar" name="file_tandaDaftar">
                                                    <label class="custom-file-label" for="file_tandaDaftar">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                </div>
                            </div>
                            <div id="akun-part" class="content" role="tabpanel" aria-labelledby="akun-part-trigger">
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" placeholder="username" name="Username">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" placeholder="password" name="Password">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Ulangi Password</label>
                                    <input type="text" class="form-control" placeholder="password" name="Password">
                                </div>
                                <div class="row justify-content-between">
                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
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
    <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

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

    <script>
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
    </script>

    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
</body>
</html>