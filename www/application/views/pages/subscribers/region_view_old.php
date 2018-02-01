<?php 
$count=0; $locations = $latitude = $longitude = '' ;
foreach($story_data as $row)
{ 
	$count++;
	$address = urlencode($row->city);
	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
	$output = json_decode($geocode);
	if(!empty($output->results[0])){
		$lat = $output->results[0]->geometry->location->lat;
		$lng = $output->results[0]->geometry->location->lng;
		if(is_numeric($lat) && is_numeric($lng)){
			$link = '<a href="'.BASE_URL.'story/details?key='.$row->content_key.'">'.str_replace("'","\'",$row->title).'</a>';
			$locations.= "['".str_replace("'","\'",$row->title)."', ".$lat.",".$lng.",".$count.",'".$link."'],";
			if($latitude==''){
				$latitude = $lat; 
				$longitude = $lng;
			}
		}
	}
}
if($latitude=='')
{
	$latitude = '-25.363882'; $longitude = '131.044922' ;
}
$locations = trim($locations,",");
?>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script>
function initialize()
{
	var locations = [ <?php echo $locations?> ];
	var myLatlng = new google.maps.LatLng(<?php echo $latitude?>,<?php echo $longitude?>);
	var mapProp = {
		center:myLatlng,
		zoom:2,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	
	var infowindow = new google.maps.InfoWindow();
	var marker, i;
	for (i = 0; i < locations.length; i++)
	{  
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map
		});
	
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
		return function() {
			infowindow.setContent(locations[i][4]);
			infowindow.open(map, marker);
		}
		})(marker, i));
	}
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="container">
	<div class="row">
    	<div class="col-lg-4">
            <h3>SEARCH BY REGION</h3>
        </div>
		
    	<div class="col-lg-8 pad-bottom pad-top">
			<div id="googleMap" style="width:700px;height:480px;" ></div>
			 <button type="button" class="btn pull-left  btn-sm " onClick="javascript: document.location = '<?php echo BASE_URL.                         'subscribers/search/source';?>';">Back</button>
		</div>
		
	</div> 
 	<br/>
 </div>


