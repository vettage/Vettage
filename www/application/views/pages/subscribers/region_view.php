<style>

#map_container{
  position: relative;
}
#map{
    height: 400px;
    overflow: hidden;
    padding-bottom: 22.25%;
    padding-top: 30px;
    position: relative;
}

/* chk-btn CSS from
http://stackoverflow.com/questions/30100978/how-to-make-a-check-button-hidden-checkbox-with-label-as-a-button-css-only
*/

input.chk-btn {
  display: none;
}
input.chk-btn + label {
  border: 1px solid grey;
  background: ghoswhite;
  padding: 5px 8px;
  cursor: pointer;
  border-radius: 5px;
 
}
input.chk-btn:not(:checked) + label:hover {
  box-shadow: 0px 1px 3px;
  
}
input.chk-btn + label:active,
input.chk-btn:checked + label {
  box-shadow: 0px 0px 3px inset;
  background: #8cc472;
  
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKXFH9h0a-ScnwSl7J_3hhlSBvgPjLm-s"></script>

<div class="container">

	<div class="row">
	<div class="col-lg-4">
	 <h3>SEARCH BY REGION</h3>
	 <div class="form">
  	<form action="" method="GET" id="mapsearch" onsubmit="javascript:updateMap();return false;">
 						<div class="form-group">
						    <label>Location:</label>
							<?php $this->load->view('sub_parts/forms/location.php'); ?>
						</div>

							<input type="submit" value="Search">

</form>
	</div>
	<h4>Search Results:</h4>
	<div id="result_details">
	
	</div>
	</div>
         <div class="col-lg-8 bg-light pad-bottom pad-top">

   <div id="map_container"></div>
	  <div id="map"></div>
<div id="campground_info"></div>
</div>
</div>
</div>

<script>

var map
var markers = []



function updateMap() {

	params = '';
	country = $("#country").val();
	city = $("#city").val();
	state = $("#state").val();
	latitude = $("#latitude").val();
	longitude = $("#longitude").val();

	if (country!='') params = params + '&country='+country;
	if (city!='')  params = params + '&city='+city;
	if (state!='')  params = params + '&state='+state;
	if (latitude!='')  params = params + '&latitude='+latitude;
	if (longitude!='')  params = params + '&longitude='+longitude;
	clearMarkers();
	map.setCenter(new google.maps.LatLng(latitude, longitude), 6);
	
	loadMarkers(params);
	return false;
	
}
// Sets the map on all markers in the array.
function clearMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
}

// after the geojson is loaded, iterate through the map data to create markers
// and add the pop up (info) windows
function loadMarkers(params='') {

	var count = 0;
	console.log('creating markers')
  var infoWindow = new google.maps.InfoWindow()
  geojson_url = '<?php echo BASE_URL?>/ajax/search?sa=1'+params
  $.getJSON(geojson_url, function(result) {

       
      $.each(result, function(key, val) {

    	  ++count;
        var point = new google.maps.LatLng(
                parseFloat(val['latitude']),
                parseFloat(val['longitude']));
        var titleText = val['title']
        var descriptionText = val['content_desc']
        var marker = new google.maps.Marker({
          position: point,
          title: titleText,
          map: map,
//          properties: val['properties']
         });

        var markerInfo = "<div><a href='<?php echo BASE_URL?>/story/"+val['alias']+"' /><h5>" + titleText + "</h5><img src='<?php echo BASE_ASSETS; ?>/uploads/stories/"+val['image']+"' class='smallpop'" + descriptionText + "</a></div>"

        marker.addListener('click', function() {
              infoWindow.close()
              infoWindow.setContent(markerInfo)
              infoWindow.open(map, marker)
            });
        markers.push(marker)
      });

      $("#result_details").html(count+" results found")
      
  });
}

function initMap() {
    map_options = {
      zoom: 5,
      mapTypeId: google.maps.MapTypeId.HYBRID,
      center: {lat: 40.730610, lng: -73.935242}
    }
    
    map_document = document.getElementById('map')
    map = new google.maps.Map(map_document,map_options);
    loadMarkers()
 
}
initMap();
</script>