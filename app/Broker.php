<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BrokerEvaluation;
use App\Score;
use Illuminate\Support\Facades\DB;

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
    protected $arrayFee = array(
        "B" => 3.5/100,
        "S" => 4.2/100,
        "G" => 5.0/100,
        "D" => 5.5/100,
        "P" => 6.5/100
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

    public function getQtdEvaluations(){
        $count = BrokerEvaluation::where('broker_id',$this->id)->count();
       
        return $count;
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

    public function getCallsQtd(){
        $m = date('m');
        $qtdCalls = DB::table('call')
        ->select(DB::raw('count(*) as qtd'))
        ->whereRaw('MONTH(created_at) = ? AND broker_id = ?',[$m,$this->id])
        ->get();

        foreach ($qtdCalls as $qtd) {
            if($qtd->qtd == null){
                return 0;
            }
            return $qtd->qtd;
        }
    }

    public function getCallsQtdDone(){
        $m = date('m');
        $qtdCalls = DB::table('call')
        ->select(DB::raw('count(*) as qtd'))
        ->whereRaw('MONTH(created_at) = ? AND broker_id = ? and status = ?',[$m,$this->id,'C'])
        ->get();

        foreach ($qtdCalls as $qtd) {
            if($qtd->qtd == null){
                return 0;
            }
            return $qtd->qtd;
        }

    }


    public function getTotalBilling(){
        $m = date('m');
        $billing = DB::table('property')
        ->select(DB::raw('sum(property.amount) as amount'))
        ->join('call_property','property.id','=','call_property.property_id')
        ->join('call','call.id','=','call_property.call_id')
        ->whereRaw('MONTH(call.created_at) = ? AND call.broker_id = ? and property.status = ?',[$m,$this->id,'S'])
        ->get();

        foreach ($billing as $b) {
            if($b->amount == null){
                return 0;
            }
            return money_format('%.2n',$b->amount);
        }

    }

    public function getTotalFee(){
        return money_format('%.2n',$this->getTotalBilling() * $this->arrayFee[$this->level]);
    }
    

}
