@extends('layouts.dashboard.master')
@section('title') Dasar Hukum @endsection

@push('css')
{{-- h1 {
    margin: 50px;
} --}}
@endpush

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
<section>
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Data Bukti Umum</h3>
                <div class="card-header"> 
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                          <th width="40px">No.</th>
                          <th>Nomor BU</th>
                          <th width="200px">Tanggal Pembuatan BU</th>
                          <th>Aksi</th>
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