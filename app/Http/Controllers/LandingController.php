<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\DasarHukumModel;

class LandingController extends Controller
{
    public function test()
    {
        return view("home.landing-page");
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
        return view("home.zone_plan");
    }

    public function data_menara()
    {
        return view("home.data_menara");
    }
}
