<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = 'personals';

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
