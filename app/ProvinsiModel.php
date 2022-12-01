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
}
