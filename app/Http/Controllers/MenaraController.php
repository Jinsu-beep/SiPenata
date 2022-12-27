<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\MenaraModel;
use App\SuperAdminModel;
use App\AdminModel;
use App\TimAdministratifModel;
use App\TimLapanganModel;
use App\PemilikMenaraModel;
use App\UserModel;
use App\ProviderModel;
use App\PenggunaanMenaraModel;

class MenaraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataMenara()
    {
        if (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();

            $dataMenara = MenaraModel::with("PemilikMenara.Menara")->with("Kecamatan.Menara")->get();

            return view("dashboard.menara.data", compact("dataUser", "dataMenara"));

        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
            $dataMenara = MenaraModel::with("PemilikMenara.Menara")->with("Kecamatan.Menara")->get();

            return view("dashboard.menara.data", compact("dataUser", "dataMenara"));
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
            $dataMenara = MenaraModel::with("PemilikMenara.Menara")->with("Kecamatan.Menara")->where("id_pemilik_menara", $dataUser->id)->get();

            return view("dashboard.menara.data", compact("dataUser", "dataMenara"));
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
            $dataMenara = MenaraModel::with("PemilikMenara.Menara")->get();

            return view("dashboard.menara.data", compact("dataUser", "dataMenara"));
        }
    }

    public function detailMenara($id)
    {
        if (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $provider = ProviderModel::get();

        $detailMenara = MenaraModel::with('Provinsi.Menara')->with('kabupaten.Menara')->with('Kecamatan.Menara')->with('Desa.Menara')->find($id);
        $dataPengguna = PenggunaanMenaraModel::with('Menara.PenggunaanMenara')->with('Provider.PenggunaanMenara')->where('id_menara', $id)->get();

        return view("dashboard.menara.detail", compact("dataUser", "detailMenara", "dataPengguna", "provider"));
    }

    public function updateMenara($id, Request $request)
    {
        // dd($request);
        if ($request->file_pembangunan) {
            $filePembangunan = $request->file('file_pembangunan');
            $extensionPembangunan = $filePembangunan->getClientOriginalExtension();
            $namaPembangunan = 'Pembangunan.' . $extensionPembangunan;
            Storage::putFileAs('public/Menara/' . $id, $request->file('file_pembangunan'), $namaPembangunan);
        }

        if ($request->file_operasional) {
            $fileOperasional = $request->file('file_operasional');
            $extensionOperasional = $fileOperasional->getClientOriginalExtension();
            $namaOperasional = 'Operasional.' . $extensionOperasional;
            Storage::putFileAs('public/Menara/' . $id, $request->file('file_operasional'), $namaOperasional);
        }

        if ($request->fotoMenara) {
            $fotoMenara = $request->file('fotoMenara');
            $fotoMenara = $fotoMenara->getClientOriginalExtension();
            $fotoMenara = 'FotoMenara.' . $fotoMenara;
            Storage::putFileAs('public/Menara/' . $id, $request->file('fotoMenara'), $fotoMenara);
        }

        $updateMenara = MenaraModel::find($id);
        if ($request->tanggalPembuatan) {
            $updateMenara->tanggal_pembuatan = $request->tanggalPembuatan;
        }
        if ($request->file_pembangunan) {
            $updateMenara->file_suratIzinPembangunan = "/storage/Menara/" . $id . '/' . $namaPembangunan;
        }
        if ($request->file_operasional) {
            $updateMenara->file_suratIzinOperasional = "/storage/Menara/" . $id . '/' . $namaOperasional;
        }
        if ($request->fotoMenara) {
            $updateMenara->foto = "/storage/Menara/" . $id . '/' . $fotoMenara;
        }
        $updateMenara->update();

        return redirect()->back()->with(['success' => 'Menara Berhasil Diupdate']);
    }

    public function tambahPengguna($id, Request $request)
    {
        $pengguna = new PenggunaanMenaraModel();
        $pengguna->id_provider = $request->pengguna;
        $pengguna->id_menara = $id;
        $pengguna->save();

        return redirect()->back()->with(['success' => 'Pengguna Berhasil Ditambah']);
    }

    public function deletePengguna($id)
    {
        $pengguna = PenggunaanMenaraModel::find($id);
        $pengguna->delete();

        return redirect()->back()->with(['success' => 'Pengguna Berhasil Dihapus']);
    }
}
