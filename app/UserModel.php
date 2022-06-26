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
}
