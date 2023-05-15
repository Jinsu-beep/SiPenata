@extends('layouts.dashboard.master')
@section('title')
    Data Akun Admin
@endsection

@push('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <style>
        .pdfobject-container {
            height: 50rem;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1>Perusahaan</h1>
                    <p>Sistem Penataan Menara Telekomunikasi</p>
                </div>
            </div>
            <div class="col-lg-1 align-self-center">
                <a href="{{ route('dashboard') }}" class="btn btn-default btn-icon-split">
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
            <div class="card card-primary mt-2">
                <div class="card-header">
                    <h3 class="card-title">Perbaiki Data Perusahaan</h3>
                </div>
                <form action="/perusahaan/update/{{ $dataUser->Perusahaan->id }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Nama Perusahaan" name="nama"
                                value="{{ $dataRegistrasi->nama }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email_perusahaan">Email Perusahaan</label>
                            <input type="text" class="form-control" placeholder="Email Perusahaan" name="email"
                                value="{{ $dataRegistrasi->email }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="no_telp_perusahaan">No Telepon Perusahaan</label>
                            <input type="text" class="form-control" placeholder="No Telepon Perusahaan" name="no_telp"
                                value="{{ $dataRegistrasi->no_telp }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="Provinsi">Provinsi</label>
                            <select class="form-control select2" id="provinsi" name="provinsi" data-placeholder="Provinsi"
                                style="width: 100%;">
                                <option value="{{ $dataRegistrasi->id_provinsi }}">{{ $dataRegistrasi->Provinsi->nama }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Kabupaten">Kabupaten</label>
                            <select class="form-control select2" id="kabupaten" name="kabupaten"
                                data-placeholder="Kabupaten" style="width: 100%;">
                                <option value="{{ $dataRegistrasi->id_kabupaten }}">{{ $dataRegistrasi->Kabupaten->nama }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Kecamatan">Kecamatan</label>
                            <select class="form-control select2" id="kecamatan" name="kecamatan"
                                data-placeholder="Kecamatan" style="width: 100%;">
                                <option value="{{ $dataRegistrasi->id_kecamatan }}">{{ $dataRegistrasi->Kecamatan->nama }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Desa">Desa</label>
                            <select class="form-control select2" id="desa" name="desa" data-placeholder="Desa"
                                style="width: 100%;">
                                <option value="{{ $dataRegistrasi->id_desa }}">{{ $dataRegistrasi->Desa->nama }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" class="form-control" placeholder="Alamat Lengkap" name="alamat">{{ $dataRegistrasi->alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="file_aktaPendirian">File Akta Pendiriian Perusahaan</label>
                            <table id="example2" class="table table-bordered table-hover">
                                <tbody>
                                    @if ($detailPerusahaan1->status == 'perbaiki')
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file_aktaPendirian"
                                                    name="file_aktaPendirian">
                                                <label class="custom-file-label" for="file_aktaPendirian">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                    @elseif ($detailPerusahaan1->status == 'disetujui')
                                        <tr>
                                            <td width='1200px'>File Akta Pendirian Perusahaan</td>
                                            <td class="text-center">
                                                <button type="button" onclick="showFile1()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td>
                                                <select class="form-control select2" name="status" id="status_1"
                                                    data-placeholder="Pilih Status" style="width: 100%;" disabled>
                                                    @if ($detailPerusahaan1->status == 'tunggu persetujuan')
                                                        <option value="tunggu persetujuan" selected>tunggu persetujuan
                                                        </option>
                                                        <option value="perbaiki">perbaiki</option>
                                                        <option value="diterima">diterima</option>
                                                    @elseif ($detailPerusahaan1->status == 'perbaiki')
                                                        <option value="tunggu persetujuan">tunggu persetujuan</option>
                                                        <option value="perbaiki" selected>perbaiki</option>
                                                        <option value="disetujui">disetujui</option>
                                                    @elseif ($detailPerusahaan1->status == 'disetujui')
                                                        <option value="tunggu persetujuan">tunggu persetujuan</option>
                                                        <option value="perbaiki">perbaiki</option>
                                                        <option value="disetujui" selected>disetujui</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                    {{-- <tr>
                                    <td width='1200px'>File Akta Pendiriian Perusahaan</td>
                                    <td class="text-center">
                                        <button type="button" onclick="showFile1()" class="btn btn-primary">
                                            Show File
                                        </button>
                                    </td>
                                    <td>
                                        <select class="form-control select2" name="status" id="status_1" data-placeholder="Pilih Status" style="width: 100%;" disabled>
                                            @if ($detailPerusahaan1->status == 'tunggu persetujuan')
                                                <option value="tunggu persetujuan" selected>tunggu persetujuan</option>
                                                <option value="perbaiki">perbaiki</option>
                                                <option value="diterima">diterima</option>
                                            @elseif ($detailPerusahaan1->status == 'perbaiki')
                                                <option value="tunggu persetujuan">tunggu persetujuan</option>
                                                <option value="perbaiki" selected>perbaiki</option>
                                                <option value="disetujui">disetujui</option>
                                            @elseif ($detailPerusahaan1->status == 'disetujui')
                                                <option value="tunggu persetujuan">tunggu persetujuan</option>
                                                <option value="perbaiki">perbaiki</option>
                                                <option value="disetujui" selected>disetujui</option>
                                            @endif
                                        </select>
                                    </td>
                                </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="file_aktaPendirian">Tanda Daftar Perusahaan</label>
                            <table id="example2" class="table table-bordered table-hover">
                                <tbody>
                                    @if ($detailPerusahaan2->status == 'perbaiki')
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file_tandaDaftar"
                                                    name="file_tandaDaftar">
                                                <label class="custom-file-label" for="file_tandaDaftar">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                    @elseif ($detailPerusahaan2->status == 'disetujui')
                                        <tr>
                                            <td width='1200px'>File Tanda Daftar Perusahaan</td>
                                            <td class="text-center">
                                                <button type="button" onclick="showFile2()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td>
                                                <select class="form-control select2" name="status" id="status_2"
                                                    data-placeholder="Pilih Status" style="width: 100%;" disabled>
                                                    @if ($detailPerusahaan2->status == 'tunggu persetujuan')
                                                        <option value="tunggu persetujuan" selected>tunggu persetujuan
                                                        </option>
                                                        <option value="perbaiki">perbaiki</option>
                                                        <option value="diterima">diterima</option>
                                                    @elseif ($detailPerusahaan2->status == 'perbaiki')
                                                        <option value="tunggu persetujuan">tunggu persetujuan</option>
                                                        <option value="perbaiki" selected>perbaiki</option>
                                                        <option value="disetujui">disetujui</option>
                                                    @elseif ($detailPerusahaan2->status == 'disetujui')
                                                        <option value="tunggu persetujuan">tunggu persetujuan</option>
                                                        <option value="perbaiki">perbaiki</option>
                                                        <option value="disetujui" selected>disetujui</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                    {{-- <tr>
                                    <td width='1200px'>File Tanda Daftar Perusahaan</td>
                                    <td class="text-center">
                                        <button type="button" onclick="showFile2()" class="btn btn-primary">
                                            Show File
                                        </button>
                                    </td>
                                    <td>
                                        <select class="form-control select2" name="status" id="status_2" data-placeholder="Pilih Status" style="width: 100%;" disabled>
                                            @if ($detailPerusahaan1->status == 'tunggu persetujuan')
                                                <option value="tunggu persetujuan" selected>tunggu persetujuan</option>
                                                <option value="perbaiki">perbaiki</option>
                                                <option value="diterima">diterima</option>
                                            @elseif ($detailPerusahaan1->status == 'perbaiki')
                                                <option value="tunggu persetujuan">tunggu persetujuan</option>
                                                <option value="perbaiki" selected>perbaiki</option>
                                                <option value="disetujui">disetujui</option>
                                            @elseif ($detailPerusahaan1->status == 'disetujui')
                                                <option value="tunggu persetujuan">tunggu persetujuan</option>
                                                <option value="perbaiki">perbaiki</option>
                                                <option value="disetujui" selected>disetujui</option>
                                            @endif
                                        </select>
                                    </td>
                                </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="Status">Status</label>
                            <select class="form-control select2" name="status" id="status"
                                data-placeholder="Pilih Status" style="width: 100%;" disabled>
                                @if ($dataRegistrasi->status == 'tunggu persetujuan')
                                    <option value="tunggu persetujuan" selected>tunggu persetujuan</option>
                                    <option value="perbaiki">perbaiki</option>
                                    <option value="diterima">diterima</option>
                                @elseif ($dataRegistrasi->status == 'perbaiki')
                                    <option value="tunggu persetujuan">tunggu persetujuan</option>
                                    <option value="perbaiki" selected>perbaiki</option>
                                    <option value="diterima">diterima</option>
                                @elseif ($dataRegistrasi->status == 'diterima')
                                    <option value="tunggu persetujuan">tunggu persetujuan</option>
                                    <option value="perbaiki">perbaiki</option>
                                    <option value="diterima" selected>diterima</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Disposisi">Disposisi</label>
                            <textarea name="disposisi" id="disposisi" rows="5" class="form-control" placeholder="Disposisi" disabled>{{ $dataRegistrasi->disposisi }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-showFile">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="judul" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="file"></div>
                </div>
            </div>
        </div>
    </div>
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

    <script src="/PDFObject/pdfobject.js"></script>

    <!-- Page specific script -->
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

    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>


    <script>
        function showFile1() {
            var data_perusahaan1 = {!! json_encode($detailPerusahaan1->toArray()) !!}
            // console.log(data_perusahaan1.patch);
            PDFObject.embed(data_perusahaan1.patch, "#file");
            $('#judul').append('File Akta Pendirian Perusahaan');
            $('#modal-showFile').modal('show');
        }
    </script>

    <script>
        function showFile2() {
            var data_perusahaan2 = {!! json_encode($detailPerusahaan2->toArray()) !!}
            // console.log(data_perusahaan2);
            PDFObject.embed(data_perusahaan2.patch, "#file");
            $('#judul').append('File Tanda Daftar Perusahaan');
            $('#modal-showFile').modal('show');
        }
    </script>
@endpush
