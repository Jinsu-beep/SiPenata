<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\PemilikMenaraModel;
use App\DasarHukumModel;
use App\MenaraModel;
use App\PerusahaanModel;
use App\ZonePlanModel;

class LandingController extends Controller
{
    public function home()
    {
        $jumlahMenara = MenaraModel::get()->count();
        $jumlahZonePlan = ZonePlanModel::get()->count();
        $jumlahPerusahaan = PerusahaanModel::where('status', 'diterima')->get()->count();

        return view("home.landing-page", compact("jumlahMenara", "jumlahZonePlan", "jumlahPerusahaan"));
    }

    public function dasarHukum()
    {
        $dataDasarHukum = DasarHukumModel::get();

        return view("home.dasar_hukum", compact("dataDasarHukum"));
    }

    public function getDasarHukum($id)
    {
        $getDasarHukum = DasarHukumModel::find($id);

        return response()->json($getDasarHukum);
    }

    public function zone_plan()
    {
        $zonePlanAvailable = ZonePlanModel::where('status', 'available')->get();
        $zonePlanUsed = ZonePlanModel::where('status', 'used')->get();

        return view("home.zone_plan", compact("zonePlanAvailable", "zonePlanUsed"));
    }

    public function data_menara()
    {
        $listPerusahaan = PemilikMenaraModel::with('perusahaan.PemilikMenara')->with('Menara.PemilikMenara')->get();
        // dd($listPerusahaan);
        $warna =["#E51DF0", "#eb4034"];

        return view("home.data_menara", compact("listPerusahaan", "warna"));
    }

    public function getMenara($id)
    {
        $menara = MenaraModel::where('id_pemilik_menara', $id)->get();

        return response()->json($menara);
    }
}
