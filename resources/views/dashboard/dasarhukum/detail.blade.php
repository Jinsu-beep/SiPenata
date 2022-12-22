@extends('layouts.dashboard.master')
@section('title') Detail Dasar Hukum Baru @endsection

@push('css')
<style>
    .pdfobject-container { height: 50rem;}
</style>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-11">
                <h1>Dasar Hukum</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
            <div class="col-lg-1 align-self-center">
                <a href="{{ route('dataDasarHukum') }}" class="btn btn-default btn-icon-split">
                    <span class="icon">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Detail Dasar Hukum</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="no_dasarHukum">No Dasar Hukum</label>
                    <input type="text" class="form-control" name="no_dasarHukum" id="no_dasarHukum" placeholder="No Dasar Hukum" value="{{ $dataDasarHukum->no_DasarHukum }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_dasarHukum">Nama</label>
                    <input type="text" class="form-control" name="nama_dasarHukum" id="nama_dasarHukum" placeholder="Nama Dasar Hukum" value="{{ $dataDasarHukum->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_dasarHukum">File Dasar Hukum</label><br>
                    <button onclick="showFile()" class="btn btn-primary">
                        Show File
                    </button>
                    <a href="/dasarhukum/download/{{ $dataDasarHukum->id }}" class="btn btn-warning">
                        Download File
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-showFile">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buat Akun Admin</h4>
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
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- SweeAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
{{-- PDFObject --}}
<script src="/PDFObject/pdfobject.js"></script>

<!-- Page specific script -->
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
    function showFile() {
        var data_DasarHukum = {!! json_encode($dataDasarHukum->toArray()) !!}
        PDFObject.embed(data_DasarHukum.file_DasarHukum, "#file");
        $('#modal-showFile').modal('show');
    }
</script>
@endpush