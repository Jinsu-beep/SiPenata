@extends('layouts.dashboard.master')
@section('title') Create Pengajuan Menara @endsection

@push('css')
{{-- Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
<style>
    #mymap { height: 590px; }
</style>
<!-- Select2 -->
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<!-- SweeAlert2 -->
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
{{-- datatables --}}
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- BS Stepper -->
<link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
@endpush

@section('content')
<section>
    <form action="/pengajuan/insert" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="NPWP">Persetujuan pendamping</label> 
            <button type="button" onclick="tambahPendamping()" id="tambah_pendamping" class="btn btn-danger btn-icon-split mb-2">
                <span class="icon">
                    <i class="fas fa-trash"></i>
                </span>
                tambah data
            </button>
            <div class="input-group">
                <table id="input_pendamping" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">nama</th>
                            <th class="text-center">no ktp</th>
                            <th class="text-center">jarak</th>
                            <th class="text-center">file</th>
                            <th class="text-center">aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabel_pendamping">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input " id="file_denahBangunan" name="file_denahBangunan">
                <label class="custom-file-label" for="file_denahBangunan">Choose file</label>
            </div>
        </div>
        <input type="number" id="jumlahData" name="jumlahData" hidden>
        <div class="row justify-content-between mx-1">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
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
{{-- Leaflet --}}
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
{{-- BsStepper --}}
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>

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
    var i = 0;

    function tambahPendamping() {
        i = i + 1;
        console.log(i);
        $('#tabel_pendamping').append('<tr id="tr' + i + '"> <td> <input type="text" class="form-control" placeholder="Latitude" name="lat[' + i + ']" id="lat"> </td> <td> <input type="text" class="form-control" placeholder="Latitude" name="lot[' + i + ']" id="lat"> </td> <td> <input type="text" class="form-control" placeholder="Latitude" name="let[' + i + ']" id="lat"> </td> <td> <input type="text" class="form-control" placeholder="Latitude" name="lit[' + i + ']" id="lat"> </td> <td class="text-center"> <button type="button" onclick="deleteKolom(' + i + ')" id="delete_akun" class="btn btn-danger btn-icon-split"> <span class="icon"> <i class="fas fa-trash"></i> </span> </button> </td> </tr>');
        $('#jumlahData').val(i).change();
    }

    function deleteKolom(id) {
        $('#tr' + id).empty();
        i = i - 1;
        console.log(i);
    }
</script>

{{-- <script>
    function deleteKolom(id) {
        $('#tr' + id).empty();
    }
</script> --}}
@endpush