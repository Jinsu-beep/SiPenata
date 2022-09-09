<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DasarHukumModel;
use App\SuperAdminModel;
use App\TimAdministratifModel;
use App\TimLapanganModel;
use App\BupatiModel;
use App\PemilikMenaraModel;
use App\ProviderModel;


class DasarHukumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataDasarHukum()
    {
        if (Auth::user()->kategori == "super admin") {
            $dataUser = SuperAdminModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "tim administratif") {
            $dataUser = TimAdministratifModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "tim lapangan") {
            $dataUser = TimLapanganModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "bupati") {
            $dataUser = BupatiModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "pemilik menara") {
            $dataUser = PemilikMenaraModel::whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "provider") {
            $dataUser = ProviderModel::whereIn("id_user", [Auth::user()->id])->first();
        } 

        

        return view("dashboard.dasarhukum.data", compact("dataUser"));
    }
}
