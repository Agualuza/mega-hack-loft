@extends('layouts.app')

@section('title')
@endsection

@section('content')
<div align="center" class="row" style="display:none;" id="prop-div">

<div class="card col-8" style="width: 20rem;">
<div style="margin:15px;text-transform:uppercase"><a onclick="showMap()"><span class="badge badge-danger">Fechar</span></a></div>
<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
  <div id="corousel-content" class="carousel-inner">
    
  </div>
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Próximo</span>
  </a>
</div>
  <div id="card-body" class="card-body">

  </div>
</div>

</div>
<div id="map-div" style="display: flex;justify-content:space-around" class="row">
<div id="max" align="center" class="col-8 my-jumbotron none">
<div style="float:right;width:16px" class="mr-2 mt-2">
    <a onclick="maximize()" ><i class="now-ui-icons arrows-1_minimal-up text-orange"></i></a>
</div>
</div>
<div id="min" align="center" class="col-8 my-jumbotron">
<div style="float:right;width:16px" class="mr-2 mt-2">
    <a onclick="minimize()" ><i class="now-ui-icons arrows-1_minimal-down text-orange"></i></a>
</div>
<div class="row" align="center">
        <h6 style="width:100%"><label class="text-orange lb mt-4">Filtro</label></h6>
</div>
<form action="/buy/filter" method="POST" style="display:flex;justify-content:space-around" class="form-inline mb-3">
    @csrf
    <div>
        <label class="text-orange lb">Cidade</label>
        <input type="text" id="filter_city" class="form-control" name="filter_city"></input>
        <label class="text-orange lb">Bairro</label>
        <input type="text" id="filter_neighborhood" class="form-control" name="filter_neighborhood"></input>
    </div>
    <!-- <div>
        <label class="text-orange lb">Quartos</label>
        <select id="room" name="room" class="form-control">
            <option value="" selected>Todos</option>
            <option value="= 1">1</option>
            <option value="= 2">2</option>
            <option value="= 3">3</option>
            <option value="= 4">4</option>
            <option value=">= 4">+4</option>
        </select>
        <label class="text-orange lb">Garagem</label>
        <select id="garage" name="garage" class="form-control">
            <option value="" selected>Todos</option>
            <option value="is NULL">Sem garagem</option>
            <option value="= 1">1 carro</option>
            <option value="= 2">2 carros</option>
            <option value=">= 2">+2 carros</option>
        </select>
        <label class="text-orange lb">Tipo</label>
        <select id="type" name="type" class="form-control">
            <option value="" selected>Todos</option>
            <option value="S">Apartamento simples</option>
            <option value="D">Apartamento duplex</option>
            <option value="C">Cobertura</option>
        </select>
    </div> -->
</form>
<button type="button" onclick="fitBounds()" class="btn btn-primary btn-round">Filtrar</button>
</div>
<div id="map" class="col-8 map-style"></div>
</div>
@endsection  

@section('scripts')
<script>
    $(document).ready(()=>{
        $("#carousel").carousel();  
    });
     function initMap() {

        center = {lat: -22.908150, lng: -43.177463};
        getLocation();

        map = new google.maps.Map(
        document.getElementById('map'), {
            zoom: 17,
            center: center,
            fullscreenControl:false,
            mapTypeControl:false,
            streetViewControl:false,
        });
        initilizeMap();
        
    }

submitFilter = () => {
    if($("#garage").val() || $("#room").val() || $("#type").val()) {
        var g = $("#garage").val() != "" ? $("#garage").val() : null;
        var r = $("#room").val() != "" ? $("#room").val() : null;
        var t = $("#type").val() != "" ? $("#type").val() : null;
        $.ajax({
        method: "GET",
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "<?php echo url('/buy/filter')?>",
        data: { garage: g, room: r , type: t,
        filter_neighborhood : $("#filter_neighborhood").val(), filter_city: $("#filter_city").val()}
        })
        .done(function( r ) {
                console.log(r);
            });
    }
    
    if(($("#filter_neighborhood").val() || $("#filter_neighborhood").val() )) {
        fitBounds();
    }
    
}

minimize = () => {
    $("#min").hide();
    $("#max").show();
}

maximize = () => {
    $("#max").hide();
    $("#min").show();
}

