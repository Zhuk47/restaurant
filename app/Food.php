<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('dateTimeInCook', 'deleted_at', 'confirmed');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')->withPivot('mass');
    }

    public function foodPrice()
    {
        return $this->hasOne('App\FoodPrice');
    }
}
