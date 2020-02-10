<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Chamado de interesse em comprar imóveis
class State extends Model
{
    protected $table = 'state';

    public function country()
    {
        return $this->hasOne('App\Country');
    }

    public function broker()
    {
        return $this->hasMany('App\Broker');
    }

}
