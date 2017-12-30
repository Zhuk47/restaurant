<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{

    protected $table = 'ingredients';

    use SoftDeletes;

    public function foods()
    {
        return $this->belongsToMany('App\Food')->withPivot('mass');
    }

    public function prices()
    {
        return $this->hasMany('App\Price');
    }
}
