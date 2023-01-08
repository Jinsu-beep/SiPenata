@extends('layouts.dashboard.master')
@section('title') Validasi Perusahaan @endsection

@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<!-- BS Stepper -->
<link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<style>
    .pdfobject-container { height: 50rem;}
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-11">
                <h1>Validasi Perusahaan</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
        <div class="col-lg-1 align-self-center">
            <a href="{{ route('dataRegistrasiPerusahaan') }}" class="btn btn-default btn-icon-split">
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
        <form action="/perusahaan/validate/{{ $perusahaanPemilikMenara->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Validasi Perusahaan</h3>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#user" data-toggle="tab">User</a></li>
                                <li class="nav-item"><a class="nav-link" href="#perusahaan" data-toggle="tab">Perusahaan</a></li>
                            </ul>
                        </div>
                        <hr>
                        <div class="active tab-pane" id="user">
                            <div class="form-group">
                                <label for="no_dasarHukum">No KTP</label>
                                <input type="text" class="form-control" placeholder="No Dasar Hukum" value="{{ $userPemilikMenara->no_ktp }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">NPWP</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->NPWP }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Nama</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Kewarganegaraan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Kewarganegaraan }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Email</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">No Telepon</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->no_telp }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Provinsi</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Provinsi->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Kabupaten</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Kabupaten->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Kecamatan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Kecamatan->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Desa</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->Desa->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Alamat</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $userPemilikMenara->alamat }}" readonly>
                            </div>
                        </div>
                        <div class="tab-pane" id="perusahaan">
                            <div class="form-group">
                                <label for="nama_dasarHukum">Nama Perusahaan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Email Perusahaan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">No Telepon Perusahaan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->no_telp }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Provinsi Perusahaan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->Provinsi->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Kabupaten Perusahaan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->Kabupaten->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Kecamatan Perusahaan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->Kecamatan->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Desa Perusahaan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->Desa->nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dasarHukum">Alamat Perusahaan</label>
                                <input type="text" class="form-control" placeholder="Nama Dasar Hukum" value="{{ $perusahaanPemilikMenara->alamat }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="file_aktaPendirian">File Akta Pendirian Perusahaan</label>
                                <table id="example2" class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Akta Pendirian Perusahaan</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile1()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                @if ($detailPerusahaan1->status == 'disetujui')
                                                    <select class="form-control select2" name="status1" id="statusFile1" data-placeholder="Pilih Status" style="width: 100%;" disabled>
                                                        <option disabled>tunggu persetujuan</option>
                                                        <option value="perbaiki">perbaiki</option>
                                                        <option value="disetujui" selected>disetujui</option>
                                                    </select>
                                                @else
                                                    <select class="form-control select2" name="status1" id="statusFile1" data-placeholder="Pilih Status" style="width: 100%;">
                                                        <option selected disabled>tunggu persetujuan</option>
                                                        <option value="perbaiki">perbaiki</option>
                                                        <option value="disetujui">disetujui</option>
                                                    </select>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <label for="file_aktaPendirian">Tanda Daftar Perusahaan</label>
                                <table id="example2" class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td width='1180px'>File Tanda Daftar Perusahaan</td>
                                            <td class="text-center" width='150px'>
                                                <button type="button" onclick="showFile2()" class="btn btn-primary">
                                                    Show File
                                                </button>
                                            </td>
                                            <td width='250px'>
                                                @if ($detailPerusahaan2->status == 'disetujui')
                                                    <select class="form-control select2" name="status2" id="statusFile2" data-placeholder="Pilih Status" style="width: 100%;" disabled>
                                                        <option disabled>tunggu persetujuan</option>
                                                        <option value="perbaiki">perbaiki</option>
                                                        <option value="disetujui" selected>disetujui</option>
                                                    </select>
                                                @else
                                                    <select class="form-control select2" name="status2" id="statusFile2" data-placeholder="Pilih Status" style="width: 100%;">
                                                        <option selected disabled>tunggu persetujuan</option>
                                                        <option value="perbaiki">perbaiki</option>
                                                        <option value="disetujui">disetujui</option>
                                                    </select>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="marker">Marker</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_marker" name="file_marker">
                            <label class="custom-file-label" for="file_marker">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Disposisi">Disposisi</label>
                        <textarea name="disposisi" id="disposisi" rows="5" class="form-control" placeholder="Disposisi">{{ $perusahaanPemilikMenara->disposisi }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="action" class="btn btn-warning" value="perbaiki">Perbaiki</button>
                    <button type="submit" name="action" class="btn btn-primary" value="diterima">Diterima</button>
                </div>
            </div>
        </form>
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

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    })
</script>

<script>
    $(function () {
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
    $(function () {
        bsCustomFileInput.init();
    });
</script>

<script>
    function showFile1() {
        var data_perusahaan1 = {!! json_encode($detailPerusahaan1->toArray()) !!}
        // console.log(data_perusahaan1.patch);
        PDFObject.embed(data_perusahaan1.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File Akta Pendirian Perusahaan');
        $('#modal-showFile').modal('show');
    }
</script>

<script>
    function showFile2() {
        var data_perusahaan2 = {!! json_encode($detailPerusahaan2->toArray()) !!}
        // console.log(data_perusahaan2);
        PDFObject.embed(data_perusahaan2.patch, "#file");
        $('#judul').empty();
        $('#judul').append('File Tanda Daftar Perusahaan');
        $('#modal-showFile').modal('show');
    }
</script>

@endpush