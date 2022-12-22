<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanMenaraModel extends Model
{
    protected $table = 'tb_pengajuan_menara';

    public function PemilikMenara()
    {
        return $this->belongsTo(PemilikMenaraModel::class, 'id_pemilik_menara', 'id');
    }

    public function PersetujuanPendamping()
    {
        return $this->hasMany(PersetujuanPendampingModel::class, 'id_pengajuan_menara', 'id');
    }

    public function DetailPengajuan()
    {
        return $this->hasMany(DetailPengajuanModel::class, 'id_pengajuan_menara', 'id');
    }

    public function PengajuanStatus()
    {
        return $this->hasMany(PengajuanStatusModel::class, 'id_pengajuan_menara', 'id');
    }

    public function PengajuanStatusTerakhir()
    {
        return $this->hasOne(PengajuanStatusModel::class, 'id_pengajuan_menara', 'id')->latest('id');
    }

    public function Provinsi()
    {
        return $this->belongsTo(ProvinsiModel::class, 'id_provinsi', 'id');
    }

    public function Kabupaten()
    {
        return $this->belongsTo(KabupatenModel::class, 'id_kabupaten', 'id');
    }

    public function Kecamatan()
    {
        return $this->belongsTo(KecamatanModel::class, 'id_kecamatan', 'id');
    }

    public function Desa()
    {
        return $this->belongsTo(DesaModel::class, 'id_desa', 'id');
    }
}
