@extends('layouts.dashboard.master')
@section('title') Draft Pengajuan Menara @endsection

@push('css')
{{-- Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
<style>
    #map { height: 590px; }
</style>
<style>
    .pdfobject-container { height: 50rem;}
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

<link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-11">
                <h1>Detail Menara</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
        <div class="col-lg-1 align-self-center">
            <a href="{{ route('dataMenara') }}" class="btn btn-default btn-icon-split">
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
        <div class="col-12 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    @if (in_array(auth()->guard('admin')->user()->kategori, ['Pemilik Menara']))
                    <div class="row justify-content-end">
                        <button type="button" onclick="edit({{ $detailMenara->id }})" class="btn btn-warning">
                            Edit
                        </button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 align-self-center text-center">
                            <img src="{{ $detailMenara->foto }}" width="600">
                        </div>
                        <div class="col-sm-7">
                            <div class="row mb-2">  
                                <label for="noMenara" class="col-sm-2 col-form-label">No Menara</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->no_menara }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->Provinsi->nama }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->Kabupaten->nama }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->Kecamatan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="desa" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->Desa->nama }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="tanggalPembuatan" class="col-sm-2 col-form-label">Tanggal Pembuatan</label>
                                <div class="col-sm-10 align-self-center">
                                    <input type="text" class="form-control" placeholder="Tanggal Pembuatan" value="{{ $detailMenara->tanggal_pembuatan }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="lat" class="col-sm-2 col-form-label">Latitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->lat }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="long" class="col-sm-2 col-form-label">Longitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->long }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="jenisMenara" class="col-sm-2 col-form-label">Jenis Menara</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->jenis_menara }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="tinggiMenara" class="col-sm-2 col-form-label">Tinggi Menara</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->tinggi_menara }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="tinggiAntena" class="col-sm-2 col-form-label">Tinggi Antena</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->tinggi_antena }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="luasArea" class="col-sm-2 col-form-label">Luas Are</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->luas_area }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="aksesJalan" class="col-sm-2 col-form-label">Akses Jalan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan" value="{{ $detailMenara->akses_jalan }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="aksesJalan" class="col-sm-2 col-form-label">File Surat Ijin Pembangunan</label>
                                <div class="col-sm-10 align-self-center">
                                    <button type="button" onclick="showFilePembangunan()" class="btn btn-primary text-center">
                                        Show File
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="aksesJalan" class="col-sm-2 col-form-label">File Surat Ijin Operasional</label>
                                <div class="col-sm-10 align-self-center">
                                    <button type="button" onclick="showFileOperasional()" class="btn btn-primary text-center">
                                        Show File
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-showFile">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="judul" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="file"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="edit" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Provider</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggalPembuatan">Tanggal Pembuatan</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggalPembuatan" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fotoMenara">Foto Menara</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('fotoMenara') is-invalid @enderror" id="fotoMenara" name="fotoMenara">
                            <label class="custom-file-label" for="fotoMenara">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="filePembangunan">File Surat Ijin Pembangunan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('file_pembangunan') is-invalid @enderror" id="file_pembangunan" name="file_pembangunan">
                            <label class="custom-file-label" for="file_pembangunan">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fileOperasional">File Surat Ijin Operasional</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('file_operasional') is-invalid @enderror" id="file_operasional" name="file_operasional">
                            <label class="custom-file-label" for="file_operasional">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../../plugins/moment/moment.min.js"></script>
<script src="/PDFObject/pdfobject.js"></script>

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

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

        //Timepicker
        $('#timepicker').datetimepicker({
        format: 'LT'
        })
    })
</script>

<script>
    //MAP INIT
    let marker = {!! json_encode($detailMenara->toArray()) !!}
    var mymap = L.map('map').setView([marker.lat, marker.long], 15);

    L.marker([marker.lat, marker.long]).addTo(mymap);
        
    L.Map.include({
        getMarkerById: function (id) {
            var marker = null;
            this.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    if (layer.options.id === id) {
                        marker = layer;
                    }
                }
            });
            return marker;
        }
    });

    //ADD CONTROLL
    mymap.pm.addControls({  
        position: 'topleft',
        drawCircle: false,
        drawMarker: false,
        drawCircleMarker:false,
        drawRectangle: false,
        drawPolyline: false,
        drawPolygon: false,
        dragMode:false,
        drawText:false,
        editMode: false,
        cutPolygon: false,
        removalMode: false,
        rotateMode: false,
    });

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
    }).addTo(mymap);
</script>

<script>
    var file = {!! json_encode($detailMenara->toArray()) !!}
    function showFilePembangunan() {
        PDFObject.embed(file.file_suratIzinPembangunan, "#file");
        $('#judul').empty();
        $('#judul').append('File Surat Izin Pembangunan');
        $('#modal-showFile').modal('show');
    }

    function showFileOperasional() {
        PDFObject.embed(file.file_suratIzinOperasional, "#file");
        $('#judul').empty();
        $('#judul').append('File Surat Izin Operasional');
        $('#modal-showFile').modal('show');
    }
</script>

<script>
    function edit(id) {
        $("#edit").attr("action", "/menara/update/"+id);
        
        $('#modal-edit').modal('show');
    }
</script>

<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
@endpush