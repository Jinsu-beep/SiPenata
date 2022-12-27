<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerifikasiMail;
use App\AdminModel;
use App\UserModel;
use App\PemilikMenaraModel;
use App\ProvinsiModel;
use App\KabupatenModel;
use App\KecamatanModel;
use App\DesaModel;
use App\PerusahaanModel;

class RegistrasiController extends Controller
{
    public function registrasiForm()
    {
        $dataProvinsi = ProvinsiModel::get();

        return view('registrasi.registrasi', compact('dataProvinsi'));
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

    public function insertRegistrasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'noKTP' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'password_ulang' => 'required',
        ]);

        if($validator->fails()){
            // dd($validator);
            return back()->withErrors($validator);
        }

        $cekKTP = PemilikMenaraModel::where('no_ktp', $request->noKTP)->first();
        if ($cekKTP) {
            return back()->with(['failed' => 'No KTP Sudah Digunakan']);
        }
        $cekEmail = PemilikMenaraModel::where('email', $request->email)->first();
        if ($cekEmail) {
            return back()->with(['failed' => 'Email Sudah Terdaftar']);
        }
        $cekUsername = UserModel::where('username', $request->username)->first();
        if ($cekUsername) {
            return back()->with(['failed' => 'Username Sudah Terdaftar']);
        }
        if ($request->password != $request->password_ulang) {
            return back()->with(['failed' => 'Password Tidak Sama']);
        }

        $password = Hash::make($request->password);
        $token = str::random(16);

        $newUser = new UserModel();
        $newUser->username = $request->username;
        $newUser->password = $password;
        $newUser->kategori = 'Pemilik Menara';
        $newUser->token = $token;
        $newUser->save();

        $newPemilikMenara = new PemilikMenaraModel();
        $newPemilikMenara->id_user = $newUser->id;
        $newPemilikMenara->nama = $request->nama;
        $newPemilikMenara->no_ktp = $request->noKTP;
        $newPemilikMenara->email = $request->email;
        $newPemilikMenara->save();

        $details = [
            'title' => 'Verifikasi Email SiPenata',
            'body' => 'Silahkan klik pada link berikut untuk mengaktifkan Akun',
            'token' => $token,
        ];
           
        Mail::to($request->email)->send(new \App\Mail\VerifikasiMail($details));

        return redirect()->route('registrasiSukses');
    }

    public function verifikasi($token)
    {
        $user = UserModel::where('token', $token)->first();
        $user->verified_at = date("Y-m-d H:i:s");
        $user->update();

        return redirect()->route('verifikasiSukses');
    }
    
    public function registrasiSukses()
    {
        return view('registrasi.regisSukses');
    }
    
    public function verifikasiSukses()
    {
        return view('registrasi.verifikasiSukses');
    }
}
