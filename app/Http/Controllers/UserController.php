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

    // Super Admin
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

        return view("dashboard.akun.super_admin.data", compact("dataUser", "dataSuperAdmin"));
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

        return redirect()->back()->with('statusInput', 'Insert Success');
    }

    public function getSuperAdmin($id)
    {
        $getSuperAdmin  = SuperAdminModel::with('user.SuperAdmin')->where('id', $id)->first();
        
        return response()->json($getSuperAdmin);
    }

    public function updateSuperAdmin($id, Request $request)
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

        $updateSuperAdmin = SuperAdminModel::find($id);
        $updateSuperAdmin->nama = $request->nama;
        $updateSuperAdmin->update();

        $idSuperAdmin = $updateSuperAdmin->id_user;

        $superAdminUpdate = UserModel::find($idSuperAdmin);
        $superAdminUpdate->username = $request->username;
        $superAdminUpdate->password = $password;
        $superAdminUpdate->update();
        
        return redirect()->back()->with('statusInput', 'Update Success');
    }

    public function deleteSuperAdmin($id)
    {
        $dataSuperAdmin = SuperAdminModel::find($id);
        $idUser = $dataSuperAdmin->id_user;
        $dataSuperAdmin->delete();

        $dataUser = UserModel::find($idUser);
        $dataUser->delete();

        return redirect()->back()->with('statusInput', 'Delete Success');
    }

    // Tim Administratif
    public function dataTimAdministratif()
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

        $dataTimAdministratif = TimAdministratifModel::get();

        return view("dashboard.akun.tim_administratif.data", compact("dataUser", "dataTimAdministratif"));
    }

    public function insertTimAdministratif(Request $request)
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
        $newUser->kategori = 'tim administratif';
        $newUser->save();

        $newTimAdministratif = new TimAdministratifModel();
        $newTimAdministratif->id_user = $newUser->id;
        $newTimAdministratif->nama = $request->nama;
        $newTimAdministratif->save();

        return redirect()->back()->with('statusInput', 'Insert Success');
    }

    public function getTimAdministratif($id)
    {
        $getTimAdministratif  = TimAdministratifModel::with('user.TimAdministratif')->where('id', $id)->first();
        
        return response()->json($getTimAdministratif);
    }

    public function updateTimAdministratif($id, Request $request)
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

        $updateTimAdministratif = TimAdministratifModel::find($id);
        $updateTimAdministratif->nama = $request->nama;
        $updateTimAdministratif->update();

        $idTimAdministratif = $updateTimAdministratif->id_user;

        $timAdministratifUpdate = UserModel::find($idTimAdministratif);
        $timAdministratifUpdate->username = $request->username;
        $timAdministratifUpdate->password = $password;
        $timAdministratifUpdate->update();
        
        return redirect()->back()->with('statusInput', 'Update Success');
    }

    public function deleteTimAdministratif($id)
    {
        $dataTimAdministratif = TimAdministratifModel::find($id);
        $idUser = $dataTimAdministratif->id_user;
        $dataTimAdministratif->delete();

        $dataUser = UserModel::find($idUser);
        $dataUser->delete();

        return redirect()->back()->with('statusInput', 'Delete Success');
    }

    // Tim Lapangan
    public function dataTimLapangan()
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

        $dataTimLapangan = TimLapanganModel::get();

        return view("dashboard.akun.tim_lapangan.data", compact("dataUser", "dataTimLapangan"));
    }

    public function insertTimLapangan(Request $request)
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
        $newUser->kategori = 'tim lapangan';
        $newUser->save();

        $newTimLapangan = new TimLapanganModel();
        $newTimLapangan->id_user = $newUser->id;
        $newTimLapangan->nama = $request->nama;
        $newTimLapangan->save();

        return redirect()->back()->with('statusInput', 'Insert Success');
    }

    public function getTimLapangan($id)
    {
        $getTimLapangan  = TimLapanganModel::with('user.TimAdministratif')->where('id', $id)->first();
        
        return response()->json($getTimLapangan);
    }

    public function updateTimLapangan($id, Request $request)
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

        $updateTimLapangan = TimLapanganModel::find($id);
        $updateTimLapangan->nama = $request->nama;
        $updateTimLapangan->update();

        $idTimLapangan = $updateTimLapangan->id_user;

        $timLapanganUpdate = UserModel::find($idTimLapangan);
        $timLapanganUpdate->username = $request->username;
        $timLapanganUpdate->password = $password;
        $timLapanganUpdate->update();
        
        return redirect()->back()->with('statusInput', 'Update Success');
    }

    public function deleteTimLapangan($id)
    {
        $dataTimLapangan = TimLapanganModel::find($id);
        $idUser = $dataTimLapangan->id_user;
        $dataTimLapangan->delete();

        $dataUser = UserModel::find($idUser);
        $dataUser->delete();

        return redirect()->back()->with('statusInput', 'Delete Success');
    }
}
