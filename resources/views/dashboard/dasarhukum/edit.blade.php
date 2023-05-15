@extends('layouts.dashboard.master')
@section('title')
    Buat Dasar Hukum Baru
@endsection

@section('content')
    <!-- Content Header (Page header) -->
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
                    <h3 class="card-title">Edit Dasar Hukum</h3>
                </div>
                <form action="/dasarhukum/update/{{ $dataDasarHukum->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="no_dasarHukum">No Dasar Hukum</label>
                            <input type="text" class="form-control @error('no_dasarHukum') is-invalid @enderror"
                                name="no_dasarHukum" id="no_dasarHukum" placeholder="No Dasar Hukum"
                                value="{{ $dataDasarHukum->no_DasarHukum }}">
                            @error('no_dasarHukum')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @else
                                <div class="invalid-feedback">
                                    No Dasar Hukum Wajib Diisi
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_dasarHukum">Nama</label>
                            <input type="text" class="form-control @error('nama_dasarHukum') is-invalid @enderror"
                                name="nama_dasarHukum" id="nama_dasarHukum" placeholder="Nama Dasar Hukum"
                                value="{{ $dataDasarHukum->nama }}">
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
                        <div class="form-group">
                            <label for="InputFile">File Dasar Hukum</label><br>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input @error('file_dasarHukum') is-invalid @enderror"
                                        id="file_dasarHukum" name="file_dasarHukum">
                                    <label class="custom-file-label" for="file_dasarHukum">Choose file</label>
                                </div>
                            </div>
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
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
