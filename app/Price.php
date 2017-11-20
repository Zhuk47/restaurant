<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'prices';

    public function ingradients()
    {
        return $this->hasMany('App\Ingradients');
    }

}
