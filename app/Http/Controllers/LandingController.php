<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\PemilikMenaraModel;
use App\DasarHukumModel;
use App\MenaraModel;
use App\PerusahaanModel;
use App\ZonePlanModel;
use App\PenggunaanMenaraModel;
use App\KecamatanModel;

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
        $zonePlanAvailable = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->with('Menara.ZonePlan')->where('status', 'available')->get();
        $zonePlanUsed = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->with('Menara.ZonePlan')->where('status', 'used')->get();
        $zonePlanTerlarang = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->where('status', 'terlarang')->get();

        return view("home.zone_plan", compact("zonePlanAvailable", "zonePlanUsed", "zonePlanTerlarang"));
    }

    public function data_menara()
    {
        $listPerusahaan = PemilikMenaraModel::with('perusahaan.PemilikMenara')->with('Menara.PemilikMenara')->with('Provinsi.PemilikMenara')->with('Kabupaten.PemilikMenara')->with('Kecamatan.PemilikMenara')->with('Desa.PemilikMenara')->get();
        // dd($listPerusahaan);

        $pemilikMenaraIds = [];
        $kecamatanMenaraIds = [];

        $menara = MenaraModel::with('PemilikMenara.Menara')
        ->with('Provinsi.Menara')->with('Kabupaten.Menara')
        ->with('Kecamatan.Menara')
        ->with('Desa.Menara')
        ->with('PenggunaanMenara.Menara')
        ->get();

        $kecamatan = KecamatanModel::where('id_kabupaten', 7)
        ->get();

        $penggunaMenara = PenggunaanMenaraModel::with('Menara.PenggunaanMenara')->with('Provider.PenggunaanMenara')->get();

        // dd(csrf_token());

        $csrf =  csrf_token();

        return view("home.data_menara", compact("listPerusahaan", "menara", "penggunaMenara", "csrf", "kecamatan"));
    }

    public function getMenara(Request $request)
    {
        $pemilikMenaraIds = $request->idPemilikMenara;
        $kecamatanMenaraIds = $request->idKecamatan;

        if ($request->idPemilikMenara) {
            if ($request->idKecamatan) {
                $menara = MenaraModel::with('PemilikMenara.Menara')
                ->with('Provinsi.Menara')
                ->with('Kabupaten.Menara')
                ->with('Kecamatan.Menara')
                ->with('Desa.Menara')
                ->with('PenggunaanMenara.Menara')
                ->whereHas('PemilikMenara', function($query) use ($pemilikMenaraIds) {
                    $query->whereIn('id', $pemilikMenaraIds);
                })
                ->whereHas('Kecamatan', function($query) use ($kecamatanMenaraIds) {
                    $query->whereIn('id', $kecamatanMenaraIds);
                })->get();
            } else {
                $menara = MenaraModel::with('PemilikMenara.Menara')
                ->with('Provinsi.Menara')
                ->with('Kabupaten.Menara')
                ->with('Kecamatan.Menara')
                ->with('Desa.Menara')
                ->with('PenggunaanMenara.Menara')
                ->whereHas('PemilikMenara', function($query) use ($pemilikMenaraIds) {
                    $query->whereIn('id', $pemilikMenaraIds);
                })->get();
            }
        } elseif ($request->idKecamatan) {
            $menara = MenaraModel::with('PemilikMenara.Menara')
            ->with('Provinsi.Menara')
            ->with('Kabupaten.Menara')
            ->with('Kecamatan.Menara')
            ->with('Desa.Menara')
            ->with('PenggunaanMenara.Menara')
            ->whereHas('Kecamatan', function($query) use ($kecamatanMenaraIds) {
                $query->whereIn('id', $kecamatanMenaraIds);
            })->get();
        } else {
            $menara = [];
        }

        // $menara = MenaraModel::with('PemilikMenara.Menara')
        // ->with('Provinsi.Menara')
        // ->with('Kabupaten.Menara')
        // ->with('Kecamatan.Menara')
        // ->with('Desa.Menara')
        // ->with('PenggunaanMenara.Menara')
        // ->whereHas('PemilikMenara', function($query) use ($pemilikMenaraIds) {
        //     $query->whereIn('id', $pemilikMenaraIds);
        // })
        // ->whereHas('Kecamatan', function($query) use ($kecamatanMenaraIds) {
        //     $query->whereIn('id', $kecamatanMenaraIds);
        // })->get();

        return response()->json($menara);
    }

    public function test()
    {
        $test = view('home.mapMenara')->render();

        return response()->json($test);
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
