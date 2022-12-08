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

        return view("dashboard.zone_plan.create", compact("dataUser"));
    }

    public function insertZonePlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'rad' => 'required',
            'status' => 'required',
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

        $dataZonePlan = ZoneplanModel::find($id);

        return view("dashboard.zone_plan.detail", compact("dataUser", "dataZonePlan"));
    }

    public function editZonePlan($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataZonePlan = ZoneplanModel::find($id);

        return view("dashboard.zone_plan.edit", compact("dataUser", "dataZonePlan"));
    }

    public function updateZonePlan($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'rad' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $newZonePlan = ZonePlanModel::find($id);
        $newZonePlan->nama = $request->nama;
        $newZonePlan->lat = $request->lat;
        $newZonePlan->long = $request->lng;
        $newZonePlan->radius = $request->rad;
        $newZonePlan->status = $request->status;
        $newZonePlan->update();

        return redirect()->route('dataZonePlan')->with(['success' => 'Zone Plan Berhasil Diperbarui']);
    }

    public function deleteZonePlan($id)
    {
        $dataZonePlan = ZonePlanModel::find($id);
        $dataZonePlan->delete();

        return redirect()->back()->with(['success' => 'Zone Plan Berhasil Di Hapus']);
    }
}
