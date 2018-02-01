<?php 

if (!isset($show)) $show = array('country','city','state','latitude','longitude','postal_code','full_address');

$latitude = $longitude = $full_address= '';

if (empty($country)) $country = '';
if (empty($city)) $city = '';
if (empty($state)) $state = '';
if (empty($location)) $location = '';
	else $full_address = $location;

if (isset($content_details) && is_object($content_details)) {
	
	$country = $content_details->country;

	$city = $content_details->city;
	$state = $content_details->state;
	$latitude = $content_details->latitude;
	$longitude = $content_details->longitude;
	$full_address = $content_details->full_address;
	
} else if (!empty($_POST)) {
	
	$country = $_POST['country'];

	$city =  $_POST['city'];
	$state =  $_POST['state'];
	if (!empty($_POST['latitude'])) $latitude =  $_POST['latitude'];
	if (!empty($_POST['longitude'])) $longitude =  $_POST['longitude'];
	$full_address =  $_POST['location'];
	
}
 
	
 

?>	
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDKXFH9h0a-ScnwSl7J_3hhlSBvgPjLm-s&amp;libraries=places"></script>
<script type="text/javascript" src="/media/geocomplete/jquery.geocomplete.js"></script>

	
						    <input type="text" name="location" id="location" class="form-control input-lg location" value="<?php echo $full_address?>" />
							<fieldset>
   							
						<div id="loc_content" class="form-group geo-details"style="display:none;">
 <legend class="location" id="location">Location Details -></legend>
						<?php if (in_array('country',$show)){?>	  Country:  <input type="text" data-geo="country_short" value="<?php echo $country;?>" id="country" name="country" /><br /><?php }?>
						<?php if (in_array('city',$show)){?>	   City: <input type="text" data-geo="locality" value="<?php echo $city;?>" id="city" name="city" /><br /><?php }?>
						<?php if (in_array('state',$show)){?>	   State: <input type="text" data-geo="administrative_area_level_1" value="<?php echo $state;?>" id="state" name="state" /><br /><?php }?>
						<?php if (in_array('latitude',$show)){?>	   Lat: <input type="text" data-geo="lat" value="<?php echo $latitude;?>" id="latitude" name="latitude" /><br /><?php }?>
						<?php if (in_array('longitude',$show)){?>	   Long: <input type="text" data-geo="lng" value="<?php echo $longitude;?>" id="longitude" name="longitude" /><br /><?php }?>
						<?php if (in_array('postal_code',$show)){?>	      Zip: <input type="text" data-geo="postal_code" value="" id="postal_code" name="postal_code" /><br /><?php }?>
						<?php if (in_array('full_address',$show)){?>	       Full: <input type="text" data-geo="formatted_address" value="<?php echo $full_address;?>" id="full_address" name="full_address" /><br /><?php }?>
							   
							   
						</div>
						  		<script type="text/javascript">
								$(function () {	
								
								  $("#location").geocomplete({
								      
								      details: ".geo-details",
								      detailsAttribute: "data-geo"
								
								  });
								  
								
								});

						        $(function(){
						            $('legend.location').click(function(){
						                $(this).parent().find('#loc_content').slideToggle("slow");
						            });
						        });
								</script>
						
						
								