@extends('layouts.dashboard.master')
@section('title') Buat Dasar Hukum Baru @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Dasar Hukum</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Dasar Hukum</h3>
            </div>
            <form action="{{ route('insertDasarHukum') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="no_dasarHukum">No Dasar Hukum</label>
                        <input type="text" class="form-control" name="no_dasarHukum" id="no_dasarHukum" placeholder="No Dasar Hukum" value="{{ $dataDasarHukum->no_DasarHukum }}">
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">Nama</label>
                        <input type="text" class="form-control" name="nama_dasarHukum" id="nama_dasarHukum" placeholder="Nama Dasar Hukum" value="{{ $dataDasarHukum->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="InputFile">File Dasar Hukum</label><br>
                        <input type="file" name="file_dasarHukum">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection