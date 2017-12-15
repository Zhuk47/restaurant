<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodPrice extends Model
{
    protected $table = 'food_prices';

    use SoftDeletes;

    public function food()
    {
        return $this->belongsTo('App\Food');
    }
}
