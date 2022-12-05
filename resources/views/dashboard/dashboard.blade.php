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

          <div class="row">
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
            
            
            {{-- <div class="clearfix hidden-md-up"></div> --}}
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
          
          </div>
        <!-- /.row -->
        <div class="row">
          
        </div>
        <div class="row">
            
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection