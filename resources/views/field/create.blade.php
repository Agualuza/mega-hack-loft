@extends('layouts.app')

@section('content')
<div class="row">
    <form id="form" class="col-7" action="/field/save" method="POST">
            @csrf
            <input required type="text" class="form-control" name="name_field" placeholder="De um apelido a sua área"></input>
    </form>
</div>
<div class="row" id="row-id">
    <div id="map" class="col-10 map-style"></div>
        <button id="btn-add-area" type="button" style="margin-left:0" onclick="showArea();" class="card-border-orange text-orange"><b>Adicionar área</b></button>
</div>

@endsection  

@section('scripts')
<script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        // The map, centered at Uluru

        var key = "AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA";
        var add = '<?php echo $broker->city->name?>';
        center = {lat: -22.906428, lng: -43.133264};
        $.ajax({
        method: "GET",
        url: "https://maps.googleapis.com/maps/api/geocode/json",
        data: { key: key, address: add }
        })
        .done(function( r ) {
            r['results'].forEach(res => {
                if(res.geometry.location.lat && res.geometry.location.lng){
                    center = {lat: res.geometry.location.lat, lng: res.geometry.location.lng};
                }
            });
            map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: 17,
                center: center,
                fullscreenControl:false,
                mapTypeControl:false,
                streetViewControl:false,
            });
        });

        // The marker, positioned at Uluru
        // var marker = new google.maps.Marker({position: center, map: map});
        }



        showArea = () => {
            var map_center = map.getCenter();
            var lat = map.getCenter().lat();
            var lng = map.getCenter().lng();;
            var_x = 0.00355;
            var_y = 0.0055;

            var latlng = [ 
                new google.maps.LatLng({lat:lat,lng:lng}),
                new google.maps.LatLng({lat:lat+var_x,lng:lng}),
                new google.maps.LatLng({lat:lat+var_x,lng:lng+var_y}),
                new google.maps.LatLng({lat:lat,lng:lng+var_y}) 
            ];

            var colors = ['#7FFFD4','#DAA520','#8A2BE2','#FF69B4','#FFD700','#FF7F50'];
            var borders = ['#2F4F4F','#D2691E',"#4B0082",'#FF1493','#F0E68C','#FF0000'];
            var color_index = Math.floor(Math.random() * colors.length);
            polygon = new google.maps.Polygon({
                path: latlng,
                map: map,
                strokeColor: colors[color_index],
                fillColor: borders[color_index],
                opacity: 0.4,
                draggable:true,
                editable: true,
                strokeWeight:0.2
            });
            polygon.setVisible(true);
            polygon.setMap(map);        
            $("#btn-add-area")[0].outerHTML = '<button id="btn-add-area" style="margin-left:0" onclick="saveArea()" class="card-border-orange text-orange"><b>&nbsp;&nbsp;&nbsp;Salvar área&nbsp;&nbsp;&nbsp;</b></button>';


        }

        saveArea = () => {
            var p = polygon.latLngs.g[0].g;
            var index = 0;
            var laln = null;
            p.forEach(v => {
                var latlng = v.lat()+','+v.lng();
                laln = latlng;
                var html = "<input type='hidden' name='coord" +
                index+"' value='"+latlng+"'>";
                index++;
                $("#form").append(html);
            });

            var color = "<input type='hidden' name='fill' value='"+polygon.fillColor+"'>"
            var border = "<input type='hidden' name='border' value='"+polygon.strokeColor+"'>"
            $("#form").append(color);
            $("#form").append(border);
            getCityId(laln);
            // $("#form").submit();
        }

        getCityId = (latlng) => {
            var key = "AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA";
            $.ajax({
            method: "GET",
            url: "https://maps.googleapis.com/maps/api/geocode/json",
            data: { key: key, latlng: latlng }
            })
            .done(function( r ) {
                r['results'].forEach(res => {
                    if(res["address_components"][0]['types'].includes("administrative_area_level_2")){
                        var val = res["address_components"][0]['long_name'];
                        var city = "<input type='hidden' name='city_name' value='"+val+"'>"
                         $("#form").append(city);
                    } else {
                        var city = "<input type='hidden' name='city_name' value='Default'>"
                         $("#form").append(city);
                    }
                });
                $("#form").submit();
            });
        }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA&callback=initMap">
    </script>
@endsection  