initilizeMap = () => {
    var icon = {
            url: "../assets/img/apartment.png", // url
            scaledSize: new google.maps.Size(32, 32), // scaled size
    };
    markerList = [];
    <?php foreach ($properties as $property) {?>
        var pos = {lat: <?php echo $property->lat ?>, lng: <?php echo $property->lng ?>}
        marker = new google.maps.Marker({
            position: pos,
            id: "<?php echo $property->id ?>",
            title:"<?php echo $property->address . ", " . $property->neighborhood . ", " . $property->city->name ?>",
            icon: icon
        });
        marker.setMap(map);
        markerList.push(marker);
    <?php } ?>

        markerList.forEach(m => {
            m.info = new google.maps.InfoWindow({
            content: '<div align="center">'+m.title+'<br/><button style="text-transform:uppercase" onclick="lookProperty('+m.id+')" class="btn btn-primary btn-round">Quero conhecer</button></div>'
            });
            m.addListener('click', function() {
                m.info.open(map, m);
            });
        });
   
}

lookProperty = (pid) => {

    $.ajax({
        method: "POST",
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "<?php echo url('/buy/property')?>",
        data: { pid : pid } 
         })
        .done(function( r ) {

                if($(".carousel-item")){
                    $(".carousel-item").remove();
                }

                if(r.response.photo){
                    r.response.photo.forEach( (p,key) => {
                    var active = key == 0 ? 'active' : '';
                    var item = '<div class="carousel-item '+active+'"><img class="d-block w-100" src="../assets/properties/'+p.photo+'"></div>';
                    $('#corousel-content').append(item);
                });
                }
                var address = r.response.property.address + ", "+ r.response.city;
                
                var garage = "Não possui";
                if(r.response.property.garage){
                    var garage = r.response.garage;
                }
                
                if(r.response.property.type == "D") {
                    var t = "Apartamento Duplo";
                } else if (r.response.property.type == "C") {
                    var t = "Cobertura";
                } else {
                    var t = "Apartamento Padrão";
                }

                var furnished = "Não";
                if(r.response.property.furnished == 1){
                    var furnished = "Sim";
                }

                var desc = '';
                if(r.response.property.description){
                    desc = r.response.property.description;
                }

                var body = "<div align='center' id='card-content'><p><b>"+address+"</b><p>"
                +"<br/> <p><b>Quartos: </b>"+r.response.property.room+"</p>"
                +"<br/> <p><b>Garagem: </b>"+garage+"</p>"
                +"<br/> <p><b>Tipo: </b>"+t+"</p>"
                +"<br/> <p><b>Mobiliado: </b>"+furnished+"</p>"
                +"<br/> <p>"+desc+"</p>"
                +'<br/><button type="button" style="text-transform:uppercase;" onclick="openCall('+r.response.property.id+')" class="btn btn-primary">Tenho interesse</button>'+"</div>";

                if($("#card-content")){
                    $("#card-content").remove();
                }

                $("#card-body").append(body);

               
            });

    $("#map-div").hide();
    $("#prop-div").show();
}

showMap = () => {
    $("#prop-div").hide();
    $("#map-div").show();
}

fitBounds = () => {
    var key = "AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA";
        center = {lat: -22.906428, lng: -43.133264};
        var add = $("#filter_neighborhood").val() + "," + $("#filter_city").val() + ", Brasil";
        $.ajax({
        method: "GET",
        url: "https://maps.googleapis.com/maps/api/geocode/json",
        data: { key: key, address: add }
        })
        .done(function( r ) {
            var new_center = null;
            r['results'].forEach(res => {
                if(res.geometry.location.lat && res.geometry.location.lng){
                    new_center = {lat: res.geometry.location.lat, lng: res.geometry.location.lng};
                }
            });
            if(new_center){
                bound = new google.maps.LatLngBounds(new_center);
                map.fitBounds(bound);
                map.setZoom(17);
            }
        });
}

openCall = (pid) => {
    var yes = confirm("Você será redirecionado para um corretor para um melhor atendimento. Fique tranquilo seus dados como telefone e email não serão expostos.")
    if(yes) {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        method: "POST",
        url: "<?php echo url('/call/create')?>",
        data: { pid : pid }
        })
        .done(function() {
           
        });
    }
}

         getLocation = () => {
            if (navigator.geolocation) {
                return navigator.geolocation.getCurrentPosition(success);
            } else {
                center = {lat: -22.908150, lng: -43.177463};
            }
        }

        success = (position) => {
            if(position) {
                center = {lat: position.coords.latitude, lng:position.coords.longitude};
                map.setCenter(center);
            }
        }

</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA&callback=initMap">
</script>
@endsection  