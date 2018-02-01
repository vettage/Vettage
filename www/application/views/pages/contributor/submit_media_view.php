         <link href="<?php echo BASE_ASSETS; ?>bootstrap-multiselect/dist/css/bootstrap-multiselect.css" rel="stylesheet">
	<script src="<?php echo BASE_ASSETS;?>bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>

<?php
$types  	= !empty($raw_details) ? $raw_details->format : '';if(!empty($_POST['format'])) $format = $_POST['format'];
$city 		= !empty($raw_details) ? $raw_details->city : '';if($this->input->post('city')!=NULL)  $city = $this->input->post('city'); 
$state 		= !empty($raw_details) ? $raw_details->state : '';if($this->input->post('state')!=NULL) $state = $this->input->post('state'); 
$country 	= !empty($raw_details) ? $raw_details->country : '';if($this->input->post('country')!=NULL) $country = $this->input->post('country'); 
$zipcode 	= !empty($raw_details) ? $raw_details->zipcode : '';if($this->input->post('zipcode')!=NULL) $zipcode = $this->input->post('zipcode'); 
$links_local 		= !empty($raw_details) ? $raw_details->links : '';if($this->input->post('links')!=NULL) $links = $this->input->post('links'); 
$time_event = !empty($raw_details) ? $raw_details->time_event : '';if($this->input->post('time_event')!=NULL) $time_event = $this->input->post('time_event'); 
$tags 		= !empty($raw_details) ? $raw_details->tags : '';if($this->input->post('tags')!=NULL) $tags = $this->input->post('tags'); 
$copyright  = !empty($raw_details) ? $raw_details->copyright : '';if(!empty($_POST['copyright'])) $copyright = $_POST['copyright'];
$date  		= !empty($raw_details) ? date("Ymd",strtotime($raw_details->date)) : date('Ymd'); if(!empty($_POST['date'])) $date = $_POST['date'];
$location  		= !empty($raw_details) ? $raw_details->location : ''; if(!empty($_POST['location'])) $location = $_POST['location'];
?>
<div class="container">
<br />
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
    <?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<div class="row">
		<div class="col-lg-5">
			<h3 less-mar-bottom=""><?php echo $title; ?></h3>
		</div>
		<div class="col-lg-7 bg-light pad-bottom pad-top">
			<form action="" method="post" onsubmit="javascript:return chkErrors();" id="frmrawmedia">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-8">
                                       <label class="control-label">Media Type:</label>
									<select multiple class="form-control" id="multimedia" name="formattypes[]" style="min-height:110px;">
									<option value="360 Video" <?php if(strpos($types,"360 Video")!==false) echo 'selected="selected"'; ?>>360 Video</option>
									<option value="Animated image" <?php if(strpos($types,"Animated image")!==false) echo 'selected="selected"'; ?>>Animated image(s)</option>
									<option value="Infographic" <?php if(strpos($types,"Infographic")!==false) echo 'selected="selected"'; ?>>Infographic</option>
									<option value="Interactive" <?php if(strpos($types,"Interactive")!==false) echo 'selected="selected"'; ?>>Interactive</option>
									<option value="Multimedia" <?php if(strpos($types,"Multimedia")!==false) echo 'selected="selected"'; ?>>Multimedia</option>
									<option value="Sound" <?php if(strpos($types,"Sound")!==false) echo 'selected="selected"'; ?>>Sound</option>
									<option value="Still image" <?php if(strpos($types,"Still image")!==false) echo 'selected="selected"'; ?>>Still image(s)</option> 
									<option value="Video" <?php if(strpos($types,"Video")!==false) echo 'selected="selected"'; ?>>Video</option>
									<option value="Writing" <?php if(strpos($types,"Writing")!==false) echo 'selected="selected"'; ?>>Writing</option>
                                </select>
								<?php echo ((form_error('format')!=NULL)) ? '<span class="text-error">'.form_error('format').'</span>' : '' ?>   
							</div>
						</div>
					</div>
 					<label>Tags (Separate by commas) <font color="#FF0000">*</font>:</label>
					<input type="text" name="tags" placeholder="Tags" value="<?php  echo $tags;?>" class="form-control input-sm">
					<?php echo ((form_error('tags')!=NULL)) ? '<span class="text-error">'.form_error('tags').'</span>' : '' ?>
                     
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label>Location <font color="#FF0000">*</font>:</label>
							<?php $this->load->view('sub_parts/forms/location.php',array('show'=>array('country','state','city'),'country'=>$country,'state'=>$state,'city'=>$city,'location'=>$location)); ?>
					</div>
					<div  class="form-group">
						<label>Time of Event (0000-2359) <font color="#FF0000">*</font>:</label>
						<input type="text" name="time_event" placeholder="Time of Event" value="<?php  echo $time_event;?>" class="form-control input-sm"  />
						<?php echo ((form_error('time_event')!=NULL)) ? '<span class="text-error">'.form_error('time_event').'</span>' : '' ?>   
					</div>                        
					<?php /*?><div class="form-group">
					<label>Radius :</label>
					<select class="form-control input-sm">
					<option >25 miles/40.23 km</option>
					<option >25 miles/40.23 km</option>
					</select>
					</div><?php */?>
					<div class="form-group"><?php ?>
						<label>Date (YYYYMMDD) :</label>
							<?php $this->load->view('sub_parts/forms/datepicker.php',array('date'=>$date)); ?>
					</div>
					<div class="form-group">
						<label>Link <font color="#FF0000">*</font>:</label>
						<input type="text" name="links"  placeholder="link" value="<?php  echo $links_local;?>" class="form-control input-sm"  />
						<?php echo ((form_error('links')!=NULL)) ? '<span class="text-error">'.form_error('links').'</span>' : '' ?>
					</div>
				</div>
								<div class="col-lg-12">
						 <a href="#myModal" id="copy">Copyright Agreement Read & Agreed</a>
														
														
														<input name="copyright" id="copyright"                  type="checkbox" value="1" <?php if($copyright==1) echo 'checked="checked"'; ?>
                                <?php echo ((form_error('copyright')!=NULL)) ? '<span class="text-error">'.form_error('copyright').'</span>' : '' ?> 		
                                <!-- Modal -->
