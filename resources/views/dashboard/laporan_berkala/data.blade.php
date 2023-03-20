@extends('layouts.dashboard.master')
@section('title') Data Laporan Berkala @endsection

@push('css')
{{-- SweeAlert2 --}}
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
{{-- datatables --}}
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Laporan Berkala</h1>
                <p>Sistem Penataan Menara Telekomunikasi</p>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-lg-10 align-self-center">
                                <h3 class="card-title">List Data Laporan Berkala</h3>
                            </div>
                            @if (in_array(auth()->guard('admin')->user()->kategori, ['Tim Lapangan']))
                                <div class="">
                                    <div class="card-tools btn btn-primary btn-icon-split">
                                        <a class="btn btn-primary" type="button" href="{{ route('createLaporanBerkala') }}">
                                            <i class="fas fa-plus"></i>
                                            <span class="text">Tambah Laporan Berkala</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th width="50px">No.</th>
                                    <th width="150px">No Menara</th>
                                    <th width="150px">Kecamatan</th>
                                    <th width="150px">Tanggal Laporan</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $l)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $l->Menara->no_menara}}</td>
                                        <td class="text-center">{{ $l->Menara->Kecamatan->nama }}</td>
                                        <td class="text-center">{{ $l->tanggal_laporan }}</td>
                                        <td class="text-center">
                                            <a href="/laporanBerkala/detail/{{ $l->id }}" id="" class="btn btn-info btn-icon-split">
                                                <span class="icon">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>
                                            {{-- <a href="" id="" class="btn btn-warning btn-icon-split">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </a> --}}
                                            {{-- <button onclick="statusdelete()" id="delete_akun" class="btn btn-danger btn-icon-split">
                                                <span class="icon">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button> --}}
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
@endsection

@push('js')
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
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
                        text: '{{$message}}'
                    })
                });
        });
    </script>
@endif

@if($message = Session::get('failed'))
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
                        icon: 'error',
                        text: '{{$message}}'
                    })
                });
        });
    </script>
@endif
@endpush