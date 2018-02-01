         <link href="<?php echo BASE_ASSETS; ?>bootstrap-multiselect/dist/css/bootstrap-multiselect.css" rel="stylesheet">

	<script src="<?php echo BASE_ASSETS;?>bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>

<?php 
$types  	=''; if(!empty($_GET['format'])) $format = $_GET['format'] ;
$city 		=''; if($this->input->get('city')!=NULL)  $city = $this->input->get('city'); 
$state 		=''; if($this->input->get('state')!=NULL)  $state = $this->input->get('state'); 
$country 	=''; if ($this->input->get('country')!=NULL)  $country = $this->input->get('country'); 
$date 		=''; if ($this->input->get('date')!=NULL) $date =  $this->input->get('date'); 
$zipcode 	=''; if ($this->input->get('zipcode')!=NULL) $zipcode =  $this->input->get('zipcode'); 
$links 		=''; if($this->input->get('links')!=NULL)  $links =  $this->input->get('links'); 
$tags 		=''; if($this->input->get('tags')!=NULL)  $tags =  $this->input->get('tags'); 
$date  		= ''; if(!empty($_GET['date'])) $date = $_GET['date'];

?>
<div class="container">
<br />
<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	    <?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<div class="row">
	
		<div class="col-lg-5">
					<h3 class="less-mar-bottom">RAW MEDIA PULL</h3>
		</div>
 		<div class="col-lg-7 bg-light pad-bottom pad-top">
		<form action="" method="get">
			<div class="row">
 				<div class="col-lg-6">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-9">
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
					<label>Tags (Separate by commas) :</label>
					<input type="text" name="tags" placeholder="Tags" class="form-control input-sm" value="<?php  echo $tags;?>">  
					<?php echo ((form_error('tags')!=NULL)) ? '<span class="text-error">'.form_error('tags').'</span>' : '' ?>
				</div>
 				  <div class="col-lg-6">
					     <div class="form-group">
						<label>Location :</label>
						<select class="form-control input-sm" name="country" id="country" onchange="javascript:getstates();">
							     <option value="" selected="selected">Select Country</option>
							     <?php foreach($countries as $row):?>
								 <option value="<?php echo $row->name;?>" <? if($row->name==$country) echo 'selected="selected"';?>><?php echo $row->name;?></option>
							<?php endforeach;?>
						</select>
						<?php echo ((form_error('country')!=NULL)) ? '<span class="text-error">'.form_error('country').'</span>' : '' ?> 
                         </div>
                         <div class="form-group">
						<div class="row">
							<div class="col-lg-6">
 						         <select class="form-control input-sm" name="state" id="state"  onchange="javascript:getcities();">
                                    <?php /*?> <option value="" selected="selected">Select State</option>
                                     <?php foreach($state as $row):?>
                                     <option value="<?php echo $row->name;?>" <? if($row->name) echo 'selected="selected"';?>><?php echo $row->name;?></option>
                                     <?php endforeach;?><?php */?>
						        </select>
						<?php echo ((form_error('state')!=NULL)) ? '<span class="text-error">'.form_error('state').'</span>' : '' ?>  
 							    </div> 
                              <div class="col-lg-6">
                                 <select class="form-control input-sm" name="city" id="city">
                                     <?php /*?><option value="" selected="selected">Select City</option>
                                     <?php foreach($city as $row):?>
                                     <option value="<?php echo $row->name;?>" <? if($row->name) echo 'selected="selected"';?>><?php echo $row->name;?></option>
                                     <?php endforeach;?><?php */?>
						        </select>
 								<?php echo ((form_error('city')!=NULL)) ? '<span class="text-error">'.form_error('city').'</span>' : '' ?>   
							</div>
                          </div>
					</div>
					<?php /*?><div class="form-group">
						<label>Radius :</label>
						<select class="form-control input-sm">
							<option>25 miles/40.23 km</option>
							<option>25 miles/40.23 km</option>
						</select>
					</div><?php */?>
					<div class="form-group">
						<label>Date (YYYYMMDD) :</label>
						<?php $this->load->view('sub_parts/forms/datepicker.php',array('date'=>$date)); ?>
					</div>
				</div>
 			</div>
			<hr>
 			<div class="text-center"><input type="submit" id="submit" class="btn btn-danger" value="Submit"  /></div>
 		</form>
		</div>
    </div> 
 	<br/>
	<div class="row">
		<div class="panel panel-warning">
			<div class="panel-heading"><h3 class="panel-title">SEARCH RESULTS</h3></div>
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Contributor</th>
					<th>Format</th>
					<th>Tags</th>
					<th>Location</th>
					<th>Date/Time</th>
					<th>Link</th>
                    <!--<th>Action</th>-->
				</tr>
			</thead>
			<tbody>
				<?php if(empty($raw_details)){?>
				<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td></tr>
				<?php }else{
				foreach($raw_details as $row) :
					$member='';
					if($row->contributor_id>0){
						$details = $this->user_model->get_single_record("id='".$row->contributor_id."'");
						if($details!="0") $member=$details->username;
					}
					$location = $row->city.", ".$row->state.", ".$row->country;
					$date = date("Ymd/H:i",strtotime($row->date));
				?>
				<tr>
					<td><a href="<?php echo BASE_URL?>collaborate/raw_media_pull/profile/<?php echo $row->contributor_id?>" class="pull-left"><?php echo $member;?></a></td>
					<td><?php echo trim($row->format,",");?></td>
					<td><?php echo $row->tags;?></td>
					<td><?php echo $location;?></td>
					<td><?php echo $date;?></td>
					<td><a href="<?php echo $row->links;?>" class="pull-left" target="_blank"><?php echo $row->links;?></a></td>
                    <!--<td><a href="<?php //echo BASE_URL ?>collaborate/raw_media_pull/submit_final_piece?raw_key=<?php //echo $row->raw_key?>" class="pull-left">Select</a></td>-->
				</tr>
				<?php  
				endforeach;
				}?>
			</tbody>
			</table>
		</div>
	</div>
 </div>  
 <script type="text/javascript">
function delete_record(content_key)
{
	 if (confirm("Are you sure you want to delete the raw media record.")){
		 window.location ='<?php echo BASE_URL.'collaborate/raw_media_pull/delete?content_key=';?>'+content_key;
	 }
}
function getstates()
{
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>collaborate/raw_media_pull/getstates",
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
		url: "<?php echo BASE_URL;?>collaborate/raw_media_pull/getcities",
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
</script>

