<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZonePlanModel extends Model
{
    protected $table = 'tb_m_zoneplan';

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

    public function PengajuanMenara()
    {
        return $this->hasMany(PengajuanMenaraModel::class, 'id_zonePlan', 'id');
    }

    public function Menara()
    {
        return $this->hasMany(MenaraModel::class, 'id_zonePlan', 'id');
    }
}
