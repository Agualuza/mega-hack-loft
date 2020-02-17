<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Imóvel
class Property extends Model
{
    protected $table = 'property';
    protected $arrayColors = array(
        "S" => "badge-info",
        "F" => "badge-success",
        "K" => "badge-danger"
    );

    protected $arrayStatus = array(
        "S" => "Vendendo",
        "F" => "Vendido",
        "K" => "Retirado"
    );

    public function getColor() {
        return $this->arrayColors[$this->status];
    }

    public function getStatus() {
        return $this->arrayStatus[$this->status];
    }

    public function call_property()
    {
        return $this->hasMany('App\CallProperty');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function property_photo()
    {
        return $this->hasMany('App\PropertyPhoto');
    }

}
