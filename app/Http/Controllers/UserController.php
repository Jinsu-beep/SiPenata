<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\SuperAdminModel;
use App\TimAdministratifModel;
use App\TimLapanganModel;
use App\BupatiModel;
use App\PemilikMenaraModel;
use App\ProviderModel;
use App\UserModel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function dashboard()
    {
        if (Auth::user()->kategori == "super admin") {
            $dataUser = SuperAdminModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "tim administratif") {
            $dataUser = TimAdministratifModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "tim lapangan") {
            $dataUser = TimLapanganModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "bupati") {
            $dataUser = BupatiModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "pemilik menara") {
            $dataUser = PemilikMenaraModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "provider") {
            $dataUser = ProviderModel::whereIn("id_user", [Auth::user()->id])->first();
        } 

        return view("dashboard.dashboard", compact("dataUser"));
    }

    public function dataSuperAdmin()
    {
        if (Auth::user()->kategori == "super admin") {
            $dataUser = SuperAdminModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "tim administratif") {
            $dataUser = TimAdministratifModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "tim lapangan") {
            $dataUser = TimLapanganModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "bupati") {
            $dataUser = BupatiModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "pemilik menara") {
            $dataUser = PemilikMenaraModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "provider") {
            $dataUser = ProviderModel::whereIn("id_user", [Auth::user()->id])->first();
        } 

        $dataSuperAdmin = SuperAdminModel::get();
        // dd($dataSuperAdmin);

        return view("dashboard.akun.super_admin.data", compact("dataUser", "dataSuperAdmin"));
    }

    public function createSuperAdmin()
    {
        if (Auth::user()->kategori == "super admin") {
            $dataUser = SuperAdminModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "tim administratif") {
            $dataUser = TimAdministratifModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "tim lapangan") {
            $dataUser = TimLapanganModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "bupati") {
            $dataUser = BupatiModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "pemilik menara") {
            $dataUser = PemilikMenaraModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "provider") {
            $dataUser = ProviderModel::whereIn("id_user", [Auth::user()->id])->first();
        } 

        return view("dashboard.akun.super_admin.create", compact("dataUser"));
    }

    public function insertSuperAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $password = Hash::make($request->password);

        $newUser = new UserModel();
        $newUser->username = $request->username;
        $newUser->password = $password;
        $newUser->kategori = 'super admin';
        $newUser->save();

        $newSuperAdmin = new SuperAdminModel();
        $newSuperAdmin->id_user = $newUser->id;
        $newSuperAdmin->nama = $request->nama;
        $newSuperAdmin->save();

        return redirect()->back();
    }
}
