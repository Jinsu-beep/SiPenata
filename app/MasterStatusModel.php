<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterStatusModel extends Model
{
    protected $table = 'tb_m_status';

    public function PengajuanStatus()
    {
        return $this->hasMany(PengajuanStatusModel::class, 'id_status', 'id');
    }
}
