<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\UserModel;
use App\PemilikMenaraModel;
use App\ProviderModel;

class RegistrasiController extends Controller
{
    public function registrasiRole()
    {
        return view('registrasi.pilihRole');
    }

    public function registrasiPemilikMenaraForm()
    {
        return view('registrasi.registrasiPemilikMenara');
    }

    public function registrasiProviderForm()
    {
        return view('registrasi.registrasiProvider');
    }

    public function insertRegistrasiPemilikMenara(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NoKTP' => 'required',
            'FileKTP' => 'required',
            'Nama' => 'required',
            'Kewarganegaraan' => 'required',
            'Email' => 'required',
            'NoTelp' => 'required',
            'NPWP' => 'required',
            'KodePos' => 'required',
            'Provinsi' => 'required',
            'Kabupaten' => 'required',
            'Kecamatan' => 'required',
            'Desa' => 'required',
            'Alamat' => 'required',
            'Username' => 'required',
            'Password' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        // dd($request);

        $password = Hash::make($request->password);

        $newUser = new UserModel();
        $newUser->username = $request->Username;
        $newUser->password = $password;
        $newUser->kategori = 'Pemilik Menara';
        $newUser->save();

        $newPemilikMenara = new PemilikMenaraModel();
        $newPemilikMenara->id_user = $newUser->id;
        $newPemilikMenara->id_provinsi = $request->Provinsi;
        $newPemilikMenara->id_kabupaten = $request->Kabupaten;
        $newPemilikMenara->id_kecamatan = $request->Kecamatan;
        $newPemilikMenara->id_desa = $request->Desa;
        $newPemilikMenara->nama = $request->Nama;
        $newPemilikMenara->no_ktp = $request->NoKTP;
        $newPemilikMenara->file_ktp = $request->FileKTP;
        $newPemilikMenara->npwp = $request->NPWP;
        $newPemilikMenara->kewarganegaraan = $request->Kewarganegaraan;
        $newPemilikMenara->alamat = $request->Alamat;
        $newPemilikMenara->kode_pos = $request->KodePos;
        $newPemilikMenara->no_telp = $request->NoTelp;
        $newPemilikMenara->email = $request->Email;
        $newPemilikMenara->save();

        return redirect()->route('registrasiSukses');
    }
    
    public function insertRegistrasiProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NoKTP' => 'required',
            'FileKTP' => 'required',
            'Nama' => 'required',
            'Kewarganegaraan' => 'required',
            'Email' => 'required',
            'NoTelp' => 'required',
            'NPWP' => 'required',
            'KodePos' => 'required',
            'Provinsi' => 'required',
            'Kabupaten' => 'required',
            'Kecamatan' => 'required',
            'Desa' => 'required',
            'Alamat' => 'required',
            'Username' => 'required',
            'Password' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        // dd($request);

        $password = Hash::make($request->password);

        $newUser = new UserModel();
        $newUser->username = $request->Username;
        $newUser->password = $password;
        $newUser->kategori = 'Provider';
        $newUser->save();

        $newProvider = new ProviderModel();
        $newProvider->id_user = $newUser->id;
        $newProvider->id_provinsi = $request->Provinsi;
        $newProvider->id_kabupaten = $request->Kabupaten;
        $newProvider->id_kecamatan = $request->Kecamatan;
        $newProvider->id_desa = $request->Desa;
        $newProvider->nama = $request->Nama;
        $newProvider->no_ktp = $request->NoKTP;
        $newProvider->file_ktp = $request->FileKTP;
        $newProvider->npwp = $request->NPWP;
        $newProvider->kewarganegaraan = $request->Kewarganegaraan;
        $newProvider->alamat = $request->Alamat;
        $newProvider->kode_pos = $request->KodePos;
        $newProvider->no_telp = $request->NoTelp;
        $newProvider->email = $request->Email;
        $newProvider->save();

        return redirect()->route('registrasiSukses');
    }

    public function registrasiSukses()
    {
        return view('registrasi.regisSukses');
    }
}
