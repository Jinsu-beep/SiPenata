<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderModel extends Model
{
    protected $table = 'tb_provider';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id');
    }
}
