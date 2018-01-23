<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

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
        return $this->belongsToMany('App\Order')->withPivot('confirmed', 'dateTimeInCook', 'created_at', 'deleted_at', 'comment')->withTimestamps();
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')->withPivot('mass');
    }

    public function foodPrice()
    {
        return $this->hasMany('App\FoodPrice');
    }

    public function currentNetCost()
    {
        $ingredients = $this->ingredients;
        $net_cost = 0;
        foreach ($ingredients as $ingredient) {
            $mass = $ingredient->pivot->mass;
            $price = $ingredient->prices->sortByDesc('dateTime')->first()->price;
            $net_cost += $mass * $price / 100;
        }
        return $net_cost;
    }

    public function currentTotalWeight()
    {
        $ingredients = $this->ingredients;
        $total_weight = 0;
        foreach ($ingredients as $ingredient) {
            $mass = $ingredient->pivot->mass;
            $total_weight += $mass;
        }
        return $total_weight;
    }

    public function getMinDate()
    {
        $firstMinPrice = FoodPrice::withTrashed()->where('food_id', $this->id)->orderBy('created_at', 'asc')->first();
        $formedTime = substr($firstMinPrice->created_at, 0, 16);
        $startTime = date('Y-m-d H:i',strtotime($formedTime.' + 1 min'));
        $result = str_replace(" ", "T", $startTime);

        return $result;
    }

    public function getAvgCookTime()
    {
        $time = DB::table('food_order')
            ->where('food_id', '=', $this->id)
            ->avg('timeInCook');
        $result = date("H:i:s", mktime(0, 0, $time));
        return $result;
    }
}
