@extends('layouts.dashboard.master')
@section('title') Buat Zone Plan Baru @endsection

@push('css')
{{-- Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
<!-- Select2 -->
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Bootstrap4 DuaNllistbox -->
<link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<!-- SweeAlert2 -->
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
{{-- datatables --}}
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
    #mapid { height: 590px; }
</style>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-11">
                <h1>Zone Plan</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
        <div class="col-lg-1 align-self-center">
            <a href="{{ route('dataZonePlan') }}" class="btn btn-default btn-icon-split">
                <span class="icon">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Data Zone Plan</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Zone Plan</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Zone Plan" value="{{ $dataZonePlan->nama }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Provinsi">Provinsi</label>
                        <select class="form-control select2" id="provinsi" name="provinsi" data-placeholder="Provinsi" style="width: 100%;" disabled>
                            <option selected disabled>{{ $dataZonePlan->Provinsi->nama }}</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Kabupaten">Kabupaten</label>
                        <select class="form-control select2" id="kabupaten" name="kabupaten" data-placeholder="Kabupaten" style="width: 100%;" disabled>
                            <option selected disabled>{{ $dataZonePlan->Kabupaten->nama }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Kecamatan">Kecamatan</label>
                        <select class="form-control select2" id="kecamatan" name="kecamatan" data-placeholder="Kecamatan" style="width: 100%;" disabled>
                            <option selected disabled>{{ $dataZonePlan->Kecamatan->nama }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Desa">Desa</label>
                        <select class="form-control select2" id="desa" name="desa" data-placeholder="Desa" style="width: 100%;" disabled>
                            <option selected disabled>{{ $dataZonePlan->Desa->nama }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control" name="lat" id="lat" value="{{ $dataZonePlan->lat }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" class="form-control" name="lng" id="lng" value="{{ $dataZonePlan->long }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Radius</label>
                        <input type="text" class="form-control" name="rad" id="rad" value="{{ $dataZonePlan->radius }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Batas Menara</label>
                        <input type="number" class="form-control" name="batasMenara" id="batasMenara" value="{{ $dataZonePlan->batas_menara }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control select2" name="status" id="status" data-placeholder="Status" style="width: 100%;" disabled>
                            <option value="available" @if ($dataZonePlan->status == 'available') selected @endif>Available</option>
                            <option value="used" @if ($dataZonePlan->status == 'used') selected @endif>Used</option>
                            <option value="terlarang" @if ($dataZonePlan->status == 'terlarang') selected @endif>Terlarang</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Map</h6>
                </div>
                <div class="card-body">
                    <div id="mapid"></div>
                </div>
            </div>
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
{{-- Leaflet --}}
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

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
    var dataZonePlan = {!! json_encode($dataZonePlan->toArray()) !!}
    let menara = {!! json_encode($menara->toArray()) !!}
    // console.log(menara)

    var lat = dataZonePlan.lat;
    var lng = dataZonePlan.long;
    let rad = dataZonePlan.radius;

    //MAP INIT
    var mymap = L.map('mapid').setView([lat, lng], 16);
    L.Map.include({
        getMarkerById: function (id) {
            var marker = null;
            this.eachLayer(function (layer) {
                if (layer instanceof L.Circle) {
                    if (layer.options.id === id) {
                        marker = layer;
                    }
                }
            });
            return marker;
        }
    });

    // console.log(lat);
    // console.log(lng);
    // console.log(rad);

    var circle = L.circle([lat, lng], rad).addTo(mymap);

    menara.forEach(element => {
        console.log(element)
        marker = L.marker([element.lat, element.long]);
        mymap.addLayer(marker);
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
@endpush