@extends('layouts.dashboard.master')
@section('title') Create Pengajuan Menara @endsection

@push('css')

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
            <a href="{{ route('dataDasarHukum') }}" class="btn btn-default btn-icon-split">
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
            <form action="{{ route('insertDasarHukum') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="no_dasarHukum">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama">
                        @error('no_dasarHukum')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Nama Wajib Diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_dasarHukum">Nama</label>
                        <input type="text" class="form-control @error('nama_dasarHukum') is-invalid @enderror" name="nama_dasarHukum" id="nama_dasarHukum" placeholder="Nama Dasar Hukum">
                        @error('nama_dasarHukum')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                No Dasar Hukum Wajib Diisi
                            </div>
                        @enderror
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

@push('js')

@endpush