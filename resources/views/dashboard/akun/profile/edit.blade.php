@extends('layouts.dashboard.master')
@section('title') Data Akun Super Admin @endsection

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
                            <form action="/profile/insert/{{ $dataUser->id }}" method="POST" class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Nama" value="{{ $dataUser->nama }}" placeholder="Nama">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Username" value="{{ $dataUser->user->username }}" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="Paasword" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="ConfirmPassword" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="/profile/profile" class="btn btn-danger">Cancel</a>
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