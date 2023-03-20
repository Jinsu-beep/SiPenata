@extends('layouts.dashboard.master')
@section('title') Data Akun {{ $dataUser->user->kategori }} @endsection

@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- SweeAlert2 -->
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    {{-- datatables --}}
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/AdminLTELogo.png" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $dataUser->nama }}</h3>
                    <p class="text-muted text-center">{{ $dataUser->user->kategori }}</p>
                    <button onclick="edit_user()" class="btn btn-primary btn-block">Edit Profil</button>
                    <button onclick="edit_password()" class="btn btn-primary btn-block">Edit Password</button>  
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#user" data-toggle="tab">User</a></li>
                        <li class="nav-item"><a class="nav-link" href="#perusahaan" data-toggle="tab">Perusahaan</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="user">
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="Nama" placeholder="Name" value="{{ $dataUser->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="Kewarganegaraan" placeholder="Kewarganegaraan" value="{{ $dataUser->Kewarganegaraan }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="Email" placeholder="Email" value="{{ $dataUser->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="no_telp" placeholder="no_telp" value="{{ $dataUser->no_telp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="NoKTP" class="col-sm-2 col-form-label">No KTP</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="NoKTP" placeholder="Name" value="{{ $dataUser->no_ktp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="NPWP" class="col-sm-2 col-form-label">NPWP</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="NPWP" placeholder="Name" value="{{ $dataUser->NPWP }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="provinsi" id="provinsi" data-placeholder="Pilih OPD" style="width: 100%;" disabled>
                                        @foreach($provinsi as $p)  
                                            <option value="{{ $p->id }}" @if($dataUser->id_provinsi == $p->id) selected @endif>{{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kabupten" class="col-sm-2 col-form-label">Kabupten</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="kabupaten" id="kabupaten" data-placeholder="Pilih OPD" style="width: 100%;" disabled>
                                        @foreach($kabupaten as $kb)  
                                            <option value="{{ $kb->id }}" @if($dataUser->id_kabupaten == $kb->id) selected @endif>{{ $kb->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="kecamatan" id="kecamatan" data-placeholder="Pilih OPD" style="width: 100%;" disabled>
                                        @foreach($kecamatan as $kc)  
                                            <option value="{{ $kc->id }}" @if($dataUser->id_kecamatan == $kc->id) selected @endif>{{ $kc->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Desa" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="desa" id="desa" data-placeholder="Pilih OPD" style="width: 100%;" disabled>
                                        @foreach($desa as $d)  
                                            <option value="{{ $d->id }}" @if($dataUser->id_desa == $d->id) selected @endif>{{ $d->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="Alamat" placeholder="Name" value="{{ $dataUser->alamat }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Username" placeholder="Skills" value="{{ $dataUser->user->username }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="perusahaan">
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="nama_perusahaan" placeholder="Name" value="{{ $dataUser->perusahaan->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email_perusahaan" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email_perusahaan" placeholder="Name" value="{{ $dataUser->perusahaan->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="noTelp_perusahaan" class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="noTelp_perusahaan" placeholder="Email" value="{{ $dataUser->perusahaan->no_telp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="provinsi_perusahaan" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="id_opd" id="id_opd" data-placeholder="Pilih OPD" style="width: 100%;" disabled>
                                        @foreach($provinsi as $p)  
                                            <option value="{{ $p->id }}" @if($dataUser->perusahaan->id_provinsi == $p->id) selected @endif>{{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kabupatenPerusahaan" class="col-sm-2 col-form-label">Kabupten</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="id_opd" id="id_opd" data-placeholder="Pilih OPD" style="width: 100%;" disabled>
                                        @foreach($kabupaten as $kb)  
                                            <option value="{{ $kb->id }}" @if($dataUser->perusahaan->id_kabupaten == $kb->id) selected @endif>{{ $kb->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kecamatan_perusahaan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="id_opd" id="id_opd" data-placeholder="Pilih OPD" style="width: 100%;" disabled>
                                        @foreach($kecamatan as $kc)  
                                            <option value="{{ $kc->id }}" @if($dataUser->perusahaan->id_kecamatan == $kc->id) selected @endif>{{ $kc->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desa_perusahaan" class="col-sm-2 col-form-label">Desa</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="id_opd" id="id_opd" data-placeholder="Pilih OPD" style="width: 100%;" disabled>
                                        @foreach($desa as $d)  
                                            <option value="{{ $d->id }}" @if($dataUser->perusahaan->id_desa == $d->id) selected @endif>{{ $d->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat_perusahaan" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="alamat_perusahaan" placeholder="Name" value="{{ $dataUser->perusahaan->alamat }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-editUser">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="edit_formUser" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="edit_nama" placeholder="Nama" value="">
                    </div>
                    <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan</label>
                        <select class="form-control select2" name="kewarganegaraan" data-placeholder="Kewarganegaraan" style="width: 100%;">
                            @if ($dataUser->Kewarganegaraan == 'WNI')
                                <option value="WNI" selected>WNI</option>
                                <option value="WNA">WNA</option>
                            @elseif ($dataUser->Kewarganegaraan == 'WNA')
                                <option value="WNI">WNI</option>
                                <option value="WNA" selected>WNA</option>
                            @else
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="edit_email" placeholder="Nama" value="">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input type="text" class="form-control" name="no_telp" id="edit_no_telp" placeholder="Nama" value="">
                    </div>
                    <div class="form-group">
                        <label for="noKTP">No KTP</label>
                        <input type="text" class="form-control" name="noKTP" id="edit_noKTP" placeholder="No Telepon" value="">
                    </div>
                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        <input type="text" class="form-control" name="NPWP" id="edit_NPWP" placeholder="No Telepon" value="">
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-control select2" name="provinsi" id="edit_provinsi" data-placeholder="Pilih OPD" style="width: 100%;">
                            <option selected disabled>Pilih Provinsi ...</option>
                            @foreach($provinsi as $p)  
                                <option value="{{ $p->id }}" @if($dataUser->id_provinsi == $p->id) selected @endif>{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kabupaten">Kabupaten</label>
                        <select class="form-control select2" name="kabupaten" id="edit_kabupaten" data-placeholder="Pilih OPD" style="width: 100%;">
                            <option selected disabled>Pilih Kabupaten ...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select class="form-control select2" name="kecamatan" id="edit_kecamatan" data-placeholder="Pilih OPD" style="width: 100%;">
                            <option selected disabled>Pilih Kecamatan ...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desa">Desa</label>
                        <select class="form-control select2" name="desa" id="edit_desa" data-placeholder="Pilih OPD" style="width: 100%;">
                            <option selected disabled>Pilih Desa ...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="edit_alamat" placeholder="No Telepon"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="usernmae">Username</label>
                        <input type="text" class="form-control" name="username" id="edit_username" placeholder="No Telepon" value="">
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

<div class="modal fade" id="modal-editPassword">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="edit_formPassword" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="passwordLama">Password Lama</label>
                        <input type="password" class="form-control" name="passwordLama" id="edit_passworrdLama" placeholder="Password Lama" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="passwordBaru">Password Baru</label>
                        <input type="password" class="form-control" name="passwordBaru" id="edit_passwordBaru" placeholder="Password Baru" value="">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="passwordRepeat">Ulang Password</label>
                        <input type="password" class="form-control" name="passwordConfirm" id="edit_passwordConfirm" placeholder="Ulang Password" value="">
                        <div id="status_password"></div>
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
    function edit_user() {
        var data_user = {!! json_encode($dataUser->toArray()) !!}
        // console.log(data_user.no_telp);
        $("#edit_formUser").attr("action", "/profile/update/userUser/"+data_user.user.id);
        $('#edit_nama').val(data_user.nama);
        $('#edit_kewarganegaraan').val(data_user.Kewarganegaraan);
        $('#edit_email').val(data_user.email);
        $('#edit_no_telp').val(data_user.no_telp);
        $('#edit_noKTP').val(data_user.no_ktp);
        $('#edit_NPWP').val(data_user.NPWP);
        $('#edit_alamat').val(data_user.alamat);
        $('#edit_username').val(data_user.user.username);
        $('#modal-editUser').modal('show');
        
        // var id_provinsi = data_user.id_provinsi;
        $.ajax({
            type: 'GET',
            url: '/profile/kabupaten/'+data_user.id_provinsi,
            success: function (response){
                // console.log(response);
                $('#edit_kabupaten').empty();
                $('#edit_kabupaten').append('<option selected disabled>Pilih Kabupaten ...</option>');
                response.forEach(element => {
                    if(element.id == data_user.id_kabupaten){
                        $('#edit_kabupaten').append('<option value="' + element['id'] + '"' +' selected>' + element['nama'] + '</option>');
                    } else{
                        $('#edit_kabupaten').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    }
                });
            }
        });

        // var id_kabupaten = $('#edit_kabupaten').val();
        // console.log(id_kabupaten);
        $.ajax({
            type: 'GET',
            url: '/profile/kecamatan/'+data_user.id_kabupaten,
            success: function (response){
                console.log(response);
                $('#edit_kecamatan').empty();
                $('#edit_kecamatan').append('<option selected disabled>Pilih Kecamatan ...</option>');
                response.forEach(element => {
                    if(element.id == data_user.id_kecamatan){
                        $('#edit_kecamatan').append('<option value="' + element['id'] + '"' +' selected>' + element['nama'] + '</option>');
                    } else{
                        $('#edit_kecamatan').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    }
                });
            }
        });

        // var id_kecamatan = $('#edit_kecamatan').val();
        $.ajax({
            type: 'GET',
            url: '/profile/desa/'+data_user.id_kecamatan,
            success: function (response){
                // console.log(response);
                $('#edit_desa').empty();
                $('#edit_desa').append('<option selected disabled>Pilih Desa ...</option>');
                response.forEach(element => {
                    if(element.id == data_user.id_desa){
                        $('#edit_desa').append('<option value="' + element['id'] + '"' +' selected>' + element['nama'] + '</option>');
                    } else{
                        $('#edit_desa').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    }
                });
        }
        });
    }

    function edit_password() {
        var data_user = {!! json_encode($dataUser->toArray()) !!}
        $("#edit_formPassword").attr("action", "/profile/update/adminPassword/"+data_user.user.id);
        $('#modal-editPassword').modal('show');
    }

    $('#edit_passwordConfirm').keyup(function(){
      let password = $('#edit_passwordBaru').val();
      let konfirm_password = $('#edit_passwordConfirm').val();
      $('#status_password').empty();
      if(konfirm_password == password){
        $('#status_password').append('<a class="text-success">Password sama</a>');
      }
      if(konfirm_password != password){
        $('#status_password').append('<a class="text-danger">Password tidak sama</a>');
      }
    })
</script>

<script>
    $('#edit_provinsi').change(function() {
        if($('#edit_provinsi').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/profile/kabupaten/'+id,
                success: function (response){
                    // console.log(response);
                    $('#edit_kabupaten').empty();
                    $('#edit_kabupaten').append('<option selected disabled>Pilih Kabupaten ...</option>');
                    response.forEach(element => {
                        $('#edit_kabupaten').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    });
                    $('#edit_kecamatan').empty();
                    $('#edit_kecamatan').append('<option selected disabled>Pilih Kecamatan ...</option>');
                    $('#edit_desa').empty();
                    $('#edit_desa').append('<option selected disabled>Pilih Desa ...</option>');
                }
            });
        } 
    });
</script>

<script>
    $('#edit_kabupaten').change(function() {
        if($('#edit_kabupaten').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/profile/kecamatan/'+id,
                success: function (response){
                    // console.log(response);
                    $('#edit_kecamatan').empty();
                    $('#edit_kecamatan').append('<option selected disabled>Pilih Kecamatan ...</option>');
                    response.forEach(element => {
                        $('#edit_kecamatan').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    });
                    $('#edit_desa').empty();
                    $('#edit_desa').append('<option selected disabled>Pilih Desa ...</option>');
                }
            });
        } 
    });
</script>

<script>
    $('#edit_kecamatan').change(function() {
        if($('#edit_kecamatan').val() != ""){ 
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/profile/desa/'+id,
                success: function (response){
                    // console.log(response);
                    $('#edit_desa').empty();
                    $('#edit_desa').append('<option selected disabled>Pilih Desa ...</option>');
                    response.forEach(element => {
                        $('#edit_desa').append('<option value="' + element['id'] + '"' +'>' + element['nama'] + '</option>');
                    });
                }
            });
        } 
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