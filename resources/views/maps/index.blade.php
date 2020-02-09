<!DOCTYPE html>
<html>
  <head>
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
  </head>
  <body>
    <!--The div element for the map -->
    <div id="map"></div>
    <button id="btn-add">Adicionar area</button>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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



		$("#btn-add").click(() => {

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
		});

    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA&callback=initMap">
    </script>
  </body>
</html>