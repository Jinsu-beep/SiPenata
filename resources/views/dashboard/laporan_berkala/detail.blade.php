@extends('layouts.dashboard.master')
@section('title')
    Buat Zone Plan Baru
@endsection

@push('css')
    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 DuaNllistbox -->
    <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- SweeAlert2 -->
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    {{-- datatables --}}
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        #mapid {
            height: 590px;
        }
    </style>
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1>Laporan Berkala</h1>
                    <p>Sistem Penataan Menara Telekomunikasi</p>
                </div>
            </div>
            <div class="col-lg-1 align-self-center">
                <a href="{{ route('dataLaporanBerkala') }}" class="btn btn-default btn-icon-split">
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
                    <h3 class="card-title">Detail Laporan Berkala</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 align-self-center text-center">
                            <img src="{{ $laporan->foto }}" width="600">
                        </div>
                        <div class="col-sm-7">
                            <div class="row mb-2">
                                <label for="noMenara" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan"
                                        value="{{ $laporan->tanggal_laporan }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="provinsi" class="col-sm-2 col-form-label">Perusahaan</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan"
                                        value="{{ $laporan->Perusahaan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="kabupaten" class="col-sm-2 col-form-label">Menara</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan"
                                        value="{{ $laporan->Menara->no_menara }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="kecamatan" class="col-sm-2 col-form-label">Laporan</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" rows="5" disabled>{{ $laporan->laporan }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- SweeAlert2 -->
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    {{-- Select2 --}}
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    {{-- DataTables --}}
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    {{-- Leaflet --}}
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
        })
    </script>
@endpush
