@extends('layouts.app')

@section('content')
<div class="profile-page">
    <div class="wrapper">
        <div align="center">
        <div class="container">
            <div class="photo-container">
                <img src="https://media-exp1.licdn.com/dms/image/C4E03AQF6_Y5xP6pd7w/profile-displayphoto-shrink_200_200/0?e=1586390400&v=beta&t=Rc2CYJi__DtETE4_JMCkxRb4_9aYgdvWLz2ayu4ajHU" alt=""> 
            </div>
            <form>
                <button type="submit" class="btn btn-edit">Editar Perfil</button>
            </form>   
            <h3 class="title" style="margin-top:0">Iago Agualuza</h3>
            <p class="category">000123 CRECIRJ</p>
            <div class="content">
            <div class="social-description">
                <h2>4.78</h2>
                <i class="now-ui-icons ui-2_favourite-28"></i>
            </div>
            <div class="social-description">
                <div style="display: flex;justify-content:space-around;">
                    <h2 class="text-right"><span style="color:gold">Gold</span></h2>
                </div>
                <i class="now-ui-icons sport_trophy"></i>
            </div>
            <div class="social-description">
                <h2>1310</h2>
                <i class="now-ui-icons objects_key-25"></i>
            </div>
            </div>
        </div>
        <div align="center" style="margin-top:20px;margin-bottom:20px;">
            <h2>Sobre mim</h2>
            <h5 class="description">An artist of considerable range, 
                Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, 
                performs and records all of his own music, giving it a warm, intimate feel with a solid
                 groove structure. An artist of considerable range.</h5>
        </div>
    </div>
</div>
@endsection  