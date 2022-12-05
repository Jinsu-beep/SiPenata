@extends('layouts.dashboard.master')
@section('title') Data Menara @endsection

@push('css')

@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Akun Super Admin</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Data Pengajuan Menara</h3>
                        <div class="card-tools btn btn-primary btn-icon-split">
                            <a class="btn btn-primary" type="button" href="{{ route('createPengajuan') }}">
                                <i class="fas fa-plus"></i>
                                <span class="text">Tambah Provider Baru</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th width="50px">No.</th>
                                    <th width="350px">Tanggal Pengajuan</th>
                                    <th width="350px">Nama</th>
                                    <th width="350px">Status</th>
                                    <th width="200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')

@endpush