@extends('layouts.dashboard.master')
@section('title') Data Akun {{ $dataUser->user->kategori }} @endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user2-160x160.jpg" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $dataUser->nama }}</h3>
                    <p class="text-muted text-center">{{ $dataUser->user->kategori }}</p>
                    <a href="{{ route('editProfileAdmin') }}" class="btn btn-primary btn-block"><b>Edit</b></a>
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
                                    <input type="email" class="form-control" id="nama" placeholder="Nama" value="{{ $dataUser->nama }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="noTelp" class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="noTelp" placeholder="No Telepon" value="{{ $dataUser->no_telp }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" placeholder="Username" value="{{ $dataUser->user->username }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection