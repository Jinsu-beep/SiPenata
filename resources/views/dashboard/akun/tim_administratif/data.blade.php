@extends('layouts.dashboard.master')
@section('title') Data Akun Super Admin @endsection

@push('css')
{{-- h1 {
    margin: 50px;
} --}}
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Akun Super Admin</h1>
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
                            <button class="btn btn-primary" type="button" onclick="createsuperadmin()">
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
                                    <th width="150px">status</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($dataSuperAdmin as $dsa)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $dsa->nama}}</td>
                                    <td></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-warning btn-icon-split">
                                          <span class="icon">
                                              <i class="fas fa-edit"></i>
                                          </span>
                                          <span class="text">Edit</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>                
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-createsa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="create_form" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Buat Akun Super Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="username" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" value="">
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

<div class="modal fade" id="modal-editsa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="edit_form" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Akun Super Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="username" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" value="">
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
    function createsuperadmin() {
        $("#create_form").attr("action", "/superadmin/insert");
        $('#modal-createsa').modal('show');
    }
</script>

{{-- <script>
    function editsuperadmin() {
        $("#edit_form").attr("action", "/superadmin/edit");
        $('#modal-editsa').modal('show');
    }
</script> --}}
@endpush