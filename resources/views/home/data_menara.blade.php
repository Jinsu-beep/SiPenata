@extends('layouts/home/index-layout')
@section('title')<title>SiPenata | Data Menara</title>@endsection

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="anonymous"/>
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> --}}
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    {{-- datatables --}}
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="Leaflet.awesome-markers/dist/leaflet.awesome-markers.css">
@endpush

@section('content')
<section class="content">
    <div class="row mt-4 mx-2">
        <div class="col-md-4 col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Data Menara</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        @foreach ($listPerusahaan as $lp)
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="namaPerusahaan{{ $lp->perusahaan->id }}">
                                        <label for="namaPerusahaan{{ $lp->perusahaan->id }}">
                                            {{ $lp->perusahaan->nama }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-1">
                                    <img src="{{ $lp->perusahaan->marker }}" alt="image" height="30">
                                </div>
                            </div>
                        @endforeach
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
                    <div id="mymap" style="width: 100%; height: 623px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Menara</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="gambarMenara" class="col-lg-5 align-self-center text-center">
                        {{-- <img src="" width="600"> --}}
                    </div>
                    <div class="col-sm-7">
                        <div class="row mb-2">  
                            <label for="noMenara" class="col-sm-2 col-form-label">No Menara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="noMenara" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="provinsi" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="kabupaten" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="kecamatan" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="desa" class="col-sm-2 col-form-label">Desa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="desa" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="tanggalPembuatan" class="col-sm-2 col-form-label">Tanggal Pembuatan</label>
                            <div class="col-sm-10 align-self-center">
                                <input type="text" class="form-control" placeholder="Tanggal Pembuatan" id="tanggalPembuatan" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="lat" class="col-sm-2 col-form-label">Latitude</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="lat" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="long" class="col-sm-2 col-form-label">Longitude</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="lng" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="jenisMenara" class="col-sm-2 col-form-label">Jenis Menara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="jenisMenara" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="tinggiMenara" class="col-sm-2 col-form-label">Tinggi Menara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="tinggiMenara" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="tinggiAntena" class="col-sm-2 col-form-label">Tinggi Antena</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="tinggiAntena" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="luasArea" class="col-sm-2 col-form-label">Luas Area</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="luasArea" value="" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="aksesJalan" class="col-sm-2 col-form-label">Akses Jalan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Tanggal Pengajuan" id="aksesJalan" value="" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>
@endsection

@push('js')
    {{-- Leaflet --}}
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="Leaflet.awesome-markers/dist/leaflet.awesome-markers.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        //MAP INIT
        var mymap = L.map('mymap').setView([-8.367760, 115.547787], 11);

        var markers = []

        var dataPerusahaan = {!! json_encode($listPerusahaan->toArray()) !!}
        dataPerusahaan.forEach(element => {
            var icon = new L.Icon({
                iconUrl: element.perusahaan.marker,
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            $('#namaPerusahaan' + element.perusahaan.id).change(function() {
                var idperusahaan = element.perusahaan.id;
                var box = this.checked;
                element.menara.forEach(element1 =>{
                    console.log(element1);
                    if (box == true) {
                        marker = L.marker([element1.lat, element1.long], {
                            icon : icon,
                            id : idperusahaan,
                        }).bindPopup('<div class="row"> <div class="col align-self-start"> No Menara : '+element1.no_menara+'<br>Jenis Menara : '+element1.jenis_menara+'<hr></div> <div class="w-100"></div> <div class="col align-self-center"> <button onclick="detailMenara('+element1.id+')" class="btn btn-primary float-center">Detail</button> </div> </div>');
                        mymap.addLayer(marker);
                        markers.push(marker)
                    } else if (box == false) {
                        markers.forEach(element1 => {
                            if (element1.options.id == idperusahaan) {
                                mymap.removeLayer(element1)
                            }
                            console.log(element1.options.id);
                        })
                    }
                });
            })
        });

        let menara = {!! json_encode($menara->toArray()) !!}

        function detailMenara(id) {
            menara.forEach(element => {
                if (element.id == id) {
                    console.log(element)
                    $('#gambarMenara').empty();
                    $('#gambarMenara').append('<img src="'+element.foto+'" width="400">');
                    $('#noMenara').val(element.no_menara);
                    $('#provinsi').val(element.provinsi.nama);
                    $('#kabupaten').val(element.kabupaten.nama);
                    $('#kecamatan').val(element.kecamatan.nama);
                    $('#desa').val(element.desa.nama);
                    $('#tanggalPembuatan').val(element.tanggal_pembuatan);
                    $('#lat').val(element.lat);
                    $('#lng').val(element.long);
                    $('#jenisMenara').val(element.jenis_menara);
                    $('#tinggiMenara').val(element.tinggi_menara);
                    $('#tinggiAntena').val(element.tinggi_antena);
                    $('#luasArea').val(element.luas_area);
                    $('#aksesJalan').val(element.akses_jalan);
                    $('#exampleModal').modal('show');
                }
            });
        }

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
        }).addTo(mymap);
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#dataMenara').addClass('active');
        });
    </script>
@endpush
