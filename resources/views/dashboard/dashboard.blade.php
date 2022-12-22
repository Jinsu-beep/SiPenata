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

          {{-- <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">CPU Traffic</span>
                  <span class="info-box-number">
                  10
                  <small>%</small>
                  </span>
                </div>
              
              </div>
            
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">41,410</span>
                </div>
              
              </div>
            
            </div>
            
            
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Sales</span>
                  <span class="info-box-number">760</span>
                </div>
              
              </div>
            
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number">2,000</span>
                </div>
              
              </div>
              
            </div>
          
          </div> --}}
        <!-- /.row -->
        @if (in_array(auth()->guard('admin')->user()->kategori, ['Pemilik Menara']))
            @if ($dataUser->id_perusahaan == NULL)
              <div class="callout callout-danger">
                <h5>Perusahaan Belum Didaftarkan</h5>
                <p><a href="{{ route('createPerusahaan') }}">Daftar Perusahaab</a></p>
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