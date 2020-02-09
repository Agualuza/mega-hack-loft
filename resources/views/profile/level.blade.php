@extends('layouts.app')

@section('content')
<div align="center">
    <h2 class="text-orange">Nível</h2>
    <div class="col-8">
        <h3 class="title-bronze">Bronze <img src="../assets/img/party.png"></h3>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-bronze" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <div class="col-8">
        <h3 class="title-silver" style="margin-top:15px">Prata <img src="../assets/img/party.png"></h3>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-silver" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <div class="col-8">
        <h3 class="title-gold" style="margin-top:15px">Ouro</h3>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-gold" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <div class="col-8">
        <h3 class="title-diamond" style="margin-top:15px">Diamante</h3>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-diamond" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <div class="col-8">
        <h3 class="title-black" style="margin-top:15px">Black</h3>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-black" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</div>
@endsection  

