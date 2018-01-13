<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    protected $table = 'foods';

    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('confirmed', 'dateTimeInCook', 'created_at', 'deleted_at')->withTimestamps();
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')->withPivot('mass');
    }

    public function foodPrice()
    {
        return $this->hasMany('App\FoodPrice');
    }

    public function currentNetCost(Food $food)
    {
        $ingredients = $food->ingredients;
        $net_cost = 0;
        foreach ($ingredients as $ingredient) {
            $mass = $ingredient->pivot->mass;
            $price = $ingredient->prices->sortByDesc('dateTime')->first()->price;
            $net_cost += $mass * $price / 100;
        }
        return $net_cost;
    }

    public function currentTotalWeight(Food $food)
    {
        $ingredients = $food->ingredients;
        $total_weight = 0;
        foreach ($ingredients as $ingredient) {
            $mass = $ingredient->pivot->mass;
            $total_weight += $mass;
        }
        return $total_weight;
    }
}
