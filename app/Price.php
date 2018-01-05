<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    protected $table = 'prices';

    use SoftDeletes;

    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }

//    public function scopeByDate($query, $date)
//    {
//        return $query->whereBetween($date, ['2017-12-27 20:46:25', '2017-12-27 20:48:50']);
//    }
}
