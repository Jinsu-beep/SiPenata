<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function test()
    {
        return view("home.landing-page");
    }

    public function DasarHukum()
    {
        return view("home.dasar_hukum");
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
