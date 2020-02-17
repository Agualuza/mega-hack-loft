@extends('layouts.app')

@section('content')
<div class="row">
        <input onfocusout="doGeocode()" id="add" type="text" class="form-control" name="name_field" placeholder="Digite seu endereço completo"></input>
</div>
<div class="row" id="row-id">
    <div id="map" class="col-10 map-style"></div>
    <div style="padding-right:150px;padding-left:150px;max-width:50%;" class="card-border-orange text-orange">
        <form enctype="multipart/form-data" method="POST" action="/sell/create/new" class="form my-3">
            @csrf
            <div class="row my-1">
                <label class="text-orange">Quartos</label>
                <input type="number" class="form-control" min="1" max="10" name="room">
            </div>
            <div class="row my-1">
                <label class="text-orange">Garagem</label>
                <select name="garage">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
            <div class="row my-1">
                <label class="text-orange">Mobiliado</label>
                <select name="furnished">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
            <div class="row my-1">
                <label class="text-orange">Tipo</label>
                <select name="type">
                    <option value="S">Apartamento Padrão</option>
                    <option value="D">Apartamento Duplo</option>
                    <option value="C">Cobertura</option>
                </select>
            </div>
            <div align="center">
                <label class="mt-2 text-orange" >Fotos</label>
            </div>
            <div id="file-area" class="row">
               <div class="custom-file my-1">
                <input class="custom-file-input" name="file0" type="file" />
                <label class="custom-file-label">Escolher imagem</label>
               </div>     
            </div>
            <div align="center">
                <a class="mt-4" style="cursor:pointer" onclick="addPhoto()"><i class="now-ui-icons ui-1_simple-add"></i></a>
            </div>
            
            <input id="form-nb" type="hidden" name="nb">
            <input id="form-city" type="hidden" name="city">
            <input id="form-adr" type="hidden" name="address">
            <input id="form-lat" type="hidden" name="lat">
            <input id="form-lng" type="hidden" name="lng">
            <button class="btn btn-primary btn-round form-control" type="submit">Cadastrar</button>
        </form>
    </div>
</div>

@endsection  

@section('scripts')
<script>

        $(document).ready(()=>{
            index = 0;
        });
        // Initialize and add the map
        function initMap() {
        marker = null;
        var key = "AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA";
        center = {lat: -22.906428, lng: -43.133264};
       
        map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: 17,
                center: center,
                fullscreenControl:false,
                mapTypeControl:false,
                streetViewControl:false,
            });


        }

        doGeocode = () => {
            var add = $("#add").val();
            var key = "AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA";
            $.ajax({
            method: "GET",
            url: "https://maps.googleapis.com/maps/api/geocode/json",
            data: { key: key, address: add }
            })
            .done(function( r ) {
                formatted_address = null;
                nb = null;
                city = null;
                adr = null;
                lat = r.results[0].geometry.location.lat;
                lng = r.results[0].geometry.location.lng;

                r['results'].forEach(res => {
                    formatted_address = res.formatted_address;
                    res.address_components.forEach(ac => {
                        ac.types.forEach(t => {
                            if(t == "route"){
                                adr = ac.long_name;
                            } if(t == "sublocality_level_1"){
                                nb = ac.long_name;
                            } if ( t == "administrative_area_level_2"){
                                city = ac.long_name;
                            }
                        });
                    });
                    if(res.geometry.location.lat && res.geometry.location.lng){
                        pos = {lat: res.geometry.location.lat, lng: res.geometry.location.lng};
                    }
                });
                var icon = {
                    url: "../assets/img/apartment.png", // url
                    scaledSize: new google.maps.Size(32, 32), // scaled size
                };

                if(marker){
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                        position: pos,
                        icon: icon
                });
                marker.setMap(map);
                map.setCenter(pos);
                $("#add").val(formatted_address);
                $("#form-adr").val(adr);
                $("#form-city").val(city)
                $("#form-nb").val(nb)
                $("#form-lat").val(lat)
                $("#form-lng").val(lng)
        });
        }
    
        addPhoto = () => {
            index = index + 1;
            var html = '<div class="custom-file my-1">'+
                '<input type="file" name="file'+index+'" class="custom-file-input">'+
                '<label class="custom-file-label">Escolher arquivo</label></div>';
            $("#file-area").append(html);
        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA&callback=initMap">
    </script>
@endsection  