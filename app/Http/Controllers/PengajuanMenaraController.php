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
use App\BupatiModel;
use App\PemilikMenaraModel;
use App\ProviderModel;
use App\UserModel;
use App\KecamatanModel;

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
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

            $dataMenara = MenaraModel::with("PemilikMenara.Menara")->with("Kecamatan.Menara")->where("id_pemilik_menara", $dataUser->id)->get();
            // dd($dataMenara);

            return view("dashboard.pengajuanMenara.data", compact("dataUser", "dataMenara"));

        }
    }
}
