<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemilikMenaraModel extends Model
{
    protected $table = 'tb_pemilik_menara';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id');
    }

    public function Menara()
    {
        return $this->hasMany(MenaraModel::class, 'id_pemilik_menara', 'id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(PerusahaanModel::class, 'id_perusahaan', 'id');
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
