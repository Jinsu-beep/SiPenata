<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OPDModel extends Model
{
    protected $table = 'tb_opd';

    public function TimAdministratif()
    {
        return $this->hasMany(TimAdministratifModel::class, 'id_opd', 'id');
    }

    public function TimLapangan()
    {
        return $this->hasMany(TimLapanganModel::class, 'id_opd', 'id');
    }
}
