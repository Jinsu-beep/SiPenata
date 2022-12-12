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
use App\PemilikMenaraModel;
use App\UserModel;
use App\OPDModel;
use App\PerusahaanModel;
use App\ProvinsiModel;
use App\KabupatenModel;
use App\KecamatanModel;
use App\DesaModel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'verified']);
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
            // dd($dataUser);
            if ($dataUser->NPWP == NULL) {
                return redirect()->route('biodata');
            }

            $perusahaan = PerusahaanModel::find($dataUser->id);

            return view("dashboard.dashboard", compact("dataUser", "perusahaan"));
        }

        

        return view("dashboard.dashboard", compact("dataUser"));
    }

    public function biodata()
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        // dd($dataUser);
        $dataProvinsi = ProvinsiModel::get();

        return view('dashboard.akun.pemilik_menara.biodata', compact("dataUser", "dataProvinsi"));
    }

    public function insertBiodata($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kewarganegaraan' => 'required',
            'email' => 'required',
            'noKTP' => 'required',
            'noTelp' => 'required',
            'NPWP' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
            dd($validator);
        }

        $dataPemilikMenara = PemilikMenaraModel::find($id);
        $dataPemilikMenara->Kewarganegaraan = $request->kewarganegaraan;
        $dataPemilikMenara->no_telp = $request->noTelp;
        $dataPemilikMenara->NPWP = $request->NPWP;
        $dataPemilikMenara->id_provinsi = $request->provinsi;
        $dataPemilikMenara->id_kabupaten = $request->kabupaten;
        $dataPemilikMenara->id_kecamatan = $request->kecamatan;
        $dataPemilikMenara->id_desa = $request->desa;
        $dataPemilikMenara->alamat = $request->alamat;
        $dataPemilikMenara->update();

        return redirect()->route('dashboard');
    }

    // Profile Admin
    public function dataProfileAdmin()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataOPD = OPDModel::get();

        return view("dashboard.akun.profile.admin", compact("dataUser", "dataOPD"));
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
                return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
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
                return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
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
                return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
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
                return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
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
        $validator = Validator::make($request->all(), [
            'passwordLama' => 'required',
            'passwordBaru' => 'required',
            'passwordConfirm' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
        }

        $dataUser = UserModel::find($id);

        if (Hash::check($request->passwordLama, $dataUser->password)) {
            $password = Hash::make($request->password);

            $user = UserModel::find($id);
            $user->password = $password;
            $user->update();
            return redirect()->back()->with(['success' => 'Password Berhasil Diperbarui']);
        } else {
            return redirect()->back()->with(['failed' => 'Password Salah']);
        }
    }

    // Profile User
    public function dataProfileUser()
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->with('provinsi.PemilikMenara')->with('kabupaten.PemilikMenara')->with('kecamatan.PemilikMenara')->with('desa.PemilikMenara')->with('perusahaan.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

        if ($dataUser->NPWP == NULL) {
            return redirect()->route('biodata');
        }

        $provinsi = ProvinsiModel::get();
        $kabupaten = KabupatenModel::get();
        $kecamatan = KecamatanModel::get();
        $desa = DesaModel::get();

        // dd($dataUser);

        return view("dashboard.akun.profile.user", compact("dataUser", "provinsi", "kabupaten", "kecamatan", "desa"));
    }

    public function getkabupaten($id)
    {
        $dataKabupaten = KabupatenModel::where('id_provinsi', $id)->get();

        return response()->json($dataKabupaten);
    }

    public function getkecamatan($id)
    {
        $dataKecamatan = KecamatanModel::where('id_kabupaten', $id)->get();

        return response()->json($dataKecamatan);
    }

    public function getDesa($id)
    {
        $dataDesa = DesaModel::where('id_kecamatan', $id)->get();

        return response()->json($dataDesa);
    }

    public function updateProfileUserUser()
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kewarganegaraan' => 'required',
            'email' => 'required',
            'noKTP' => 'required',
            'no_telp' => 'required',
            'NPWP' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
            'username' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
        }

        $dataUser = UserModel::find($id);

        if ($dataUser->username == $request->username) {
            $editPemilikMenara = PemilikMenaraModel::where("id_user", $id)->first();
            $editPemilikMenara->id_provinsi = $request->provinsi;
            $editPemilikMenara->id_kabupaten = $request->kabupaten;
            $editPemilikMenara->id_kecamatan = $request->kecamatan;
            $editPemilikMenara->id_desa = $request->desa;
            $editPemilikMenara->nama = $request->nama;
            $editPemilikMenara->no_ktp = $request->noKTP;
            $editPemilikMenara->npwp = $request->NPWP;
            $editPemilikMenara->kewarganegaraan = $request->kewarganegaraan;
            $editPemilikMenara->alamat = $request->alamat;
            $editPemilikMenara->no_telp = $request->no_telp;
            $editPemilikMenara->email = $request->email;
            $editPemilikMenara->update();
            return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
        }

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $editUser = UserModel::find($id);
            $editUser->username = $request->username;
            $editUser->update();

            $editPemilikMenara = PemilikMenaraModel::where("id_user", $id)->first();
            $editPemilikMenara->id_provinsi = $request->provinsi;
            $editPemilikMenara->id_kabupaten = $request->kabupaten;
            $editPemilikMenara->id_kecamatan = $request->kecamatan;
            $editPemilikMenara->id_desa = $request->desa;
            $editPemilikMenara->nama = $request->nama;
            $editPemilikMenara->no_ktp = $request->noKTP;
            $editPemilikMenara->npwp = $request->NPWP;
            $editPemilikMenara->kewarganegaraan = $request->kewarganegaraan;
            $editPemilikMenara->alamat = $request->alamat;
            $editPemilikMenara->no_telp = $request->no_telp;
            $editPemilikMenara->email = $request->email;
            $editPemilikMenara->update();
            return redirect()->back()->with(['success' => 'Profile Berhasil Di Edit']);
        } else {
            return redirect()->back()->with(['failed' => 'Username Sudah Dipakai']);
        }
    }

    public function updateProfilePasswordUser($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'passwordLama' => 'required',
            'passwordBaru' => 'required',
            'passwordConfirm' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
        }

        $dataUser = UserModel::find($id);

        if (Hash::check($request->passwordLama, $dataUser->password)) {
            $password = Hash::make($request->password);

            $user = UserModel::find($id);
            $user->password = $password;
            $user->update();
            return redirect()->back()->with(['success' => 'Password Berhasil Diperbarui']);
        } else {
            return redirect()->back()->with(['failed' => 'Password Salah']);
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
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
        }

        $password = Hash::make($request->password);

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $newUser = new UserModel();
            $newUser->username = $request->username;
            $newUser->password = $password;
            $newUser->kategori = 'Super Admin';
            $newUser->verified_at = date("Y-m-d H:i:s");
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
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
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
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
        }

        $password = Hash::make($request->password);

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $newUser = new UserModel();
            $newUser->username = $request->username;
            $newUser->password = $password;
            $newUser->kategori = 'Admin';
            $newUser->verified_at = date("Y-m-d H:i:s");
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
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
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
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
        }

        $password = Hash::make($request->password);

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $newUser = new UserModel();
            $newUser->username = $request->username;
            $newUser->password = $password;
            $newUser->kategori = 'Tim Administratif';
            $newUser->verified_at = date("Y-m-d H:i:s");
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
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
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
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
        }

        $password = Hash::make($request->password);

        $cekUsername = UserModel::where("username", $request->username)->first();
        if ($cekUsername == NULL) {
            $newUser = new UserModel();
            $newUser->username = $request->username;
            $newUser->password = $password;
            $newUser->kategori = 'Tim Lapangan';
            $newUser->verified_at = date("Y-m-d H:i:s");
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
            return redirect()->back()->with(['failed' => 'Terdapat Field Yang Kosong']);
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
}
