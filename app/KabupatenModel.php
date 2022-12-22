<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabupatenModel extends Model
{
    protected $table = 'tb_m_kabupaten';

    public function PemilikMenara()
    {
        return $this->hasMany(PemilikMenaraModel::class, 'id_kabupaten', 'id');
    }

    public function Perusahaan()
    {
        return $this->hasMany(PerusahaanModel::class, 'id_kabupaten', 'id');
    }

    public function PengajuanMenara()
    {
        return $this->hasMany(PengajuanMenaraModel::class, 'id_kabupaten', 'id');
    }

    public function Menara()
    {
        return $this->hasMany(MenaraModel::class, 'id_kecamatan', 'id');
    }
}
