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
        @if (in_array(auth()->guard('admin')->user()->kategori, ['Tim Administratif']))
            @if ($status->Status->status == 'Pemeriksaan Oleh Tim Administrasi')
                <form action="/pengajuan/validateTimAdministratif/{{ $detailPengajuan->id }}" method="POST" enctype="multipart/form-data">
            @elseif ($status->Status->status == 'Pengajuan Disetujui')
                <form action="/pengajuan/akhirPengajuan/{{ $detailPengajuan->id }}" method="POST" enctype="multipart/form-data">
            @endif
        @elseif (in_array(auth()->guard('admin')->user()->kategori, ['Tim Lapangan']))
            <form action="/pengajuan/validateTimLapangan/{{ $detailPengajuan->id }}" method="POST" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Detail Pengajuan Menara</h3>
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
                                    <input type="text" class="form-control" id="Nama" placeholder="Name" value="{{ $detailPengajuan->PemilikMenara->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Kewarganegaraan" placeholder="Kewarganegaraan" value="{{ $detailPengajuan->PemilikMenara->Kewarganegaraan }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="Email" placeholder="Email" value="{{ $detailPengajuan->PemilikMenara->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_telp" placeholder="no_telp" value="{{ $detailPengajuan->PemilikMenara->no_telp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="NoKTP" class="col-sm-2 col-form-label">No KTP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="NoKTP" placeholder="Name" value="{{ $detailPengajuan->PemilikMenara->no_ktp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="NPWP" class="col-sm-2 col-form-label">NPWP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="NPWP" placeholder="Name" value="{{ $detailPengajuan->PemilikMenara->NPWP }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="provinsi" placeholder="Provinsi" value="{{ $detailPengajuan->PemilikMenara->Provinsi->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kabupten" class="col-sm-2 col-form-label">Kabupten</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kabupaten" placeholder="Kabupaten" value="{{ $detailPengajuan->PemilikMenara->Kabupaten->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan" value="{{ $detailPengajuan->PemilikMenara->Kecamatan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Desa" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="desa" placeholder="Desa" value="{{ $detailPengajuan->PemilikMenara->Desa->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="Alamat" placeholder="Name" disabled>{{ $detailPengajuan->PemilikMenara->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="card-body">
                                <label for="Perusahaan" class="col-sm-2 col-form-label">Data Perusahaan</label>
                            </div>
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="nama_perusahaan" placeholder="Name" value="{{ $detailPengajuan->PemilikMenara->perusahaan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email_perusahaan" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email_perusahaan" placeholder="Name" value="{{ $detailPengajuan->PemilikMenara->perusahaan->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="noTelp_perusahaan" class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="noTelp_perusahaan" placeholder="Email" value="{{ $detailPengajuan->PemilikMenara->perusahaan->no_telp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="provinsi_perusahaan" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="provinsi" placeholder="Provinsi" value="{{ $detailPengajuan->PemilikMenara->perusahaan->Provinsi->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kabupatenPerusahaan" class="col-sm-2 col-form-label">Kabupten</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kabupaten" placeholder="Kabupaten" value="{{ $detailPengajuan->PemilikMenara->perusahaan->Kabupaten->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kecamatan_perusahaan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan" value="{{ $detailPengajuan->PemilikMenara->perusahaan->Kecamatan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desa_perusahaan" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="desa" placeholder="Desa" value="{{ $detailPengajuan->PemilikMenara->perusahaan->Desa->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat_perusahaan" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="alamat_perusahaan" placeholder="Name" disabled>{{ $detailPengajuan->PemilikMenara->perusahaan->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="mx-2">
                                    <button class="btn btn-primary" type="button" id="user_button" onclick="stepper.next()">Next</button>
                                </div>
                            </div>
                        </div>
                        <div id="menara-part" class="content" role="tabpanel" aria-labelledby="menara-part-trigger">
                            <div class="card ">
                                <div id="mymap"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="Latitude">Latitude</label>
                                        <input type="text" class="form-control" placeholder="Latitude" name="lat" id="lat" value="{{ $detailPengajuan->lat }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="Longitude">Longitude</label>
                                        <input type="text" class="form-control" placeholder="Longitude" name="lng" id="lng" value="{{ $detailPengajuan->long }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Provinsi</label>
                                <input type="text" class="form-control" placeholder="Longitude" name="provinsi" id="provinsi" value="{{ $detailPengajuan->Provinsi->nama }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Kabupaten</label>
                                <input type="text" class="form-control" placeholder="Longitude" name="kabupaten" id="kabupaten" value="{{ $detailPengajuan->Kabupaten->nama }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Kecamatan</label>
                                <input type="text" class="form-control" placeholder="Longitude" name="kecamatan" id="kecamatan" value="{{ $detailPengajuan->Kecamatan->nama }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Desa</label>
                                <input type="text" class="form-control" placeholder="Longitude" name="desa" id="desa" value="{{ $detailPengajuan->Desa->nama }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Jenis Menara</label>
                                <input type="text" class="form-control" placeholder="Longitude" name="provinsi" id="provinsi" value="{{ $detailPengajuan->jenis_menara }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Tinggi Menara (Meter)</label>
                                <input type="text" class="form-control" placeholder="Tinggi Menara" name="tinggiMenara" value="{{ $detailPengajuan->tinggi_menara }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Tinggi Antena (Meter)</label>
                                <input type="text" class="form-control" placeholder="Tinggi Antena" name="tinggiAntena" value="{{ $detailPengajuan->tinggi_antena }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Luas Area (Meter Persegi)</label>
                                <input type="number" class="form-control" placeholder="Luas Area" name="luasArea" value="{{ $detailPengajuan->luas_area }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Akses Jalan</label>
                                <input type="text" class="form-control" placeholder="Akses Jalan" name="aksesJalan" value="{{ $detailPengajuan->akses_jalan }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Status Lahan</label>
                                <input type="text" class="form-control" placeholder="Longitude" name="provinsi" id="provinsi" value="{{ $detailPengajuan->status_lahan }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Nama Kepemilikan Tanah</label>
                                <input type="text" class="form-control" placeholder="Nama Kepemilikan Tanah" name="namaPemilikTanah" value="{{ $detailPengajuan->kepemilikan_tanah }}" disabled>
                            </div>
                            <div class="row justify-content-between mx-1">
                                <button class="btn btn-primary" type="button" onclick="stepper.previous()">Previous</button>
                                <button class="btn btn-primary" type="button" onclick="stepper.next()">Next</button>
                            </div>
                        </div>
                        <div id="file-part" class="content" role="tabpanel" aria-labelledby="file-part-trigger">
                            <div class="form-group mb-3">
                                <label for="NPWP">Gambar KTP Pemohon</label>
                                <table id="example2" class="table table-bordered table-hover mt-1">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Gambar KTP Pemohon</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile1()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                <select class="form-control select2" name="status1" id="statusFile1" data-placeholder="Pilih Status" style="width: 100%;" @if ($detailFile1->status == 'disetujui') disabled @endif>
                                                    <option selected disabled>Status ...</option>
                                                    <option value="perbaiki" @if ($detailFile1->status == 'perbaiki') selected @endif>Perbaiki</option>
                                                    <option value="disetujui" @if ($detailFile1->status == 'disetujui') selected @endif>Disetujui</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Gambar NPWP Pemohon</label>
                                <table id="example2" class="table table-bordered table-hover mt-1">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Gambar NPWP Pemohon</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile2()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                <select class="form-control select2" name="status2" id="statusFile2" data-placeholder="Pilih Status" style="width: 100%;" @if ($detailFile2->status == 'disetujui') disabled @endif>
                                                    <option selected disabled>Status ...</option>
                                                    <option value="perbaiki" @if ($detailFile2->status == 'perbaiki') selected @endif>Perbaiki</option>
                                                    <option value="disetujui" @if ($detailFile2->status == 'disetujui') selected @endif>Disetujui</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Gambar Foto Pemohon</label>
                                <table id="example2" class="table table-bordered table-hover mt-1">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Gambar Foto Pemohon</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile3()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                <select class="form-control select2" name="status3" id="statusFile3" data-placeholder="Pilih Status" style="width: 100%;" @if ($detailFile3->status == 'disetujui') disabled @endif>
                                                    <option selected disabled>Status ...</option>
                                                    <option value="perbaiki" @if ($detailFile3->status == 'perbaiki') selected @endif>Perbaiki</option>
                                                    <option value="disetujui" @if ($detailFile3->status == 'disetujui') selected @endif>Disetujui</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Surat Kuasa</label>
                                <table id="example2" class="table table-bordered table-hover mt-1">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Surat Kuasa</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile4()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                <select class="form-control select2" name="status4" id="statusFile4" data-placeholder="Pilih Status" style="width: 100%;" @if ($detailFile4->status == 'disetujui') disabled @endif>
                                                    <option selected disabled>Status ...</option>
                                                    <option value="perbaiki" @if ($detailFile4->status == 'perbaiki') selected @endif>Perbaiki</option>
                                                    <option value="disetujui" @if ($detailFile4->status == 'disetujui') selected @endif>Disetujui</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Gambar Rancang Bangun</label>
                                <table id="example2" class="table table-bordered table-hover mt-1">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Gambar Rancang Bangun</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile5()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                <select class="form-control select2" name="status5" id="statusFile5" data-placeholder="Pilih Status" style="width: 100%;" @if ($detailFile5->status == 'disetujui') disabled @endif>
                                                    <option selected disabled>Status ...</option>
                                                    <option value="perbaiki" @if ($detailFile5->status == 'perbaiki') selected @endif>Perbaiki</option>
                                                    <option value="disetujui" @if ($detailFile5->status == 'disetujui') selected @endif>Disetujui</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Denah Bangunan</label>
                                <table id="example2" class="table table-bordered table-hover mt-1">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Denah Bangunan</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile6()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                <select class="form-control select2" name="status6" id="statusFile6" data-placeholder="Pilih Status" style="width: 100%;" @if ($detailFile6->status == 'disetujui') disabled @endif>
                                                    <option selected disabled>Status ...</option>
                                                    <option value="perbaiki" @if ($detailFile6->status == 'perbaiki') selected @endif>Perbaiki</option>
                                                    <option value="disetujui" @if ($detailFile6->status == 'disetujui') selected @endif>Disetujui</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Gambar Lokasi dan Situasi</label>
                                <table id="example2" class="table table-bordered table-hover mt-1">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Gambar Lokasi Dan Situasi</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile7()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                <select class="form-control select2" name="status7" id="statusFile7" data-placeholder="Pilih Status" style="width: 100%;" @if ($detailFile7->status == 'disetujui') disabled @endif>
                                                    <option selected disabled>Status ...</option>
                                                    <option value="perbaiki" @if ($detailFile7->status == 'perbaiki') selected @endif>Perbaiki</option>
                                                    <option value="disetujui" @if ($detailFile7->status == 'disetujui') selected @endif>Disetujui</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">File Surat Tanah</label>
                                <table id="example2" class="table table-bordered table-hover mt-1">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Surat Tanah</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile8()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                <select class="form-control select2" name="status8" id="statusFile8" data-placeholder="Pilih Status" style="width: 100%;" @if ($detailFile8->status == 'disetujui') disabled @endif>
                                                    <option selected disabled>Status ...</option>
                                                    <option value="perbaiki" @if ($detailFile8->status == 'perbaiki') selected @endif>Perbaiki</option>
                                                    <option value="disetujui" @if ($detailFile8->status == 'disetujui') selected @endif>Disetujui</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mb-3">
                                <label for="NPWP">Persetujuan pendamping</label>
                                <div class="input-group">
                                    <table id="input_pendamping" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="320px">nama</th>
                                                <th class="text-center" width="250px">no ktp</th>
                                                <th class="text-center" width="150px">jarak</th>
                                                <th class="text-center" width="300px">file</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabel_pendamping">
                                            @foreach ($detailPengajuan->PersetujuanPendamping as $pp)
                                                <tr id="tr{{ $loop->iteration }}">
                                                    <td class="text-center">{{ $pp->nama }}</td>
                                                    <td class="text-center">{{ $pp->no_ktp }}</td>
                                                    <td class="text-center">{{ $pp->jarak }}</td>
                                                    <td class="text-center">
                                                        <button type="button" id="filePendamping{{ $loop->iteration }}" class="btn btn-primary">
                                                            Show File
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <input type="number" id="jumlahData" name="jumlahData" value="{{ $detailPengajuan->jumlah_pendamping }}" hidden>
                            </div>
                            <div class="row justify-content-between mx-1">
                                <div class="col-lg-6">
                                    <button class="btn btn-primary" type="button" onclick="stepper.previous()">Previous</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-body">
                @if ($status->Status->status == 'Pengajuan Disetujui')
                        <div class="form-group">
                            <label for="file_rekomendasiPembangunan">File Surat Rekomendasi Pembangunan Menara</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_rekomendasiPembangunan" name="file_rekomendasiPembangunan">
                                <label class="custom-file-label" for="file_rekomendasiPembangunan">Choose file</label>
                            </div>
                        </div>
                @endif
                <div class="form-group">
                    <label for="Disposisi">Disposisi</label>
                    <textarea name="disposisi" id="disposisi" rows="5" class="form-control" placeholder="Disposisi"></textarea>
                </div>
            </div>
            <div class="card-footer">
                @if (in_array(auth()->guard('admin')->user()->kategori, ['Tim Administratif']))
                    @if ($status->Status->status == 'Pemeriksaan Oleh Tim Administrasi')
                        <div class="row justify-content-between">
                            <button type="submit" name="action" class="btn btn-warning" value="perbaiki">Perbaiki</button>
                            <button type="submit" name="action" class="btn btn-primary" value="diterima">Diterima</button>
                        </div>
                    @elseif ($status->Status->status == 'Pengajuan Disetujui')
                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    @endif
                @elseif (in_array(auth()->guard('admin')->user()->kategori, ['Tim Lapangan']))
                    <div class="row justify-content-between">
                        <button type="submit" name="action" class="btn btn-danger" value="ditolak">Ditolak</button>
                        <button type="submit" name="action" class="btn btn-primary" value="diterima">Diterima</button>
                    </div>    
                @endif
            </div>
        </div>
        </form>
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
    })
</script>

<script>
    let data = {!! json_encode($detailPengajuan->toArray()) !!}
    //MAP INIT
    var mymap = L.map('mymap').setView([data.lat, data.long], 15);
    
    $('#user_button').click(function () {
        setTimeout(function() {
            mymap.invalidateSize();
        }, 100);
    });

    var zonePlan = {!! json_encode($dataZonePlan->toArray()) !!}
    zonePlan.forEach(element => {
        if (element.status == 'available') {
            var circle = L.circle([element.lat, element.long], element.radius).addTo(mymap);
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

    
    // console.log(data);
    let marker =  L.marker([data.lat, data.long]).addTo(mymap);
    // console.log(marker);

    marker.on('pm:remove', ({layer}) => {
        $('#lat').val('');
        $('#lng').val('');
        mymap.pm.addControls({
            dragMode: false,
            removalMode: false,
            drawMarker: true,
        });
    });

    marker.on('move', function(e){
        $('#lat').val(e.latlng.lat);
        $('#lng').val(e.latlng.lng);;
    });

    //ADD CONTROLL
    mymap.pm.addControls({  
        position: 'topleft',
        drawCircle: false,
        drawMarker: false,
        drawCircleMarker: false,
        drawRectangle: false,
        drawPolyline: false,
        drawPolygon: false,
        dragMode: false,
        drawText: false,
        editMode: false,
        cutPolygon: false,
        removalMode: false,
        rotateMode: false,
    });

    //HANDLER PM CREATE
    mymap.on('pm:create', e => {
    let shape = e.shape;
    // console.log(e);
        if (shape == 'Marker') {
            let lat = e.marker._latlng.lat;
            let lng = e.marker._latlng.lng;

            $('#lat').val(lat);
            $('#lng').val(lng);

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
                mymap.pm.addControls({
                    editMode: false,
                    removalMode: false,
                    drawMarker: true,
                });
            });

            e.marker.pm.enable({  
                allowSelfIntersection: false,  
            });
                      
            e.marker.on('move', function(e){
                console.log(e);
                $('#lat').val(e.latlng.lat);
                $('#lng').val(e.latlng.lng);
            });  
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
    let dataPengajuan = {!! json_encode($detailPengajuan->toArray()) !!}
    $.ajax({
            type: 'GET',
            url: '/profile/kabupaten/'+dataPengajuan.id_provinsi,
            success: function (response){
                // console.log(response);
                $('#edit_kabupaten').empty();
                $('#edit_kabupaten').append('<option selected disabled>Pilih Kabupaten ...</option>');
                response.forEach(element => {
                    if(element.id == dataPengajuan.id_kabupaten){
                        $('#edit_kabupaten').append('<option value="' + element['id'] + '"' +' selected>' + element['nama'] + '</option>');
                    } else{
                        $('#edit_kabupaten').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    }
                });
        }
    });

    $.ajax({
            type: 'GET',
            url: '/profile/kecamatan/'+dataPengajuan.id_kabupaten,
            success: function (response){
                // console.log(response);
                $('#edit_kecamatan').empty();
                $('#edit_kecamatan').append('<option selected disabled>Pilih Kecamatan ...</option>');
                response.forEach(element => {
                    if(element.id == dataPengajuan.id_kecamatan){
                        $('#edit_kecamatan').append('<option value="' + element['id'] + '"' +' selected>' + element['nama'] + '</option>');
                    } else{
                        $('#edit_kecamatan').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    }
                });
        }
    });

    $.ajax({
            type: 'GET',
            url: '/profile/desa/'+dataPengajuan.id_kecamatan,
            success: function (response){
                // console.log(response);
                $('#edit_desa').empty();
                $('#edit_desa').append('<option selected disabled>Pilih Desa ...</option>');
                response.forEach(element => {
                    if(element.id == dataPengajuan.id_desa){
                        $('#edit_desa').append('<option value="' + element['id'] + '"' +' selected>' + element['nama'] + '</option>');
                    } else{
                        $('#edit_desa').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    }
                });
        }
    });
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
    if ($('#jumlahData').val() == '') {
        var id = 0;
    } else {
        var id = $('#jumlahData').val();
    }

    console.log(id);

    function tambahPendamping() {
        id = parseInt(id) + 1;
        // console.log(id);
        $('#tabel_pendamping').append('<tr id="tr' + id + '"> <td> <input type="text" class="form-control" placeholder="Nama Pendamping" name="nama[' + id + ']" id="lat"> </td> <td> <input type="text" class="form-control" placeholder="No KTP Pendamping" name="ktp[' + id + ']" id="lat"> </td> <td> <input type="text" class="form-control" placeholder="Jarak (Meter)" name="jarak[' + id + ']" id="lat"> </td> <td> <input type="file" id="file_pendamping[' + id + ']" name="file_pendamping[' + id + ']"> </td> <td class="text-center"> <button type="button" onclick="deleteKolom(' + id + ')" id="delete_akun" class="btn btn-danger btn-icon-split"> <span class="icon"> <i class="fas fa-trash"></i> </span> </button> </td> </tr>');
        $('#jumlahData').val(id).change();
    }
</script>

<script>
    function deleteKolom(id) {
        $('#tr' + id).empty();
    }

    function deleteData(id) {
        $.ajax({
            type: 'GET',
            url: '/pengajuan/deletePendamping/'+id,
            success:function(response){
                location.reload();
            }
        });
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

<script>
    function showFile1() {
        let file = {!! json_encode($detailFile1->toArray()) !!}
        console.log(file);
        PDFObject.embed(file.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File KTP Pemohon');
        $('#modal-showFile').modal('show');
    }

    function showFile2() {
        let file = {!! json_encode($detailFile2->toArray()) !!}
        console.log(file);
        PDFObject.embed(file.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File NPWP Pemohon');
        $('#modal-showFile').modal('show');
    }

    function showFile3() {
        let file = {!! json_encode($detailFile3->toArray()) !!}
        console.log(file);
        PDFObject.embed(file.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File Foto Pemohon');
        $('#modal-showFile').modal('show');
    }

    function showFile4() {
        let file = {!! json_encode($detailFile4->toArray()) !!}
        console.log(file);
        PDFObject.embed(file.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File Surat Kuasa');
        $('#modal-showFile').modal('show');
    }

    function showFile5() {
        let file = {!! json_encode($detailFile5->toArray()) !!}
        console.log(file);
        PDFObject.embed(file.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File Rancang Bangun');
        $('#modal-showFile').modal('show');
    }

    function showFile6() {
        let file = {!! json_encode($detailFile6->toArray()) !!}
        console.log(file);
        PDFObject.embed(file.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File Denah Bangunan');
        $('#modal-showFile').modal('show');
    }

    function showFile7() {
        let file = {!! json_encode($detailFile7->toArray()) !!}
        console.log(file);
        PDFObject.embed(file.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File Lokasi dan Situasi');
        $('#modal-showFile').modal('show');
    }

    function showFile8() {
        let file = {!! json_encode($detailFile8->toArray()) !!}
        console.log(file);
        PDFObject.embed(file.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File Surat Tananh');
        $('#modal-showFile').modal('show');
    }
</script>

<script>
    let detailPengajuan = {!! json_encode($detailPengajuan->toArray()) !!}
    let jumlahPendamping = detailPengajuan.jumlah_pendamping;
    let data_Pengajuan = {!! json_encode($detailPengajuan->PersetujuanPendamping->toArray()) !!}
    // console.log(jumlahPendamping);
    for (let i = 1; i <= jumlahPendamping; i++) {
        $('#filePendamping' + i).click(function () {
            let u = i - 1;
            // console.log(Pendamping.file_suratPersetujuan);
            PDFObject.embed(data_Pengajuan[u].file_suratPersetujuan, "#file");
            $('#judul').empty();
            $('#judul').append('File Persetujuan Pendamping');
            $('#modal-showFile').modal('show');
        });
    }
</script>
@endpush