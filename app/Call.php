<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Chamado de interesse em comprar imóveis
class Call extends Model
{
    protected $table = 'call';
    protected $arrayStatus = array(
        "C" => "Finalizada",
        "W" => "Aguardando Atendimento",
        "O" => "Aberta",
        "K" => "Cancelada"
    );

    protected $arrayColors = array(
        "C" => "badge-success",
        "W" => "badge-primary",
        "O" => "badge-info",
        "K" => "badge-danger"
    );

    public function callProperty()
    {
        return $this->hasMany('App\CallProperty');
    }

    public function getCallStatus() {
        return $this->arrayStatus[$this->status];
    }

    public function getCallColor() {
        return $this->arrayColors[$this->status];
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
