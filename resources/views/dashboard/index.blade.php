@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4 col-xl-3 col-sm-10">
        <div class="card style-card card-border-orange">
            <div class="card-block">
                <h6 class="m-b-20">Chamadas</h6>
                <div class="card-flex-content">
                <h2><i class="now-ui-icons business_briefcase-24"></i></h2><h2 class="text-right"><span>7</span></h2>
                </div>
                <div class="card-flex-content">
                    <p class="m-b-0">Chamadas Realizadas</p> <p> <span class="f-right"><strong>3</strong></span></p> 
                </div>  
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3 col-sm-10">
        <div class="card style-card card-border-orange">
            <div class="card-block">
                <h6 class="m-b-20">Total em Vendas</h6>
                <div class="card-flex-content">
                    <h2><i class="now-ui-icons business_money-coins"></i></h2><h3 class="text-right"><span>R$ 1.000.000</span></h3>
                </div>
                <div class="card-flex-content">
                    <p class="m-b-0">Comissão</p> <p><span class="f-right"><strong>6.000</strong></span></p>   
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3 col-sm-10">
        <div class="card style-card card-border-orange">
            <div class="card-block">
                <h6 class="m-b-20">Avaliação</h6>
                <div class="card-flex-content">
                    <h2><i class="now-ui-icons ui-2_favourite-28"></i></h2><h3 class="text-right"><span>4.78</span></h3>
                </div>
                <div class="card-flex-content">
                    <p class="m-b-0">Avaliações</p> <p><span class="f-right"><strong>120</strong></span></p>   
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3 col-sm-10">
        <div class="card style-card card-border-orange">
            <div class="card-block">
                <h6 class="m-b-20">Nível</h6>
                <div class="card-flex-content">
                    <h2><i class="now-ui-icons sport_trophy"></i></h2><h3 class="text-right"><span style="color:gold">Gold</span></h3>
                </div>
                <div class="card-flex-content">
                    <p class="m-b-0">Pontos</p> <p><span class="f-right"><strong>1310</strong></span></p>   
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
                <div class="alert alert-info row alert-avaible" role="alert">
                    <p class="item-style"><b>Jorge</b></p>
                    <p class="item-style"><b>Icaraí</b></p>
                    <p class="item-style"><b>10/03/2020</b></p>
                    <div style="display:flex;justify-content:space-around">
                        <button type="button" class="btn btn-neutral green-btn"><p>Aceitar<p></button>
                        <button type="button" class="btn btn-neutral red-btn"><p>Recusar<p></button>
                    </div>
                </div>
                <div class="alert alert-info row alert-avaible" role="alert">
                    <p class="item-style"><b>Iago</b></p>
                    <p class="item-style"><b>Icaraí</b></p>
                    <p class="item-style"><b>10/03/2020</b></p>
                    <div style="display:flex;justify-content:space-around">
                        <button type="button" class="btn btn-neutral green-btn"><p>Aceitar<p></button>
                        <button type="button" class="btn btn-neutral red-btn"><p>Recusar<p></button>
                    </div>
                </div>
                <div class="alert alert-danger row alert-unavaible" role="alert">
                    <p class="item-style"><b>Mauricio</b></p>
                    <p class="item-style"><b>Icaraí</b></p>
                    <p class="item-style"><b>10/03/2020</b></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection  