@extends('layouts.dashboard.master')
@section('title') Data Akun Admin @endsection

@push('css')
<!-- SweeAlert2 -->
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
{{-- datatables --}}
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Akun Admin</h1>
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
                        <h3 class="card-title">List Data User</h3>
                        <div class="card-tools btn btn-primary btn-icon-split">
                            <button class="btn btn-primary" type="button" onclick="createadmin()">
                                <i class="fas fa-plus"></i>
                                <span class="text">Tambah User Baru</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th width="50px">No.</th>
                                    <th>Nama</th>
                                    {{-- <th width="150px">status</th> --}}
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>                
                                @foreach ($dataAdmin as $da)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $da->nama}}</td>
                                        {{-- <td></td> --}}
                                        <td class="text-center">
                                            <button value="{{ $da->id }}" id="edit_Admin{{ $da->id }}" class="btn btn-warning btn-icon-split">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </button>
                                            <button onclick="statusdelete({{ $da->id }})" id="delete_akun" class="btn btn-danger btn-icon-split">
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

<div class="modal fade" id="modal-createa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="create_form" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Buat Akun Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telepon" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edita">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="edit_form" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Akun Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="edit_nama" placeholder="Nama" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input type="text" class="form-control" name="no_telp" id="edit_no_telp" placeholder="No Telepon" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="edit_username" placeholder="Username" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="edit_password" placeholder="Password" value="">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-sdelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="sdelete" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Delete Akun Admin</h4>
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
    function createadmin() {
        $("#create_form").attr("action", "/admin/insert");
        $('#modal-createa').modal('show');
    }
</script>

<script>
    var data_Admin = {!! json_encode($dataAdmin->toArray()) !!}
    data_Admin.forEach(element => {
        $('#edit_Admin'+element.id).click(function () {
            if ($('edit_Admin').val() != ""){
                let id = $(this).val();
                // console.log(id);
                $.ajax({
                    type: 'GET',
                    url: '/admin/get/'+id,
                    success:function(response){
                        // console.log(response.id);
                        $("#edit_form").attr("action", "/admin/update/"+response.id);
                        $('#edit_nama').val(response.nama);
                        $('#edit_no_telp').val(response.no_telp);
                        $('#edit_username').val(response.user.username);
                        $('#modal-edita').modal('show');
                    }
                });
            }
        });
    });
</script>

<script>
    function statusdelete(id) {
    $("#sdelete").attr("action", "/admin/delete/"+id);
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