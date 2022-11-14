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
                        <h3 class="card-title">List Data Menara</h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th width="50px">No.</th>
                                    <th width="100px">ID Menara</th>
                                    <th width="350px">Nama</th>
                                    <th width="350px">Alamat</th>
                                    <th width="200px">Kecamatan</th>
                                    <th width="150px">Lat</th>
                                    <th width="150px">Lang</th>
                                    <th width="200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataMenara as $dm)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $dm->id }}</td>
                                        <td>{{ $dm->nama }}</td>
                                        <td>{{ $dm->alamat }}</td>
                                        <td>{{ $dm->Kecamatan->nama }}</td>
                                        <td>{{ $dm->lat }}</td>
                                        <td>{{ $dm->long }}</td>
                                        <td class="text-center">
                                            <button onclick="" id="delete_akun" class="btn btn-primary btn-icon-split">
                                                <span class="icon">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </button>
                                            <button onclick="" id="delete_akun" class="btn btn-danger btn-icon-split">
                                                <span class="icon">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
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