<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimLapanganModel extends Model
{
    protected $table = 'tb_tim_lapangan';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id');
    }
    
    public function opd()
    {
        return $this->belongsTo(OPDModel::class, 'id_opd', 'id');
    }
}
