@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4 col-xl-3 col-sm-10">
        <div class="card style-card card-border-orange">
            <div class="card-block">
                <h6 class="m-b-20">Chamadas</h6>
                <div class="card-flex-content">
                <h2><i class="now-ui-icons business_briefcase-24"></i></h2><h2 class="text-right"><span>{{$broker->getCallsQtd()}}</span></h2>
                </div>
                <div class="card-flex-content">
                    <p class="m-b-0">Chamadas Realizadas</p> <p> <span class="f-right"><strong>{{$broker->getCallsQtdDone()}}</strong></span></p> 
                </div>  
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3 col-sm-10">
        <div class="card style-card card-border-orange">
            <div class="card-block">
                <h6 class="m-b-20">Total em Vendas</h6>
                <div class="card-flex-content">
                    <h2><i class="now-ui-icons business_money-coins"></i></h2><h3 class="text-right"><span>R$ {{$broker->getTotalBilling()}}</span></h3>
                </div>
                <div class="card-flex-content">
                    <p class="m-b-0">Comissão</p> <p><span class="f-right"><strong>R$ {{$broker->getTotalFee()}}</strong></span></p>   
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3 col-sm-10">
        <div class="card style-card card-border-orange">
            <div class="card-block">
                <h6 class="m-b-20">Avaliação</h6>
                <div class="card-flex-content">
                    <h2><i class="now-ui-icons ui-2_favourite-28"></i></h2><h3 class="text-right"><span>{{$broker->getEvaluationScore()}}</span></h3>
                </div>
                <div class="card-flex-content">
                    <p class="m-b-0">Avaliações</p> <p><span class="f-right"><strong>{{$broker->getQtdEvaluations()}}</strong></span></p>   
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3 col-sm-10">
        <div class="card style-card card-border-orange">
            <div class="card-block">
                <h6 class="m-b-20">Nível</h6>
                <div class="card-flex-content">
                    <h2><i class="now-ui-icons sport_trophy"></i></h2><h3 class="text-right"><span style="color:<?php echo $broker->getNODBTriggerColorLevel()?>">{{$broker->getNoDBTriggerLevel()}}</span></h3>
                </div>
                <div class="card-flex-content">
                    <p class="m-b-0">Pontos</p> <p><span class="f-right"><strong>{{$broker->getScore()}}</strong></span></p>   
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-12">
        <div class="card style-card card-border-orange">
            <div>    
                    <div class="title-style"><h3 class="text-orange">Chamadas</h3></div>
            </div>    
            <div class="card-block">
                @foreach ($broker->dispatch as $d)
                <div class="alert alert-info row alert-avaible" role="alert">
                    <p class="item-style"><b>{{$d->call->id}}</b></p>
                    <p class="item-style"><b>{{$d->call->callProperty[0]->property->neighborhood}}</b></p>
                    <p class="item-style"><b>{{$d->getDate()}}</b></p>
                    <div style="display:flex;justify-content:space-around">
                        <button type="button" class="btn btn-neutral green-btn"><p>Aceitar<p></button>
                        <button type="button" class="btn btn-neutral red-btn"><p>Recusar<p></button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection  