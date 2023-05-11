<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\MenaraModel;
use App\SuperAdminModel;
use App\TimAdministratifModel;
use App\TimLapanganModel;
use App\PemilikMenaraModel;
use App\ProvinsiModel;
use App\KabupatenModel;
use App\KecamatanModel;
use App\DesaModel;
use App\ZonePlanModel;
use App\PersetujuanPendampingModel;
use App\PengajuanMenaraModel;
use App\MasterStatusModel;
use App\PengajuanStatusModel;
use App\DetailPengajuanModel;

class PengajuanMenaraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPengajuan()
    {
        if (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
            $dataPengajuan = PengajuanMenaraModel::with("PengajuanStatusTerakhir.PengajuanMenara")->get();
            // $waktu = Carbon::now();
            // dd($dataPengajuan);
            $no = 1;

            return view("dashboard.pengajuanMenara.data", compact("dataUser", "dataPengajuan", "no"));

        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
            $dataPengajuan = PengajuanMenaraModel::with("PengajuanStatusTerakhir.PengajuanMenara")->get();
            // $waktu = Carbon::now();
            // dd($waktu);
            $no = 1;

            return view("dashboard.pengajuanMenara.data", compact("dataUser", "dataPengajuan", "no"));
        } elseif (Auth::user()->kategori == "Pemilik Menara") {
            $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

            $dataMenara = MenaraModel::with("PemilikMenara.Menara")->with("Kecamatan.Menara")->where("id_pemilik_menara", $dataUser->id)->get();
            // dd($dataMenara);

            $dataPengajuan = PengajuanMenaraModel::with("PengajuanStatusTerakhir.PengajuanMenara")->where("id_pemilik_menara", $dataUser->id)->get();
            $status = MasterStatusModel::get();
            // dd($dataPengajuan);
            $no = 1;

            return view("dashboard.pengajuanMenara.data", compact("dataUser", "dataMenara", "dataPengajuan", "status", "no"));

        }
    }

    public function createPengajuan()
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

        $dataZonePlan = ZonePlanModel::get();

        $provinsi = ProvinsiModel::get();
        $kabupaten = KabupatenModel::get();
        $kecamatan = KecamatanModel::get();
        $desa = DesaModel::get();

        return view("dashboard.pengajuanMenara.create", compact("dataUser", "dataZonePlan", "provinsi", "kabupaten", "kecamatan", "desa"));
    }

    public function insertPengajuan($id, Request $request)
    {
        switch ($request->input('action')) {
            case 'draft':
                break;
            
            case 'ajukan':
                $validator = Validator::make($request->all(), [
                    'lat' => 'required',
                    'lng' => 'required',
                    'provinsi' => 'required',
                    'kabupaten' => 'required',
                    'kecamatan' => 'required',
                    'desa' => 'required',
                    'jenisMenara' => 'required',
                    'tinggiMenara' => 'required',
                    'tinggiAntena' => 'required',
                    'luasArea' => 'required',
                    'aksesJalan' => 'required',
                    'statusLahan' => 'required',
                    'namaPemilikTanah' => 'required',
                    'file_KTPPemohon' => 'required',
                    'file_NPWPPemohon' => 'required',
                    'file_fotoPemohon' => 'required',
                    'file_suratKuasa' => 'required',
                    'file_rancangBangun' => 'required',
                    'file_denahBangunan' => 'required',
                    'file_lokasiDanSituasi' => 'required',
                    'file_suratTanah' => 'required',
                    'idZone' => 'required',
                ]);
        
                if($validator->fails()){
                    // dd($validator);
                    return back()->withErrors($validator);
                }

                break;
        }

        $pengajuan = PengajuanMenaraModel::latest('id')->first();
        if ($pengajuan) {
            $kodeRegistrasi = $pengajuan->kode_registrasi + 1;
        } else {
            $kodeRegistrasi = 1;
        }

        $newPengajuan = new PengajuanMenaraModel();
        $newPengajuan->id_pemilik_menara = $id;
        $newPengajuan->id_provinsi = $request->provinsi;
        $newPengajuan->id_kabupaten = $request->kabupaten;
        $newPengajuan->id_kecamatan = $request->kecamatan;
        $newPengajuan->id_desa = $request->desa;
        $newPengajuan->kode_registrasi = $kodeRegistrasi;
        $newPengajuan->lat = $request->lat;
        $newPengajuan->long = $request->lng;
        $newPengajuan->jenis_menara = $request->jenisMenara;
        $newPengajuan->tinggi_menara = $request->tinggiMenara;
        $newPengajuan->tinggi_antena = $request->tinggiAntena;
        $newPengajuan->luas_area = $request->luasArea;
        $newPengajuan->akses_jalan = $request->aksesJalan;
        $newPengajuan->status_lahan = $request->statusLahan;
        $newPengajuan->kepemilikan_tanah = $request->namaPemilikTanah;
        $newPengajuan->jumlah_pendamping = $request->jumlahData;
        $newPengajuan->id_zonePlan = $request->idZone;
        

        switch ($request->input('action')) {
            case 'draft':
                $newPengajuan->status = 'draft';
                $newPengajuan->save();

                break;
            
            case 'ajukan':
                $newPengajuan->status = 'diajukan';
                $newPengajuan->tanggal = Carbon::now();
                $newPengajuan->save();

                $status = MasterStatusModel::where('status', 'Pemeriksaan Oleh Tim Administrasi')->first();

                $newStatus = new PengajuanStatusModel;
                $newStatus->id_status = $status->id;
                $newStatus->id_pengajuan_menara = $newPengajuan->id;
                $newStatus->tanggal_status = Carbon::now();
                $newStatus->save();
                break;
        }

        switch ($request->input('action')) {
            case 'draft':
                $zonePlan = ZonePlanModel::find($request->idZone);
                if ($zonePlan) {
                    $zonePlan->jumlah_menara = $zonePlan->jumlah_menara + 1;
                    if ($zonePlan->jumlah_menara == $zonePlan->batas_menara) {
                        $zonePlan->status = 'used';
                    }
                    $zonePlan->save();
                }

                break;
            
            case 'ajukan':
                $zonePlan = ZonePlanModel::find($request->idZone);
                $zonePlan->jumlah_menara = $zonePlan->jumlah_menara + 1;
                if ($zonePlan->jumlah_menara == $zonePlan->batas_menara) {
                    $zonePlan->status = 'used';
                }
                $zonePlan->save();

                break;
        }

        switch ($request->input('action')) {
            case 'draft':
                $fileKTP = $request->file('file_KTPPemohon');
                if ($fileKTP) {
                    $extensionKTP = $fileKTP->getClientOriginalExtension();
                    $namaKTP = 'KTPPemohon.' . $extensionKTP;
                    Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_KTPPemohon'), $namaKTP);

                    $newDetailPengajuan1 = new DetailPengajuanModel();
                    $newDetailPengajuan1->id_pengajuan_menara = $newPengajuan->id;
                    $newDetailPengajuan1->file = "KTPPemohon";
                    $newDetailPengajuan1->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaKTP;
                    $newDetailPengajuan1->status = "tunggu persetujuan";
                    $newDetailPengajuan1->tanggal = Carbon::now();
                    $newDetailPengajuan1->save();
                }

                $fileNPWP = $request->file('file_NPWPPemohon');
                if ($fileNPWP) {
                    $extensionNPWP = $fileNPWP->getClientOriginalExtension();
                    $namaNPWP = 'NPWPPemohon.' . $extensionNPWP;
                    Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_NPWPPemohon'), $namaNPWP);

                    $newDetailPengajuan2 = new DetailPengajuanModel();
                    $newDetailPengajuan2->id_pengajuan_menara = $newPengajuan->id;
                    $newDetailPengajuan2->file = "NPWPPemohon";
                    $newDetailPengajuan2->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaNPWP;
                    $newDetailPengajuan2->status = "tunggu persetujuan";
                    $newDetailPengajuan2->tanggal = Carbon::now();
                    $newDetailPengajuan2->save();
                }

                $fileFotoPemohon = $request->file('file_fotoPemohon');
                if ($fileFotoPemohon) {
                    $extensionFotoPemohon = $fileFotoPemohon->getClientOriginalExtension();
                    $namaFotoPemohon = 'FotoPemohon.' . $extensionFotoPemohon;
                    Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_fotoPemohon'), $namaFotoPemohon);
                    $newDetailPengajuan3 = new DetailPengajuanModel();
                    $newDetailPengajuan3->id_pengajuan_menara = $newPengajuan->id;
                    $newDetailPengajuan3->file = "FotoPemohon";
                    $newDetailPengajuan3->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaFotoPemohon;
                    $newDetailPengajuan3->status = "tunggu persetujuan";
                    $newDetailPengajuan3->tanggal = Carbon::now();
                    $newDetailPengajuan3->save();
                }

                $fileSuratKuasa = $request->file('file_suratKuasa');
                if ($fileSuratKuasa) {
                    $extensionSuratKuasa = $fileSuratKuasa->getClientOriginalExtension();
                    $namaSuratKuasa = 'SuratKuasa.' . $extensionSuratKuasa;
                    Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_suratKuasa'), $namaSuratKuasa);

                    $newDetailPengajuan4 = new DetailPengajuanModel();
                    $newDetailPengajuan4->id_pengajuan_menara = $newPengajuan->id;
                    $newDetailPengajuan4->file = "SuratKuasa";
                    $newDetailPengajuan4->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaSuratKuasa;
                    $newDetailPengajuan4->status = "tunggu persetujuan";
                    $newDetailPengajuan4->tanggal = Carbon::now();
                    $newDetailPengajuan4->save();
                }

                $fileRancangBangun = $request->file('file_rancangBangun');
                if ($fileRancangBangun) {
                    $extensionRancangBangun = $fileRancangBangun->getClientOriginalExtension();
                    $namaRancangBangun = 'RancangBangun.' . $extensionRancangBangun;
                    Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_rancangBangun'), $namaRancangBangun);

                    $newDetailPengajuan5 = new DetailPengajuanModel();
                    $newDetailPengajuan5->id_pengajuan_menara = $newPengajuan->id;
                    $newDetailPengajuan5->file = "RancangBangun";
                    $newDetailPengajuan5->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaRancangBangun;
                    $newDetailPengajuan5->status = "tunggu persetujuan";
                    $newDetailPengajuan5->tanggal = Carbon::now();
                    $newDetailPengajuan5->save();
                }

                $fileDenahBangunan = $request->file('file_denahBangunan');
                if ($fileDenahBangunan) {
                    $extensionDenahBangunan = $fileDenahBangunan->getClientOriginalExtension();
                    $namaDenahBangunan = 'DenahBangunan.' . $extensionDenahBangunan;
                    Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_denahBangunan'), $namaDenahBangunan);

                    $newDetailPengajuan6 = new DetailPengajuanModel();
                    $newDetailPengajuan6->id_pengajuan_menara = $newPengajuan->id;
                    $newDetailPengajuan6->file = "DenahBangunan";
                    $newDetailPengajuan6->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaDenahBangunan;
                    $newDetailPengajuan6->status = "tunggu persetujuan";
                    $newDetailPengajuan6->tanggal = Carbon::now();
                    $newDetailPengajuan6->save();
                }

                $fileLokasiDanSituasi = $request->file('file_lokasiDanSituasi');
                if ($fileLokasiDanSituasi) {
                    $extensionLokasiDanSituasi = $fileLokasiDanSituasi->getClientOriginalExtension();
                    $namaLokasiDanSituasi = 'LokasiDanSituasi.' . $extensionLokasiDanSituasi;
                    Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_lokasiDanSituasi'), $namaLokasiDanSituasi);

                    $newDetailPengajuan7 = new DetailPengajuanModel();
                    $newDetailPengajuan7->id_pengajuan_menara = $newPengajuan->id;
                    $newDetailPengajuan7->file = "GambarLokasiDanSituasi";
                    $newDetailPengajuan7->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaLokasiDanSituasi;
                    $newDetailPengajuan7->status = "tunggu persetujuan";
                    $newDetailPengajuan7->tanggal = Carbon::now();
                    $newDetailPengajuan7->save();
                }

                $fileSuratTanah = $request->file('file_suratTanah');
                if ($fileSuratTanah) {
                    $extensionSuratTanah = $fileSuratTanah->getClientOriginalExtension();
                    $namaSuratTanah = 'SuratTanah.' . $extensionSuratTanah;
                    Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_suratTanah'), $namaSuratTanah);

                    $newDetailPengajuan8 = new DetailPengajuanModel();
                    $newDetailPengajuan8->id_pengajuan_menara = $newPengajuan->id;
                    $newDetailPengajuan8->file = "SuratTanah";
                    $newDetailPengajuan8->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaSuratTanah;
                    $newDetailPengajuan8->status = "tunggu persetujuan";
                    $newDetailPengajuan8->tanggal = Carbon::now();
                    $newDetailPengajuan8->save();
                }
                
                $jumlahData = $request->jumlahData;

                for ($i=1; $i <= $jumlahData; $i++) { 
                    $filePendamping = $request->file('file_pendamping');
                    $extension = $filePendamping[$i]->getClientOriginalExtension();
                    $nama = 'Pendamping' . $i . '.' . $extension;
                    Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id . '/Pendamping', $request->file_pendamping[$i], $nama);

                    $newPendamping = new PersetujuanPendampingModel();
                    $newPendamping->id_pengajuan_menara = $newPengajuan->id;
                    $newPendamping->nama = $request->nama[$i];
                    $newPendamping->no_ktp = $request->ktp[$i];
                    $newPendamping->jarak = $request->jarak[$i];
                    $newPendamping->file_suratPersetujuan = "/storage/Pengajuan/" . $newPengajuan->id . "/Pendamping/" . $nama;
                    $newPendamping->save();
                }
                
                break;
            
            case 'ajukan':
                $fileKTP = $request->file('file_KTPPemohon');
                $extensionKTP = $fileKTP->getClientOriginalExtension();
                $namaKTP = 'KTPPemohon.' . $extensionKTP;
                Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_KTPPemohon'), $namaKTP);

                $fileNPWP = $request->file('file_NPWPPemohon');
                $extensionNPWP = $fileNPWP->getClientOriginalExtension();
                $namaNPWP = 'NPWPPemohon.' . $extensionNPWP;
                Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_NPWPPemohon'), $namaNPWP);

                $fileFotoPemohon = $request->file('file_fotoPemohon');
                $extensionFotoPemohon = $fileFotoPemohon->getClientOriginalExtension();
                $namaFotoPemohon = 'FotoPemohon.' . $extensionFotoPemohon;
                Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_fotoPemohon'), $namaFotoPemohon);

                $fileSuratKuasa = $request->file('file_suratKuasa');
                $extensionSuratKuasa = $fileSuratKuasa->getClientOriginalExtension();
                $namaSuratKuasa = 'SuratKuasa.' . $extensionSuratKuasa;
                Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_suratKuasa'), $namaSuratKuasa);

                $fileRancangBangun = $request->file('file_rancangBangun');
                $extensionRancangBangun = $fileRancangBangun->getClientOriginalExtension();
                $namaRancangBangun = 'RancangBangun.' . $extensionRancangBangun;
                Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_rancangBangun'), $namaRancangBangun);

                $fileDenahBangunan = $request->file('file_denahBangunan');
                $extensionDenahBangunan = $fileDenahBangunan->getClientOriginalExtension();
                $namaDenahBangunan = 'DenahBangunan.' . $extensionDenahBangunan;
                Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_denahBangunan'), $namaDenahBangunan);

                $fileLokasiDanSituasi = $request->file('file_lokasiDanSituasi');
                $extensionLokasiDanSituasi = $fileLokasiDanSituasi->getClientOriginalExtension();
                $namaLokasiDanSituasi = 'LokasiDanSituasi.' . $extensionLokasiDanSituasi;
                Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_lokasiDanSituasi'), $namaLokasiDanSituasi);

                $fileSuratTanah = $request->file('file_suratTanah');
                $extensionSuratTanah = $fileSuratTanah->getClientOriginalExtension();
                $namaSuratTanah = 'SuratTanah.' . $extensionSuratTanah;
                Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id, $request->file('file_suratTanah'), $namaSuratTanah);

                $newDetailPengajuan1 = new DetailPengajuanModel();
                $newDetailPengajuan1->id_pengajuan_menara = $newPengajuan->id;
                $newDetailPengajuan1->file = "KTPPemohon";
                $newDetailPengajuan1->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaKTP;
                $newDetailPengajuan1->status = "tunggu persetujuan";
                $newDetailPengajuan1->tanggal = Carbon::now();
                $newDetailPengajuan1->save();

                $newDetailPengajuan2 = new DetailPengajuanModel();
                $newDetailPengajuan2->id_pengajuan_menara = $newPengajuan->id;
                $newDetailPengajuan2->file = "NPWPPemohon";
                $newDetailPengajuan2->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaNPWP;
                $newDetailPengajuan2->status = "tunggu persetujuan";
                $newDetailPengajuan2->tanggal = Carbon::now();
                $newDetailPengajuan2->save();

                $newDetailPengajuan3 = new DetailPengajuanModel();
                $newDetailPengajuan3->id_pengajuan_menara = $newPengajuan->id;
                $newDetailPengajuan3->file = "FotoPemohon";
                $newDetailPengajuan3->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaFotoPemohon;
                $newDetailPengajuan3->status = "tunggu persetujuan";
                $newDetailPengajuan3->tanggal = Carbon::now();
                $newDetailPengajuan3->save();

                $newDetailPengajuan4 = new DetailPengajuanModel();
                $newDetailPengajuan4->id_pengajuan_menara = $newPengajuan->id;
                $newDetailPengajuan4->file = "SuratKuasa";
                $newDetailPengajuan4->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaSuratKuasa;
                $newDetailPengajuan4->status = "tunggu persetujuan";
                $newDetailPengajuan4->tanggal = Carbon::now();
                $newDetailPengajuan4->save();

                $newDetailPengajuan5 = new DetailPengajuanModel();
                $newDetailPengajuan5->id_pengajuan_menara = $newPengajuan->id;
                $newDetailPengajuan5->file = "RancangBangun";
                $newDetailPengajuan5->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaRancangBangun;
                $newDetailPengajuan5->status = "tunggu persetujuan";
                $newDetailPengajuan5->tanggal = Carbon::now();
                $newDetailPengajuan5->save();

                $newDetailPengajuan6 = new DetailPengajuanModel();
                $newDetailPengajuan6->id_pengajuan_menara = $newPengajuan->id;
                $newDetailPengajuan6->file = "DenahBangunan";
                $newDetailPengajuan6->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaDenahBangunan;
                $newDetailPengajuan6->status = "tunggu persetujuan";
                $newDetailPengajuan6->tanggal = Carbon::now();
                $newDetailPengajuan6->save();

                $newDetailPengajuan7 = new DetailPengajuanModel();
                $newDetailPengajuan7->id_pengajuan_menara = $newPengajuan->id;
                $newDetailPengajuan7->file = "GambarLokasiDanSituasi";
                $newDetailPengajuan7->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaLokasiDanSituasi;
                $newDetailPengajuan7->status = "tunggu persetujuan";
                $newDetailPengajuan7->tanggal = Carbon::now();
                $newDetailPengajuan7->save();

                $newDetailPengajuan8 = new DetailPengajuanModel();
                $newDetailPengajuan8->id_pengajuan_menara = $newPengajuan->id;
                $newDetailPengajuan8->file = "SuratTanah";
                $newDetailPengajuan8->patch = "/storage/Pengajuan/" . $newPengajuan->id . "/" . $namaSuratTanah;
                $newDetailPengajuan8->status = "tunggu persetujuan";
                $newDetailPengajuan8->tanggal = Carbon::now();
                $newDetailPengajuan8->save();

                $jumlahData = $request->jumlahData;

                for ($i=1; $i <= $jumlahData; $i++) {
                    if ($request->file('file_pendamping')) {
                        $filePendamping = $request->file('file_pendamping');
                        $extension = $filePendamping[$i]->getClientOriginalExtension();
                        $nama = 'Pendamping' . $i . '.' . $extension;
                        Storage::putFileAs('public/Pengajuan/' . $newPengajuan->id . '/Pendamping', $request->file_pendamping[$i], $nama);
    
                        $newPendamping = new PersetujuanPendampingModel();
                        $newPendamping->id_pengajuan_menara = $newPengajuan->id;
                        $newPendamping->nama = $request->nama[$i];
                        $newPendamping->no_ktp = $request->ktp[$i];
                        $newPendamping->jarak = $request->jarak[$i];
                        $newPendamping->file_suratPersetujuan = "/storage/Pengajuan/" . $newPengajuan->id . "/Pendamping/" . $nama;
                        $newPendamping->save();
                    }
                }
                
                break;
        }

        switch ($request->input('action')) {
            case 'draft':
                return redirect()->route('draftPengajuan', ['id' => $newPengajuan->id]);
                break;

            case 'ajukan':
                return redirect()->route('detailPengajuan', ['id' => $newPengajuan->id]);
                break;
        }
    }

    public function draftPengajuan($id)
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->with('Provinsi.PemilikMenara')->with('Kabupaten.PemilikMenara')->with('Kecamatan.PemilikMenara')->with('Desa.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

        $detailPengajuan = PengajuanMenaraModel::with('Provinsi.PengajuanMenara')->with('Kabupaten.PengajuanMenara')->with('Kecamatan.PengajuanMenara')->with('Desa.PengajuanMenara')->with('DetailPengajuan.PengajuanMenara')->with('PersetujuanPendamping.PengajuanMenara')->with('PengajuanStatus.PengajuanMenara')->find($id);
        $status = PengajuanStatusModel::with('Status.PengajuanStatus')->where('id_pengajuan_menara', $id)->first();
        
        $detailFile1 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "KTPPemohon")->first();
        $detailFile2 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "NPWPPemohon")->first();
        $detailFile3 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "FotoPemohon")->first();
        $detailFile4 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratKuasa")->first();
        $detailFile5 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "RancangBangun")->first();
        $detailFile6 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "DenahBangunan")->first();
        $detailFile7 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "GambarLokasiDanSituasi")->first();
        $detailFile8 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratTanah")->first();

        if ($detailFile1 == null) {
            $detailFileData1['status'] = 0;
            $detailFileData1['data'] = 0;
        } else {
            $detailFileData1['status'] = 1;
            $detailFileData1['data'] = $detailFile1;
        }

        if ($detailFile2 == null) {
            $detailFileData2['status'] = 0;
            $detailFileData2['data'] = 0;
        } else {
            $detailFileData2['status'] = 1;
            $detailFileData2['data'] = $detailFile2;
        }

        if ($detailFile3 == null) {
            $detailFileData3['status'] = 0;
            $detailFileData3['data'] = 0;
        } else {
            $detailFileData3['status'] = 1;
            $detailFileData3['data'] = $detailFile3;
        }

        if ($detailFile4 == null) {
            $detailFileData4['status'] = 0;
            $detailFileData4['data'] = 0;
        } else {
            $detailFileData4['status'] = 1;
            $detailFileData4['data'] = $detailFile4;
        }

        if ($detailFile5 == null) {
            $detailFileData5['status'] = 0;
            $detailFileData5['data'] = 0;
        } else {
            $detailFileData5['status'] = 1;
            $detailFileData5['data'] = $detailFile5;
        }

        if ($detailFile6 == null) {
            $detailFileData6['status'] = 0;
            $detailFileData6['data'] = 0;
        } else {
            $detailFileData6['status'] = 1;
            $detailFileData6['data'] = $detailFile6;
        }

        if ($detailFile7 == null) {
            $detailFileData7['status'] = 0;
            $detailFileData7['data'] = 0;
        } else {
            $detailFileData7['status'] = 1;
            $detailFileData7['data'] = $detailFile7;
        }

        if ($detailFile8 == null) {
            $detailFileData8['status'] = 0;
            $detailFileData8['data'] = 0;
        } else {
            $detailFileData8['status'] = 1;
            $detailFileData8['data'] = $detailFile8;
        }

        // dd($detailPengajuan);

        return view("dashboard.pengajuanMenara.draftPengajuan", compact("dataUser", "detailPengajuan", "status", "detailFileData1", "detailFileData2", "detailFileData3", "detailFileData4", "detailFileData5", "detailFileData6", "detailFileData7", "detailFileData8"));
    }

    public function editDraft($id)
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')
                    ->with('Provinsi.PemilikMenara')
                    ->with('Kabupaten.PemilikMenara')
                    ->with('Kecamatan.PemilikMenara')
                    ->with('Desa.PemilikMenara')
                    ->whereIn("id_user", [Auth::user()->id])
                    ->first();

        $detailPengajuan = PengajuanMenaraModel::with('Provinsi.PengajuanMenara')
                            ->with('Kabupaten.PengajuanMenara')
                            ->with('Kecamatan.PengajuanMenara')
                            ->with('Desa.PengajuanMenara')
                            ->with('DetailPengajuan.PengajuanMenara')
                            ->with('PersetujuanPendamping.PengajuanMenara')
                            ->with('PengajuanStatus.PengajuanMenara')
                            ->with('ZonePlan.PengajuanMenara')
                            ->find($id);

        $status = PengajuanStatusModel::with('Status.PengajuanStatus')
                    ->where('id_pengajuan_menara', $id)
                    ->first();
        // dd($status);

        $provinsi = ProvinsiModel::get();
        $kabupaten = KabupatenModel::get();
        $kecamatan = KecamatanModel::get();
        $desa = DesaModel::get();

        $dataZonePlan = ZonePlanModel::get();

        $detailFile1 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "KTPPemohon")->first();
        $detailFile2 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "NPWPPemohon")->first();
        $detailFile3 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "FotoPemohon")->first();
        $detailFile4 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratKuasa")->first();
        $detailFile5 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "RancangBangun")->first();
        $detailFile6 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "DenahBangunan")->first();
        $detailFile7 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "GambarLokasiDanSituasi")->first();
        $detailFile8 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratTanah")->first();

        if ($detailFile1 == null) {
            $detailFileData1['status'] = 0;
            $detailFileData1['data'] = 0;
        } else {
            $detailFileData1['status'] = 1;
            $detailFileData1['data'] = $detailFile1;
        }

        if ($detailFile2 == null) {
            $detailFileData2['status'] = 0;
            $detailFileData2['data'] = 0;
        } else {
            $detailFileData2['status'] = 1;
            $detailFileData2['data'] = $detailFile2;
        }

        if ($detailFile3 == null) {
            $detailFileData3['status'] = 0;
            $detailFileData3['data'] = 0;
        } else {
            $detailFileData3['status'] = 1;
            $detailFileData3['data'] = $detailFile3;
        }

        if ($detailFile4 == null) {
            $detailFileData4['status'] = 0;
            $detailFileData4['data'] = 0;
        } else {
            $detailFileData4['status'] = 1;
            $detailFileData4['data'] = $detailFile4;
        }

        if ($detailFile5 == null) {
            $detailFileData5['status'] = 0;
            $detailFileData5['data'] = 0;
        } else {
            $detailFileData5['status'] = 1;
            $detailFileData5['data'] = $detailFile5;
        }

        if ($detailFile6 == null) {
            $detailFileData6['status'] = 0;
            $detailFileData6['data'] = 0;
        } else {
            $detailFileData6['status'] = 1;
            $detailFileData6['data'] = $detailFile6;
        }

        if ($detailFile7 == null) {
            $detailFileData7['status'] = 0;
            $detailFileData7['data'] = 0;
        } else {
            $detailFileData7['status'] = 1;
            $detailFileData7['data'] = $detailFile7;
        }

        if ($detailFile8 == null) {
            $detailFileData8['status'] = 0;
            $detailFileData8['data'] = 0;
        } else {
            $detailFileData8['status'] = 1;
            $detailFileData8['data'] = $detailFile8;
        }

        return view("dashboard.pengajuanMenara.editDraft", compact("dataUser", "detailPengajuan", "status", "provinsi", "kabupaten", "kecamatan", "desa", "dataZonePlan", "detailFileData1", "detailFileData2", "detailFileData3", "detailFileData4", "detailFileData5", "detailFileData6", "detailFileData7", "detailFileData8"));
    }

    public function updateDraft($id, Request $request)
    {
        $detailPengajuan = PengajuanMenaraModel::with('Provinsi.PengajuanMenara')
                            ->with('Kabupaten.PengajuanMenara')
                            ->with('Kecamatan.PengajuanMenara')
                            ->with('Desa.PengajuanMenara')
                            ->with('DetailPengajuan.PengajuanMenara')
                            ->with('PersetujuanPendamping.PengajuanMenara')
                            ->with('PengajuanStatus.PengajuanMenara')
                            ->find($id);
        $detailFile1 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)
                        ->where("file", "KTPPemohon")
                        ->first();
        $detailFile2 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)
                        ->where("file", "NPWPPemohon")
                        ->first();
        $detailFile3 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)
                        ->where("file", "FotoPemohon")
                        ->first();
        $detailFile4 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)
                        ->where("file", "SuratKuasa")
                        ->first();
        $detailFile5 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)
                        ->where("file", "RancangBangun")
                        ->first();
        $detailFile6 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)
                        ->where("file", "DenahBangunan")
                        ->first();
        $detailFile7 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)
                        ->where("file", "GambarLokasiDanSituasi")
                        ->first();
        $detailFile8 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)
                        ->where("file", "SuratTanah")
                        ->first();

        switch ($request->input('action')) {
            case 'draft':
                break;
            
            case 'ajukan':
                $validator = Validator::make($request->all(), [
                    'lat' => 'required',
                    'lng' => 'required',
                    'provinsi' => 'required',
                    'kabupaten' => 'required',
                    'kecamatan' => 'required',
                    'desa' => 'required',
                    'jenisMenara' => 'required',
                    'tinggiMenara' => 'required',
                    'tinggiAntena' => 'required',
                    'luasArea' => 'required',
                    'aksesJalan' => 'required',
                    'statusLahan' => 'required',
                    'namaPemilikTanah' => 'required',
                    'idZone' => 'required'
                ]);

                if($validator->fails()){
                    return back()->withErrors($validator);
                }

                break;
        }
        
        switch ($request->input('action')) {
            case 'ajukan':
                if ($detailFile1 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_KTPPemohon' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile2 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_NPWPPemohon' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile3 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_fotoPemohon' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile4 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_suratKuasa' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile5 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_rancangBangun' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile6 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_denahBangunan' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile7 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_lokasiDanSituasi' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile8 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_suratTanah' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                }
                break;
        }

        // dd($request);
        if ($detailPengajuan->id_zonePlan == null) {
            $zonaBaru = ZonePlanModel::find($request->idZone);
            // dd($zonaBaru);
            $zonaBaru->jumlah_menara = $zonaBaru->jumlah_menara + 1;
            if ($zonaBaru->jumlah_menara == $zonaBaru->batas_menara) {
                $zonaBaru->status = 'used';
            }
            $zonaBaru->update();
        } elseif ($detailPengajuan->id_zonePlan != $request->idZone) {
            $zonaLama = ZonePlanModel::find($detailPengajuan->id_zonePlan);
            $zonaLama->jumlah_menara = $zonaLama->jumlah_menara - 1;
            if ($zonaLama->status == 'used') {
                $zonaLama->status = 'available';
            }
            $zonaLama->update();

            $zonaBaru = ZonePlanModel::find($request->idZone);
            // dd($zonaBaru);
            $zonaBaru->jumlah_menara = $zonaBaru->jumlah_menara + 1;
            if ($zonaBaru->jumlah_menara == $zonaBaru->batas_menara) {
                $zonaBaru->status = 'used';
            }
            $zonaBaru->update();
        }

        $editPengajuan = PengajuanMenaraModel::with('Provinsi.PengajuanMenara')->with('Kabupaten.PengajuanMenara')->with('Kecamatan.PengajuanMenara')->with('Desa.PengajuanMenara')->with('DetailPengajuan.PengajuanMenara')->with('PersetujuanPendamping.PengajuanMenara')->with('PengajuanStatus.PengajuanMenara')->find($id);
        $editPengajuan->id_provinsi = $request->provinsi;
        $editPengajuan->id_kabupaten = $request->kabupaten;
        $editPengajuan->id_kecamatan = $request->kecamatan;
        $editPengajuan->id_desa = $request->desa;
        $editPengajuan->lat = $request->lat;
        $editPengajuan->long = $request->lng;
        $editPengajuan->jenis_menara = $request->jenisMenara;
        $editPengajuan->tinggi_menara = $request->tinggiMenara;
        $editPengajuan->tinggi_antena = $request->tinggiAntena;
        $editPengajuan->luas_area = $request->luasArea;
        $editPengajuan->akses_jalan = $request->aksesJalan;
        $editPengajuan->status_lahan = $request->statusLahan;
        $editPengajuan->kepemilikan_tanah = $request->namaPemilikTanah;
        $editPengajuan->jumlah_pendamping = $request->jumlahData;
        $editPengajuan->id_zonePlan = $request->idZone;
        switch ($request->input('action')) {
            case 'draft':
                $editPengajuan->save();
                break;
            case 'ajukan':
                $editPengajuan->tanggal = Carbon::now();
                $editPengajuan->status = 'diajukan';
                $editPengajuan->save();

                $status = MasterStatusModel::where('status', 'Pemeriksaan Oleh Tim Administrasi')->first();

                $newStatus = new PengajuanStatusModel;
                $newStatus->id_status = $status->id;
                $newStatus->id_pengajuan_menara = $id;
                $newStatus->tanggal_status = Carbon::now();
                $newStatus->save();
                break;
        }

        $fileKTP = $request->file('file_KTPPemohon');
        if ($fileKTP != NULL) {
            $extensionKTP = $fileKTP->getClientOriginalExtension();
            $namaKTP = 'KTPPemohon.' . $extensionKTP;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_KTPPemohon'), $namaKTP);

            $updateDetailPengajuan1 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'KTPPemohon')->first();
            if ($updateDetailPengajuan1) {
                $updateDetailPengajuan1->patch = "/storage/Pengajuan/" . $id . "/" . $namaKTP;
                $updateDetailPengajuan1->status = "tunggu persetujuan";
                $updateDetailPengajuan1->tanggal = Carbon::now();
                $updateDetailPengajuan1->update();
            } else {
                $newDetailPengajuan1 = new DetailPengajuanModel();
                $newDetailPengajuan1->id_pengajuan_menara = $id;
                $newDetailPengajuan1->file = "KTPPemohon";
                $newDetailPengajuan1->patch = "/storage/Pengajuan/" . $id . "/" . $namaKTP;
                $newDetailPengajuan1->status = "tunggu persetujuan";
                $newDetailPengajuan1->tanggal = Carbon::now();
                $newDetailPengajuan1->save();
            }
        }

        $fileNPWP = $request->file('file_NPWPPemohon');
        if ($fileNPWP != NULL) {
            $extensionNPWP = $fileNPWP->getClientOriginalExtension();
            $namaNPWP = 'NPWPPemohon.' . $extensionNPWP;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_NPWPPemohon'), $namaNPWP);

            $updateDetailPengajuan2 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'NPWPPemohon')->first();
            if ($updateDetailPengajuan2) {
                $updateDetailPengajuan2->patch = "/storage/Pengajuan/" . $id . "/" . $namaNPWP;
                $updateDetailPengajuan2->status = "tunggu persetujuan";
                $updateDetailPengajuan2->tanggal = Carbon::now();
                $updateDetailPengajuan2->upadate();
            }else {
                $newDetailPengajuan2 = new DetailPengajuanModel();
                $newDetailPengajuan2->id_pengajuan_menara = $id;
                $newDetailPengajuan2->file = "NPWPPemohon";
                $newDetailPengajuan2->patch = "/storage/Pengajuan/" . $id . "/" . $namaNPWP;
                $newDetailPengajuan2->status = "tunggu persetujuan";
                $newDetailPengajuan2->tanggal = Carbon::now();
                $newDetailPengajuan2->save();
            }
        }

        $fileFotoPemohon = $request->file('file_fotoPemohon');
        if ($fileFotoPemohon != NULL) {
            $extensionFotoPemohon = $fileFotoPemohon->getClientOriginalExtension();
            $namaFotoPemohon = 'FotoPemohon.' . $extensionFotoPemohon;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_fotoPemohon'), $namaFotoPemohon);
    
            $updateDetailPengajuan3 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'FotoPemohon')->first();
            if ($updateDetailPengajuan3) {
                $updateDetailPengajuan3->patch = "/storage/Pengajuan/" . $id . "/" . $namaFotoPemohon;
                $updateDetailPengajuan3->status = "tunggu persetujuan";
                $updateDetailPengajuan3->tanggal = Carbon::now();
                $updateDetailPengajuan3->update();
            } else {
                $newDetailPengajuan3 = new DetailPengajuanModel();
                $newDetailPengajuan3->id_pengajuan_menara = $id;
                $newDetailPengajuan3->file = "FotoPemohon";
                $newDetailPengajuan3->patch = "/storage/Pengajuan/" . $id . "/" . $namaFotoPemohon;
                $newDetailPengajuan3->status = "tunggu persetujuan";
                $newDetailPengajuan3->tanggal = Carbon::now();
                $newDetailPengajuan3->save();
            }
        }

        $fileSuratKuasa = $request->file('file_suratKuasa');
        if ($fileSuratKuasa != NULL) {
            $extensionSuratKuasa = $fileSuratKuasa->getClientOriginalExtension();
            $namaSuratKuasa = 'SuratKuasa.' . $extensionSuratKuasa;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_suratKuasa'), $namaSuratKuasa);

            $updateDetailPengajuan4 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'SuratKuasa')->first();
            if ($updateDetailPengajuan4) {
                $updateDetailPengajuan4->patch = "/storage/Pengajuan/" . $id . "/" . $namaSuratKuasa;
                $updateDetailPengajuan4->status = "tunggu persetujuan";
                $updateDetailPengajuan4->tanggal = Carbon::now();
                $updateDetailPengajuan4->update();
            } else {
                $newDetailPengajuan4 = new DetailPengajuanModel();
                $newDetailPengajuan4->id_pengajuan_menara = $id;
                $newDetailPengajuan4->file = "SuratKuasa";
                $newDetailPengajuan4->patch = "/storage/Pengajuan/" . $id . "/" . $namaSuratKuasa;
                $newDetailPengajuan4->status = "tunggu persetujuan";
                $newDetailPengajuan4->tanggal = Carbon::now();
                $newDetailPengajuan4->save();
            }
        }

        $fileRancangBangun = $request->file('file_rancangBangun');
        if ($fileRancangBangun != NULL) {
            $extensionRancangBangun = $fileRancangBangun->getClientOriginalExtension();
            $namaRancangBangun = 'RancangBangun.' . $extensionRancangBangun;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_rancangBangun'), $namaRancangBangun);
    
            $newDetailPengajuan5 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'RancangBangun')->first();
            if ($newDetailPengajuan5) {
                $newDetailPengajuan5->patch = "/storage/Pengajuan/" . $id . "/" . $namaRancangBangun;
                $newDetailPengajuan5->status = "tunggu persetujuan";
                $newDetailPengajuan5->tanggal = Carbon::now();
                $newDetailPengajuan5->update();
            } else {
                $newDetailPengajuan5 = new DetailPengajuanModel();
                $newDetailPengajuan5->id_pengajuan_menara = $id;
                $newDetailPengajuan5->file = "RancangBangun";
                $newDetailPengajuan5->patch = "/storage/Pengajuan/" . $id . "/" . $namaRancangBangun;
                $newDetailPengajuan5->status = "tunggu persetujuan";
                $newDetailPengajuan5->tanggal = Carbon::now();
                $newDetailPengajuan5->save();
            }
        }

        $fileDenahBangunan = $request->file('file_denahBangunan');
        if ($fileDenahBangunan != NULL) {
            $extensionDenahBangunan = $fileDenahBangunan->getClientOriginalExtension();
            $namaDenahBangunan = 'DenahBangunan.' . $extensionDenahBangunan;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_denahBangunan'), $namaDenahBangunan);
    
            $updateDetailPengajuan6 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'DenahBangunan')->first();
            if ($updateDetailPengajuan6) {
                $updateDetailPengajuan6->patch = "/storage/Pengajuan/" . $id . "/" . $namaDenahBangunan;
                $updateDetailPengajuan6->status = "tunggu persetujuan";
                $updateDetailPengajuan6->tanggal = Carbon::now();
                $updateDetailPengajuan6->save();
            } else {
                $newDetailPengajuan6 = new DetailPengajuanModel();
                $newDetailPengajuan6->id_pengajuan_menara = $id;
                $newDetailPengajuan6->file = "DenahBangunan";
                $newDetailPengajuan6->patch = "/storage/Pengajuan/" . $id . "/" . $namaDenahBangunan;
                $newDetailPengajuan6->status = "tunggu persetujuan";
                $newDetailPengajuan6->tanggal = Carbon::now();
                $newDetailPengajuan6->save();
            }
            
        }
        
        $fileLokasiDanSituasi = $request->file('file_lokasiDanSituasi');
        if ($fileLokasiDanSituasi != NULL) {
            $extensionLokasiDanSituasi = $fileLokasiDanSituasi->getClientOriginalExtension();
            $namaLokasiDanSituasi = 'LokasiDanSituasi.' . $extensionLokasiDanSituasi;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_lokasiDanSituasi'), $namaLokasiDanSituasi);
    
            $updateDetailPengajuan7 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'GambarLokasiDanSituasi')->first();
            if ($updateDetailPengajuan7) {
                $updateDetailPengajuan7->patch = "/storage/Pengajuan/" . $id . "/" . $namaLokasiDanSituasi;
                $updateDetailPengajuan7->status = "tunggu persetujuan";
                $updateDetailPengajuan7->tanggal = Carbon::now();
                $updateDetailPengajuan7->update();
            } else {
                $newDetailPengajuan7 = new DetailPengajuanModel();
                $newDetailPengajuan7->id_pengajuan_menara = $id;
                $newDetailPengajuan7->file = "GambarLokasiDanSituasi";
                $newDetailPengajuan7->patch = "/storage/Pengajuan/" . $id . "/" . $namaLokasiDanSituasi;
                $newDetailPengajuan7->status = "tunggu persetujuan";
                $newDetailPengajuan7->tanggal = Carbon::now();
                $newDetailPengajuan7->save();
            }
            
        }

        $fileSuratTanah = $request->file('file_suratTanah');
        if ($fileSuratTanah != NULL) {
            $extensionSuratTanah = $fileSuratTanah->getClientOriginalExtension();
            $namaSuratTanah = 'SuratTanah.' . $extensionSuratTanah;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_suratTanah'), $namaSuratTanah);
    
            $newDetailPengajuan8 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'SuratTanah')->first();
            if ($newDetailPengajuan8) {
                $newDetailPengajuan8->patch = "/storage/Pengajuan/" . $id . "/" . $namaSuratTanah;
                $newDetailPengajuan8->status = "tunggu persetujuan";
                $newDetailPengajuan8->tanggal = Carbon::now();
                $newDetailPengajuan8->update();
            } else {
                $newDetailPengajuan8 = new DetailPengajuanModel();
                $newDetailPengajuan8->id_pengajuan_menara = $id;
                $newDetailPengajuan8->file = "SuratTanah";
                $newDetailPengajuan8->patch = "/storage/Pengajuan/" . $id . "/" . $namaSuratTanah;
                $newDetailPengajuan8->status = "tunggu persetujuan";
                $newDetailPengajuan8->tanggal = Carbon::now();
                $newDetailPengajuan8->save();
            }
        }

        $jumlahData = $request->jumlahData;

        for ($i=1; $i <= $jumlahData; $i++) {
            $filePendamping = $request->file('file_pendamping');
            if (isset($filePendamping[$i])) {
                $extension = $filePendamping[$i]->getClientOriginalExtension();
                $nama = 'Pendamping' . $i . '.' . $extension;
                Storage::putFileAs('public/Pengajuan/' . $id . '/Pendamping', $request->file_pendamping[$i], $nama);

                $newPendamping = new PersetujuanPendampingModel();
                $newPendamping->id_pengajuan_menara = $id;
                $newPendamping->nama = $request->nama[$i];
                $newPendamping->no_ktp = $request->ktp[$i];
                $newPendamping->jarak = $request->jarak[$i];
                $newPendamping->file_suratPersetujuan = "/storage/Pengajuan/" . $id . "/Pendamping/" . $nama;
                $newPendamping->save();
            } else {
                continue;
            }
        }

        switch ($request->input('action')) {
            case 'draft':
                return redirect()->route('draftPengajuan', ['id' => $id]);
                break;

            case 'ajukan':
                return redirect()->route('detailPengajuan', ['id' => $id]);
                break;
        }
    }

    public function deletePendamping($id)
    {
        $delete = PersetujuanPendampingModel::find($id);
        $delete->delete();

        return response()->json();
    }

    public function detailPengajuan($id)
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->with('Provinsi.PemilikMenara')->with('Kabupaten.PemilikMenara')->with('Kecamatan.PemilikMenara')->with('Desa.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

        $detailPengajuan = PengajuanMenaraModel::with('Provinsi.PengajuanMenara')->with('Kabupaten.PengajuanMenara')->with('Kecamatan.PengajuanMenara')->with('Desa.PengajuanMenara')->with('DetailPengajuan.PengajuanMenara')->with('PersetujuanPendamping.PengajuanMenara')->with('PengajuanStatusTerakhir.PengajuanMenara')->with('PengajuanStatus.PengajuanMenara')->find($id);
        // dd($detailPengajuan);

        // $pengajuanTerakhir = PengajuanStatusModel::latest()->first();
        // dd($pengajuanTerakhir);

        $dataZonePlan = ZonePlanModel::get();

        // $

        $detailFile1 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "KTPPemohon")->first();
        $detailFile2 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "NPWPPemohon")->first();
        $detailFile3 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "FotoPemohon")->first();
        $detailFile4 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratKuasa")->first();
        $detailFile5 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "RancangBangun")->first();
        $detailFile6 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "DenahBangunan")->first();
        $detailFile7 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "GambarLokasiDanSituasi")->first();
        $detailFile8 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratTanah")->first();

        return view("dashboard.pengajuanMenara.detail", compact("dataUser", "detailPengajuan", "dataZonePlan", "detailFile1", "detailFile2", "detailFile3", "detailFile4", "detailFile5", "detailFile6", "detailFile7", "detailFile8"));
    }

    public function validasiPengajuan($id)
    {
        if (Auth::user()->kategori == "Tim Administratif") {
            $dataUser = TimAdministratifModel::with('user.TimAdministratif')->whereIn("id_user", [Auth::user()->id])->first();
        } elseif (Auth::user()->kategori == "Tim Lapangan") {
            $dataUser = TimLapanganModel::with('user.TimLapangan')->whereIn("id_user", [Auth::user()->id])->first();
        }

        $detailPengajuan = PengajuanMenaraModel::with('PemilikMenara.PengajuanMenara')->with('Provinsi.PengajuanMenara')->with('Kabupaten.PengajuanMenara')->with('Kecamatan.PengajuanMenara')->with('Desa.PengajuanMenara')->with('DetailPengajuan.PengajuanMenara')->with('PersetujuanPendamping.PengajuanMenara')->with('PengajuanStatus.PengajuanMenara')->with('PengajuanStatusTerakhir.PengajuanMenara')->find($id);
        $status = PengajuanStatusModel::with('Status.PengajuanStatus')->where('id_pengajuan_menara', $id)->latest('id')->first();
        // dd($status);

        $provinsi = ProvinsiModel::get();
        $kabupaten = KabupatenModel::get();
        $kecamatan = KecamatanModel::get();
        $desa = DesaModel::get();

        $dataZonePlan = ZonePlanModel::get();

        $detailFile1 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "KTPPemohon")->first();
        $detailFile2 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "NPWPPemohon")->first();
        $detailFile3 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "FotoPemohon")->first();
        $detailFile4 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratKuasa")->first();
        $detailFile5 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "RancangBangun")->first();
        $detailFile6 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "DenahBangunan")->first();
        $detailFile7 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "GambarLokasiDanSituasi")->first();
        $detailFile8 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratTanah")->first();

        return view("dashboard.pengajuanMenara.validasiPengajuan", compact("dataUser", "detailPengajuan", "status", "provinsi", "kabupaten", "kecamatan", "desa", "dataZonePlan", "detailFile1", "detailFile2", "detailFile3", "detailFile4", "detailFile5", "detailFile6", "detailFile7", "detailFile8"));
    }

    public function validateTimAdministratif($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'disposisi' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $detailValidate1 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'KTPPemohon')->first();
        if ($detailValidate1->status != 'disetujui') {
            $validator = Validator::make($request->all(), [
                'status1' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $detailValidate1->status = $request->status1;
            $detailValidate1->update();
        }
        $detailValidate2 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'NPWPPemohon')->first();
        if ($detailValidate2->status != 'disetujui') {
            $validator = Validator::make($request->all(), [
                'status2' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $detailValidate2->status = $request->status2;
            $detailValidate2->update();
        }
        $detailValidate3 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'FotoPemohon')->first();
        if ($detailValidate3->status != 'disetujui') {
            $validator = Validator::make($request->all(), [
                'status3' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $detailValidate3->status = $request->status3;
            $detailValidate3->update();
        }
        $detailValidate4 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'SuratKuasa')->first();
        if ($detailValidate4->status != 'disetujui') {
            $validator = Validator::make($request->all(), [
                'status4' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $detailValidate4->status = $request->status4;
            $detailValidate4->update();
        }
        $detailValidate5 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'RancangBangun')->first();
        if ($detailValidate5->status != 'disetujui') {
            $validator = Validator::make($request->all(), [
                'status5' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $detailValidate5->status = $request->status5;
            $detailValidate5->update();
        }
        $detailValidate6 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'DenahBangunan')->first();
        if ($detailValidate6->status != 'disetujui') {
            $validator = Validator::make($request->all(), [
                'status6' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $detailValidate6->status = $request->status6;
            $detailValidate6->update();
        }
        $detailValidate7 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'GambarLokasiDanSituasi')->first();
        if ($detailValidate7->status != 'disetujui') {
            $validator = Validator::make($request->all(), [
                'status7' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $detailValidate7->status = $request->status7;
            $detailValidate7->update();
        }
        $detailValidate8 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'SuratTanah')->first();
        if ($detailValidate8->status != 'disetujui') {
            $validator = Validator::make($request->all(), [
                'status8' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $detailValidate8->status = $request->status8;
            $detailValidate8->update();
        }

        switch ($request->input('action')) {
            case 'perbaiki':
                $statusPerbaiki = MasterStatusModel::where('status', 'Perbaikan Administrasi')->first();
                
                $validate = new PengajuanStatusModel();
                $validate->id_status = $statusPerbaiki->id;
                $validate->id_pengajuan_menara = $id;
                $validate->tanggal_status = Carbon::now();
                $validate->disposisi = $request->disposisi;
                $validate->save();

                return redirect()->route('dataPengajuan')->with(['success' => 'Status Berhasil Dirubah']);
                break;
            
            case 'diterima':
                $statusPerbaiki = MasterStatusModel::where('status', 'Disetujui Tim Administratif')->first();
                $validate = new PengajuanStatusModel();
                $validate->id_status = $statusPerbaiki->id;
                $validate->id_pengajuan_menara = $id;
                $validate->tanggal_status = Carbon::now();
                $validate->disposisi = $request->disposisi;
                $validate->save();

                $statusTimLapangan = MasterStatusModel::where('status', 'Pemeriksaan Oleh Tim Lapangan')->first();
                $validate = new PengajuanStatusModel();
                $validate->id_status = $statusTimLapangan->id;
                $validate->id_pengajuan_menara = $id;
                $validate->tanggal_status = Carbon::now();
                $validate->disposisi = $request->disposisi;
                $validate->save();

                return redirect()->route('dataPengajuan')->with(['success' => 'Status Berhasil Dirubah']);
                break;
        }
    }

    public function validateTimLapangan($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'disposisi' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        switch ($request->input('action')) {
            case 'ditolak':
                $statusPerbaiki = MasterStatusModel::where('status', 'Ditolak')->first();
                
                $validate = new PengajuanStatusModel();
                $validate->id_status = $statusPerbaiki->id;
                $validate->id_pengajuan_menara = $id;
                $validate->tanggal_status = Carbon::now();
                $validate->disposisi = $request->disposisi;
                $validate->save();

                $pengajuan = PengajuanMenaraModel::find($id);
                $zonePlan = ZonePlanModel::find($pengajuan->id_zonePlan);
                $zonePlan->jumlah_menara = $zonePlan->jumlah_menara - 1;
                if ($zonePlan->jumlah_menara != $zonePlan->batas_menara) {
                    $zonePlan->status = 'available';
                }
                $zonePlan->update();

                return redirect()->route('dataPengajuan')->with(['success' => 'Status Berhasil Dirubah']);
                break;
            
            case 'diterima':
                $statusPerbaiki = MasterStatusModel::where('status', 'Disetujui Tim Lapangan')->first();
                $validate = new PengajuanStatusModel();
                $validate->id_status = $statusPerbaiki->id;
                $validate->id_pengajuan_menara = $id;
                $validate->tanggal_status = Carbon::now();
                $validate->disposisi = $request->disposisi;
                $validate->save();

                $statusTimLapangan = MasterStatusModel::where('status', 'Pengajuan Disetujui')->first();
                $validate = new PengajuanStatusModel();
                $validate->id_status = $statusTimLapangan->id;
                $validate->id_pengajuan_menara = $id;
                $validate->tanggal_status = Carbon::now();
                $validate->disposisi = $request->disposisi;
                $validate->save();

                return redirect()->route('dataPengajuan')->with(['success' => 'Status Berhasil Dirubah']);
                break;
        }
    }

    public function editPengajuan($id)
    {
        $dataUser = PemilikMenaraModel::with('user.PemilikMenara')->with('Provinsi.PemilikMenara')->with('Kabupaten.PemilikMenara')->with('Kecamatan.PemilikMenara')->with('Desa.PemilikMenara')->whereIn("id_user", [Auth::user()->id])->first();

        $detailPengajuan = PengajuanMenaraModel::with('Provinsi.PengajuanMenara')->with('Kabupaten.PengajuanMenara')->with('Kecamatan.PengajuanMenara')->with('Desa.PengajuanMenara')->with('DetailPengajuan.PengajuanMenara')->with('PersetujuanPendamping.PengajuanMenara')->with('PengajuanStatus.PengajuanMenara')->with('PengajuanStatusTerakhir.PengajuanMenara')->with('ZonePlan.PengajuanMenara')->find($id);
        $status = PengajuanStatusModel::with('Status.PengajuanStatus')->where('id_pengajuan_menara', $id)->first();
        // dd($status);

        $provinsi = ProvinsiModel::get();
        $kabupaten = KabupatenModel::get();
        $kecamatan = KecamatanModel::get();
        $desa = DesaModel::get();

        $dataZonePlan = ZonePlanModel::get();

        $detailFile1 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "KTPPemohon")->first();
        $detailFile2 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "NPWPPemohon")->first();
        $detailFile3 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "FotoPemohon")->first();
        $detailFile4 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratKuasa")->first();
        $detailFile5 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "RancangBangun")->first();
        $detailFile6 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "DenahBangunan")->first();
        $detailFile7 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "GambarLokasiDanSituasi")->first();
        $detailFile8 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratTanah")->first();

        return view("dashboard.pengajuanMenara.editPengajuan", compact("dataUser", "detailPengajuan", "status", "provinsi", "kabupaten", "kecamatan", "desa", "dataZonePlan", "detailFile1", "detailFile2", "detailFile3", "detailFile4", "detailFile5", "detailFile6", "detailFile7", "detailFile8"));
    }

    public function updatePengajuan($id, Request $request)
    {
        $detailPengajuan = PengajuanMenaraModel::with('Provinsi.PengajuanMenara')->with('Kabupaten.PengajuanMenara')->with('Kecamatan.PengajuanMenara')->with('Desa.PengajuanMenara')->with('DetailPengajuan.PengajuanMenara')->with('PersetujuanPendamping.PengajuanMenara')->with('PengajuanStatus.PengajuanMenara')->find($id);
        $detailFile1 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "KTPPemohon")->first();
        $detailFile2 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "NPWPPemohon")->first();
        $detailFile3 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "FotoPemohon")->first();
        $detailFile4 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratKuasa")->first();
        $detailFile5 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "RancangBangun")->first();
        $detailFile6 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "DenahBangunan")->first();
        $detailFile7 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "GambarLokasiDanSituasi")->first();
        $detailFile8 = DetailPengajuanModel::where("id_pengajuan_menara", $detailPengajuan->id)->where("file", "SuratTanah")->first();

        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'jenisMenara' => 'required',
            'tinggiMenara' => 'required',
            'tinggiAntena' => 'required',
            'luasArea' => 'required',
            'aksesJalan' => 'required',
            'statusLahan' => 'required',
            'namaPemilikTanah' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }
        
        switch ($request->input('action')) {
            case 'draft':
                if ($detailFile1 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_KTPPemohon' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile2 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_NPWPPemohon' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile3 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_fotoPemohon' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile4 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_suratKuasa' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile5 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_rancangBangun' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile6 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_denahBangunan' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile7 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_lokasiDanSituasi' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                } elseif ($detailFile8 == NULL) {
                    $validator = Validator::make($request->all(), [
                        'file_suratTanah' => 'required',
                    ]);
        
                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }
                }
                break;
        }

        // dd($request);

        if ($detailPengajuan->id_zonePlan != $request->idZone) {
            $zonaLama = ZonePlanModel::find($detailPengajuan->id_zonePlan);
            $zonaLama->jumlah_menara = $zonaLama->jumlah_menara - 1;
            if ($zonaLama->status == 'used') {
                $zonaLama->status = 'available';
            }
            $zonaLama->update();

            $zonaBaru = ZonePlanModel::find($request->idZone);
            // dd($zonaBaru);
            $zonaBaru->jumlah_menara = $zonaBaru->jumlah_menara + 1;
            if ($zonaBaru->jumlah_menara == $zonaBaru->batas_menara) {
                $zonaBaru->status = 'used';
            }
            $zonaBaru->update();
        }

        $editPengajuan = PengajuanMenaraModel::with('Provinsi.PengajuanMenara')->with('Kabupaten.PengajuanMenara')->with('Kecamatan.PengajuanMenara')->with('Desa.PengajuanMenara')->with('DetailPengajuan.PengajuanMenara')->with('PersetujuanPendamping.PengajuanMenara')->with('PengajuanStatus.PengajuanMenara')->find($id);
        $editPengajuan->id_provinsi = $request->provinsi;
        $editPengajuan->id_kabupaten = $request->kabupaten;
        $editPengajuan->id_kecamatan = $request->kecamatan;
        $editPengajuan->id_desa = $request->desa;
        $editPengajuan->lat = $request->lat;
        $editPengajuan->long = $request->lng;
        $editPengajuan->jenis_menara = $request->jenisMenara;
        $editPengajuan->tinggi_menara = $request->tinggiMenara;
        $editPengajuan->tinggi_antena = $request->tinggiAntena;
        $editPengajuan->luas_area = $request->luasArea;
        $editPengajuan->akses_jalan = $request->aksesJalan;
        $editPengajuan->status_lahan = $request->statusLahan;
        $editPengajuan->kepemilikan_tanah = $request->namaPemilikTanah;
        $editPengajuan->jumlah_pendamping = $request->jumlahData;
        $editPengajuan->id_zonePlan = $request->idZone;
        $editPengajuan->save();

        $status = MasterStatusModel::where('status', 'Pemeriksaan Oleh Tim Administrasi')->first();
        $statusTerakhir = PengajuanStatusModel::latest('id')->first();

        $newStatus = new PengajuanStatusModel;
        $newStatus->id_status = $status->id;
        $newStatus->id_pengajuan_menara = $id;
        $newStatus->tanggal_status = Carbon::now();
        $newStatus->disposisi = $statusTerakhir->disposisi;
        $newStatus->save();


        $fileKTP = $request->file('file_KTPPemohon');
        if ($fileKTP != NULL) {
            $extensionKTP = $fileKTP->getClientOriginalExtension();
            $namaKTP = 'KTPPemohon.' . $extensionKTP;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_KTPPemohon'), $namaKTP);

            $updateDetailPengajuan1 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'KTPPemohon')->first();
            if ($updateDetailPengajuan1) {
                $updateDetailPengajuan1->patch = "/storage/Pengajuan/" . $id . "/" . $namaKTP;
                $updateDetailPengajuan1->status = "tunggu persetujuan";
                $updateDetailPengajuan1->tanggal = Carbon::now();
                $updateDetailPengajuan1->update();
            } else {
                $newDetailPengajuan1 = new DetailPengajuanModel();
                $newDetailPengajuan1->id_pengajuan_menara = $id;
                $newDetailPengajuan1->file = "KTPPemohon";
                $newDetailPengajuan1->patch = "/storage/Pengajuan/" . $id . "/" . $namaKTP;
                $newDetailPengajuan1->status = "tunggu persetujuan";
                $newDetailPengajuan1->tanggal = Carbon::now();
                $newDetailPengajuan1->save();
            }
        }

        $fileNPWP = $request->file('file_NPWPPemohon');
        if ($fileNPWP != NULL) {
            $extensionNPWP = $fileNPWP->getClientOriginalExtension();
            $namaNPWP = 'NPWPPemohon.' . $extensionNPWP;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_NPWPPemohon'), $namaNPWP);

            $updateDetailPengajuan2 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'KTPPemohon')->first();
            if ($updateDetailPengajuan2) {
                $updateDetailPengajuan2->patch = "/storage/Pengajuan/" . $id . "/" . $namaNPWP;
                $updateDetailPengajuan2->status = "tunggu persetujuan";
                $updateDetailPengajuan2->tanggal = Carbon::now();
                $updateDetailPengajuan2->upadate();
            }else {
                $newDetailPengajuan2 = new DetailPengajuanModel();
                $newDetailPengajuan2->id_pengajuan_menara = $id;
                $newDetailPengajuan2->file = "NPWPPemohon";
                $newDetailPengajuan2->patch = "/storage/Pengajuan/" . $id . "/" . $namaNPWP;
                $newDetailPengajuan2->status = "tunggu persetujuan";
                $newDetailPengajuan2->tanggal = Carbon::now();
                $newDetailPengajuan2->save();
            }
        }

        $fileFotoPemohon = $request->file('file_fotoPemohon');
        if ($fileFotoPemohon != NULL) {
            $extensionFotoPemohon = $fileFotoPemohon->getClientOriginalExtension();
            $namaFotoPemohon = 'FotoPemohon.' . $extensionFotoPemohon;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_fotoPemohon'), $namaFotoPemohon);
    
            $updateDetailPengajuan3 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'FotoPemohon')->first();
            if ($updateDetailPengajuan3) {
                $updateDetailPengajuan3->patch = "/storage/Pengajuan/" . $id . "/" . $namaFotoPemohon;
                $updateDetailPengajuan3->status = "tunggu persetujuan";
                $updateDetailPengajuan3->tanggal = Carbon::now();
                $updateDetailPengajuan3->update();
            } else {
                $newDetailPengajuan3 = new DetailPengajuanModel();
                $newDetailPengajuan3->id_pengajuan_menara = $id;
                $newDetailPengajuan3->file = "FotoPemohon";
                $newDetailPengajuan3->patch = "/storage/Pengajuan/" . $id . "/" . $namaFotoPemohon;
                $newDetailPengajuan3->status = "tunggu persetujuan";
                $newDetailPengajuan3->tanggal = Carbon::now();
                $newDetailPengajuan3->save();
            }
        }

        $fileSuratKuasa = $request->file('file_suratKuasa');
        if ($fileSuratKuasa != NULL) {
            $extensionSuratKuasa = $fileSuratKuasa->getClientOriginalExtension();
            $namaSuratKuasa = 'SuratKuasa.' . $extensionSuratKuasa;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_suratKuasa'), $namaSuratKuasa);

            $updateDetailPengajuan4 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'SuratKuasa')->first();
            if ($updateDetailPengajuan4) {
                $updateDetailPengajuan4->patch = "/storage/Pengajuan/" . $id . "/" . $namaSuratKuasa;
                $updateDetailPengajuan4->status = "tunggu persetujuan";
                $updateDetailPengajuan4->tanggal = Carbon::now();
                $updateDetailPengajuan4->update();
            } else {
                $newDetailPengajuan4 = new DetailPengajuanModel();
                $newDetailPengajuan4->id_pengajuan_menara = $id;
                $newDetailPengajuan4->file = "SuratKuasa";
                $newDetailPengajuan4->patch = "/storage/Pengajuan/" . $id . "/" . $namaSuratKuasa;
                $newDetailPengajuan4->status = "tunggu persetujuan";
                $newDetailPengajuan4->tanggal = Carbon::now();
                $newDetailPengajuan4->save();
            }
        }

        $fileRancangBangun = $request->file('file_rancangBangun');
        if ($fileRancangBangun != NULL) {
            $extensionRancangBangun = $fileRancangBangun->getClientOriginalExtension();
            $namaRancangBangun = 'RancangBangun.' . $extensionRancangBangun;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_rancangBangun'), $namaRancangBangun);
    
            $newDetailPengajuan5 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'RancangBangun')->first();
            if ($newDetailPengajuan5) {
                $newDetailPengajuan5->patch = "/storage/Pengajuan/" . $id . "/" . $namaRancangBangun;
                $newDetailPengajuan5->status = "tunggu persetujuan";
                $newDetailPengajuan5->tanggal = Carbon::now();
                $newDetailPengajuan5->update();
            } else {
                $newDetailPengajuan5 = new DetailPengajuanModel();
                $newDetailPengajuan5->id_pengajuan_menara = $id;
                $newDetailPengajuan5->file = "RancangBangun";
                $newDetailPengajuan5->patch = "/storage/Pengajuan/" . $id . "/" . $namaRancangBangun;
                $newDetailPengajuan5->status = "tunggu persetujuan";
                $newDetailPengajuan5->tanggal = Carbon::now();
                $newDetailPengajuan5->save();
            }
        }

        $fileDenahBangunan = $request->file('file_denahBangunan');
        if ($fileDenahBangunan != NULL) {
            $extensionDenahBangunan = $fileDenahBangunan->getClientOriginalExtension();
            $namaDenahBangunan = 'DenahBangunan.' . $extensionDenahBangunan;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_denahBangunan'), $namaDenahBangunan);
    
            $updateDetailPengajuan6 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'DenahBangunan')->first();
            if ($updateDetailPengajuan6) {
                $updateDetailPengajuan6->patch = "/storage/Pengajuan/" . $id . "/" . $namaDenahBangunan;
                $updateDetailPengajuan6->status = "tunggu persetujuan";
                $updateDetailPengajuan6->tanggal = Carbon::now();
                $updateDetailPengajuan6->save();
            } else {
                $newDetailPengajuan6 = new DetailPengajuanModel();
                $newDetailPengajuan6->id_pengajuan_menara = $id;
                $newDetailPengajuan6->file = "DenahBangunan";
                $newDetailPengajuan6->patch = "/storage/Pengajuan/" . $id . "/" . $namaDenahBangunan;
                $newDetailPengajuan6->status = "tunggu persetujuan";
                $newDetailPengajuan6->tanggal = Carbon::now();
                $newDetailPengajuan6->save();
            }
            
        }
        
        $fileLokasiDanSituasi = $request->file('file_lokasiDanSituasi');
        if ($fileLokasiDanSituasi != NULL) {
            $extensionLokasiDanSituasi = $fileLokasiDanSituasi->getClientOriginalExtension();
            $namaLokasiDanSituasi = 'LokasiDanSituasi.' . $extensionLokasiDanSituasi;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_lokasiDanSituasi'), $namaLokasiDanSituasi);
    
            $updateDetailPengajuan7 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'GambarLokasiDanSituasi')->first();
            if ($updateDetailPengajuan7) {
                $updateDetailPengajuan7->patch = "/storage/Pengajuan/" . $id . "/" . $namaLokasiDanSituasi;
                $updateDetailPengajuan7->status = "tunggu persetujuan";
                $updateDetailPengajuan7->tanggal = Carbon::now();
                $updateDetailPengajuan7->update();
            } else {
                $newDetailPengajuan7 = new DetailPengajuanModel();
                $newDetailPengajuan7->id_pengajuan_menara = $id;
                $newDetailPengajuan7->file = "GambarLokasiDanSituasi";
                $newDetailPengajuan7->patch = "/storage/Pengajuan/" . $id . "/" . $namaLokasiDanSituasi;
                $newDetailPengajuan7->status = "tunggu persetujuan";
                $newDetailPengajuan7->tanggal = Carbon::now();
                $newDetailPengajuan7->save();
            }
            
        }

        $fileSuratTanah = $request->file('file_suratTanah');
        if ($fileSuratTanah != NULL) {
            $extensionSuratTanah = $fileSuratTanah->getClientOriginalExtension();
            $namaSuratTanah = 'SuratTanah.' . $extensionSuratTanah;
            Storage::putFileAs('public/Pengajuan/' . $id, $request->file('file_suratTanah'), $namaSuratTanah);
    
            $newDetailPengajuan8 = DetailPengajuanModel::where('id_pengajuan_menara', $id)->where('file', 'SuratTanah')->first();
            if ($newDetailPengajuan8) {
                $newDetailPengajuan8->patch = "/storage/Pengajuan/" . $id . "/" . $namaSuratTanah;
                $newDetailPengajuan8->status = "tunggu persetujuan";
                $newDetailPengajuan8->tanggal = Carbon::now();
                $newDetailPengajuan8->update();
            } else {
                $newDetailPengajuan8 = new DetailPengajuanModel();
                $newDetailPengajuan8->id_pengajuan_menara = $id;
                $newDetailPengajuan8->file = "SuratTanah";
                $newDetailPengajuan8->patch = "/storage/Pengajuan/" . $id . "/" . $namaSuratTanah;
                $newDetailPengajuan8->status = "tunggu persetujuan";
                $newDetailPengajuan8->tanggal = Carbon::now();
                $newDetailPengajuan8->save();
            }
        }

        $jumlahData = $request->jumlahData;

        for ($i=1; $i <= $jumlahData; $i++) {
            $filePendamping = $request->file('file_pendamping');
            if (isset($filePendamping[$i])) {
                $extension = $filePendamping[$i]->getClientOriginalExtension();
                $nama = 'Pendamping' . $i . '.' . $extension;
                Storage::putFileAs('public/Pengajuan/' . $id . '/Pendamping', $request->file_pendamping[$i], $nama);

                $newPendamping = new PersetujuanPendampingModel();
                $newPendamping->id_pengajuan_menara = $id;
                $newPendamping->nama = $request->nama[$i];
                $newPendamping->no_ktp = $request->ktp[$i];
                $newPendamping->jarak = $request->jarak[$i];
                $newPendamping->file_suratPersetujuan = "/storage/Pengajuan/" . $id . "/Pendamping/" . $nama;
                $newPendamping->save();
            } else {
                continue;
            }
        }

        return redirect()->route('detailPengajuan', ['id' => $id]);
    }

    public function akhirPengajuan($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'disposisi' => 'required',
            'file_rekomendasiPembangunan' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $fileRekomendasi = $request->file('file_rekomendasiPembangunan');
        $extensionRekomendasi = $fileRekomendasi->getClientOriginalExtension();
        // dd($fileRekomendasi);
        $namaRekomendasi = 'RekomendasiPembangunanMenara.' . $extensionRekomendasi;
        Storage::putFileAs('public/Pengajuan/' . $id . '/FileSurat', $request->file('file_rekomendasiPembangunan'), $namaRekomendasi);

        $filePengajuanMenara = PengajuanMenaraModel::find($id);
        $filePengajuanMenara->file_RekomendasiPembangunanMenara = "/storage/Pengajuan/" . $id . "/FileSurat/" . $namaRekomendasi;
        $filePengajuanMenara->update();

        $status = MasterStatusModel::where('status', 'Selesai')->first();
        $statusTerakhir = PengajuanStatusModel::latest('id')->first();

        $newStatus = new PengajuanStatusModel;
        $newStatus->id_status = $status->id;
        $newStatus->id_pengajuan_menara = $id;
        $newStatus->tanggal_status = Carbon::now();
        $newStatus->disposisi = $request->disposisi;
        $newStatus->save();

        $jumlahMenara = MenaraModel::where('id_pemilik_menara', $filePengajuanMenara->id_pemilik_menara)->count();
        $nomer = $jumlahMenara + 1;

        $newMenara = new MenaraModel();
        $newMenara->id_provinsi = $filePengajuanMenara->id_provinsi;
        $newMenara->id_kabupaten = $filePengajuanMenara->id_kabupaten;
        $newMenara->id_kecamatan = $filePengajuanMenara->id_kecamatan;
        $newMenara->id_desa = $filePengajuanMenara->id_desa;
        $newMenara->id_pemilik_menara = $filePengajuanMenara->id_pemilik_menara;
        $newMenara->no_menara = $filePengajuanMenara->id_pemilik_menara . $nomer;
        $newMenara->lat = $filePengajuanMenara->lat;
        $newMenara->long = $filePengajuanMenara->long;
        $newMenara->jenis_menara = $filePengajuanMenara->jenis_menara;
        $newMenara->tinggi_menara = $filePengajuanMenara->tinggi_menara;
        $newMenara->tinggi_antena = $filePengajuanMenara->tinggi_antena;
        $newMenara->luas_area = $filePengajuanMenara->luas_area;
        $newMenara->akses_jalan = $filePengajuanMenara->akses_jalan;
        $newMenara->id_zonePlan = $filePengajuanMenara->id_zonePlan;
        $newMenara->save();

        return redirect()->route('dataPengajuan')->with(['success' => 'Status Berhasil Dirubah']);
    }

    public function downloadFile($id)
    {
        $data = PengajuanMenaraModel::find($id);
        $nama = explode('/', $data->file_rekomendasiPembangunanMenara);
        $file = '/public/' . $nama[2] . '/' . $nama[3] . '/' . $nama[4] . '/' . $nama[5];
        // dd($file);

        return storage::disk('local')->download($file);
    }

    public function getDistance($lat, $lng)
    {
        $statusZona = 0;
        $statusMenara = 0;
        $data = [];

        $zoneplan = ZonePlanModel::with('Provinsi.ZonePlan')
                    ->with('Kabupaten.ZonePlan')
                    ->with('Kecamatan.ZonePlan')
                    ->with('Desa.ZonePlan')
                    ->get();
        $menara = MenaraModel::get();
        
        foreach ($zoneplan as $zp) {
            $theta = $zp->long - $lng;
            if ($theta == 0.0) {
                $meter = 0;
            } else {
                $miles = (sin(deg2rad($zp->lat)) * sin(deg2rad($lat))) + (cos(deg2rad($zp->lat)) * cos(deg2rad($lat)) * cos(deg2rad($theta)));
                $miles = acos($miles);
                $miles = rad2deg($miles);
                $miles = $miles * 60 *1.1515;
                $km = $miles * 1.609344;
                $meter = $km * 1000;
            }

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
                        $data['menaraDekat'] = $m;
                        // $menaraDekat = $m;
                    }
                    
                    // $data['meters'] = $meters;
                }
                $statusZona = 1;
                $data['statusZona'] = $statusZona;
                $data['statusMenara'] = $statusMenara;
                $data['zp'] = $zp;
                // if ($menaraDekat) {
                //     $data['menaraDekat'] = $menaraDekat;
                // } else {
                //     $data['menaraDekat'] = 0;
                // }
                // $data['menara'] = $menara;
                // $data = [$status, $zp, $zp->Provinsi, $zp->Kabupaten, $zp->Kecamatan, $zp->Desa];
                return response()->json($data);
            }
        }
        
        $data['statusZona'] = $statusZona;

        return response()->json($data);
    }
}