<?php
$types 	= '';if(!empty($_POST['format'])) 				$types 	= $_POST['format'];
$city 		= '';if($this->input->post('city')!=NULL)  		$city 		= $this->input->post('city'); 
$state 		= '';if($this->input->post('state')!=NULL) 		$state 		= $this->input->post('state'); 
$country 	= '';if($this->input->post('country')!=NULL) 	$country 	= $this->input->post('country'); 
$zipcode 	= '';if($this->input->post('zipcode')!=NULL) 	$zipcode 	= $this->input->post('zipcode'); 
$links 		= '';if($this->input->post('links')!=NULL) 		$links 		= $this->input->post('links'); 
$time_event = '';if($this->input->post('time_event')!=NULL) $time_event = $this->input->post('time_event'); 
$tags 		= '';if($this->input->post('tags')!=NULL) 		$tags 		= $this->input->post('tags'); 
$copyright  = '';if(!empty($_POST['copyright'])) 			$copyright 	= $_POST['copyright'];
$date  		= date('Ymd'); if(!empty($_POST['date'])) 		$date 		= $_POST['date'];
?>
<div class="container">
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
    <?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<div class="row">
		<div class="col-lg-4">
			<br />
			<div class="btn-group">
				<a href="<?php echo BASE_URL?>account" class="btn btn-default btn-sm ">PROFILE</a>
				<a href="javascript:void(0);" class="btn btn-default btn-sm  active" >SUBMIT</a>
				<a href="<?php echo BASE_URL?>raw_media/connect" class="btn btn-default btn-sm">CONNECT</a>
			</div>
			<h3 less-mar-bottom=""><?php echo $title; ?></h3>
		</div>
		<div class="col-lg-8 bg-light pad-bottom pad-top">
			<form action="" method="post" onsubmit="javascript:return chkErrors();" id="frmrawmedia">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-8">
								<label>Media Type :</label>
								<?php echo $format;?>
								<select multiple class="form-control" name="formattypes[]" style="min-height:110px;">
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
								<p><small class="text-muted">Hold down 'ctrl' key to select multiple types</small></p>
								<?php echo ((form_error('format')!=NULL)) ? '<span class="text-error">'.form_error('format').'</span>' : '' ?>   
							</div>
						</div>
					</div>
					<label>Tags (Separate by commas) :</label>
					<input type="text" name="tags" value="<?php  echo $tags;?>" class="form-control input-sm">
					<?php echo ((form_error('tags')!=NULL)) ? '<span class="text-error">'.form_error('tags').'</span>' : '' ?>
				</div>
				<div class="col-lg-4">
				 <a href="#myModal"  class="btn btn-small btn-primary" data-toggle="modal">Copyright Agreement Read & Agreed</a>
														
														
														<input name="copyright" id="copyright"                  type="checkbox" value="1" <?php if($copyright==1) echo 'checked="checked"'; ?>
                                <?php echo ((form_error('copyright')!=NULL)) ? '<span class="text-error">'.form_error('copyright').'</span>' : '' ?> 	
					<?php echo ((form_error('copyright')!=NULL)) ? '<span class="text-error">'.form_error('copyright').'</span>' : '' ?>   
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Location :</label>
						<select class="form-control input-sm" name="country">
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
								<input type="state" name="state" placeholder="State" value="<?php  echo $state;?>" class="form-control input-sm"  />
								<?php echo ((form_error('state')!=NULL)) ? '<span class="text-error">'.form_error('state').'</span>' : '' ?>   
							</div> 
							<div class="col-lg-6">
								<input type="city" name="city" placeholder="City" value="<?php  echo $city;?>" class="form-control input-sm"  />
								<?php echo ((form_error('city')!=NULL)) ? '<span class="text-error">'.form_error('city').'</span>' : '' ?>   
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="zipcode" value="<?php  echo $zipcode;?>" class="form-control input-sm" placeholder="Or Postal Code" />                   
						<?php echo ((form_error('zipcode')!=NULL)) ? '<span class="text-error">'.form_error('zipcode').'</span>' : '' ?>   
					</div>
					<div  class="form-group">
						<label>Time of Event (0000-2359) :</label>
						<input type="text" name="time_event" value="<?php  echo $time_event;?>" class="form-control input-sm"  />
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
						<input type="text" name="date" value="<?php  echo $date;?>" class="form-control input-sm"  />
						<?php echo ((form_error('date')!=NULL)) ? '<span class="text-error">'.form_error('date').'</span>' : '' ?>   
					</div>
					<div class="form-group">
						<label>Link :</label>
						<input type="text" name="links" value="<?php  echo $links;?>" class="form-control input-sm"  />
						<?php echo ((form_error('links')!=NULL)) ? '<span class="text-error">'.form_error('links').'</span>' : '' ?>
					</div>
				</div>
			</div>
			<hr>
			<div class="text-center"><input type="submit" class="btn btn-danger" value="submit"/> </div>
			</form>
		</div>
	</div> 
</div> 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Copyright</h4>
      </div>
      <div class="modal-body">
      <p>By submitting stories on Vettage.com, you certify that you are the copyright owner of said material and have legal copyright agreements in place with the Raw Content Contributors of your team, if applicable. Vettage.com also retains the Copyright of publication solely on the web for promotion purposes for the duration of each competition and is not liable for any type of infringement.</p> 

<p>Any further agreement between Editor(s) and third parties (i.e., other media outlets or distributors) for acquisition of Editor's content is subject to agreement between VETTAGE.COM, the Editor and the third party. Institutional Subscriber status by a third party will cover all expenses necessary to VETTAGE.COM.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      
      </div>
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
</script>		
 

        
		
	

