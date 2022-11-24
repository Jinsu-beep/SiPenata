<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\SuperAdminModel;
use App\AdminModel;
use App\TimAdministratifModel;
use App\TimLapanganModel;
use App\BupatiModel;
use App\ProviderModel;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataProvider()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataProvider = ProviderModel::get();

        return view("dashboard.provider.data", compact("dataUser", "dataProvider"));
    }

    public function insertProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }
        
        $newProvider = new ProviderModel();
        $newProvider->nama = $request->provider;
        $newProvider->save();

        return redirect()->back()->with(['success' => 'Provider Berhasil Di Tambah']);
    }

    public function getProvider($id)
    {
        $getProvider  = ProviderModel::where('id', $id)->first();
        
        return response()->json($getProvider);
    }

    public function updateProvider($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $editProvider = ProviderModel::find($id);
        $editProvider->nama = $request->provider;
        $editProvider->update();

        return redirect()->back()->with(['success' => 'Provider Berhasil Di Edit']);
    }

    public function deleteProvider($id)
    {
        $deleteProvider = ProviderModel::find($id);
        $deleteProvider->delete();

        return redirect()->back()->with(['success' => 'Provider Berhasil Di Hapus']);
    }
}
