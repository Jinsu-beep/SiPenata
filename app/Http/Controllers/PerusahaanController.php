<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\PerusahaanModel;
use App\PemilikMenaraModel;
use App\SuperAdminModel;
use App\AdminModel;

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
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataPerusahaan = PemilikMenaraModel::with('Perusahaan.PemilikMenara')->where('status', 'Aktif')->get();
        // dd($dataPerusahaan);

        return view("dashboard.perusahaan.data", compact("dataUser", "dataPerusahaan"));
    }

    public function detailPerusahaan($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataPerusahaan = PerusahaanModel::with('Provinsi.Perusahaan', 'Kabupaten.Perusahaan', 'Kecamatan.Perusahaan', 'Desa.Perusahaan')->find($id);

        return view("dashboard.perusahaan.detail", compact("dataUser", "dataPerusahaan"));
    }
}
