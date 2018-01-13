<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'orders';

    use SoftDeletes;

    public function foods()
    {
        return $this->belongsToMany('App\Food')->withPivot('confirmed', 'dateTimeInCook', 'deleted_at', 'created_at')->withTimestamps();
    }

    public function table()
    {
        return $this->belongsTo('App\Table');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
