<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Avaliação do cliente sobre o corretor
class BrokerEvaluation extends Model
{
    protected $table = 'broker_evaluation';

    public function getEvaluation($broker_id){
        $evaluations = $this::where('broker_id',$broker_id)->limit(100)->get();
        $total = 0;
        $qtd = 0;

        foreach ($evaluations as $e) {
            $total += $e->score;
            $qtd++;
        }

        return number_format($total/$qtd,2);
    }

}
