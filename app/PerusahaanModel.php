<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerusahaanModel extends Model
{
    protected $table = 'tb_perusahaan';

    public function PemilikMenara()
    {
        return $this->hasOne(PemilikMenaraModel::class, 'id_perusahaan', 'id');
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
