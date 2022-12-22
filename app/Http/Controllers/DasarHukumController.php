<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DasarHukumModel;
use App\SuperAdminModel;
use App\AdminModel;


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
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }
        
        $dataDasarHukum = DasarHukumModel::get();

        return view("dashboard.dasarhukum.data", compact("dataUser", "dataDasarHukum"));
    }

    public function createDasarHukum()
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }
        

        return view("dashboard.dasarhukum.create", compact("dataUser"));
    }

    public function insertDasarHukum(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_dasarHukum' => 'required',
            'nama_dasarHukum' => 'required',
            'file_dasarHukum' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

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

        return redirect()->route('dataDasarHukum')->with(['success' => 'Dasar Hukum Berhasil Dibuat']);
    }

    public function detailDasarHukum($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataDasarHukum = DasarHukumModel::find($id);

        return view("dashboard.dasarhukum.detail", compact("dataUser", "dataDasarHukum"));
    }

    public function downloadDasarHukum($id)
    {
        $data = DasarHukumModel::find($id);
        $nama = $data->nama;
        $file = '/public/DasarHukum/'. $nama . '.pdf';

        return storage::disk('local')->download($file);
    }

    public function editDasarHukum($id)
    {
        if (Auth::user()->kategori == "Super Admin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $dataDasarHukum = DasarHukumModel::find($id);

        return view("dashboard.dasarhukum.edit", compact("dataUser", "dataDasarHukum"));
    }

    public function updateDasarHukum($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_dasarHukum' => 'required',
            'nama_dasarHukum' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        if ($request->file_dasarHukum) {
            $file = $request->file('file_dasarHukum');
            $extension = $file->getClientOriginalExtension();
            $nama = $request->nama_dasarHukum . '.' . $extension;
            Storage::putFileAs('public/DasarHukum', $request->file('file_dasarHukum'), $nama);

            $updateDasarHukum = DasarHukumModel::find($id);
            $updateDasarHukum->nama = $request->nama_dasarHukum;
            $updateDasarHukum->no_DasarHukum = $request->no_dasarHukum;
            $updateDasarHukum->file_Dasarhukum = "/storage/DasarHukum/" . $nama;
            $updateDasarHukum->tanggal = Date('Y-m-d');
            $updateDasarHukum->update();

            return redirect()->route('dataDasarHukum')->with(['success' => 'Dasar Hukum Berhasil Diperbarui']);
        } else {
            $updateDasarHukum = DasarHukumModel::find($id);
            $updateDasarHukum->nama = $request->nama_dasarHukum;
            $updateDasarHukum->no_DasarHukum = $request->no_dasarHukum;
            $updateDasarHukum->tanggal = Date('Y-m-d');
            $updateDasarHukum->update();
        }
    }

    public function deleteDasarHukum($id)
    {
        $DasarHukum = DasarHukumModel::find($id);
        $nama = $DasarHukum->nama;
        $file = '/public/DasarHukum/'. $nama . '.pdf';
        storage::disk('local')->delete($file);
        $DasarHukum->delete();
        
        return redirect()->back()->with(['success' => 'Dasar Hukum Berhasil Dihapus']);
    }
}
