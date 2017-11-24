<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingradient extends Model
{
    protected $table = 'ingradients';

    public function foods()
    {
        return $this->belongsToMany('App\Food')->withPivot('mass');
    }

    public function price()
    {
        return $this->belongsTo('App\Price');
    }
}
