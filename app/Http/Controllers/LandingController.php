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
        $zonePlanTerlarang = ZonePlanModel::where('status', 'terlarang')->get();

        return view("home.zone_plan", compact("zonePlanAvailable", "zonePlanUsed", "zonePlanTerlarang"));
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
    
    public function analisaLokasi($lat, $lng)
    {
        $statusZona = 0;
        $statusMenara = 0;
        $data = [];

        $zoneplan = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->get();
        $menara = MenaraModel::get();

        foreach ($zoneplan as $zp) {
            $theta = $zp->long - $lng;
            $miles = (sin(deg2rad($zp->lat)) * sin(deg2rad($lat))) + (cos(deg2rad($zp->lat)) * cos(deg2rad($lat)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 *1.1515;
            $km = $miles * 1.609344;
            $meter = $km * 1000;

            if ($meter <= $zp->radius) {
                foreach ($menara as $m) {
                    $thetas = $m->long - $lng;
                    $mile = (sin(deg2rad($m->lat)) * sin(deg2rad($lat))) + (cos(deg2rad($m->lat)) * cos(deg2rad($lat)) * cos(deg2rad($thetas)));
                    $mile = acos($mile);
                    $mile = rad2deg($mile);
                    $mile = $mile * 60 *1.1515;
                    $kms = $mile * 1.609344;
                    $meters = $kms * 1000;

                    if ($meters <= 350) {
                        $statusMenara = 1;
                    }
                }
                $statusZona = 1;
                $data['statusZona'] = $statusZona;
                $data['statusMenara'] = $statusMenara;
                $data['zp'] = $zp;
                // $data = [$status, $zp, $zp->Provinsi, $zp->Kabupaten, $zp->Kecamatan, $zp->Desa];
                return response()->json($data);
            }
        }
        
        $data['statusZona'] = $statusZona;

        return response()->json($data);
    }
}
