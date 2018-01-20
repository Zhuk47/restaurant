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

    public function getMinDate()
    {
        $firstMinPrice = Price::withTrashed()->where('ingredient_id', $this->id)->orderBy('created_at', 'asc')->first();
        $formedTime = substr($firstMinPrice->created_at, 0, 16);
        $startTime = date('Y-m-d H:i',strtotime($formedTime.' + 1 min'));
        $result = str_replace(" ", "T", $startTime);

        return $result;
    }
}
