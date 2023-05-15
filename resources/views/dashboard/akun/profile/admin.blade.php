@extends('layouts.dashboard.master')
@section('title')
    Data Akun {{ $dataUser->user->kategori }}
@endsection

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
                            <img class="profile-user-img img-fluid img-circle" src="../../dist/img/AdminLTELogo.png"
                                alt="User profile picture">
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
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="user">
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="nama" placeholder="Nama"
                                            value="{{ $dataUser->nama }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="noTelp" class="col-sm-2 col-form-label">No Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="noTelp" placeholder="No Telepon"
                                            value="{{ $dataUser->no_telp }}" disabled>
                                    </div>
                                </div>
                                @if (in_array($dataUser->user->kategori, ['Tim Administratif', 'Tim Lapangan']))
                                    <div class="form-group row">
                                        <label for="noTelp" class="col-sm-2 col-form-label">OPD</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="id_opd" id="id_opd"
                                                data-placeholder="Pilih OPD" style="width: 100%;" disabled>
                                                @foreach ($dataOPD as $do)
                                                    <option value="{{ $do->id }}"
                                                        @if ($dataUser->opd->id == $do->id) selected @endif>
                                                        {{ $do->opd }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" placeholder="Username"
                                            value="{{ $dataUser->user->username }}" disabled>
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
                            <label for="Nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="edit_nama" placeholder="Nama"
                                value="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="no_telp">No Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id="edit_no_telp"
                                placeholder="No Telepon" value="">
                        </div>
                    </div>
                    @if (in_array($dataUser->user->kategori, ['Tim Administratif', 'Tim Lapangan']))
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="opd">OPD</label>
                                <select class="form-control select2" name="id_opd" id="id_opd"
                                    data-placeholder="Pilih OPD" style="width: 100%;">
                                    @foreach ($dataOPD as $do)
                                        <option value="{{ $do->id }}"
                                            @if ($dataUser->opd->id == $do->id) selected @endif>{{ $do->opd }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username"">Username</label>
                            <input type="text" class="form-control" name="username" id="edit_username"
                                placeholder="Username" value="">
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
                            <input type="password" class="form-control" name="passwordLama" id="edit_passworrdLama"
                                placeholder="Password Lama" value="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="passwordBaru">Password Baru</label>
                            <input type="password" class="form-control" name="passwordBaru" id="edit_passwordBaru"
                                placeholder="Password Baru" value="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="passwordRepeat">Ulang Password</label>
                            <input type="password" class="form-control" name="passwordConfirm" id="edit_passwordConfirm"
                                placeholder="Ulang Password" value="">
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
        function edit_user() {
            var data_user = {!! json_encode($dataUser->toArray()) !!}
            $("#edit_formUser").attr("action", "/profile/update/adminUser/" + data_user.user.id);
            $('#edit_nama').val(data_user.nama);
            $('#edit_no_telp').val(data_user.no_telp);
            $('#edit_username').val(data_user.user.username);
            if (data_user.user.kategori == ['Tim Administratif', 'Tim Lapangan']) {
                $('#edit_opd').val(data_user.opd.opd).change();
            }
            $('#modal-editUser').modal('show');
        }

        function edit_password() {
            var data_user = {!! json_encode($dataUser->toArray()) !!}
            $("#edit_formPassword").attr("action", "/profile/update/adminPassword/" + data_user.user.id);
            $('#modal-editPassword').modal('show');
        }

        $('#edit_passwordConfirm').keyup(function() {
            let password = $('#edit_passwordBaru').val();
            let konfirm_password = $('#edit_passwordConfirm').val();
            $('#status_password').empty();
            if (konfirm_password == password) {
                $('#status_password').append('<a class="text-success">Password sama</a>');
            }
            if (konfirm_password != password) {
                $('#status_password').append('<a class="text-danger">Password tidak sama</a>');
            }
        })
    </script>

    @if ($message = Session::get('success'))
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
                        text: '{{ $message }}'
                    })
                });
            });
        </script>
    @endif

    @if ($message = Session::get('failed'))
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
                        text: '{{ $message }}'
                    })
                });
            });
        </script>
    @endif
@endpush
