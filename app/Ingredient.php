<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = 'ingredients';

    public function foods()
    {
        return $this->belongsToMany('App\Food')->withPivot('mass');
    }

    public function price()
    {
        return $this->belongsTo('App\Price');
    }
}
