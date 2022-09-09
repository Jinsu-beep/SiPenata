<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BupatiModel extends Model
{
    protected $table = 'tb_bupati';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id');
    }
}