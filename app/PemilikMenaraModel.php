<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemilikMenaraModel extends Model
{
    protected $table = 'tb_pemilik_menara';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id');
    }

    public function Menara()
    {
        return $this->hasMany(MenaraModel::class, 'id_pemilik_menara', 'id');
    }
}
