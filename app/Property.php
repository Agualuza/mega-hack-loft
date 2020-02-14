<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Imóvel
class Property extends Model
{
    protected $table = 'property';

    public function call_property()
    {
        return $this->hasMany('App\CallProperty');
    }
}
