@extends('layouts.dashboard.master')
@section('title') Edit Akun {{ $dataUser->user->kategori }} @endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $dataUser->nama }}</h3>
                    <p class="text-muted text-center">{{ $dataUser->user->kategori }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <a>Settings</a>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="" id="settings">
                            <form  class="form-horizontal" action="/profile/update/{{ $dataUser->user->id }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Nama" name="nama" value="{{ $dataUser->nama }}" placeholder="Nama">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Username" name="username" value="{{ $dataUser->user->username }}" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="Password" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="confirmPassword" name="ConfirmPassword" placeholder="Confirm Password">
                                        <div id="status_password"></div>
                                    </div>
                                </div>
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="/profile" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
    $('#confirmPassword').keyup(function(){
      let password = $('#Password').val();
      let konfirm_password = $('#confirmPassword').val();
      $('#status_password').empty();
      if(konfirm_password == password){
        $('#status_password').append('<a class="text-success">Password sama</a>');
      }
      if(konfirm_password != password){
        $('#status_password').append('<a class="text-danger">Password tidak sama</a>');
      }
    })
</script>
@endpush