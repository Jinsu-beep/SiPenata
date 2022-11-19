@extends('layouts.dashboard.master')
@section('title') Dasar Hukum @endsection

@push('css')
{{-- SweeAlert2 --}}
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
{{-- datatables --}}
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
{{-- @if (session()->has('statusInput'))
    <div class="row">
        <div class="col-sm-12 alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('statusInput')}}
            <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif --}}
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
                        <div class="row">
                            <div class="col-lg-10 align-self-center">
                                <h3 class="card-title ">List Data Dasar Hukum</h3>
                            </div>
                            <div class="col-lg-2">
                                <div class="card-tools btn btn-primary btn-icon-split">
                                    <a class="btn btn-primary" href="{{ route('createDasarHukum') }}">
                                        <i class="fas fa-plus"></i>
                                        <span class="text">Tambah Dasar Hukum Baru</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                <th width="40px">No.</th>
                                <th>Nama Dasar Hukum</th>
                                <th width="200px">Tanggal Penambahan</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataDasarHukum as $ddh)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $ddh->nama }}</td>
                                    <td>{{ $ddh->tanggal }}</td>
                                    <td class="text-center">
                                        <a href="/dasarhukum/detail/{{ $ddh->id }}" id="" class="btn btn-info btn-icon-split">
                                            <span class="icon">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </a>
                                        <a href="/dasarhukum/edit/{{ $ddh->id }}" id="" class="btn btn-warning btn-icon-split">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                        </a>
                                        <button onclick="statusdelete({{ $ddh->id }})" id="delete_akun" class="btn btn-danger btn-icon-split">
                                            <span class="icon">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-sdelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="sdelete" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Delete Dasar Hukum</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin akan menghapus data?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="delete" type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
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
    function statusdelete(id) {
    $("#sdelete").attr("action", "/dasarhukum/delete/"+id);
    $('#modal-sdelete').modal('show');
    }
</script>

@if($message = Session::get('success'))
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
                $(document).ready(function() {
                    Toast.fire({
                        icon: 'success',
                        title: '{{$message}}'
                    })
                });
        });
    </script>
@endif
@endpush