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
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-11">
                <h1>Pengajuan Menara</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
        <div class="col-lg-1 align-self-center">
            <a href="{{ route('dataPengajuan') }}" class="btn btn-default btn-icon-split">
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
                <h3 class="card-title">Create Pengajuan Menara</h3>
            </div>
            <div class="card-body p-0">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#user-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="user-part" id="user-part-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Data Pemohon</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#menara-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="menara-part" id="menara-part-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Data Menara</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#file-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="file-part" id="file-part-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">File Pendukung</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="user-part" class="content" role="tabpanel" aria-labelledby="user-part-trigger">
                            <div class="card-body">
                                <label for="User" class="">Data User</label>
                            </div>
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Nama" placeholder="Name" value="{{ $dataUser->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Kewarganegaraan" placeholder="Kewarganegaraan" value="{{ $dataUser->Kewarganegaraan }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="Email" placeholder="Email" value="{{ $dataUser->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_telp" placeholder="no_telp" value="{{ $dataUser->no_telp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="NoKTP" class="col-sm-2 col-form-label">No KTP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="NoKTP" placeholder="Name" value="{{ $dataUser->no_ktp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="NPWP" class="col-sm-2 col-form-label">NPWP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="NPWP" placeholder="Name" value="{{ $dataUser->NPWP }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="provinsi" placeholder="Provinsi" value="{{ $dataUser->Provinsi->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kabupten" class="col-sm-2 col-form-label">Kabupten</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kabupaten" placeholder="Kabupaten" value="{{ $dataUser->Kabupaten->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan" value="{{ $dataUser->Kecamatan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Desa" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="desa" placeholder="Desa" value="{{ $dataUser->Desa->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="Alamat" placeholder="Name" disabled>{{ $dataUser->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="card-body">
                                <label for="Perusahaan" class="col-sm-2 col-form-label">Data Perusahaan</label>
                            </div>
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="nama_perusahaan" placeholder="Name" value="{{ $dataUser->perusahaan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email_perusahaan" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email_perusahaan" placeholder="Name" value="{{ $dataUser->perusahaan->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="noTelp_perusahaan" class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="noTelp_perusahaan" placeholder="Email" value="{{ $dataUser->perusahaan->no_telp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="provinsi_perusahaan" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="provinsi" placeholder="Provinsi" value="{{ $dataUser->perusahaan->Provinsi->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kabupatenPerusahaan" class="col-sm-2 col-form-label">Kabupten</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kabupaten" placeholder="Kabupaten" value="{{ $dataUser->perusahaan->Kabupaten->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kecamatan_perusahaan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan" value="{{ $dataUser->perusahaan->Kecamatan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desa_perusahaan" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="desa" placeholder="Desa" value="{{ $dataUser->perusahaan->Desa->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat_perusahaan" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="alamat_perusahaan" placeholder="Name" disabled>{{ $dataUser->perusahaan->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="mx-2">
                                    <button class="btn btn-primary" type="button" id="user_button" onclick="stepper.next()">Next</button>
                                </div>
                            </div>
                        </div>
                        <form action="/pengajuan/insert/{{ $dataUser->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="menara-part" class="content" role="tabpanel" aria-labelledby="menara-part-trigger">
                            <div class="card ">
                                <div id="mymap"></div>
                            </div>
                            <div id="status">
                            </div>
                            <div>
                                <input type="text" class="form-control" name="idZone" id="idZone" readonly hidden>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="Latitude">Latitude</label>
                                        <input type="text" class="form-control" placeholder="Latitude" name="lat" id="lat" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="Longitude">Longitude</label>
                                        <input type="text" class="form-control" placeholder="Longitude" name="lng" id="lng" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Provinsi</label>
                                <select class="form-control select2" name="provinsi" id="menara_provinsi" data-placeholder=" Provinsi " style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Kabupaten</label>
                                <select class="form-control select2" name="kabupaten" id="menara_kabupaten" data-placeholder=" Kabupaten " style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Kecamatan</label>
                                <select class="form-control select2" name="kecamatan" id="menara_kecamatan" data-placeholder=" Kecamatan " style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Desa</label>
                                <select class="form-control select2" name="desa" id="menara_desa" data-placeholder=" Desa " style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Jenis Menara</label>
                                <select class="form-control select2" name="jenisMenara" id="jenisMenara" data-placeholder="Pilih OPD" style="width: 100%;">
                                    <option selected disabled>Pilih Jenis Menara ...</option>
                                    <option value="Menara 4 Kaki">Menara 4 Kaki</option>
                                    <option value="Menara 3 Kaki">Menara 3 Kaki</option>
                                    <option value="Menara 1 Kaki">Menara 1 Kaki</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Tinggi Menara (Meter)</label>
                                <input type="number" class="form-control" placeholder="Tinggi Menara" name="tinggiMenara" id="tinggiMenara">
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Tinggi Antena (Meter)</label>
                                <input type="number" class="form-control" placeholder="Tinggi Antena" name="tinggiAntena">
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Luas Area (Meter Persegi)</label>
                                <input type="number" class="form-control" placeholder="Luas Area" name="luasArea">
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Akses Jalan</label>
                                <input type="text" class="form-control" placeholder="Akses Jalan" name="aksesJalan">
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Status Lahan</label>
                                <select class="form-control select2" name="statusLahan" id="statusLahan" data-placeholder="Status Lahan" style="width: 100%;">
                                    <option selected disabled>Pilih Status Lahan ...</option>
                                    <option value="sewa">Sewa</option>
                                    <option value="milik perusahaan">Milik Perusahaan</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Nama Kepemilikan Tanah</label>
                                <input type="text" class="form-control" placeholder="Nama Kepemilikan Tanah" name="namaPemilikTanah">
                            </div>
                            <div class="row justify-content-between mx-1">
                                <button class="btn btn-primary" type="button" onclick="stepper.previous()">Previous</button>
                                <button class="btn btn-primary" type="button" onclick="stepper.next()">Next</button>
                            </div>
                        </div>
                        <div id="file-part" class="content" role="tabpanel" aria-labelledby="file-part-trigger">
                            <div class="form-group mb-3">
                                <label for="NPWP">Gambar KTP Pemohon</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_KTPPemohon" name="file_KTPPemohon">
                                        <label class="custom-file-label" for="file_KTPPemohon">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Gambar NPWP Pemohon</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_NPWPPemohon" name="file_NPWPPemohon">
                                        <label class="custom-file-label" for="file_NPWPPemohon">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Gambar Foto Pemohon</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_fotoPemohon" name="file_fotoPemohon">
                                        <label class="custom-file-label" for="file_fotoPemohon">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Surat Kuasa</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_suratKuasa" name="file_suratKuasa">
                                        <label class="custom-file-label" for="file_suratKuasa">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Gambar Rancang Bangun</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input " id="file_rancangBangun" name="file_rancangBangun">
                                        <label class="custom-file-label" for="file_rancangBangun">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Denah Bangunan</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input " id="file_denahBangunan" name="file_denahBangunan">
                                        <label class="custom-file-label" for="file_denahBangunan">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Gambar Lokasi dan Situasi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_lokasiDanSituasi" name="file_lokasiDanSituasi">
                                        <label class="custom-file-label" for="file_lokasiDanSituasi">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Surat Tanah</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_suratTanah" name="file_suratTanah">
                                        <label class="custom-file-label" for="file_suratTanah">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Persetujuan pendamping</label> <br>
                                <button type="button" onclick="tambahPendamping()" id="tambah_pendamping" class="btn btn-primary btn-icon-split mb-2">
                                    <span class="icon">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    tambah data
                                </button>
                                <div class="input-group">
                                    <table id="input_pendamping" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="320px">nama</th>
                                                <th class="text-center" width="250px">no ktp</th>
                                                <th class="text-center" width="150px">jarak</th>
                                                <th class="text-center" width="300px">file</th>
                                                <th class="text-center" width="80px">aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabel_pendamping">
                                        </tbody>
                                    </table>
                                </div>
                                <input type="number" id="jumlahData" name="jumlahData" hidden>
                            </div>
                            <div class="row justify-content-between mx-1">
                                <div class="col-lg-6">
                                    <button class="btn btn-primary" type="button" onclick="stepper.previous()">Previous</button>
                                </div>
                                <div>
                                    <button type="submit" name="action" class="btn btn-warning" value="draft">draft</button>
                                    <button type="submit" name="action" class="btn btn-primary" value="ajukan">Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">
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
    let kerusakanZona = [];
    //MAP INIT
    var mymap = L.map('mymap').setView([-8.367760, 115.547787], 11);
    
    $('#user_button').click(function () {
        setTimeout(function() {
            mymap.invalidateSize();
        }, 100);
    });

    var circles = []

    var zonePlan = {!! json_encode($dataZonePlan->toArray()) !!}
    zonePlan.forEach(element => {
        if (element.status == 'available') {
            var circle = L.circle([element.lat, element.long], element.radius).addTo(mymap);
            circles.push(circle);
        }
    });
    
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
        drawMarker: true,
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

    //HANDLER PM CREATE
    let menaraTerdekat = [];
    var icon = new L.Icon({
        iconUrl: '/images/marker-icon-red.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    mymap.on('pm:create', e => {
    let shape = e.shape;
    // console.log(e);
        if (shape == 'Marker') {
            let lat = e.marker._latlng.lat;
            let lng = e.marker._latlng.lng;

            $.ajax({
                type: 'GET',
                url: '/pengajuan/getDistance/'+lat+'/'+lng,
                success: function (response){
                    console.log(response);
                    if (response.statusZona == 1) {
                        if (response.zp.status != 'available') {
                            $('#status').append('<h6 style="color: red">*Lokasi Yang Dipilih Diluar Zona Pembangunan Yang Ada</h6>');
                        } else {
                            $('#menara_provinsi').empty();
                            $('#menara_provinsi').append('<option value="' + response.zp.id_provinsi + '"' +' selected>' + response.zp.provinsi.nama + '</option>');
                            $('#menara_kabupaten').empty();
                            $('#menara_kabupaten').append('<option value="' + response.zp.id_kabupaten + '"' +' selected>' + response.zp.kabupaten.nama + '</option>');
                            $('#menara_kecamatan').empty();
                            $('#menara_kecamatan').append('<option value="' + response.zp.id_kecamatan + '"' +' selected>' + response.zp.kecamatan.nama + '</option>');
                            $('#menara_desa').empty();
                            $('#menara_desa').append('<option value="' + response.zp.id_desa + '"' +' selected>' + response.zp.desa.nama + '</option>');
                            $('#idZone').empty();
                            $('#idZone').val(response.zp.id);
                        }
                    } else if (response.statusZona == 0) {
                        $('#status').append('<h6 style="color: red">*Lokasi Yang Dipilih Diluar Zona Pembangunan Yang Ada</h6>');
                    }

                    if (response.statusMenara == 1) {
                        dekatMenara = L.marker([response.menaraDekat.lat, response.menaraDekat.long], {
                            icon : icon,
                        }).addTo(mymap);
                        menaraTerdekat.push(dekatMenara);
                        $('#status').append('<h6 style="color: red">**Lokasi Yang Dipilih Berjarak Kurang Dari Atau Sama Dengan 350 Meter Dengan Menara BTS Terdekat</h6>');
                    }
                }
            });

            $('#lat').val(lat);
            $('#lng').val(lng);

            let tinggiMenara = $('#tinggiMenara').val();

            if (tinggiMenara != '') {
                zonaKerusakan = L.circle([lat, lng], {radius: tinggiMenara, color: '#ff0000'}).addTo(mymap);
                kerusakanZona.push(zonaKerusakan);
            }

            $('#tinggiMenara').keyup(function(){
                kerusakanZona.forEach(element => {
                    mymap.removeLayer(element);
                });
                let kerusakan = $('#tinggiMenara').val();
                console.log(kerusakan);
                zonaKerusakan = L.circle([lat, lng], {radius: kerusakan, color: '#ff0000'}).addTo(mymap);
                kerusakanZona.push(zonaKerusakan);
                if (kerusakan == '') {
                    kerusakanZona.forEach(element => {
                        mymap.removeLayer(element);
                    });
                }
            });

            mymap.pm.disableDraw('Marker', {
                snappable: true,
                snapDistance: 20,
            });

            mymap.pm.addControls({
                editMode: false,
                drawMarker: false,
                removalMode: true,
            });

            e.marker.on('pm:remove', ({layer}) => {
                $('#lat').val('');
                $('#lng').val('');
                $('#menara_provinsi').empty();
                $('#menara_kabupaten').empty();
                $('#menara_kecamatan').empty();
                $('#menara_desa').empty();
                $('#status').empty();
                menaraTerdekat.forEach(element => {
                    mymap.removeLayer(element);
                })
                mymap.pm.addControls({
                    editMode: false,
                    removalMode: false,
                    drawMarker: true,
                });
                kerusakanZona.forEach(element => {
                    mymap.removeLayer(element);
                });
            });

            // e.marker.pm.enable({  
            //     allowSelfIntersection: false,  
            // });
                      
            // e.marker.on('move', function(e){
            //     // console.log(e);
            //     $('#lat').val(e.latlng.lat);
            //     $('#lng').val(e.latlng.lng);

            //     $.ajax({
            //         type: 'GET',
            //         url: '/pengajuan/getDistance/'+e.latlng.lat+'/'+e.latlng.lng,
            //         success: function (response){
            //             console.log(response[0]);
            //         }
            //     });
            // });  
        }
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
    $('#edit_provinsi').change(function() {
        if($('#edit_provinsi').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/profile/kabupaten/'+id,
                success: function (response){
                    // console.log(response);
                    $('#edit_kabupaten').empty();
                    $('#edit_kabupaten').append('<option selected disabled>Pilih Kabupaten ...</option>');
                    response.forEach(element => {
                        $('#edit_kabupaten').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    });
                    $('#edit_kecamatan').empty();
                    $('#edit_kecamatan').append('<option selected disabled>Pilih Kecamatan ...</option>');
                    $('#edit_desa').empty();
                    $('#edit_desa').append('<option selected disabled>Pilih Desa ...</option>');
                }
            });
        } 
    });
</script>

<script>
    $('#edit_kabupaten').change(function() {
        if($('#edit_kabupaten').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/profile/kecamatan/'+id,
                success: function (response){
                    // console.log(response);
                    $('#edit_kecamatan').empty();
                    $('#edit_kecamatan').append('<option selected disabled>Pilih Kecamatan ...</option>');
                    response.forEach(element => {
                        $('#edit_kecamatan').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    });
                    $('#edit_desa').empty();
                    $('#edit_desa').append('<option selected disabled>Pilih Desa ...</option>');
                }
            });
        } 
    });
</script>

<script>
    $('#edit_kecamatan').change(function() {
        if($('#edit_kecamatan').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/profile/desa/'+id,
                success: function (response){
                    // console.log(response);
                    $('#edit_desa').empty();
                    $('#edit_desa').append('<option selected disabled>Pilih Desa ...</option>');
                    response.forEach(element => {
                        $('#edit_desa').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    });
                }
            });
        } 
    });
</script>

<script>
    var id = 0;

    function tambahPendamping() {
        id = parseInt(id) + 1;
        console.log(id);
        $('#tabel_pendamping').append('<tr id="tr' + id + '"> <td> <input type="text" class="form-control" placeholder="Nama Pendamping" name="nama[' + id + ']" id="lat"> </td> <td> <input type="text" class="form-control" placeholder="No KTP Pendamping" name="ktp[' + id + ']" id="lat"> </td> <td> <input type="text" class="form-control" placeholder="Jarak (Meter)" name="jarak[' + id + ']" id="lat"> </td> <td> <input type="file" id="file_pendamping[' + id + ']" name="file_pendamping[' + id + ']"> </td> <td class="text-center"> <button type="button" onclick="deleteKolom(' + id + ')" id="delete_akun" class="btn btn-danger btn-icon-split"> <span class="icon"> <i class="fas fa-trash"></i> </span> </button> </td> </tr>');
        $('#jumlahData').val(id).change();
    }
</script>

<script>
    function deleteKolom(id) {
        $('#tr' + id).empty();
    }
</script>

<script>
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
</script>

<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>

@endpush