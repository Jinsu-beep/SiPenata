<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'tb_admin';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id');
    }
}
