<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\PerusahaanModel;
use App\DetailPerusahaanModel;
use App\PemilikMenaraModel;
use App\SuperAdminModel;
use App\AdminModel;
use App\ProvinsiModel;
use App\KabupatenModel;
use App\KecamatanModel;
use App\DesaModel;

class PerusahaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function createPerusahaan()
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        $dataProvinsi = ProvinsiModel::get();

        return view('dashboard.perusahaan.create', compact("dataUser", "dataProvinsi"));
    }

    public function insertPerusahaan($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
            'file_aktaPendirian' => 'required',
            'file_tandaDaftar' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $newPerusahaan = new PerusahaanModel();
        $newPerusahaan->nama = $request->nama;
        $newPerusahaan->email = $request->email;
        $newPerusahaan->no_telp = $request->no_telp;
        $newPerusahaan->id_provinsi = $request->provinsi;
        $newPerusahaan->id_kabupaten = $request->kabupaten;
        $newPerusahaan->id_kecamatan = $request->kecamatan;
        $newPerusahaan->id_desa = $request->desa;
        $newPerusahaan->alamat = $request->alamat;
        $newPerusahaan->status = 'tunggu persetujuan';
        $newPerusahaan->save();

        $updatePemiliMenara = PemilikMenaraModel::find($id);
        $updatePemiliMenara->id_perusahaan = $newPerusahaan->id;
        $updatePemiliMenara->update();

        $file_aktaPendirian = $request->file('file_aktaPendirian');
        $extension_aktaPendirian = $file_aktaPendirian->getClientOriginalExtension();
        $nama_aktaPendirian = 'AktaPendirian.' . $extension_aktaPendirian;
        $file_tandaDaftar = $request->file('file_tandaDaftar');
        $extension_tandaDaftar = $file_tandaDaftar->getClientOriginalExtension();
        $nama_tandaDaftar = 'TandaDaftar.' . $extension_tandaDaftar;

        Storage::putFileAs('public/Perusahaan/' . $newPerusahaan->id, $request->file('file_aktaPendirian'), $nama_aktaPendirian);
        Storage::putFileAs('public/Perusahaan/' . $newPerusahaan->id, $request->file('file_tandaDaftar'), $nama_tandaDaftar);

        $newDetail1 = new DetailPerusahaanModel();
        $newDetail1->id_perusahaan = $newPerusahaan->id;
        $newDetail1->file = 'TandaDaftarPerusahaan';
        $newDetail1->patch = "/storage/Perusahaan/" . $newPerusahaan->id . "/" . $nama_tandaDaftar;
        $newDetail1->status = 'tunggu persetujuan';
        $newDetail1->tanggal = date("Y-m-d");
        $newDetail1->save();
        
        $newDetail2 = new DetailPerusahaanModel();
        $newDetail2->id_perusahaan = $newPerusahaan->id;
        $newDetail2->file = 'AktaPendirianPerusahaan';
        $newDetail2->patch = "/storage/Perusahaan/" . $newPerusahaan->id . "/" . $nama_aktaPendirian;
        $newDetail2->status = 'tunggu persetujuan';
        $newDetail2->tanggal = date("Y-m-d");
        $newDetail2->save();

        return redirect()->route('detailRegistrasi', ['id' => $perusahaan->id]);
    }

    public function detailRegistrasi($id)
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

        $dataRegistrasi = PerusahaanModel::with('Provinsi.Perusahaan')->with('Kabupaten.Perusahaan')->with('Kecamatan.Perusahaan')->with('Desa.Perusahaan')->where('id', $id)->first();
        $detailPerusahaan1 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'AktaPendirianPerusahaan')->first();
        $detailPerusahaan2 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'TandaDaftarPerusahaan')->first();
        // dd($detailPerusahaan2);

        return view('dashboard.perusahaan.detailRegistrasi', compact("dataUser", "dataRegistrasi", "detailPerusahaan1", "detailPerusahaan2"));
    }

    public function dataPerusahaan()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataPerusahaan = PerusahaanModel::where('status', 'diterima')->get();
        // dd($dataPerusahaan);

        return view("dashboard.perusahaan.data", compact("dataUser", "dataPerusahaan"));
    }

    public function dataRegistrasiPerusahaan()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataPerusahaan = PerusahaanModel::with('PemilikMenara.Perusahaan')->where('status', 'tunggu persetujuan')->get();

        // $dataPemilikMenara = PemilikMenaraModel::with('Perusahaan.PemilikMenara')->where('status', 'Non Aktif')->get();
        // dd($dataPemilikMenara);

        return view("dashboard.Perusahaan.dataRegistrasi", compact("dataUser", "dataPerusahaan"));
    }

    public function detailPerusahaan($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataPerusahaan = PerusahaanModel::with('Provinsi.Perusahaan', 'Kabupaten.Perusahaan', 'Kecamatan.Perusahaan', 'Desa.Perusahaan')->find($id);
        $detailPerusahaan1 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'AktaPendirianPerusahaan')->first();
        $detailPerusahaan2 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'TandaDaftarPerusahaan')->first();

        return view("dashboard.perusahaan.detail", compact("dataUser", "dataPerusahaan", "detailPerusahaan1", "detailPerusahaan2"));
    }

    public function validasiPerusahaan($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $userPemilikMenara = PemilikMenaraModel::with('Provinsi.PemilikMenara', 'Kabupaten.PemilikMenara', 'Kecamatan.PemilikMenara', 'Desa.PemilikMenara')->where('id_perusahaan', $id)->first();
        $perusahaanPemilikMenara = PerusahaanModel::with('Provinsi.Perusahaan', 'Kabupaten.Perusahaan', 'Kecamatan.Perusahaan', 'Desa.Perusahaan')->find($id);
        $detailPerusahaan1 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'AktaPendirianPerusahaan')->first();
        $detailPerusahaan2 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'TandaDaftarPerusahaan')->first();

        // dd($perusahaanPemilikMenara);

        return view("dashboard.Perusahaan.validasi", compact("dataUser", "userPemilikMenara", "perusahaanPemilikMenara", "detailPerusahaan1", "detailPerusahaan2"));
    }

    public function validatePerusahaan($id, Request $request)
    {   
        // dd($request->input('action'));
        switch ($request->input('action')) {
            case 'perbaiki':
                $detailValidate1 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'AktaPendirianPerusahaan')->first();
                $detailValidate1->status = $request->status1;
                $detailValidate1->update();

                $detailValidate2 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'TandaDaftarPerusahaan')->first();
                $detailValidate2->status = $request->status2;
                $detailValidate2->update();

                $validate = PerusahaanModel::find($id);
                $validate->disposisi = $request->disposisi;
                $validate->status = $request->status;
                $validate->update();

                return redirect()->route('dataRegistrasiPerusahaan')->with(['success' => 'Status Berhasil Dirubah']);
                break;

            case 'diterima':
                $detailValidate1 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'AktaPendirianPerusahaan')->first();
                $detailValidate1->status = $request->status1;
                $detailValidate1->update();

                $detailValidate2 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'TandaDaftarPerusahaan')->first();
                $detailValidate2->status = $request->status2;
                $detailValidate2->update();

                $validate = PerusahaanModel::find($id);
                $validate->disposisi = $request->disposisi;
                $validate->status = $request->status;
                $validate->update();

                return redirect()->route('dataRegistrasiPerusahaan')->with(['success' => 'Validasi Perusahaan Berhasil']);
                break;
        }
    }

    public function editPerusahaan($id)
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

        $dataRegistrasi = PerusahaanModel::with('Provinsi.Perusahaan')->with('Kabupaten.Perusahaan')->with('Kecamatan.Perusahaan')->with('Desa.Perusahaan')->where('id', $id)->first();
        $detailPerusahaan1 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'AktaPendirianPerusahaan')->first();
        $detailPerusahaan2 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'TandaDaftarPerusahaan')->first();
        // dd($detailPerusahaan2);

        return view('dashboard.perusahaan.edit', compact("dataUser", "dataRegistrasi", "detailPerusahaan1", "detailPerusahaan2"));
    }

    public function updateRegistrasi($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $dataDetailPerusahaan1 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'AktaPendirianPerusahaan')->first();
        $dataDetailPerusahaan2 = DetailPerusahaanModel::where('id_perusahaan', $id)->where('file', 'TandaDaftarPerusahaan')->first();

        if ($dataDetailPerusahaan1->status == 'perbaiki') {
            // dd('a');
            $validator = Validator::make($request->all(), [
                'file_aktaPendirian' => 'required',
            ]);
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $file_aktaPendirian = $request->file('file_aktaPendirian');
            $extension_aktaPendirian = $file_aktaPendirian->getClientOriginalExtension();
            $nama_aktaPendirian = 'AktaPendirian.' . $extension_aktaPendirian;

            Storage::putFileAs('public/Perusahaan/' . $id, $request->file('file_aktaPendirian'), $nama_aktaPendirian);

            $editDetail1 = DetailPerusahaanModel::find($dataDetailPerusahaan1->id);
            $editDetail1->patch = "/storage/Perusahaan/" . $id . "/" . $nama_aktaPendirian;
            $editDetail1->status = 'tunggu persetujuan';
            $editDetail1->tanggal = date("Y-m-d");
            $editDetail1->update();
        }

        if ($dataDetailPerusahaan2->status == 'perbaiki') {
            $validator = Validator::make($request->all(), [
                'file_tandaDaftar' => 'required',
            ]);
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $file_tandaDaftar = $request->file('file_tandaDaftar');
            $extension_tandaDaftar = $file_tandaDaftar->getClientOriginalExtension();
            $nama_tandaDaftar = 'TandaDaftar.' . $extension_tandaDaftar;

            Storage::putFileAs('public/Perusahaan/' . $id, $request->file('file_tandaDaftar'), $nama_tandaDaftar);

            $editDetail2 = DetailPerusahaanModel::find($dataDetailPerusahaan2->id);
            $editDetail2->patch = "/storage/Perusahaan/" . $id . "/" . $nama_tandaDaftar;
            $editDetail2->status = 'tunggu persetujuan';
            $editDetail2->tanggal = date("Y-m-d");
            $editDetail2->update();
        }

        $editPerusahaan = PerusahaanModel::find($id);
        $editPerusahaan->nama = $request->nama;
        $editPerusahaan->email = $request->email;
        $editPerusahaan->no_telp = $request->no_telp;
        $editPerusahaan->id_provinsi = $request->provinsi;
        $editPerusahaan->id_kabupaten = $request->kabupaten;
        $editPerusahaan->id_kecamatan = $request->kecamatan;
        $editPerusahaan->id_desa = $request->desa;
        $editPerusahaan->alamat = $request->alamat;
        $editPerusahaan->status = 'tunggu persetujuan';
        $editPerusahaan->update();

        return redirect()->route('detailRegistrasi', ['id' => $id]);
    }
}
