<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdminModel extends Model
{
    protected $table = 'tb_super_admin';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id');
    }
}
