<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\SuperAdminModel;
use App\AdminModel;
use App\TimAdministratifModel;
use App\TimLapanganModel;
use App\BupatiModel;
use App\PemilikMenaraModel;
use App\ProviderModel;
use App\UserModel;
use App\OPDModel;
use App\PerusahaanModel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function dashboard()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        }

        return view("dashboard.dashboard", compact("dataUser"));
    }

    // Profile Admin
    public function dataProfileAdmin()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataOPD = OPDModel::get();

        return view("dashboard.akun.profile.admin.admin", compact("dataUser", "dataOPD"));
    }

    public function updateProfileUserAdmin($id, Request $request)
    {
        $dataUser = UserModel::find($id);

        if ($dataUser->kategori == "Super Admin") {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'username' => 'required',
                'no_telp' => 'required',
            ]);

            if($validator->fails()){
                return back()->withErrors($validator);
            }

            if ($dataUser->username == $request->username) {
                $editSuperAdmin = SuperAdminModel::where("id_user", $id)->first();
                $editSuperAdmin->nama = $request->nama;
                $editSuperAdmin->no_telp = $request->no_telp;
                $editSuperAdmin->update();
                return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
            }

            $cekUsername = UserModel::where("username", $request->username)->first();
            if ($cekUsername == NULL) {
                $editUser = UserModel::find($id);
                $editUser->username = $request->username;
                $editUser->update();

                $editSuperAdmin = SuperAdminModel::where("id_user", $id)->first();
                $editSuperAdmin->nama = $request->nama;
                $editSuperAdmin->no_telp = $request->no_telp;
                $editSuperAdmin->update();
                return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
            } else {
                return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
            }
        } elseif ($dataUser->kategori == "Admin") {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'username' => 'required',
                'no_telp' => 'required',
            ]);

            if($validator->fails()){
                return back()->withErrors($validator);
            }

            if ($dataUser->username == $request->username) {
                $editAdmin = AdminModel::where("id_user", $id)->first();
                $editAdmin->nama = $request->nama;
                $editAdmin->no_telp = $request->no_telp;
                $editAdmin->update();
                return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
            }

            $cekUsername = UserModel::where("username", $request->username)->first();
            if ($cekUsername == NULL) {
                $editUser = UserModel::find($id);
                $editUser->username = $request->username;
                $editUser->update();

                $editAdmin = AdminModel::where("id_user", $id)->first();
                $editAdmin->nama = $request->nama;
                $editAdmin->no_telp = $request->no_telp;
                $editAdmin->update();
                return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
            } else {
                return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
            }
        } elseif ($dataUser->kategori == "Tim Administratif") {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'username' => 'required',
                'no_telp' => 'required',
                'id_opd' => 'required',
            ]);

            if($validator->fails()){
                return back()->withErrors($validator);
            }

            if ($dataUser->username == $request->username) {
                $editTimAdministratif = TimAdministratifModel::where("id_user", $id)->first();
                $editTimAdministratif->nama = $request->nama;
                $editTimAdministratif->no_telp = $request->no_telp;
                $editTimAdministratif->id_opd = $request->id_opd;
                $editTimAdministratif->update();
                return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
            }

            $cekUsername = UserModel::where("username", $request->username)->first();
            if ($cekUsername == NULL) {
                $editUser = UserModel::find($id);
                $editUser->username = $request->username;
                $editUser->update();

                $editTimAdministratif = TimAdministratifModel::where("id_user", $id)->first();
                $editTimAdministratif->nama = $request->nama;
                $editTimAdministratif->no_telp = $request->no_telp;
                $editTimAdministratif->id_opd = $request->id_opd;
                $editTimAdministratif->update();
                return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
            } else {
                return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
            }
        } elseif ($dataUser->kategori == "Tim Lapangan") {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'username' => 'required',
                'no_telp' => 'required',
                'id_opd' => 'required',
            ]);

            if($validator->fails()){
                return back()->withErrors($validator);
            }

            if ($dataUser->username == $request->username) {
                $editTimLapangan = TimLapanganModel::where("id_user", $id)->first();
                $editTimLapangan->nama = $request->nama;
                $editTimLapangan->no_telp = $request->no_telp;
                $editTimLapangan->id_opd = $request->id_opd;
                $editTimLapangan->update();
                return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
            }

            $cekUsername = UserModel::where("username", $request->username)->first();
            if ($cekUsername == NULL) {
                $editUser = UserModel::find($id);
                $editUser->username = $request->username;
                $editUser->update();

                $editTimLapangan = TimLapanganModel::where("id_user", $id)->first();
                $editTimLapangan->nama = $request->nama;
                $editTimLapangan->no_telp = $request->no_telp;
                $editTimLapangan->id_opd = $request->id_opd;
                $editTimLapangan->update();
                return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
            } else {
                return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
            }
        } 
    }

    public function updateProfilePasswordAdmin($id, Request $request)
    {
        # code...
    }

    // Profile User
    public function dataProfileUser()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        // dd($dataUser);

        return view("dashboard.akun.profile.user.user", compact("dataUser"));
    }

    public function updateProfileUser()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Provider") {
            $dataUser = ProviderModel::with('user.Provider')->whereIn("id_user", [Auth::user()->id])->first();
        }

        // dd($dataUser);

        return view("dashboard.akun.profile.user.edit", compact("dataUser"));
    }

    public function insertProfileUser($id, Request $request)
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

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $cekPassword = UserModel::where("password", $password)->first();
            if ($cekPassword == NULL) {
                $dataUser = UserModel::find($id);
                if ($dataUser->kategori == "Pemilik Menara") {
                    $editUser = UserModel::find($id);
                    $editUser->username = $request->username;
                    $editUser->password = $password;
                    $editUser->update();

                    $editPemilikMenara = PemilikMenaraModel::where("id_user", $id)->first();
                    $editPemilikMenara->nama = $request->nama;
                    $editPemilikMenara->update();
                } elseif ($dataUser->kategori == "Provider") {
                    $editUser = UserModel::find($id);
                    $editUser->username = $request->username;
                    $editUser->password = $password;
                    $editUser->update();

                    $editProvider = ProviderModel::where("id_user", $id)->first();
                    $editProvider->nama = $request->nama;
                    $editProvider->update();
                }

                return redirect('/profile/user');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
        }
    }

    // Super Admin
    public function dataSuperAdmin()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataSuperAdmin = SuperAdminModel::get();

        return view("dashboard.akun.super_admin.data", compact("dataUser", "dataSuperAdmin"));
    }

    public function insertSuperAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_telp' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $password = Hash::make($request->password);

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $newUser = new UserModel();
            $newUser->username = $request->username;
            $newUser->password = $password;
            $newUser->kategori = 'Super Admin';
            $newUser->save();

            $newSuperAdmin = new SuperAdminModel();
            $newSuperAdmin->id_user = $newUser->id;
            $newSuperAdmin->nama = $request->nama;
            $newSuperAdmin->no_telp = $request->no_telp;
            $newSuperAdmin->save();

            return redirect()->back()->with(['success' => 'Super Admin Berhasil Di Tambah']);
        } else {
            return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
        }
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

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $updateSuperAdmin = SuperAdminModel::find($id);
            $updateSuperAdmin->nama = $request->nama;
            $updateSuperAdmin->no_telp = $request->no_telp;
            $updateSuperAdmin->update();

            $idSuperAdmin = $updateSuperAdmin->id_user;

            $superAdminUpdate = UserModel::find($idSuperAdmin);
            $superAdminUpdate->username = $request->username;
            $superAdminUpdate->password = $password;
            $superAdminUpdate->update();
            
            return redirect()->back()->with(['success' => 'Super Admin Berhasil Di Edit']);
        } else {
            return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
        }
    }

    public function deleteSuperAdmin($id)
    {
        $dataSuperAdmin = SuperAdminModel::find($id);
        $idUser = $dataSuperAdmin->id_user;
        $dataSuperAdmin->delete();

        $dataUser = UserModel::find($idUser);
        $dataUser->delete();

        return redirect()->back()->with(['success' => 'Super Admin Berhasil Di Hapus']);
    }

    // Admin
    public function dataAdmin()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataAdmin = AdminModel::get();

        return view("dashboard.akun.admin.data", compact("dataUser", "dataAdmin"));
    }

    public function insertAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_telp' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $password = Hash::make($request->password);

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $newUser = new UserModel();
            $newUser->username = $request->username;
            $newUser->password = $password;
            $newUser->kategori = 'Admin';
            $newUser->save();

            $newAdmin = new AdminModel();
            $newAdmin->id_user = $newUser->id;
            $newAdmin->nama = $request->nama;
            $newAdmin->no_telp = $request->no_telp;
            $newAdmin->save();

            return redirect()->back()->with(['success' => 'Admin Berhasil Di Tambah']);
        } else {
            return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
        }
    }

    public function getAdmin($id)
    {
        $getAdmin  = AdminModel::with('user.Admin')->where('id', $id)->first();
        
        return response()->json($getAdmin);
    }

    public function updateAdmin($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_telp' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $password = Hash::make($request->password);

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $updateAdmin = AdminModel::find($id);
            $updateAdmin->nama = $request->nama;
            $updateAdmin->no_telp = $request->no_telp;
            $updateAdmin->update();

            $idAdmin = $updateAdmin->id_user;

            $AdminUpdate = UserModel::find($idAdmin);
            $AdminUpdate->username = $request->username;
            $AdminUpdate->password = $password;
            $AdminUpdate->update();
            
            return redirect()->back()->with(['success' => 'Admin Berhasil Di Edit']);
        } else {
            return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
        }
    }

    public function deleteAdmin($id)
    {
        $dataAdmin = AdminModel::find($id);
        $idUser = $dataAdmin->id_user;
        $dataAdmin->delete();

        $dataUser = UserModel::find($idUser);
        $dataUser->delete();

        return redirect()->back()->with(['success' => 'Admin Berhasil Di Hapus']);
    }

    // Tim Administratif
    public function dataTimAdministratif()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataTimAdministratif = TimAdministratifModel::get();
        $dataOPD = OPDModel::get();

        return view("dashboard.akun.tim_administratif.data", compact("dataUser", "dataTimAdministratif", "dataOPD"));
    }

    public function insertTimAdministratif(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_telp' => 'required',
            'id_opd' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $password = Hash::make($request->password);

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $newUser = new UserModel();
            $newUser->username = $request->username;
            $newUser->password = $password;
            $newUser->kategori = 'Tim Administratif';
            $newUser->save();

            $newTimAdministratif = new TimAdministratifModel();
            $newTimAdministratif->id_user = $newUser->id;
            $newTimAdministratif->nama = $request->nama;
            $newTimAdministratif->no_telp = $request->no_telp;
            $newTimAdministratif->id_opd = $request->id_opd;
            $newTimAdministratif->save();

            return redirect()->back()->with(['success' => 'Tim Administratif Berhasil Di Tambah']);
        } else {
            return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
        }
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
            'no_telp' => 'required',
            'username' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $password = Hash::make($request->password);
        $cekUsername = UserModel::where("username", $request->username)->first();
        $dataTimAdministratif = TimAdministratifModel::find($id);
        $usernameTimAdministratif = UserModel::find($dataTimAdministratif->id_user);
        if ($request->username == $usernameTimAdministratif->username) {
            $updateTimAdministratif = TimAdministratifModel::find($id);
            $updateTimAdministratif->nama = $request->nama;
            $updateTimAdministratif->no_telp = $request->no_telp;
            $updateTimAdministratif->id_opd = $request->id_opd;
            $updateTimAdministratif->update();

            $idTimAdministratif = $updateTimAdministratif->id_user;

            $timAdministratifUpdate = UserModel::find($idTimAdministratif);
            if ($request->password) {
                $timAdministratifUpdate->password = $password;
            }
            $timAdministratifUpdate->update();
            
            return redirect()->back()->with(['success' => 'Tim Administratif Berhasil Di Edit']);
        } elseif ($cekUsername == NULL) {
            $updateTimAdministratif = TimAdministratifModel::find($id);
            $updateTimAdministratif->nama = $request->nama;
            $updateTimAdministratif->no_telp = $request->no_telp;
            $updateTimAdministratif->id_opd = $request->id_opd;
            $updateTimAdministratif->update();

            $idTimAdministratif = $updateTimAdministratif->id_user;

            $timAdministratifUpdate = UserModel::find($idTimAdministratif);
            $timAdministratifUpdate->username = $request->username;
            if ($request->password) {
                $timAdministratifUpdate->password = $password;
            }
            $timAdministratifUpdate->update();
            
            return redirect()->back()->with(['success' => 'Tim Administratif Berhasil Di Edit']);
        } else {
            return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
        }
    }

    public function deleteTimAdministratif($id)
    {
        $dataTimAdministratif = TimAdministratifModel::find($id);
        $idUser = $dataTimAdministratif->id_user;
        $dataTimAdministratif->delete();

        $dataUser = UserModel::find($idUser);
        $dataUser->delete();

        return redirect()->back()->with(['success' => 'Tim Administratif Berhasil Di Hapus']);
    }

    // Tim Lapangan
    public function dataTimLapangan()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataTimLapangan = TimLapanganModel::get();
        $dataOPD = OPDModel::get();

        return view("dashboard.akun.tim_lapangan.data", compact("dataUser", "dataTimLapangan", "dataOPD"));
    }

    public function insertTimLapangan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_telp' => 'required',
            'id_opd' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $password = Hash::make($request->password);

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $newUser = new UserModel();
            $newUser->username = $request->username;
            $newUser->password = $password;
            $newUser->kategori = 'Tim Lapangan';
            $newUser->save();

            $newTimLapangan = new TimLapanganModel();
            $newTimLapangan->id_user = $newUser->id;
            $newTimLapangan->nama = $request->nama;
            $newTimLapangan->no_telp = $request->no_telp;
            $newTimLapangan->id_opd = $request->id_opd;
            $newTimLapangan->save();

            return redirect()->back()->with(['success' => 'Tim Lapangan Berhasil Di Tambah']);
        } else {
            return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
        }
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
            'no_telp' => 'required',
            'username' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $password = Hash::make($request->password);
        $cekUsername = UserModel::where("username", $request->username)->first();
        $dataTimLapangan = TimLapanganModel::find($id);
        $usernameTimLapangan = UserModel::find($dataTimLapangan->id_user);
        if ($request->username == $usernameTimLapangan->username) {
            $updateTimLapangan = TimLapanganModel::find($id);
            $updateTimLapangan->nama = $request->nama;
            $updateTimLapangan->no_telp = $request->no_telp;
            $updateTimLapangan->id_opd = $request->id_opd;
            $updateTimLapangan->update();

            $idTimLapangan = $updateTimLapangan->id_user;

            $timLapanganUpdate = UserModel::find($idTimLapangan);
            if ($request->password) {
                $timLapanganUpdate->password = $password;
            }
            $timLapanganUpdate->update();
            
            return redirect()->back()->with(['success' => 'Tim Lapangan Berhasil Di Edit']);
        } elseif ($cekUsername == NULL) {
            $updateTimLapangan = TimLapanganModel::find($id);
            $updateTimLapangan->nama = $request->nama;
            $updateTimLapangan->update();

            $idTimLapangan = $updateTimLapangan->id_user;

            $timLapanganUpdate = UserModel::find($idTimLapangan);
            $timLapanganUpdate->username = $request->username;
            if ($request->password) {
                $timLapanganUpdate->password = $password;
            }
            $timLapanganUpdate->update();
            
            return redirect()->back()->with(['success' => 'Tim Lapangan Berhasil Di Edit']);
        } else {
            return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
        }
    }

    public function deleteTimLapangan($id)
    {
        $dataTimLapangan = TimLapanganModel::find($id);
        $idUser = $dataTimLapangan->id_user;
        $dataTimLapangan->delete();

        $dataUser = UserModel::find($idUser);
        $dataUser->delete();

        return redirect()->back()->with(['success' => 'Tim Lapangan Berhasil Di Hapus']);
    }

    // Pemilik Menara
    public function dataPemilikMenara()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Provider") {
            $dataUser = ProviderModel::with('user.Provider')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataPemilikMenara = PemilikMenaraModel::with('Perusahaan.PemilikMenara')->where('status', 'Non Aktif')->get();
        // dd($dataPemilikMenara);

        return view("dashboard.akun.pemilik_menara.data", compact("dataUser", "dataPemilikMenara"));
    }

    public function validasiPemilikMenara($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Provider") {
            $dataUser = ProviderModel::with('user.Provider')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $userPemilikMenara = PemilikMenaraModel::with('Provinsi.PemilikMenara', 'Kabupaten.PemilikMenara', 'Kecamatan.PemilikMenara', 'Desa.PemilikMenara')->find($id);
        $perusahaanPemilikMenara = PerusahaanModel::with('Provinsi.Perusahaan', 'Kabupaten.Perusahaan', 'Kecamatan.Perusahaan', 'Desa.Perusahaan')->find($userPemilikMenara->id_perusahaan);
        // dd($perusahaanPemilikMenara);

        return view("dashboard.akun.pemilik_menara.validasi", compact("dataUser", "userPemilikMenara", "perusahaanPemilikMenara"));
    }

    public function validatePemilikMenara($id)
    {
        $validate = PemilikMenaraModel::find($id);
        $validate->status = 'Aktif';
        $validate->update();

        return redirect()->route('dataPemilikMenara')->with(['success' => 'Validasi Berhasil']);
    }
}
