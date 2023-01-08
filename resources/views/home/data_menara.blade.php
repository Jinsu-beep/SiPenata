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
@endsection

@push('js')
    {{-- Leaflet --}}
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="Leaflet.awesome-markers/dist/leaflet.awesome-markers.js"></script>

    <script>
        //MAP INIT
        var mymap = L.map('mymap').setView([-8.367760, 115.547787], 11);
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
                element.menara.forEach(element =>{
                    if (box == true) {
                        marker = L.marker([element.lat, element.long], {
                            icon : icon,
                            id : idperusahaan,
                        });
                        mymap.addLayer(marker);
                        markers.push(marker)
                    } else if (box == false) {
                        markers.forEach(element => {
                            if (element.options.id == idperusahaan) {
                                mymap.removeLayer(element)
                            }
                            console.log(element.options.id);
                        })
                    }
                });
            })
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#dataMenara').addClass('active');
        });
    </script>


@endpush
