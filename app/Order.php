<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function foods()
    {
        return $this->belongsToMany('App\Food');
    }
}
