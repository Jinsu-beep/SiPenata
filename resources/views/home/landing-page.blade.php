@extends('layouts/home2/index')
@section('title')
    <title>SiPenata</title>
@endsection

@section('content')
    <section class="home" id="home">
        <div class="home-text">
            <h1>Penataan Menara Telekomunikasi Secara Efektif</h1>
            <h2>APLIKASI INFORMASI PENDIRIAN MENARA TELEKOMUNIKASI (SIPENATA) KABUPATEN KARANGASEM</h2>
        </div>
        <div class="home-img">
            <img src="{{ asset('/images/logosipenata.png') }}" class="img-fluid animated" alt="">
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-img">
            <img src="landing2/img/details.png" class="img-fluid mx-auto d-block" alt="">
        </div>
        <div class="about-text">
            <h1>
                <dt> Tentang SiPENATA </dt>
            </h1> <br>
            <p class="h4">Si Penata merupakan media online dari Dinas Komunikasi dan Informatika Kabupaten
                Karangasem
                untuk melihat data menara yang ada, melihat zona lokasi atau zona pendirian menara telekomunikasi dan
                pendaftaran menara telekomuniasi. </p>
        </div>
    </section>

    <section class="count" id="count">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <i class="fas fa-tower-cell"></i>
                        <span>{{ $jumlahMenara }}</span>
                        <p>Jumlah Menara</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <i class="fas fa-map"></i>
                        <span>{{ $jumlahZonePlan }}</span>
                        <p>Jumlah Zone Plan</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <i class="fas fa-reguler fa-building"></i>
                        <span>{{ $jumlahPerusahaan }}</span>
                        <p>Jumlah Perusahaan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
