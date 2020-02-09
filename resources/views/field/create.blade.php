@extends('layouts.app')

@section('content')
<div class="row" id="row-id">
    <div id="map" class="col-10 map-style"></div>
        <button id="btn-add-area" style="margin-left:0" onclick="showArea()" class="card-border-orange text-orange"><b>Adicionar área</b></button>
</div>


@endsection  

@section('scripts')
<script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        var center = {lat: -22.906428, lng: -43.133264};
        // The map, centered at Uluru
        map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: 17,
                center: center,
                fullscreenControl:false,
                mapTypeControl:false,
                streetViewControl:false
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

            var polygon = new google.maps.Polygon({
                path: latlng,
                map: map,
                strokeColor: 'black',
                fillColor: 'green',
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
            alert("salvou");
        }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA&callback=initMap">
    </script>
@endsection  