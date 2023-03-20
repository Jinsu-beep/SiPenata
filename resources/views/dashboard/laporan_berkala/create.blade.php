@extends('layouts.dashboard.master')
@section('title') Buat Laporan Berkala Baru @endsection

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
    <!-- Date & Time Picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-11">
                <h1>Laporan Berkala</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
        <div class="col-lg-1 align-self-center">
            <a href="{{ route('dataLaporanBerkala') }}" class="btn btn-default btn-icon-split">
                <span class="icon">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Laporan Berkala</h3>
            </div>
            <form action="/laporanBerkala/insert/{{ $dataUser->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        {{-- <input type="text" class="form-control" placeholder="Nama Perusahaan" id="tanggalTampil" readonly>
                        <input type="text" class="form-control" placeholder="Nama Perusahaan" id="tanggal" name="tanggal" hidden> --}}
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" class="form-control datetimepicker-input" id="tanggal" name="tanggal" data-target="#reservationdate"/>
                        </div>
                        @error('no_dasarHukum')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Perusahaan Wajib Diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_dasarHukum">Perusahaan</label>
                        <select class="form-control select2 @error('perusahaan') is-invalid @enderror" id="perusahaan" name="perusahaan" data-placeholder="Provinsi" style="width: 100%;">
                            <option selected disabled>Pilih Perusahaan ...</option>
                            @foreach ($perusahaan as $p)
                                <option value="{{ $p->id }}">{{ $p->Perusahaan->nama }}</option>
                            @endforeach
                        </select>
                        @error('no_dasarHukum')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Perusahaan Wajib Diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">Menara</label>
                        <select class="form-control select2 @error('menara') is-invalid @enderror" id="menara" name="menara" data-placeholder="Provinsi" style="width: 100%;">
                            <option selected disabled>Pilih Menara ...</option>
                        </select>
                        @error('nama_dasarHukum')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Menara Wajib Diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="laporan">Laporan</label>
                        <textarea type="text" class="form-control @error('laporan') is-invalid @enderror" name="laporan" id="laporan" placeholder="Laporan"></textarea>
                        @error('laporan')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Laporan Wajib Diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="InputFile">Dokumentasi Lapangan Kondisi Menara</label><br>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('file_dasarHukum') is-invalid @enderror" id="dokumentasi" name="dokumentasi">
                                <label class="custom-file-label" for="file_dasarHukum">Choose file</label>
                            </div>
                        </div>
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
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
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
<!-- Date & Time Picker -->
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

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

        //Datemask dd/mm/yyyy
        // $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })

        //Date picker
        $('#reservationdate').datetimepicker({
            locale: 'id',
            format: 'YYYY-MM-DD',
        });

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
    var menara = {!! json_encode($menara->toArray()) !!}

    $('#perusahaan').change(function() {
        if($('#perusahaan').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/laporanBerkala/getMenara/'+id,
                success: function (response){
                    // console.log(response);
                    $('#menara').empty();
                    $('#menara').append('<option selected disabled>Pilih Menara ...</option>');
                    response.forEach(element => {
                        $('#menara').append('<option value="' + element['id'] + '"' +'>' + element['no_menara'] + '</option>');
                    });
                }
            });
        } 
    });
</script>

<script>
    arrbulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
    date = new Date();
    let tahun = date.getFullYear();
    let bulan = date.getMonth();
    let tanggal = date.getDate();

    // console.log(tanggal)

    $('#tanggalTampil').val(tanggal + ' ' + arrbulan[bulan] + ' ' + tahun);
    $('#tanggal').val(tahun + '-' + bulan + '-' + tanggal);
</script>

<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
@endpush