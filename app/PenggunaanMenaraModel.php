<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggunaanMenaraModel extends Model
{
    protected $table = 'tb_penggunaan_menara';

    public function Provider()
    {
        return $this->belongsTo(ProviderModel::class, 'id_provider', 'id');
    }

    public function Menara()
    {
        return $this->belongsTo(MenaraModel::class, 'id_menara', 'id');
    }
}
