@extends('layouts.dashboard.master')
@section('title') Validasi Akun Pemilik Menara @endsection

@push('css')
<style>
    .pdfobject-container { height: 50rem;}
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-11">
                <h1>Dasar Hukum</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
        <div class="col-lg-1 align-self-center">
            <a href="{{ route('dataPemilikMenara') }}" class="btn btn-default btn-icon-split">
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
                <h3 class="card-title">Create Dasar Hukum</h3>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#user" data-toggle="tab">User</a></li>
                            <li class="nav-item"><a class="nav-link" href="#perusahaan" data-toggle="tab">Perusahaan</a></li>
                        </ul>
                    </div>
                    <hr>
                    <div class="active tab-pane" id="user">
                        <div class="form-group">
                            <label for="no_dasarHukum">No KTP</label>
                            <input type="text" class="form-control" placeholder="No Dasar Hukum" value="{{ $userPemilikMenara->no_ktp }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">NPWP</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->NPWP }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Nama</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Kewarganegaraan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Kewarganegaraan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Email</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">No Telepon</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->no_telp }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Provinsi</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Provinsi->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Kabupaten</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Kabupaten->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Kecamatan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Kecamatan->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Desa</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Desa->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Alamat</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->alamat }}" readonly>
                        </div>
                    </div>
                    <div class="tab-pane" id="perusahaan">
                        <div class="form-group">
                            <label for="nama_dasarHukum">Nama Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Email Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">No Telepon Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->no_telp }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Provinsi Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->Provinsi->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Kabupaten Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->Kabupaten->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Kecamatan Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->Kecamatan->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Desa Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->Desa->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Alamat Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->alamat }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">File Akte Pendirian Perusahaan</label> <br>
                            <button onclick="showFile1()" class="btn btn-primary">
                                Show File
                            </button>
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">File Tanda Daftar Perusahaan</label> <br>
                            <button onclick="showFile2()" class="btn btn-primary">
                                Show File
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/pemilikmenara/validate/{{ $userPemilikMenara->id }}" class="btn btn-primary">Submit</a>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-showFile1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">File Akta Pendirian Perusahaan</h4>
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

<div class="modal fade" id="modal-showFile2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">File Tanda Daftar Perusahaan</h4>
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
<script src="/PDFObject/pdfobject.js"></script>

<script>
    function showFile1() {
        var data_perusahaan = {!! json_encode($perusahaanPemilikMenara->toArray()) !!}
        PDFObject.embed(data_perusahaan.file_AktaPendirianPerusahaan, "#file");
        $('#modal-showFile1').modal('show');
    }
</script>

<script>
    function showFile2() {
        var data_perusahaan = {!! json_encode($perusahaanPemilikMenara->toArray()) !!}
        PDFObject.embed(data_perusahaan.file_TandaDaftarPerusahaan, "#file");
        $('#modal-showFile2').modal('show');
    }
</script>

@endpush