<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BrokerEvaluation;
use App\Score;

//Corretor
class Broker extends Model
{
    public $primarykey = 'id';
    protected $table = 'broker';
    protected $arrayLevels = array(
        "B" => "Bronze",
        "S" => "Prata",
        "G" => 'Ouro',
        "D" => "Diamante",
        "P" => "Black"
    );

    public function call()
    {
        return $this->hasMany('App\Call');
    }

    public function message()
    {
        return $this->hasMany('App\Message');
    }

    public function field()
    {
        return $this->hasMany('App\Field');
    }

    public function broker_evaluation()
    {
        return $this->hasMany('App\BrokerEvaluation');
    }

    public function score()
    {
        return $this->hasMany('App\Score');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function city()
    {
        return $this->hasOne('App\City');
    }

    public function getEvaluationScore(){
        $evaluations = BrokerEvaluation::where('broker_id',$this->id)->limit(100)->get();
        $total = 0;
        $qtd = 0;

        foreach ($evaluations as $e) {
            $total += $e->score;
            $qtd++;
        }

        return number_format($total/$qtd,2);
    }

    public function getScore(){
        $score = Score::where('broker_id',$this->id)->get();
        $total = 0;

        foreach ($score as $s) {
            $total += $s->score;
        }

        return $total;
    }

    public function getLevel(){
        return $this->arrayLevels[$this->level];
    }
    

    

}
