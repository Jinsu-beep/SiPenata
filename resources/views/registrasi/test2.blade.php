@extends('layouts.dashboard.master')
@section('title') Data Akun Admin @endsection

@push('css')
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
@endpush

@section('content')
<section class="content-header">
    <div class="card card-primary">
        <div class="card-body">
            <div class="row">
                <div class="">
                    <span class="fas fa-solid fa-circle-exclamation fa-3x" style="color: red"></span>
                </div>
                <div class="col-lg-10 align-self-center">
                    <h1>Biodata Belum Lengkap</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Detail Profile</h3>
            </div>
            <form action="{{ route('insertDasarHukum') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama" name="Nama">
                    </div>
                    <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan</label>
                        <select class="form-control select2" name="Kewarganegaraan" data-placeholder="Kewarganegaraan" style="width: 100%;">
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="Email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="NoKTP">No KTP</label>
                        <input type="text" class="form-control" placeholder="No KTP" name="NoKTP">
                    </div>
                    <div class="form-group mb-3">
                        <label for="NoTelp">Nomer Telfon</label>
                        <input type="text" class="form-control" placeholder="No Telfon" name="NoTelp">
                    </div>
                    <div class="form-group mb-3">
                        <label for="NPWP">NPWP</label>
                        <input type="text" class="form-control" placeholder="NPWP" name="NPWP">
                    </div>
                    <div class="form-group mb-3">
                        <label for="Provinsi">Provinsi</label>
                        <select class="form-control select2" id="provinsi_user" name="Provinsi" data-placeholder="id_provinsi" style="width: 100%;">
                            <option selected disabled>Pilih Provinsi ...</option>
                            @foreach ($dataProvinsi as $dp)
                            <option value="{{ $dp->id }}">{{ $dp->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Kabupaten">Kabupaten</label>
                        <select class="form-control select2" id="kabupaten_user" name="Kabupaten" data-placeholder="id_kabupaten" style="width: 100%;">
                            <option selected disabled>Pilih Kabupaten ...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Kecamatan">Kecamatan</label>
                        <select class="form-control select2" id="kecamatan_user" name="Kecamatan" data-placeholder="id_kecamatan" style="width: 100%;">
                            <option selected disabled>Pilih Kecamatan ...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Desa">Desa</label>
                        <select class="form-control select2" id="desa_user" name="Desa" data-placeholder="id_desa" style="width: 100%;">
                            <option selected disabled>Pilih Desa ...</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat Lengkap" name="Alamat">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('js')
@endpush