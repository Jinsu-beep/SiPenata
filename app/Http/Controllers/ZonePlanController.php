<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\ZonePlanModel;
use App\SuperAdminModel;
use App\AdminModel;
use App\ProvinsiModel;
use App\MenaraModel;

class ZonePlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataZonePlan()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }
        
        $dataZonePlan = ZonePlanModel::get();

        return view("dashboard.zone_plan.data", compact("dataUser", "dataZonePlan"));
    }

    public function createZonePlan()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataProvinsi = ProvinsiModel::get();
        $zonePlanAvailable = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->with('Menara.ZonePlan')->where('status', 'available')->get();
        $zonePlanUsed = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->with('Menara.ZonePlan')->where('status', 'used')->get();
        $zonePlanTerlarang = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->where('status', 'terlarang')->get();

        return view("dashboard.zone_plan.create", compact("dataUser", "dataProvinsi", "zonePlanAvailable", "zonePlanUsed", "zonePlanTerlarang"));
    }

    public function insertZonePlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'rad' => 'required',
            'status' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'batasMenara' => 'required',
            'detail' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $newZonePlan = new ZonePlanModel();
        $newZonePlan->nama = $request->nama;
        $newZonePlan->lat = $request->lat;
        $newZonePlan->long = $request->lng;
        $newZonePlan->radius = $request->rad;
        $newZonePlan->status = $request->status;
        $newZonePlan->id_provinsi = $request->provinsi;
        $newZonePlan->id_kabupaten = $request->kabupaten;
        $newZonePlan->id_kecamatan = $request->kecamatan;
        $newZonePlan->id_desa = $request->desa;
        $newZonePlan->batas_menara = $request->batasMenara;
        $newZonePlan->jumlah_menara = 0;
        $newZonePlan->detail = $request->detail;
        $newZonePlan->save();

        return redirect()->route('dataZonePlan')->with(['success' => 'Zone Plan Berhasil Dibuat']);
    }

    public function detailZonePlan($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataZonePlan = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->with('Menara.ZonePlan')->find($id);
        $menara = MenaraModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->where('id_zonePlan', $id)->get();

        return view("dashboard.zone_plan.detail", compact("dataUser", "dataZonePlan", "menara"));
    }

    public function editZonePlan($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataProvinsi = ProvinsiModel::get();
        $dataZonePlan = ZonePlanModel::find($id);
        
        $zonePlanAvailable = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->with('Menara.ZonePlan')->where('status', 'available')->get();
        $zonePlanUsed = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->with('Menara.ZonePlan')->where('status', 'used')->get();
        $zonePlanTerlarang = ZonePlanModel::with('Provinsi.ZonePlan')->with('Kabupaten.ZonePlan')->with('Kecamatan.ZonePlan')->with('Desa.ZonePlan')->where('status', 'terlarang')->get();

        return view("dashboard.zone_plan.edit", compact("dataUser", "dataZonePlan", "dataProvinsi", "zonePlanAvailable", "zonePlanUsed", "zonePlanTerlarang"));
    }

    public function updateZonePlan($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'rad' => 'required',
            'status' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'batasMenara' => 'required',
            'detail' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $updateZonePlan = ZonePlanModel::find($id);
        $updateZonePlan->nama = $request->nama;
        $updateZonePlan->lat = $request->lat;
        $updateZonePlan->long = $request->lng;
        $updateZonePlan->radius = $request->rad;
        $updateZonePlan->status = $request->status;
        $updateZonePlan->id_provinsi = $request->provinsi;
        $updateZonePlan->id_kabupaten = $request->kabupaten;
        $updateZonePlan->id_kecamatan = $request->kecamatan;
        $updateZonePlan->id_desa = $request->desa;
        $updateZonePlan->batas_menara = $request->batasMenara;
        $updateZonePlan->detail = $request->detail;
        $updateZonePlan->update();

        return redirect()->route('dataZonePlan')->with(['success' => 'Zone Plan Berhasil Diperbarui']);
    }

    public function deleteZonePlan($id)
    {
        $dataZonePlan = ZonePlanModel::find($id);
        $dataZonePlan->delete();

        return redirect()->back()->with(['success' => 'Zone Plan Berhasil Di Hapus']);
    }
}
