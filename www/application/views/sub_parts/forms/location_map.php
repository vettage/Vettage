<?php 

if (!isset($show)) $show = array('country','city','state','latitude','longitude','postal_code','full_address');


 

?>	
	<div class="row">
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDKXFH9h0a-ScnwSl7J_3hhlSBvgPjLm-s&amp;libraries=places"></script>
<script type="text/javascript" src="/media/geocomplete/jquery.geocomplete.js"></script>

		<div class="col-lg-4">
		        	<form action="<?php echo BASE_URL ?>account/locations" method="post" id="formlocation">
							
							<div class="form-group">
						    <label>Location:</label>

	
						    <input type="text" name="location" id="location" class="location" />
							<fieldset>
   							 <legend class="location" id="location">Location Details -></legend>
						<div id="loc_content" class="form-group geo-details"style="display:none;">

						<?php if (in_array('country',$show)){?>	  Country:  <input type="text" data-geo="country_short" value="" id="country" name="country" /><br /><?php }?>
						<?php if (in_array('city',$show)){?>	   City: <input type="text" data-geo="locality" value="" id="city" name="city" /><br /><?php }?>
						<?php if (in_array('state',$show)){?>	   State: <input type="text" data-geo="administrative_area_level_1" value="" id="state" name="state" /><br /><?php }?>
						<?php if (in_array('latitude',$show)){?>	   Lat: <input type="text" data-geo="lat" value="" id="latitude" name="latitude" disabled /><br /><?php }?>
						<?php if (in_array('longitude',$show)){?>	   Long: <input type="text" data-geo="lng" value="" id="longitude" name="longitude" disabled /><br /><?php }?>
						<?php if (in_array('postal_code',$show)){?>	      Zip: <input type="text" data-geo="postal_code" value="" id="postal_code" name="postal_code" /><br /><?php }?>
						<?php if (in_array('full_address',$show)){?>	       Full: <input type="text" data-geo="formatted_address" value="" id="full_address" name="full_address" /><br /><?php }?>
							   
							   
						</div>
						  
						</div>
						<input type="submit" class="btn btn-danger" value="submit"/>
					</form>
		</div>
		<div class="col-lg-8">
			 <div class="map_canvas"></div>
		</div>
						  		<script type="text/javascript">
								$(function () {	

								
								  $("#location").geocomplete({
								      map: ".map_canvas",
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
						
						
		
	</div>

								