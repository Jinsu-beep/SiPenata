<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPerusahaanModel extends Model
{
    protected $table = 'tb_detail_perusahaan';

    public function Perusahaan()
    {
        return $this->belongsTo(PerusahaanModel::class, 'id_perusahaan', 'id');
    }
}
