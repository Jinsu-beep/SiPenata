@extends('layouts.dashboard.master')
@section('title') Dashboard @endsection
    
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- solid sales graph -->
        <div class="card bg-gradient-default">
          <div class="card-body" style="background-color:rgb(231, 231, 234, 1);">
            <center>
              <img src="/../../images/logosipenata.png" alt="Logo Pemkab Karangasem" >
            </center>
          </div>
        </div>
          <!-- /.card -->
        <!-- Small boxes (Stat box) -->

        <div class="row justify-content-center">
          <div class="col-lg-4 col-6">
          
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $menara->count('id') }}</h3>
                <p>Jumlah Menara</p>
              </div>
              <div class="icon">
                <i class="nav-icon far fa-solid fa-tower-cell"></i>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-6">
          
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $zoneplan->count('id') }}</h3>
                <p>Jumlah Zone Plan</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-map-location-dot"></i>
              </div>
            </div>
          </div>

          @if (in_array(auth()->guard('admin')->user()->kategori, ['Super Admin', 'Admin', 'Tim Administratif', 'Tim Lapangan']))
            <div class="col-lg-4 col-6">
            
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $perusahaan->count('id') }}</h3>
                  <p>Jumlah Perusahaan</p>
                </div>
                <div class="icon">
                  <i class="nav-icon far fa-solid fa-building"></i>
                </div>
              </div>
            </div>
          @endif
          
          
        </div>  

        <!-- /.row -->
        @if (in_array(auth()->guard('admin')->user()->kategori, ['Pemilik Menara']))
            @if ($dataUser->id_perusahaan == NULL)
              <div class="callout callout-danger">
                <h5>Perusahaan Belum Didaftarkan</h5>
                <p><a href="{{ route('createPerusahaan') }}">Daftar Perusahaan</a></p>
              </div>
            @elseif ($perusahaan->status == 'tunggu persetujuan')
              <div class="callout callout-info">
                <h5>Pendaftaran Perusahaan Berhasil</h5>
                <p>Menunggu validasi dari Admin. Untuk Melihat detail klik <a href="/perusahaan/detailRegistrasi/{{ $dataUser->id_perusahaan }}">di sini</a>.</p>
              </div>
            @elseif ($perusahaan->status == 'perbaiki')
              <div class="callout callout-warning">
                <h5>Status Pendaftaran Perusahaan : Diperbaiki</h5>
                <p>Terdapat data yang harus diperbaiki. Untuk memperbaiki data klik <a href="/perusahaan/edit/{{ $dataUser->id_perusahaan }}">di sini</a>.</p>
              </div>
            @elseif ($perusahaan->status == 'diterima')
              <div class="callout callout-success">
                <h5>Status Pendaftaran Perusahaan : Diterima</h5>
                <p>Pendaftaran perusahaan diterima. Anda dapat melanjutkan proses selanjutnya.</p>
              </div>
            @endif
        @endif
        
        <div class="row">
            
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('js')
  <script>
    console.log()
  </script>
@endpush