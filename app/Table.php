<?php
/**
 * Created by PhpStorm.
 * User: Kulibacks
 * Date: 28.11.2017
 * Time: 17:42
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $isFree = ['attribute'];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function getIsFreeAttribute()
    {
        return $this->orders->where('deleted_at', null)->count();
    }

}
