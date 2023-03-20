<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanBerkalaModel extends Model
{
    protected $table = 'tb_laporan_kondisi';

    public function Menara()
    {
        return $this->belongsTo(MenaraModel::class, 'id_menara', 'id');
    }

    public function Perusahaan()
    {
        return $this->belongsTo(PerusahaanModel::class, 'id_perusahaan', 'id');
    }
}
