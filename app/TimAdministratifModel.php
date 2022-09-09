<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimAdministratifModel extends Model
{
    protected $table = 'tb_tim_administratif';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id');
    }
}
