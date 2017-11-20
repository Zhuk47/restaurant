<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function personals()
    {
        return $this->hasMany('App\Personal');
    }
}
