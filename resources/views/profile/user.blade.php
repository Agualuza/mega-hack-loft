@extends('layouts.app')

@section('title')
Perfil
@endsection

@section('content')
<div class="profile-page">
    <div class="wrapper">
        <div align="center">
        <div class="container">
            <form>
                <button type="submit" class="btn btn-edit">Editar Perfil</button>
            </form>   
            <h3 class="title" style="margin-top:0">{{$user->name}}</h3>
            <div class="content">
            <div class="social-description">
                <h2>2</h2>
                <div><b>Imóveis Anunciados</b></div>
                <i class="now-ui-icons shopping_shop"></i>
            </div>
            <div class="social-description">
                <h2>1</h2>
                <div><b>Chamados Abertos Compra</b></div>
                <i class="now-ui-icons objects_key-25"></i>
            </div>
            </div>
        </div>
        <div align="center" style="margin-top:20px;margin-bottom:20px;">
            <h2>Sobre mim</h2>
            <h5 class="description"></h5>
        </div>
    </div>
</div>
@endsection  