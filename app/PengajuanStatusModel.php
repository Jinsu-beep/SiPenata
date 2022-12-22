<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanStatusModel extends Model
{
    protected $table = 'tb_pengajuan_status';

    public function PengajuanMenara()
    {
        return $this->belongsTo(PengajuanMenaraModel::class, 'id_pengajuan_menara', 'id');
    }

    public function Status()
    {
        return $this->belongsTo(MasterStatusModel::class, 'id_status', 'id');
    }
}
