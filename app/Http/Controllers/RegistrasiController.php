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
        ]);

        if($validator->fails()){
            // dd($validator);
            return back()->withErrors($validator);
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

    public function insert(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'Nama' => 'required',
            'Kewarganegaraan' => 'required',
            'Email' => 'required',
            'NoKTP' => 'required',
            'NoTelp' => 'required',
            'NPWP' => 'required',
            'Provinsi' => 'required',
            'Kabupaten' => 'required',
            'Kecamatan' => 'required',
            'Desa' => 'required',
            'Alamat' => 'required',
            'nama_perusahaan' => 'required',
            'email_perusahaan' => 'required',
            'no_telp_perusahaan' => 'required',
            'provinsi_perusahaan' => 'required',
            'kabupaten_perusahaan' => 'required',
            'kecamatan_perusahaan' => 'required',
            'desa_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'file_aktaPendirian' => 'required',
            'file_tandaDaftar' => 'required',
            'Username' => 'required',
            'Password' => 'required',
        ]);

        if($validator->fails()){
            // dd($validator);
            return back()->withErrors($validator);
        }

        // dd($request);

        $password = Hash::make($request->password);

        $newUser = new UserModel();
        $newUser->username = $request->Username;
        $newUser->password = $password;
        $newUser->kategori = 'Pemilik Menara';
        $newUser->save();

        $file_aktaPendirian = $request->file('file_aktaPendirian');
        $extension_aktaPendirian = $file_aktaPendirian->getClientOriginalExtension();
        $nama_aktaPendirian = 'AktaPendirian.' . $extension_aktaPendirian;
        $file_tandaDaftar = $request->file('file_tandaDaftar');
        $extension_tandaDaftar = $file_tandaDaftar->getClientOriginalExtension();
        $nama_tandaDaftar = 'TandaDaftar.' . $extension_tandaDaftar;

        $newPerusahaan = new PerusahaanModel;
        $newPerusahaan->nama = $request->nama_perusahaan;
        $newPerusahaan->no_telp = $request->no_telp_perusahaan;
        $newPerusahaan->id_provinsi = $request->provinsi_perusahaan;
        $newPerusahaan->id_kabupaten = $request->kabupaten_perusahaan;
        $newPerusahaan->id_kecamatan = $request->kecamatan_perusahaan;
        $newPerusahaan->id_desa = $request->desa_perusahaan;
        $newPerusahaan->alamat = $request->alamat_perusahaan;
        $newPerusahaan->email = $request->email_perusahaan;
        $newPerusahaan->save();

        Storage::putFileAs('public/Perusahaan/' . $newPerusahaan->id, $request->file('file_aktaPendirian'), $nama_aktaPendirian);
        Storage::putFileAs('public/Perusahaan/' . $newPerusahaan->id, $request->file('file_tandaDaftar'), $nama_tandaDaftar);

        $editPerusahaan = PerusahaanModel::find($newPerusahaan->id);
        $editPerusahaan->file_AktaPendirianPerusahaan = "/storage/Perusahaan/" . $newPerusahaan->id . "/" . $nama_aktaPendirian;
        $editPerusahaan->file_TandaDaftarPerusahaan = "/storage/Perusahaan/" . $newPerusahaan->id . "/" . $nama_tandaDaftar;
        $editPerusahaan->update();
        
        $newPemilikMenara = new PemilikMenaraModel();
        $newPemilikMenara->id_user = $newUser->id;
        $newPemilikMenara->id_perusahaan = $newPerusahaan->id;
        $newPemilikMenara->id_provinsi = $request->Provinsi;
        $newPemilikMenara->id_kabupaten = $request->Kabupaten;
        $newPemilikMenara->id_kecamatan = $request->Kecamatan;
        $newPemilikMenara->id_desa = $request->Desa;
        $newPemilikMenara->nama = $request->Nama;
        $newPemilikMenara->no_ktp = $request->NoKTP;
        $newPemilikMenara->npwp = $request->NPWP;
        $newPemilikMenara->kewarganegaraan = $request->Kewarganegaraan;
        $newPemilikMenara->alamat = $request->Alamat;
        $newPemilikMenara->no_telp = $request->NoTelp;
        $newPemilikMenara->email = $request->Email;
        $newPemilikMenara->status = 'Non Aktif';
        $newPemilikMenara->save();

        return redirect()->route('registrasiSukses');
    }

    public function test()
    {
        return view('registrasi.test');
    }

    public function test2()
    {
        if (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }
        $dataProvinsi = ProvinsiModel::get();

        return view('registrasi.test2', compact('dataUser', 'dataProvinsi'));
    }

    public function testEmail()
    {
        $test = now();
        dd($test);

        $details = [
            'title' => 'Verifikasi Email SiPenata',
            'body' => 'Silahkan klik pada link berikut untuk mengaktifkan Akun',
            'token' => '1234567890',
        ];
           
        Mail::to('tyagijisnubagas222@gmail.com')->send(new \App\Mail\VerifikasiMail($details));
        
        dd("Email sudah terkirim.");
    }
}
