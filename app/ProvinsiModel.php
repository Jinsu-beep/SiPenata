<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvinsiModel extends Model
{
    protected $table = 'tb_m_provinsi';

    public function PemilikMenara()
    {
        return $this->hasMany(PemilikMenaraModel::class, 'id_desa', 'id');
    }

    public function Perusahaan()
    {
        return $this->hasMany(PerusahaanModel::class, 'id_provinsi', 'id');
    }
    
    public function PengajuanMenara()
    {
        return $this->hasMany(PengajuanMenaraModel::class, 'id_provinsi', 'id');
    }

    public function Menara()
    {
        return $this->hasMany(MenaraModel::class, 'id_provinsi', 'id');
    }

    public function ZonePlan()
    {
        return $this->hasMany(ZonePlanModel::class, 'id_provinsi', 'id');
    }
}
