@extends('layouts.dashboard.master')
@section('title') Data Perusahaan @endsection

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
            <a href="{{ route('dataPerusahaan') }}" class="btn btn-default btn-icon-split">
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
                <h3 class="card-title">Detail Perusahaan</h3>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="form-group">
                        <label for="nama_dasarHukum">Nama Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $dataPerusahaan->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">Email Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $dataPerusahaan->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">No Telepon Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $dataPerusahaan->no_telp }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">Provinsi Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $dataPerusahaan->Provinsi->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">Kabupaten Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $dataPerusahaan->Kabupaten->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">Kecamatan Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $dataPerusahaan->Kecamatan->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">Desa Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $dataPerusahaan->Desa->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">Alamat Perusahaan</label>
                        <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $dataPerusahaan->alamat }}" readonly>
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
    </div>
</section>

<div class="modal fade" id="modal-showFile">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buat Akun Admin</h4>
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
        var data_perusahaan1 = {!! json_encode($detailPerusahaan1->toArray()) !!}
        // console.log(data_perusahaan1.patch);
        PDFObject.embed(data_perusahaan1.patch, "#file");
        $('#judul').append('File Akta Pendirian Perusahaan');
        $('#modal-showFile').modal('show');
    }
</script>

<script>
    function showFile2() {
        var data_perusahaan2 = {!! json_encode($detailPerusahaan2->toArray()) !!}
        // console.log(data_perusahaan2);
        PDFObject.embed(data_perusahaan2.patch, "#file");
        $('#judul').append('File Tanda Daftar Perusahaan');
        $('#modal-showFile').modal('show');
    }
</script>

@endpush