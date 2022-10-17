<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KecamatanModel extends Model
{
    protected $table = 'tb_m_kecamatan';

    public function Menara()
    {
        return $this->hasMany(MenaraModel::class, 'id_m_kecamatan', 'id');
    }
}
