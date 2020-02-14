<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallProperty extends Model
{
    protected $table = 'call_property';

    public function property()
    {
        return $this->belongsTo('App\Property');
    }

}
