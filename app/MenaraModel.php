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

    public function Kecamatan()
    {
        return $this->belongsTo(KecamatanModel::class, 'id_m_kecamatan', 'id');
    }
}
