<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderModel extends Model
{
    protected $table = 'tb_m_provider';

    public function PenggunaanMenara()
    {
        return $this->hasMany(PenggunaanMenaraModel::class, 'id_menara', 'id');
    }


}
