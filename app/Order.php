<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'orders';
    protected $isFree = ['attribute'];

    use SoftDeletes;

    public function foods()
    {
        return $this->belongsToMany('App\Food')->withPivot('confirmed', 'dateTimeInCook', 'created_at', 'deleted_at')->withTimestamps();
    }

    public function table()
    {
        return $this->belongsTo('App\Table');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getIsFreeAttribute()
    {
        return $this->foods()->wherePivot('deleted_at', null)->count();
    }

    public function totalPrice()
    {
        $sum = 0;
        foreach ($this->foods as $food) {
            foreach ($food->foodPrice as $price) {
                $sum += $price->price;
            }
        }
        return $sum;
    }
}
