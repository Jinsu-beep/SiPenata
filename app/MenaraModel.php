<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenaraModel extends Model
{
    protected $table = 'tb_menara';

    public function PemilikMenara()
    {
        return $this->belongsTo(PemilikMenaraModel::class, 'id_pemilik_menara', 'id');
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

    public function PenggunaanMenara()
    {
        return $this->hasMany(PenggunaanMenaraModel::class, 'id_menara', 'id');
    }

    public function ZonePlan()
    {
        return $this->belongsTo(ZonePlanModel::class, 'id_zonePlan', 'id');
    }
}
