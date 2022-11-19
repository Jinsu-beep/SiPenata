<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    protected $table = 'tb_user';

    protected $guard = 'admin';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
    ];

    public function SuperAdmin()
    {
        return $this->hasMany(SuperAdminModel::class, 'id_user', 'id');
    }

    public function Admin()
    {
        return $this->hasMany(AdminModel::class, 'id_user', 'id');
    }

    public function TimAdministratif()
    {
        return $this->hasMany(TimAdministratifModel::class, 'id_user', 'id');
    }

    public function TimLapangan()
    {
        return $this->hasMany(TimLapanganModel::class, 'id_user', 'id');
    }

    public function PemilikMenara()
    {
        return $this->hasMany(PemilikMenaraModel::class, 'id_user', 'id');
    }

    public function Provider()
    {
        return $this->hasMany(ProviderModel::class, 'id_user', 'id');
    }
}
