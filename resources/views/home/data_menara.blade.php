@extends('layouts/home/index-layout')
@section('title') Data Menara @endsection

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="anonymous"/>
@endpush

@section('content')
<section class="content">
    <div class="row mt-4">
        <div class="col-md-4 col-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Zone Plan</label>
                        <input type="text" class="form-control" name="nama" id="no_dasarHukum" placeholder="Nama Zone Plan">
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
</section>
@endsection

@push('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script>
        var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11'
            });

        var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/satellite-v9'
            });


        var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

        var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/dark-v10'
            });
        
        var desa = L.layerGroup();
        var map = L.map('map', {
        center: [-8.482422431008075, 115.51989631657665],
        zoom: 14,
        layers: [peta2, desa]
        });

        var baseMaps = {
        "Grayscale": peta1,
        "satellite": peta2,
        "Streets": peta3,
        "Dark": peta4
        };

        L.control.layers(baseMaps).addTo(map);
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#home').addClass('active');
            $('#menu-home').addClass('active');
        });
    </script>
@endpush