<div id="myModal" tabindex="-1" style="display:none">
    <div class="content">
      <div class="body">
      <p>By submitting stories on Vettage.com, you certify that you are the copyright owner of said material and have legal copyright agreements in place with the Raw Content Contributors of your team, if applicable. Vettage.com also retains the Copyright of publication solely on the web for promotion purposes for the duration of each competition and is not liable for any type of infringement.</p> 

<p>Any further agreement between Editor(s) and third parties (i.e., other media outlets or distributors) for acquisition of Editor's content is subject to agreement between VETTAGE.COM, the Editor and the third party. Institutional Subscriber status by a third party will cover all expenses necessary to VETTAGE.COM.</p>
      </div>
    </div>
</div>	  		
				</div>
			</div>
			<hr>
			<?php if($raw_key==NULL){ ?>
				<div class="text-center"><input type="submit" class="btn btn-danger" value="Submit"/></div>
			<?php } else { ?>
				<div class="text-center">
					<input type="submit" class="btn btn-danger" value="Update"/>
					<a href="<?php echo BASE_URL?>contributor/raw_media"><input type="button" class="btn btn-default" value="Cancel"/></a>
				</div>
			<?php } ?>
			</form>
		</div>
	</div> 
</div>   
<script>
function chkErrors()
{
	var Form = document.getElementById('frmrawmedia');  
	var copyright = '';
	for(Count = 0; Count < 2; Count++){
		if(Form.copyright[Count].checked)
		{
			copyright = Form.copyright[Count].value;
			break;
		}
	}
	if(copyright==2)
	{
		alert("You must be the owner of this content to submit");
		return false;
	}
	return true;
}

function getstates()
{
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>contributor/raw_media/getstates",
		data: "country="+ $('#country').val() + "&state=<?php echo $state?>",
		cache: false,
		async: true,
		success: function(result)
		{
			$('#state').html(result);
			getcities();	
		},
		error: function(request, textStatus, errorThrown)
		{
			//alert('error');
		}
	});
}
$("#country").change(function (e) {
	getstates();
});

getstates();
function getcities(state)
{
	if(!state)  state = $('#state').val();
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>contributor/raw_media/getcities",
		data: "state="+ state + "&city=<?php echo $city?>",
		cache: false,
		async: true,
		success: function(result)
		{
			$('#city').html(result);	
		},
		error: function(request, textStatus, errorThrown)
		{
			//alert('error');
		}
	});
}
$("#state").change(function (e) {
	getcities();
});

getcities('<?php echo $state?>');
$(document).ready(function() {
    $('#multimedia').multiselect();
});

$(document).ready(function(){
    $("#copy").click(function(){
        $("#myModal").toggle();
    });
});

</script>		
 

        
		
	

