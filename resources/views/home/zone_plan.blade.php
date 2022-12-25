@extends('layouts/home/index-layout')
@section('title') Zone Plan @endsection

@push('css')
{{-- Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />

<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row mt-4 mx-2">
            <div class="col-md-4 col-12">
                <div class="row">
                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Zone Plan</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary2">
                                            <label for="checkboxPrimary2">
                                                Zone Plan Tersedia
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-1">
                                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#0505f7" d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary1">
                                            <label for="checkboxPrimary1">
                                                Zone Plan Terisi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-1">
                                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#f70505" d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Analisa Zona Cellplan</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Latitude</label>
                                    <input type="text" class="form-control" name="nama" id="no_dasarHukum" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Longitude</label>
                                    <input type="text" class="form-control" name="nama" id="no_dasarHukum" placeholder="">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
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
                        <div id="map" style="width: 100%; height: 600px;"></div>
                    </div>
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
    
    <script>
        //MAP INIT
        var mymap = L.map('map').setView([-8.620616586325221, 115.23332286413316], 16);
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

        var available = []
        var used = []

        var dataZonePlanAvailable = {!! json_encode($zonePlanAvailable->toArray()) !!}
        var dataZonePlanUsed = {!! json_encode($zonePlanUsed->toArray()) !!}

        $('#checkboxPrimary2').change(function() {
            if (this.checked == true) {
                dataZonePlanAvailable.forEach(element => {
                    console.log()
                    circleAvailable = L.circle([element.lat, element.long], element.radius).addTo(mymap);
                    available.push(circleAvailable)
                });
            } else if (this.checked == false) {
                available.forEach(element => {
                    mymap.removeLayer(element);
                })
            }
        })
        $('#checkboxPrimary').change(function() {
            if (this.checked == true) {
                dataZonePlanUsed.forEach(element => {
                    console.log()
                    circleUsed = L.circle([element.lat, element.long], element.radius).addTo(mymap);
                    used.push(circleUsed)
                });
            } else if (this.checked == false) {
                used.forEach(element => {
                    mymap.removeLayer(element);
                })
            }
        })

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
            $('#zonePlan').addClass('active');
        });
    </script>
@endpush