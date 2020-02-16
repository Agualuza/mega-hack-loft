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
    protected $arrayColor = array(
        "B" => "#cd7f32",
        "S" => "#C0C0C0",
        "G" => "#ffd700",
        "D" => "#9ac5db",
        "P" => "#000000"
    );

    private $bronze = 0;
    private $silver = 2200;
    private $gold = 4700;
    private $diamond = 8100;
    private $black = 12200;

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
        return $this->belongsTo('App\City');
    }

    public function dispatch()
    {
        return $this->hasMany('App\Dispatch');
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
        $score = $this->score;
        $total = 0;

        foreach ($score as $s) {
            $total += $s->score;
        }

        return $total;
    }

    public function getLevel(){
        return $this->arrayLevels[$this->level];
    }

    public function getNODBTriggerColorLevel() {
        $key = "B";
        if($this->total_score){
            if($this->total_score >= 12200){
                $key = 'P';
            } else if($this->total_score >= 8100){
                $key = 'D';
            } else if($this->total_score >= 4700){
                $key = 'G';
            } else if($this->total_score >= 2200){
                $key = 'S';
            } 
        }
        return $this->arrayColor[$key];
    }

    public function getNoDBTriggerLevelChar(){
        $key = "B";
        if($this->total_score){
            if($this->total_score >= 12200){
                $key = 'P';
            } else if($this->total_score >= 8100){
                $key = 'D';
            } else if($this->total_score >= 4700){
                $key = 'G';
            } else if($this->total_score >= 2200){
                $key = 'S';
            } 
        }
        return $key;
    }

    public function getNoDBTriggerLevel(){
        $key = "B";
        if($this->total_score){
            if($this->total_score >= 12200){
                $key = 'P';
            } else if($this->total_score >= 8100){
                $key = 'D';
            } else if($this->total_score >= 4700){
                $key = 'G';
            } else if($this->total_score >= 2200){
                $key = 'S';
            } 
        }
        return $this->arrayLevels[$key];
    }

    public function getCallsQtd(){
        $m = date('m');
        $y = date('Y');
        $qtdCalls = DB::table('call')
        ->select(DB::raw('count(*) as qtd'))
        ->whereRaw('MONTH(created_at) = ? AND YEAR(created_at) = ? AND broker_id = ?',[$m,$y,$this->id])
        ->get();

        foreach ($qtdCalls as $qtd) {
            if($qtd->qtd == null){
                return 0;
            }
            return $qtd->qtd;
        }
    }

    //0 >= Bronze < 2200 sum 2200
    //2200 >= Prata < 4700 sum 2500 
    //4700 >= Ouro < 8100 sum 3400
    //8100 >= Diamond < 12200 sum 4100
    //12200 >= Black

    public function getEachLevelScore(){
        $totalScore = $this->total_score;
        $bronze = 100;
        $silver = 0;
        $gold = 0;
        $diamond = 0;
        $black = 0;
        
        if($totalScore >= $this->black){
            $silver = 100;
            $gold = 100;
            $diamond = 100;
            $black = 100;
        } else if($totalScore >= $this->diamond) {
            $silver = 100;
            $gold = 100;
            $diamond = 100;
            $black = ($totalScore - $this->diamond)/$this->black;
            $black = $black * 100;
        } else if($totalScore >= $this->gold) {
            $silver = 100;
            $gold = 100;
            $diamond = ($totalScore - $this->gold)/$this->diamond;
            $diamond = $diamond * 100;
        } else if($totalScore >= $this->silver) {
            $silver = 100;
            $gold = ($totalScore - $this->silver)/$this->gold;
            $gold = $gold * 100;
        } else if($totalScore >= $this->bronze) {
            $silver = ($totalScore)/$this->silver;
            $silver = $silver * 100;
        } 

        return array("B" => $bronze, "S" => $silver, "G" => $gold, "D" => $diamond, "P" => $black);

    }

    public function getCallsQtdDone(){
        $m = date('m');
        $y = date('Y');
        $qtdCalls = DB::table('call')
        ->select(DB::raw('count(*) as qtd'))
        ->whereRaw('MONTH(created_at) = ? AND YEAR(created_at) = ? AND broker_id = ? and status = ?',[$m,$y,$this->id,'C'])
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
        $y = date('Y');
        $billing = DB::table('property')
        ->select(DB::raw('sum(property.amount) as amount'))
        ->join('call_property','property.id','=','call_property.property_id')
        ->join('call','call.id','=','call_property.call_id')
        ->whereRaw('MONTH(call.created_at) = ? AND YEAR(call.created_at) = ? AND call.broker_id = ? and property.status = ?',[$m,$y,$this->id,'S'])
        ->get();

        foreach ($billing as $b) {
            if($b->amount == null){
                return 0;
            }
            return money_format('%.2n',$b->amount);
        }

    }

    public function getTotalFee(){
        return money_format('%.2n',$this->getTotalBilling() * $this->arrayFee[$this->getNoDBTriggerLevelChar()]);
    }
    

}
