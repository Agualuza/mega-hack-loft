@extends('layouts.app')

@section('content')
<div class="profile-page">
    <div class="wrapper">
        <div align="center">
        <div class="container">
            <div class="photo-container">
                <img src="{{$broker->photo}}" alt=""> 
            </div>
            <form>
                <button type="submit" class="btn btn-edit">Editar Perfil</button>
            </form>   
            <h3 class="title" style="margin-top:0">Iago Agualuza</h3>
            <p class="category">{{$broker->creci}} CRECI{{$broker->state->abbreviation}}</p>
            <div class="content">
            <div class="social-description">
                <h2>{{$broker->getEvaluationScore()}}</h2>
                <i class="now-ui-icons ui-2_favourite-28"></i>
            </div>
            <div class="social-description">
                <div style="display: flex;justify-content:space-around;">
                    <h2 class="text-right"><span style="color:gold">{{$broker->getLevel()}}</span></h2>
                </div>
                <i class="now-ui-icons sport_trophy"></i>
            </div>
            <div class="social-description">
                <h2>{{$broker->getScore()}}</h2>
                <i class="now-ui-icons objects_key-25"></i>
            </div>
            </div>
        </div>
        <div align="center" style="margin-top:20px;margin-bottom:20px;">
            <h2>Sobre mim</h2>
            <h5 class="description">{{$broker->description}}</h5>
        </div>
    </div>
</div>
@endsection  