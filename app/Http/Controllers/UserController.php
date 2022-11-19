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
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Provider") {
            $dataUser = ProviderModel::with('user.Provider')->whereIn("id_user", [Auth::user()->id])->first();
        }

        return view("dashboard.dashboard", compact("dataUser"));
    }

    // Profile Admin
    public function dataProfileAdmin()
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

        return view("dashboard.akun.profile.admin.admin", compact("dataUser"));
    }

    public function editProfileAdmin()
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

        return view("dashboard.akun.profile.admin.edit", compact("dataUser"));
    }

    public function updateProfileAdmin($id, Request $request)
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
                if ($dataUser->kategori == "Super Admin") {
                    $editUser = UserModel::find($id);
                    $editUser->username = $request->username;
                    $editUser->password = $password;
                    $editUser->update();

                    $editSuperAdmin = SuperAdminModel::where("id_user", $id)->first();
                    $editSuperAdmin->nama = $request->nama;
                    $editSuperAdmin->update();
                } elseif ($dataUser->kategori == "Tim Administratif") {
                    $editUser = UserModel::find($id);
                    $editUser->username = $request->username;
                    $editUser->password = $password;
                    $editUser->update();

                    $editTimAdministratif = TimAdministratifModel::where("id_user", $id)->first();
                    $editTimAdministratif->nama = $request->nama;
                    $editTimAdministratif->update();
                } elseif ($dataUser->kategori == "Tim Lapangan") {
                    $editUser = UserModel::find($id);
                    $editUser->username = $request->username;
                    $editUser->password = $password;
                    $editUser->update();

                    $editTimLapangan = TimLapaganModel::where("id_user", $id)->first();
                    $editTimLapangan->nama = $request->nama;
                    $editTimLapangan->update();
                }

                return redirect('/profile/admin');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
        }
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
        } elseif (Auth::user()->kategori == "Provider") {
            $dataUser = ProviderModel::with('user.Provider')->whereIn("id_user", [Auth::user()->id])->first();
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
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Provider") {
            $dataUser = ProviderModel::with('user.Provider')->whereIn("id_user", [Auth::user()->id])->first();
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

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $cekPassword = UserModel::where("password", $password)->first();
            if ($cekPassword == NULL) {
                $newUser = new UserModel();
                $newUser->username = $request->username;
                $newUser->password = $password;
                $newUser->kategori = 'Super Admin';
                $newUser->save();

                $newSuperAdmin = new SuperAdminModel();
                $newSuperAdmin->id_user = $newUser->id;
                $newSuperAdmin->nama = $request->nama;
                $newSuperAdmin->save();

                return redirect()->back()->with('statusInput', 'Insert Success');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
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
            $cekPassword = UserModel::where("password", $password)->first();
            if ($cekPassword == NULL) {
                $updateSuperAdmin = SuperAdminModel::find($id);
                $updateSuperAdmin->nama = $request->nama;
                $updateSuperAdmin->update();

                $idSuperAdmin = $updateSuperAdmin->id_user;

                $superAdminUpdate = UserModel::find($idSuperAdmin);
                $superAdminUpdate->username = $request->username;
                $superAdminUpdate->password = $password;
                $superAdminUpdate->update();
                
                return redirect()->back()->with('statusInput', 'Update Success');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
        }
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

    // Admin
    public function dataAdmin()
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

        $dataAdmin = AdminModel::get();

        return view("dashboard.akun.admin.data", compact("dataUser", "dataAdmin"));
    }

    public function insertAdmin(Request $request)
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
                $newUser = new UserModel();
                $newUser->username = $request->username;
                $newUser->password = $password;
                $newUser->kategori = 'Admin';
                $newUser->save();

                $newAdmin = new AdminModel();
                $newAdmin->id_user = $newUser->id;
                $newAdmin->nama = $request->nama;
                $newAdmin->save();

                return redirect()->back()->with('statusInput', 'Insert Success');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
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
                $updateAdmin = AdminModel::find($id);
                $updateAdmin->nama = $request->nama;
                $updateAdmin->update();

                $idAdmin = $updateAdmin->id_user;

                $AdminUpdate = UserModel::find($idAdmin);
                $AdminUpdate->username = $request->username;
                $AdminUpdate->password = $password;
                $AdminUpdate->update();
                
                return redirect()->back()->with('statusInput', 'Update Success');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
        }
    }

    public function deleteAdmin($id)
    {
        $dataAdmin = AdminModel::find($id);
        $idUser = $dataAdmin->id_user;
        $dataAdmin->delete();

        $dataUser = UserModel::find($idUser);
        $dataUser->delete();

        return redirect()->back()->with('statusInput', 'Delete Success');
    }

    // Tim Administratif
    public function dataTimAdministratif()
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

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $cekPassword = UserModel::where("password", $password)->first();
            if ($cekPassword == NULL) {
                $newUser = new UserModel();
                $newUser->username = $request->username;
                $newUser->password = $password;
                $newUser->kategori = 'Tim Administratif';
                $newUser->save();

                $newTimAdministratif = new TimAdministratifModel();
                $newTimAdministratif->id_user = $newUser->id;
                $newTimAdministratif->nama = $request->nama;
                $newTimAdministratif->save();

                return redirect()->back()->with('statusInput', 'Insert Success');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
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
                $updateTimAdministratif = TimAdministratifModel::find($id);
                $updateTimAdministratif->nama = $request->nama;
                $updateTimAdministratif->update();

                $idTimAdministratif = $updateTimAdministratif->id_user;

                $timAdministratifUpdate = UserModel::find($idTimAdministratif);
                $timAdministratifUpdate->username = $request->username;
                $timAdministratifUpdate->password = $password;
                $timAdministratifUpdate->update();
                
                return redirect()->back()->with('statusInput', 'Update Success');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
        }
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

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $cekPassword = UserModel::where("password", $password)->first();
            if ($cekPassword == NULL) {
                $newUser = new UserModel();
                $newUser->username = $request->username;
                $newUser->password = $password;
                $newUser->kategori = 'Tim Lapangan';
                $newUser->save();

                $newTimLapangan = new TimLapanganModel();
                $newTimLapangan->id_user = $newUser->id;
                $newTimLapangan->nama = $request->nama;
                $newTimLapangan->save();

                return redirect()->back()->with('statusInput', 'Insert Success');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
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
                $updateTimLapangan = TimLapanganModel::find($id);
                $updateTimLapangan->nama = $request->nama;
                $updateTimLapangan->update();

                $idTimLapangan = $updateTimLapangan->id_user;

                $timLapanganUpdate = UserModel::find($idTimLapangan);
                $timLapanganUpdate->username = $request->username;
                $timLapanganUpdate->password = $password;
                $timLapanganUpdate->update();
                
                return redirect()->back()->with('statusInput', 'Update Success');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
        }
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

        $dataPemilikMenara = PemilikMenaraModel::get();

        return view("dashboard.akun.pemilik_menara.data", compact("dataUser", "dataPemilikMenara"));
    }

    public function insertPemilikMenara(Request $request)
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
                $newUser = new UserModel();
                $newUser->username = $request->username;
                $newUser->password = $password;
                $newUser->kategori = 'Pemilik Menara';
                $newUser->save();

                $newPemilikMenara = new PemilikMenaraModel();
                $newPemilikMenara->id_user = $newUser->id;
                $newPemilikMenara->nama = $request->nama;
                $newPemilikMenara->save();

                return redirect()->back()->with('statusInput', 'Insert Success');
            } else {
                return redirect()->back()->with('statusInput', 'Password Sudah Dipakai');
            }
        } else {
            return redirect()->back()->with('statusInput', 'Username Sudah Dipakai');
        }
    }
}
