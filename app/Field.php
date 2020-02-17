<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

//Área de atuação do corretor
class Field extends Model
{
    protected $table = 'field';

    public function vertex()
    {
        return $this->hasMany('App\Vertex');
    }

}
