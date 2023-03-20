<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\LaporanBerkalaModel;
use App\AdminModel;
use App\TimLapanganModel;
use App\PemilikMenaraModel;
use App\MenaraModel;

class LaporanBerkalaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataLaporanBerkala()
    {
        if (Auth::user()->kategori == "SuperAdmin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
            $laporan = LaporanBerkalaModel::with('Menara.LaporanBerkala')->get();
            return view("dashboard.laporan_berkala.data", compact("dataUser", "laporan"));
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
            $laporan = LaporanBerkalaModel::with('Menara.LaporanBerkala')->get();
            return view("dashboard.laporan_berkala.data", compact("dataUser", "laporan"));
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
            $laporan = LaporanBerkalaModel::with('Menara.LaporanBerkala')->get();
            return view("dashboard.laporan_berkala.data", compact("dataUser", "laporan"));
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
            $laporan = LaporanBerkalaModel::with('Menara.LaporanBerkala')->get();
            return view("dashboard.laporan_berkala.data", compact("dataUser", "laporan"));
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
            $laporan = LaporanBerkalaModel::with('Menara.LaporanBerkala')->where("id_perusahaan", $dataUser->id_perusahaan)->get();
            return view("dashboard.laporan_berkala.data", compact("dataUser", "laporan"));
        }
    }

    public function createLaporanBerkala()
    {
        if (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $perusahaan = PemilikMenaraModel::with('Perusahaan.PemilikMenara')->get();
        $menara = MenaraModel::get();

        return view("dashboard.laporan_berkala.create", compact("dataUser", "perusahaan", "menara"));
    }

    public function insertLaporanBerkala($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'perusahaan' => 'required',
            'menara' => 'required',
            'laporan' => 'required',
            'dokumentasi' => 'required',
        ]);

        if($validator->fails()){
            dd($validator);
            return back()->withErrors($validator);
        }

        // dd($request);

        $gambar = $request->file('dokumentasi');
        $extensionGambar = $gambar->getClientOriginalExtension();
        $namaGambar = 'DokumenKondisi_' . $request->tanggal . '.' . $extensionGambar;
        Storage::putFileAs('public/LaporanKondisi/' . $request->menara . '/' . $request->tanggal, $request->file('dokumentasi'), $namaGambar);

        $newLaporan = new LaporanBerkalaModel();
        $newLaporan->id_perusahaan = $request->perusahaan;
        $newLaporan->id_menara = $request->menara;
        $newLaporan->id_tim_lapangan = $id;
        $newLaporan->tanggal_laporan = $request->tanggal;
        $newLaporan->foto = "/storage/LaporanKondisi/" . $request->menara . "/" . $request->tanggal . "/" . $namaGambar;
        $newLaporan->laporan = $request->laporan;
        $newLaporan->save();
        
        return redirect()->route('dataLaporanBerkala')->with(['success' => 'Laporan Berkala Berhasil Dibuat']);
    }

    public function detailLaporanBerkala($id)
    {
        if (Auth::user()->kategori == "SuperAdmin") {
            $dataUser = SuperAdminModel::with('user.SuperAdmin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Admin") {
            $dataUser = AdminModel::with('user.Admin')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $laporan = LaporanBerkalaModel::with('Menara.LaporanBerkala')->with('Perusahaan.LaporanBerkala')->where('id', $id)->first();
        // dd($laporan);

        return view("dashboard.laporan_berkala.detail", compact("dataUser", "laporan"));
    }

    public function getMenara($id)
    {
        $dataMenara = MenaraModel::where('id_pemilik_menara', $id)->get();

        return response()->json($dataMenara);
    }
}
