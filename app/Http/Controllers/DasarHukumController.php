<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
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
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Provider") {
            $dataUser = ProviderModel::with('user.Provider')->whereIn("id_user", [Auth::user()->id])->first();
        }
        
        $dataDasarHukum = DasarHukumModel::get();

        return view("dashboard.dasarhukum.data", compact("dataUser", "dataDasarHukum"));
    }

    public function createDasarHukum()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Provider") {
            $dataUser = ProviderModel::with('user.Provider')->whereIn("id_user", [Auth::user()->id])->first();
        }
        

        return view("dashboard.dasarhukum.create", compact("dataUser"));
    }

    public function insertDasarHukum(Request $request)
    {
        $file = $request->file('file_dasarHukum');
        $extension = $file->getClientOriginalExtension();
        $nama = $request->nama_dasarHukum . '.' . $extension;
        Storage::putFileAs('public/DasarHukum', $request->file('file_dasarHukum'), $nama);

        $newDasarHukum = new DasarHukumModel();
        $newDasarHukum->nama = $request->nama_dasarHukum;
        $newDasarHukum->no_DasarHukum = $request->no_dasarHukum;
        $newDasarHukum->file_Dasarhukum = "/storage/DasarHukum/" . $nama;
        $newDasarHukum->tanggal = Date('Y-m-d');
        $newDasarHukum->save();

        return redirect()->route('dataDasarHukum')->with('statusInput', 'Insert Success');
    }

    public function detailDasarHukum($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Provider") {
            $dataUser = ProviderModel::with('user.Provider')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataDasarHukum = DasarHukumModel::find($id);

        return view("dashboard.dasarhukum.detail", compact("dataUser", "dataDasarHukum"));
    }
}
