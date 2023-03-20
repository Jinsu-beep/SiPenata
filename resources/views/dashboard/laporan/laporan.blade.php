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
                <h1>Laporan Menara</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
        <div class="col-lg-1 align-self-center">
            <a href="{{ route('dataDasarHukum') }}" class="btn btn-default btn-icon-split">
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
                <h3 class="card-title">Laporan Menara</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <select class="form-control select2 @error('menara') is-invalid @enderror" id="perusahaan" name="perusahaan" data-placeholder="Provinsi" style="width: 100%;">
                                <option value="0">Semua Perusahaan</option>
                                @foreach ($perusahaan as $p)
                                    <option value="{{ $p->id }}">{{ $p->Perusahaan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-2 align-self-center">
                        <button class="btn btn-primary" type="button" onclick="laporan()">
                            {{-- <i class="fas fa-plus"></i> --}}
                            <span class="text">Tampilkan Laporan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card" id="laporan">
            {{-- <div class="card-header">
                <button class="btn btn-primary" type="button" onclick="download()">
                    <span class="text">Download</span>
                </button>
            </div> --}}
            {{-- <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th width="25px">No.</th>
                            <th width="100px">Nama Perusahaan</th>
                            <th width="100px">No Menara</th>
                            <th width="100px">Kecamatan</th>
                            <th width="100px">Ketinggian Menara</th>
                            <th width="100px">Titik Koordinat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">1</td>
                            <td class="text-center">1</td>
                            <td class="text-center">1</td>
                            <td class="text-center">1</td>
                            <td class="text-center">1</td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}
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
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

    })
</script>

<script>
    $(function () {
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": false,
        });
    });
</script>

<script>
    function laporan() {
        $('#laporan').empty();
        var perusahaan = {!! json_encode($perusahaan->toArray()) !!}
        let id = $('#perusahaan').val();
        // console.log(id)
        $.ajax({
            type: 'GET',
            url: '/laporan/getMenara/'+id,
            success: function (response){
                $('#laporan').append('<div class="card-header"> <a class="btn btn-primary" type="button" href="/laporan/downloadLaporan/' + id + '"> <span class="text">Download</span> </a> </div> <div class="card-body"> <table id="example2" class="table table-bordered table-hover"> <thead class="text-center"> <tr> <th width="25px">No.</th> <th width="100px">Nama Perusahaan</th> <th width="100px">No Menara</th> <th width="100px">Kecamatan</th> <th width="100px">Ketinggian Menara</th> <th width="100px">Titik Koordinat</th> </tr> </thead> <tbody id="body"> </tbody> </table> </div>');
                response.forEach(function(element, index) {
                    no = index + 1
                    perusahaan.forEach(element1 => {
                        if (element1.perusahaan.id == element.pemilik_menara.id_perusahaan) {
                            namaPerusahaan = element1.perusahaan.nama
                        }
                    });
                    $('#body').append('<tr> <td class="text-center">' + no + '</td> <td class="text-center">' + namaPerusahaan + '</td> <td class="text-center">' + element['no_menara'] + '</td> <td class="text-center">' + element.kecamatan.nama + '</td> <td class="text-center">' + element['tinggi_menara'] + '</td> <td class="text-center">' + element['lat'] + ', ' + element['long'] + '</td> </tr>');
                });
            }
        });
    }

    // function download(id) {
    //     $.ajax({
    //         type: 'GET',
    //         url: '/laporan/getMenara/'+id,
    //         success: function (response){
                
    //         }
    //     });
    // }
</script>
@endpush