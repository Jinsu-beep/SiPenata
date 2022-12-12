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
            <form action="/biodata/insert/{{ $dataUser->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama" name="nama" value="{{ $dataUser->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan</label>
                        <select class="form-control select2" name="kewarganegaraan" data-placeholder="Kewarganegaraan" style="width: 100%;">
                            <option selected disabled>Pilih Kewarganegaraan ...</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $dataUser->email }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="NoKTP">No KTP</label>
                        <input type="text" class="form-control" placeholder="No KTP" name="noKTP" value="{{ $dataUser->no_ktp }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="NoTelp">Nomer Telfon</label>
                        <input type="text" class="form-control" placeholder="No Telepon" name="noTelp">
                    </div>
                    <div class="form-group mb-3">
                        <label for="NPWP">NPWP</label>
                        <input type="text" class="form-control" placeholder="NPWP" name="NPWP">
                    </div>
                    <div class="form-group mb-3">
                        <label for="Provinsi">Provinsi</label>
                        <select class="form-control select2" id="provinsi" name="provinsi" data-placeholder="Provinsi" style="width: 100%;">
                            <option selected disabled>Pilih Provinsi ...</option>
                            @foreach ($dataProvinsi as $dp)
                            <option value="{{ $dp->id }}">{{ $dp->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Kabupaten">Kabupaten</label>
                        <select class="form-control select2" id="kabupaten" name="kabupaten" data-placeholder="Kabupaten" style="width: 100%;">
                            <option selected disabled>Pilih Kabupaten ...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Kecamatan">Kecamatan</label>
                        <select class="form-control select2" id="kecamatan" name="kecamatan" data-placeholder="Kecamatan" style="width: 100%;">
                            <option selected disabled>Pilih Kecamatan ...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Desa">Desa</label>
                        <select class="form-control select2" id="desa" name="desa" data-placeholder="Desa" style="width: 100%;">
                            <option selected disabled>Pilih Desa ...</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control" placeholder="Alamat Lengkap" name="alamat"></textarea>
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
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- SweeAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
{{-- Select2 --}}
<script src="../../plugins/select2/js/select2.full.min.js"></script>
{{-- DataTables --}}
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
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
    $(function () {
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    });
</script>

<script>
    $('#provinsi').change(function() {
        if($('#provinsi').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/profile/kabupaten/'+id,
                success: function (response){
                    // console.log(response);
                    $('#kabupaten').empty();
                    $('#kabupaten').append('<option selected disabled>Pilih Kabupaten ...</option>');
                    response.forEach(element => {
                        $('#kabupaten').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    });
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option selected disabled>Pilih Kecamatan ...</option>');
                    $('#desa').empty();
                    $('#desa').append('<option selected disabled>Pilih Desa ...</option>');
                }
            });
        } 
    });
</script>

<script>
    $('#kabupaten').change(function() {
        if($('#kabupaten').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/profile/kecamatan/'+id,
                success: function (response){
                    // console.log(response);
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option selected disabled>Pilih Kecamatan ...</option>');
                    response.forEach(element => {
                        $('#kecamatan').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    });
                    $('#desa').empty();
                    $('#desa').append('<option selected disabled>Pilih Desa ...</option>');
                }
            });
        } 
    });
</script>

<script>
    $('#kecamatan').change(function() {
        if($('#kecamatan').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/profile/desa/'+id,
                success: function (response){
                    // console.log(response);
                    $('#desa').empty();
                    $('#desa').append('<option selected disabled>Pilih Desa ...</option>');
                    response.forEach(element => {
                        $('#desa').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    });
                }
            });
        } 
    });
</script>
@endpush