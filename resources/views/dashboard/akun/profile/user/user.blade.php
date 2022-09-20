@extends('layouts.dashboard.master')
@section('title') Data Akun {{ $dataUser->user->kategori }} @endsection

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
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Nama" value="{{ $dataUser->nama }}" placeholder="Nama" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Username" value="{{ $dataUser->user->username }}" placeholder="Username" readonly>
                                </div>
                            </div>
                            <div class="offset-sm-2 col-sm-10">
                                <a href="/profile/edit/user" class="btn btn-warning">Edit</a>
                            </div>
                        </div>
                    
                    </div>
                
                </div>
            </div>
        
        </div>
    
    </div>
    
</div>
@endsection