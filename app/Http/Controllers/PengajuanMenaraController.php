<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\MenaraModel;
use App\SuperAdminModel;
use App\TimAdministratifModel;
use App\TimLapanganModel;
use App\PemilikMenaraModel;
use App\ProvinsiModel;
use App\KabupatenModel;
use App\KecamatanModel;
use App\DesaModel;
use App\ZonePlanModel;
use App\PersetujuanPendampingModel;

class PengajuanMenaraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPengajuan()
    {
        if (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();

            $dataMenara = MenaraModel::with("PemilikMenara.Menara")->with("Kecamatan.Menara")->get();
            // dd($dataMenara);

            return view("dashboard.pengajuanMenara.data", compact("dataUser", "dataMenara"));

        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
            $dataMenara = MenaraModel::with("PemilikMenara.Menara")->with("Kecamatan.Menara")->get();
            // dd($dataMenara);

            return view("dashboard.pengajuanMenara.data", compact("dataUser", "dataMenara"));
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

            $dataMenara = MenaraModel::with("PemilikMenara.Menara")->with("Kecamatan.Menara")->where("id_pemilik_menara", $dataUser->id)->get();
            // dd($dataMenara);

            return view("dashboard.pengajuanMenara.data", compact("dataUser", "dataMenara"));

        }
    }

    public function createPengajuan()
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

        $dataZonePlan = ZonePlanModel::get();

        $provinsi = ProvinsiModel::get();
        $kabupaten = KabupatenModel::get();
        $kecamatan = KecamatanModel::get();
        $desa = DesaModel::get();

        return view("dashboard.pengajuanMenara.create", compact("dataUser", "dataZonePlan", "provinsi", "kabupaten", "kecamatan", "desa"));
    }

    public function test()
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

        return view("dashboard.pengajuanMenara.test", compact("dataUser")); 
    }

    public function insertTest(Request $request)
    {
        // $i = 1;
        // dd($request->lat[$i]);

        $jumlahData = $request->jumlahData;

        for ($i=1; $i <= $jumlahData; $i++) { 
            $newPendamping = new PersetujuanPendampingModel();
            $newPendamping->nama = $request->lat[$i];
            $newPendamping->no_ktp = $request->lot[$i];
            $newPendamping->jarak = $request->let[$i];
            $newPendamping->file_suratPersetujuan = $request->lit[$i];
            $newPendamping->save();
        }

        return redirect()->back()->with(['success' => 'Provider Berhasil Di Hapus']);
    }
}