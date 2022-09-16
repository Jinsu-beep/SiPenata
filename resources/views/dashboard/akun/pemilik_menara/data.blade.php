@extends('layouts.dashboard.master')
@section('title') Data Akun Super Admin @endsection

@push('css')
{{-- h1 {
    margin: 50px;
} --}}
@endpush

@section('content')
@if (session()->has('statusInput'))
    <div class="row">
    <div class="col-sm-12 alert alert-success alert-dismissible fade show" role="alert">
        {{session()->get('statusInput')}}
        <button type="button" class="close" data-dismiss="alert"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    </div>
@endif
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Akun Pemilik Menara</h1>
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
                            <button class="btn btn-primary" type="button" onclick="createpemilikmenara()">
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
                            <tbody>                
                                @foreach ($dataPemilikMenara as $dpm)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $dpm->nama}}</td>
                                        <td></td>
                                        <td class="text-center">
                                            {{-- <button value="{{ $dpm->id }}" id="edit_PemilikMenara{{ $dpm->id }}" class="btn btn-warning btn-icon-split">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </button> --}}
                                            {{-- <button onclick="statusdelete({{ $dpm->id }})" id="delete_akun" class="btn btn-danger btn-icon-split">
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

<div class="modal fade" id="modal-createpm">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="create_form" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Buat Akun Pemilik Menara</h4>
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

{{-- <div class="modal fade" id="modal-editpm">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="edit_form" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Akun Pemilik Menara</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" id="edit_nama" placeholder="nama" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="edit_username" placeholder="username" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="edit_password" placeholder="password" value="">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- <div class="modal fade" id="modal-sdelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="sdelete" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Delete Akun Pemilik Menara</h4>
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
</div> --}}
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
    function createpemilikmenara() {
        $("#create_form").attr("action", "/pemilikmenara/insert");
        $('#modal-createpm').modal('show');
    }
</script>

{{-- <script>
    var data_PemilikMenara = {!! json_encode($dataPemilikMenara->toArray()) !!}
    data_PemilikMenara.forEach(element => {
        $('#edit_PemilikMenara'+element.id).click(function () {
            if ($('edit_PemilikMenara').val() != ""){
                let id = $(this).val();
                // console.log(id);
                $.ajax({
                    type: 'GET',
                    url: '/pemilikmenara/get/'+id,
                    success:function(response){
                        // console.log(response.id);
                        $("#edit_form").attr("action", "/pemilikmenara/update/"+response.id);
                        $('#edit_nama').val(response.nama);
                        $('#edit_username').val(response.user.username);
                        $('#modal-editpm').modal('show');
                    }
                });
            }
        });
    });
</script> --}}

{{-- <script>
    function statusdelete(id) {
    $("#sdelete").attr("action", "/pemilikmenara/delete/"+id);
    $('#modal-sdelete').modal('show');
    }
  </script> --}}
@endpush