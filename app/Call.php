<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Chamado de interesse em comprar imóveis
class Call extends Model
{
    protected $table = 'call';

    public function callProperty()
    {
        return $this->hasMany('App\CallProperty');
    }


}
