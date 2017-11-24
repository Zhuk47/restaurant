<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'prices';

    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }

}
