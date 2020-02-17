@extends('layouts.app')

@section('title')
Área de atuação
@endsection

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
    <?php 
      $i = 1;
    ?>
    @foreach ($broker->field as $f) 
      @if ($f->status == 'A')
        <tr>
          <th scope="row">{{$i}}</th>
          <td>{{$f->name}}</td>
          <td><input class="form-check-input" type="checkbox" name="active" id="active"> Ativo</td>
          <td>
            <div align="left">
                <button type="submit" class="btn-icon"><i class="now-ui-icons ui-1_settings-gear-63"></i></button>
                <button type="submit" onclick="deleteField(<?php echo $f->id?>)" class="btn-icon"><i class="now-ui-icons ui-1_simple-remove"></i></button>
            </div>
        </td>
        </tr>
        <?php $i++;?>
      @endif
    @endforeach
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
            showAreas();
        });
        }

        deleteField = (fid) => {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

          $.ajax({
            url : "<?php echo url('/field/delete')?>",
            type : 'post',
            data : {
                field_id : fid
            }
          }).done(function( r ) {
              location.reload();
          });
        }

        showAreas = () => {
            <?php foreach($broker->field as $f) { ?>
              if('<?php echo $f->status?>' == 'A') {
                var latlng = [];
                <?php foreach($f->vertex as $v) {?>
                latlng.push(new google.maps.LatLng({lat:<?php echo $v->lat?>,lng:<?php echo $v->lng?>}));
                <?php } ?>

                var border = '<?php echo $f->border_color?>';
                var fill = '<?php echo $f->fill_color?>';
                
                var polygon = new google.maps.Polygon({
                    path: latlng,
                    map: map,
                    strokeColor: border,
                    fillColor: fill,
                    opacity: 0.4,
                    draggable:false,
                    editable: false,
                    strokeWeight:0.2
                });
                polygon.setVisible(true);
                polygon.setMap(map);  
              }
              <?php }?>      
        }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA&callback=initMap">
    </script>
@endsection 
