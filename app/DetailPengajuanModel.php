<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPengajuanModel extends Model
{
    protected $table = 'tb_detail_pengajuan';

    public function PengajuanMenara()
    {
        return $this->belongsTo(PengajuanMenaraModel::class, 'id_pengajuan_menara', 'id')->latest();
    }
}
