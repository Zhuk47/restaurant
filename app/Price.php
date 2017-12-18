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

}
