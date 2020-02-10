<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Chamado de interesse em comprar imóveis
class City extends Model
{
    protected $table = 'city';

    public function state()
    {
        return $this->hasOne('App\State');
    }

}
