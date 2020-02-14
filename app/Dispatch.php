<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Broker;

class Dispatch extends Model
{
    protected $table = 'dispatch';

    public function call()
    {
        return $this->belongsTo('App\Call');
    }

    public function getDate(){
        return date('d/m/Y H:i:s', strtotime($this->created_at));
    }
}
