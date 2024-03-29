<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersetujuanPendampingModel extends Model
{
    protected $table = 'tb_persetujuan_pendamping';

    public function PengajuanMenara()
    {
        return $this->belongsTo(PengajuanMenaraModel::class, 'id_pengajuan_menara', 'id');
    }
}
