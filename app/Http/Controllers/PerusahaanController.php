<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\PerusahaanModel;
use App\PemilikMenaraModel;
use App\SuperAdminModel;
use App\TimAdministratifModel;
use App\TimLapanganModel;
use App\BupatiModel;

class PerusahaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPerusahaan()
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

        $dataPerusahaan = PemilikMenaraModel::with('Perusahaan.PemilikMenara')->where('status', 'Aktif')->get();
        // dd($dataPerusahaan);

        return view("dashboard.perusahaan.data", compact("dataUser", "dataPerusahaan"));
    }

    public function detailPerusahaan($id)
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

        $dataPerusahaan = PerusahaanModel::with('Provinsi.Perusahaan', 'Kabupaten.Perusahaan', 'Kecamatan.Perusahaan', 'Desa.Perusahaan')->find($id);

        return view("dashboard.perusahaan.detail", compact("dataUser", "dataPerusahaan"));
    }
}
