@extends('layouts.dashboard.master')
@section('title')
    Draft Pengajuan Menara
@endsection

@push('css')
    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
    <style>
        #mymap {
            height: 590px;
        }
    </style>
    <style>
        .pdfobject-container {
            height: 50rem;
        }
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
            <div class="col-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="row justify-content-end">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-2 col-form-label">Tanggal Pengajuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tanggalPengajuan"
                                    placeholder="Tanggal Pengajuan"
                                    value="{{ $detailPengajuan->PengajuanStatusTerakhir->tanggal_status }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-2 col-form-label">Status Pengajuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tanggalPengajuan"
                                    placeholder="Status Pengajuan"
                                    value="{{ $detailPengajuan->PengajuanStatusTerakhir->Status->status }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-2 col-form-label">Disposisi</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="tanggalPengajuan" placeholder="Disposisi" disabled>{{ $detailPengajuan->PengajuanStatusTerakhir->disposisi }}</textarea>
                            </div>
                        </div>
                        @if ($detailPengajuan->PengajuanStatusTerakhir->Status->status == 'Selesai')
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-2 col-form-label">File Rekomendasi Pembuatan
                                    Menara</label>
                                <div class="col-sm-10">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <td class="text-center" width='150px'>
                                                    <button type="button" onclick="showFileRekomendasi()"
                                                        class="btn btn-primary">
                                                        Show File
                                                    </button>
                                                </td>
                                                <td class="text-center" width='150px'>
                                                    <a type="button" href="/pengajuan/download/{{ $detailPengajuan->id }}"
                                                        class="btn btn-primary">
                                                        Download
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <section class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h1>Timeline</h1>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="timeline">
                                            @foreach ($detailPengajuan->PengajuanStatus as $ps)
                                                <div>
                                                    <i class="fas fa-play bg-blue"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i
                                                                class="fas fa-clock"></i>{{ $ps->tanggal_status }}</span>
                                                        <h3 class="timeline-header"><a>{{ $ps->Status->status }}</a></h3>
                                                        <div class="timeline-body">
                                                            Berkas Pengajuan anda <a>{{ $ps->Status->status }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($detailPengajuan->PengajuanStatusTerakhir->Status->status == 'Selesai')
                                                <div>
                                                    <i class="fas fa-solid fa-check bg-green"></i>
                                                </div>
                                            @elseif ($detailPengajuan->PengajuanStatusTerakhir->Status->status == 'Ditolak')
                                                <div>
                                                    <i class="fas fa-solid fa-xmark bg-red"></i>
                                                </div>
                                            @else
                                                <div>
                                                    <i class="fas fa-clock bg-gray"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="dataPemohon-tab" data-toggle="pill" href="#dataPemohon"
                                    role="tab" aria-controls="dataPemohon" aria-selected="true">Data Pemohon</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="dataMenara-tab" data-toggle="pill" href="#dataMenara"
                                    role="tab" aria-controls="dataMenara" aria-selected="false">Data Menara</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="filePendukung-tab" data-toggle="pill" href="#filePendukung"
                                    role="tab" aria-controls="filePendukung" aria-selected="false">File Pendukung</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="dataPemohon" role="tabpanel"
                                aria-labelledby="dataPemohon-tab">
                                <div class="card-body">
                                    <label for="User" class="">Data User</label>
                                </div>
                                <div class="form-group row">
                                    <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Nama" placeholder="Name"
                                            value="{{ $dataUser->nama }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Kewarganegaraan"
                                            placeholder="Kewarganegaraan" value="{{ $dataUser->Kewarganegaraan }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="Email" placeholder="Email"
                                            value="{{ $dataUser->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Email" class="col-sm-2 col-form-label">No Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_telp" placeholder="no_telp"
                                            value="{{ $dataUser->no_telp }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="NoKTP" class="col-sm-2 col-form-label">No KTP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="NoKTP" placeholder="Name"
                                            value="{{ $dataUser->no_ktp }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="NPWP" class="col-sm-2 col-form-label">NPWP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="NPWP" placeholder="Name"
                                            value="{{ $dataUser->NPWP }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="provinsi" placeholder="Provinsi"
                                            value="{{ $dataUser->Provinsi->nama }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Kabupten" class="col-sm-2 col-form-label">Kabupten</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kabupaten"
                                            placeholder="Kabupaten" value="{{ $dataUser->Kabupaten->nama }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kecamatan"
                                            placeholder="Kecamatan" value="{{ $dataUser->Kecamatan->nama }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Desa" class="col-sm-2 col-form-label">Desa</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="desa" placeholder="Desa"
                                            value="{{ $dataUser->Desa->nama }}" disabled>
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
                                        <input type="email" class="form-control" id="nama_perusahaan"
                                            placeholder="Name" value="{{ $dataUser->perusahaan->nama }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_perusahaan" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_perusahaan"
                                            placeholder="Name" value="{{ $dataUser->perusahaan->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="noTelp_perusahaan" class="col-sm-2 col-form-label">No Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="noTelp_perusahaan"
                                            placeholder="Email" value="{{ $dataUser->perusahaan->no_telp }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="provinsi_perusahaan" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="provinsi" placeholder="Provinsi"
                                            value="{{ $dataUser->perusahaan->Provinsi->nama }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kabupatenPerusahaan" class="col-sm-2 col-form-label">Kabupten</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kabupaten"
                                            placeholder="Kabupaten" value="{{ $dataUser->perusahaan->Kabupaten->nama }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kecamatan_perusahaan" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kecamatan"
                                            placeholder="Kecamatan" value="{{ $dataUser->perusahaan->Kecamatan->nama }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="desa_perusahaan" class="col-sm-2 col-form-label">Desa</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="desa" placeholder="Desa"
                                            value="{{ $dataUser->perusahaan->Desa->nama }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat_perusahaan" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="alamat_perusahaan" placeholder="Name"disabled>{{ $dataUser->perusahaan->alamat }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="dataMenara" role="tabpanel" aria-labelledby="dataMenara-tab">
                                <div class="card ">
                                    <div id="mymap"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="Latitude">Latitude</label>
                                            <input type="text" class="form-control" placeholder="Latitude"
                                                name="lat" id="lat" value="{{ $detailPengajuan->lat }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="Longitude">Longitude</label>
                                            <input type="text" class="form-control" placeholder="Longitude"
                                                name="lng" id="lng" value="{{ $detailPengajuan->long }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Provinsi</label>
                                    <input type="text" class="form-control" placeholder="Provinsi" name="provinsi"
                                        id="provinsi" value="{{ $detailPengajuan->Provinsi->nama }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Kabupaten</label>
                                    <input type="text" class="form-control" placeholder="Kabupaten" name="kabupaten"
                                        id="kabupaten" value="{{ $detailPengajuan->Kabupaten->nama }}" readonly>
                                    {{-- <select class="form-control select2" name="kabupaten" id="edit_kabupaten" data-placeholder="Pilih OPD" style="width: 100%;">
                                    <option selected disabled>Pilih Kabupaten ...</option>
                                </select> --}}
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Kecamatan</label>
                                    <input type="text" class="form-control" placeholder="Kecamatan" name="kecamatan"
                                        id="kecamatan" value="{{ $detailPengajuan->Kecamatan->nama }}" readonly>
                                    {{-- <select class="form-control select2" name="kecamatan" id="edit_kecamatan" data-placeholder="Pilih OPD" style="width: 100%;">
                                    <option selected disabled>Pilih Kecamatan ...</option>
                                </select> --}}
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Desa</label>
                                    <input type="text" class="form-control" placeholder="Desa" name="desa"
                                        id="desa" value="{{ $detailPengajuan->Desa->nama }}" readonly>
                                    {{-- <select class="form-control select2" name="desa" id="edit_desa" data-placeholder="Pilih OPD" style="width: 100%;">
                                    <option selected disabled>Pilih Desa ...</option>
                                </select> --}}
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Jenis Menara</label>
                                    <input type="text" class="form-control" placeholder="Jenis Menara"
                                        name="jenisMenara" id="jenisMenara" value="{{ $detailPengajuan->jenis_menara }}"
                                        readonly>
                                    {{-- <select class="form-control select2" name="jenisMenara" id="jenisMenara" data-placeholder="Pilih OPD" style="width: 100%;">
                                    <option selected disabled>Pilih Jenis Menara ...</option>
                                    <option value="Tower 4 Kaki">Tower 4 Kaki</option>
                                    <option value="Tower 3 Kaki">Tower 3 Kaki</option>
                                    <option value="Tower 1 Kaki">Tower 1 Kaki</option>
                                </select> --}}
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Tinggi Menara (Meter)</label>
                                    <input type="text" class="form-control" placeholder="Tinggi Menara"
                                        name="tinggiMenara" value="{{ $detailPengajuan->tinggi_menara }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Tinggi Antena (Meter)</label>
                                    <input type="text" class="form-control" placeholder="Tinggi Antena"
                                        name="tinggiAntena" value="{{ $detailPengajuan->tinggi_antena }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Luas Area (Meter Persegi)</label>
                                    <input type="number" class="form-control" placeholder="Luas Area" name="luasArea"
                                        value="{{ $detailPengajuan->luas_area }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Akses Jalan</label>
                                    <input type="text" class="form-control" placeholder="Akses Jalan"
                                        name="aksesJalan" value="{{ $detailPengajuan->akses_jalan }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Status Lahan</label>
                                    <input type="text" class="form-control" placeholder="Status Lahan"
                                        name="statusLahan" id="statusLahan" value="{{ $detailPengajuan->status_lahan }}"
                                        readonly>
                                    {{-- <select class="form-control select2" name="statusLahan" id="statusLahan" data-placeholder="Status Lahan" style="width: 100%;">
                                    <option selected disabled>Pilih Status Lahan ...</option>
                                    <option value="sewa">Sewa</option>
                                    <option value="milik perusahaan">Milik Perusahaan</option>
                                </select> --}}
                                </div>
                                <div class="form-group mb-3">
                                    <label for="NPWP">Nama Kepemilikan Tanah</label>
                                    <input type="text" class="form-control" placeholder="Nama Kepemilikan Tanah"
                                        name="namaPemilikTanah" value="{{ $detailPengajuan->kepemilikan_tanah }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="filePendukung" role="tabpanel"
                                aria-labelledby="filePendukung-tab">
                                <div class="form-group mb-3">
                                    <label for="NPWP">File Pendukung</label>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <td width='1180px'><label for="NPWP">Gambar KTP Pemohon</label></td>
                                                <td class="text-center" width='150px'>
                                                    <button type="button" onclick="showFile1()" class="btn btn-primary">
                                                        Show File
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='1180px'><label for="NPWP">Gambar NPWP Pemohon</label></td>
                                                <td class="text-center" width='150px'>
                                                    <button type="button" onclick="showFile2()" class="btn btn-primary">
                                                        Show File
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='1180px'><label for="NPWP">Gambar Foto Pemohon</label></td>
                                                <td class="text-center" width='150px'>
                                                    <button type="button" onclick="showFile3()" class="btn btn-primary">
                                                        Show File
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='1180px'><label for="NPWP">File Surat Kuasa</label></td>
                                                <td class="text-center" width='150px'>
                                                    <button type="button" onclick="showFile4()" class="btn btn-primary">
                                                        Show File
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='1180px'><label for="NPWP">File Gambar Rancang
                                                        Bangun</label></td>
                                                <td class="text-center" width='150px'>
                                                    <button type="button" onclick="showFile5()" class="btn btn-primary">
                                                        Show File
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='1180px'><label for="NPWP">File Denah Bangunan</label></td>
                                                <td class="text-center" width='150px'>
                                                    <button type="button" onclick="showFile6()" class="btn btn-primary">
                                                        Show File
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='1180px'><label for="NPWP">File Gambar Lokasi dan
                                                        Situasi</label></td>
                                                <td class="text-center" width='150px'>
                                                    <button type="button" onclick="showFile7()" class="btn btn-primary">
                                                        Show File
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='1180px'><label for="NPWP">File Surat Tanah</label></td>
                                                <td class="text-center" width='150px'>
                                                    <button type="button" onclick="showFile8()" class="btn btn-primary">
                                                        Show File
                                                    </button>
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
                                                    <th class="text-center" width="80px">file</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabel_pendamping">
                                                @foreach ($detailPengajuan->PersetujuanPendamping as $pp)
                                                    <tr>
                                                        <td class="text-center">{{ $pp->nama }}</td>
                                                        <td class="text-center">{{ $pp->no_ktp }}</td>
                                                        <td class="text-center">{{ $pp->jarak }}</td>
                                                        <td class="text-center"><button type="button"
                                                                id="filePendamping{{ $loop->iteration }}"
                                                                class="btn btn-primary">
                                                                Show File
                                                            </button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="number" id="jumlahData" name="jumlahData" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

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
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    {{-- BsStepper --}}
    <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>

    <script src="/PDFObject/pdfobject.js"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
        })
    </script>

    <script>
        let kerusakanZona = [];
        let marker = {!! json_encode($detailPengajuan->toArray()) !!}

        //MAP INIT
        var mymap = L.map('mymap').setView([marker.lat, marker.long], 15);

        $('#dataMenara-tab').click(function() {
            setTimeout(function() {
                mymap.invalidateSize();
            }, 200);
        });


        // console.log(marker);
        L.marker([marker.lat, marker.long]).addTo(mymap);

        zonaKerusakan = L.circle([marker.lat, marker.long], {
            radius: marker.tinggi_menara,
            color: '#ff0000'
        }).addTo(mymap);
        kerusakanZona.push(zonaKerusakan);

        L.Map.include({
            getMarkerById: function(id) {
                var marker = null;
                this.eachLayer(function(layer) {
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
        function showFile1() {
            let file = {!! json_encode($detailFile1->toArray()) !!}
            // console.log(file);
            PDFObject.embed(file.patch, "#file");
            $('#judul').empty();
            $('#judul').append('File KTP Pemohon');
            $('#modal-showFile').modal('show');
        }

        function showFile2() {
            let file = {!! json_encode($detailFile2->toArray()) !!}
            // console.log(file);
            PDFObject.embed(file.patch, "#file");
            $('#judul').empty();
            $('#judul').append('File NPWP Pemohon');
            $('#modal-showFile').modal('show');
        }

        function showFile3() {
            let file = {!! json_encode($detailFile3->toArray()) !!}
            // console.log(file);
            PDFObject.embed(file.patch, "#file");
            $('#judul').empty();
            $('#judul').append('File Foto Pemohon');
            $('#modal-showFile').modal('show');
        }

        function showFile4() {
            let file = {!! json_encode($detailFile4->toArray()) !!}
            // console.log(file);
            PDFObject.embed(file.patch, "#file");
            $('#judul').empty();
            $('#judul').append('File Surat Kuasa');
            $('#modal-showFile').modal('show');
        }

        function showFile5() {
            let file = {!! json_encode($detailFile5->toArray()) !!}
            // console.log(file);
            PDFObject.embed(file.patch, "#file");
            $('#judul').empty();
            $('#judul').append('File Rancang Bangun');
            $('#modal-showFile').modal('show');
        }

        function showFile6() {
            let file = {!! json_encode($detailFile6->toArray()) !!}
            // console.log(file);
            PDFObject.embed(file.patch, "#file");
            $('#judul').empty();
            $('#judul').append('File Denah Bangunan');
            $('#modal-showFile').modal('show');
        }

        function showFile7() {
            let file = {!! json_encode($detailFile7->toArray()) !!}
            // console.log(file);
            PDFObject.embed(file.patch, "#file");
            $('#judul').empty();
            $('#judul').append('File Lokasi dan Situasi');
            $('#modal-showFile').modal('show');
        }

        function showFile8() {
            let file = {!! json_encode($detailFile8->toArray()) !!}
            // console.log(file);
            PDFObject.embed(file.patch, "#file");
            $('#judul').empty();
            $('#judul').append('File Surat Tananh');
            $('#modal-showFile').modal('show');
        }

        function showFileRekomendasi() {
            let file = {!! json_encode($detailPengajuan->toArray()) !!}
            // console.log(file);
            PDFObject.embed(file.file_rekomendasiPembangunanMenara, "#file");
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
            $('#filePendamping' + i).click(function() {
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
