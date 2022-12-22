<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KecamatanModel extends Model
{
    protected $table = 'tb_m_kecamatan';

    public function PemilikMenara()
    {
        return $this->hasMany(PemilikMenaraModel::class, 'id_kecamatan', 'id');
    }

    public function Perusahaan()
    {
        return $this->hasMany(PerusahaanModel::class, 'id_kecamatan', 'id');
    }

    public function PengajuanMenara()
    {
        return $this->hasMany(PengajuanMenaraModel::class, 'id_kecamatan', 'id');
    }

    public function Menara()
    {
        return $this->hasMany(MenaraModel::class, 'id_kecamatan', 'id');
    }


}
