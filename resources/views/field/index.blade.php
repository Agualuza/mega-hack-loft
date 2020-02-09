@extends('layouts.app')

@section('content')
<div class="row">
<div id="map" class="col-10 map-style"></div>
<table class="col-10 table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Apelido</th>
      <th scope="col">Status</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Icaraí</td>
      <td><input class="form-check-input" type="checkbox" name="active" id="active"> Ativo</td>
      <td>
        <div align="left">
            <button type="submit" class="btn-icon"><i class="now-ui-icons ui-1_settings-gear-63"></i></button>
            <button type="submit" class="btn-icon"><i class="now-ui-icons ui-1_simple-remove"></i></button>
        </div>
    </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Centro</td>
      <td><input class="form-check-input" type="checkbox" name="active" id="active"> Ativo</td>
      <td>
        <div align="left">
            <button type="submit" class="btn-icon"><i class="now-ui-icons ui-1_settings-gear-63"></i></button>
            <button type="submit" class="btn-icon"><i class="now-ui-icons ui-1_simple-remove"></i></button>
        </div>
    </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>São Francisco</td>
      <td><input class="form-check-input" type="checkbox" name="active" id="active"> Ativo</td>
      <td>
        <div align="left">
            <button type="submit" class="btn-icon"><i class="now-ui-icons ui-1_settings-gear-63"></i></button>
            <button type="submit" class="btn-icon"><i class="now-ui-icons ui-1_simple-remove"></i></button>
        </div>
    </td>
    </tr>
  </tbody>
</table>
</div>
<div align="center">
    <button class="btn btn-primary btn-icon btn-round">
        <a href="/field/create"><i class="now-ui-icons ui-1_simple-add"></i></a>
    </button>
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



        // showArea = () => {
        //     var map_center = map.getCenter();
        //     var lat = map.getCenter().lat();
        //     var lng = map.getCenter().lng();;
        //     var_x = 0.00355;
        //     var_y = 0.0055;

        //     var latlng = [ 
        //         new google.maps.LatLng({lat:lat,lng:lng}),
        //         new google.maps.LatLng({lat:lat+var_x,lng:lng}),
        //         new google.maps.LatLng({lat:lat+var_x,lng:lng+var_y}),
        //         new google.maps.LatLng({lat:lat,lng:lng+var_y}) 
        //     ];

        //     var polygon = new google.maps.Polygon({
        //         path: latlng,
        //         map: map,
        //         strokeColor: 'black',
        //         fillColor: 'green',
        //         opacity: 0.4,
        //         draggable:true,
        //         editable: true,
        //         strokeWeight:0.2
        //     });
        //     polygon.setVisible(true);
        //     polygon.setMap(map);        

        // }


    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA&callback=initMap">
    </script>
@endsection  