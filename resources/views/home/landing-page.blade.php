@extends('layouts/home/index-layout')
@section('title')<title>SiPenata</title>@endsection

@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero">

        <div class="container">
          <div class="row justify-content-between">
            <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
              <div data-aos="zoom-out">
                <h1>Penataan Menara Telekomunikasi Secara Efektif</h1>
                <h2>APLIKASI INFORMASI PENDIRIAN MENARA TELEKOMUNIKASI (SIPENATA) KABUPATEN KARANGASEM</h2>
              </div>
            </div>
            <div class="row col-lg-4 order-1 order-lg-2 hero-img align-items-center" data-aos="zoom-out" data-aos-delay="300">
              <img src="{{ asset('/images/logosipenata.png') }}" class="img-fluid animated" alt="">
            </div>
          </div>
        </div>
    
        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
          <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
          </defs>
          <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
          </g>
          <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
          </g>
          <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
          </g>
        </svg>
    
    </section>
    <!-- End Hero -->

    {{-- About Start --}}
	<section class="Features section">
        <div class="row content">
            <div class="col-md-5" data-aos="fade-right">
              <img src="landing/img/details-3.png" class="img-fluid mx-auto d-block" alt="" width="200px">
            </div>
            <div class="col-md-6 pt-5 align-self-center" data-aos="fade-up">
              <h1 class="display-4"> <dt> Tentang SiPENATA </dt></h1> <br>
              <p class="h4">Si Penata merupakan media online dari Dinas Komunikasi dan Informatika Kabupaten Karangasem untuk melihat data menara yang ada, melihat Zona Lokasi atau Zona pendirian menara telekomunikasi dan pendaftaran menara telekomuniasi. </p>
            </div>
          </div>
    </section>
    {{-- About End --}}

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="fas fa-tower-cell"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $jumlahMenara }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Jumlah Menara</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class="fas fa-map"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $jumlahZonePlan }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Jumlah Zone Plan</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="fas fa-reguler fa-building"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $jumlahPerusahaan }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Jumlah Perusahaan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Counts Section -->
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#home').addClass('active');
            $('#beranda').addClass('active');
        });
    </script>
@endpush