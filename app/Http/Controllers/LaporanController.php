<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\SuperAdminModel;
use App\AdminModel;
use App\PemilikMenaraModel;
use App\MenaraModel;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function laporan()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }
        $perusahaan = PemilikMenaraModel::with('Perusahaan.PemilikMenara')->get();

        return view("dashboard.laporan.laporan", compact("dataUser", "perusahaan"));
    }

    public function getLaporanMenara($id)
    {
        if ($id == '0') {
            $menara = MenaraModel::with('PemilikMenara.Menara')->with('Kecamatan.Menara')->get();
        } else {
            $menara = MenaraModel::with('PemilikMenara.Menara')->with('Kecamatan.Menara')->where('id_pemilik_menara', $id)->get();
        }

        return response()->json($menara);
    }

    public function downloadLaporan($id)
    {
        if ($id == '0') {
            $menara = MenaraModel::with('PemilikMenara.Menara')->with('Kecamatan.Menara')->get();
        } else {
            $menara = MenaraModel::with('PemilikMenara.Menara')->with('Kecamatan.Menara')->where('id_pemilik_menara', $id)->get();
        }

        $pdf = PDF::loadview('dashboard.laporan.pdf',['menara'=>$menara]);
        return $pdf->download('laporan.pdf');
    }
}