<?php 
$format  	=''; if(!empty($_GET['format'])) $format = $_GET['format'] ;
$city 		=''; if($this->input->get('city')!=NULL)  $city = $this->input->get('city'); 
$state 		=''; if($this->input->get('state')!=NULL)  $state = $this->input->get('state'); 
$country 	=''; if ($this->input->get('country')!=NULL)  $country = $this->input->get('country'); 
$zipcode 	=''; if ($this->input->get('zipcode')!=NULL) $zipcode =  $this->input->get('zipcode'); 
$city 		=''; if($this->input->get('city')!=NULL)  $city = $this->input->get('city'); 
$city 		=''; if($this->input->get('city')!=NULL)  $city = $this->input->get('city');
$keywords   = ''; if($this->input->get('keywords')!=NULL) $keywords = $this->input->get('keywords');
$experience = ''; if($this->input->get('experience')!=NULL) $experience = $this->input->get('experience');
$picture 	= ''; if($this->input->get('picture')!=NULL) $picture = $this->input->get('picture');				
?>
<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
<div class="container">
	<div class="row" >
 		<div class="col-lg-5">
			<h3 class="less-mar-bottom">CONNECT</h3>
		</div>
 		<div class="col-lg-7 bg-light pad-bottom">
			<div class="row">
 				<div class="col-lg-6 col-md-6" id="user_list">
					<?php if($_GET) 
					{  //print_r($_GET);exit;
						if($member_requests!=NULL) echo '<h4>Results</h4>';
						else echo '<h4>No result found</h4>';
					}
					else
					{ 
							echo '<h4>Requests From Raw Content Contributors</h4>';
							if($new_member_requests==NULL) 
								echo '<span style="color:#FF0000">No new connection requests</span>';
							else
								echo '<span style="color:#009900">new connection request(s)</span>';
						 
						//else echo '<h4>There are no requests</h4>';
						//else echo '<h4>There are no new requests</h4>';
					}
 					 ?>
                     <hr>
 					<div class="listing-wrap">
					<?php
					  foreach($member_requests as $row) :
						/*$status  = 'Connect';
						$connect_details = $this->connect_model->get_single_record("(from_id='".$this->mem_id."' AND to_id='".$row->mem_id."' )                         OR  (from_id='".$row->mem_id."' AND to_id='".$this->mem_id."') ");
						
						if($connect_details!=NULL)
						{
							if($connect_details->status==0) $status = 'Request sent';
							if($connect_details->status==1) $status = 'Connected';
							//if($connect_details->status==2) $status = 'Declined';
						}*/
						//if($status!='Declined') {
				    	$member_file_path = getcwd().'/media/uploads/members/';
					    $member_path = BASE_URL.'media/uploads/members/';
 						/*$member='';
						if($row->contributor_id>0){
						$details = $this->member_model->get_single_record("mem_id='".$row->contributor_id."'");
						if($details!="0") $member=$details->username;
						}*/
						$img_src = $member_path.'randombig.gif';
						if($row->picture!='' && file_exists($member_file_path.$row->picture))
							$img_src = $member_path.$row->picture;
					?>
                    <div dummy_var="<?php echo $row->mem_id?>" class="media user_listing">
                    <div class="pull-left"><img src="<?php echo $img_src?>" style="width: 35px; height: 35px;" class="media-object" 
                    alt="64x64"></div>
                    <div class="media-body"><h5 class="less-mar-bottom"><?php echo $row->username; ?></h5></div>
                    </div>
					<?php //} 
					 endforeach;?>
                    </div>
				</div>
				<?php
				foreach($member_requests as $row) :		
				
  					$img_src = $member_path.'randombig.gif';
					if($row->picture!='' && file_exists($member_file_path.$row->picture))
					$img_src = $member_path.$row->picture;
 					$connections = sizeof($this->connect_model->combox("*","(to_id='".$row->mem_id."' OR from_id='".$row->mem_id."') AND                    status=1")); 			
  					$where = "raw_id>0 ";
					$member_contribution_details = $this->content_model->combox("*","contributor='".$row->mem_id."'"); 
					if($row->type==1)
					{
						$contents_ids = '';
						$allotments = $this->allotment_model->combox("distinct(content_id) as content_id","contributor_id='".$row->mem_id."'");
						foreach($allotments as $row_allotments) $contents_ids.=$row_allotments->content_id.",";		
						if($contents_ids!='') $contents_ids = trim($contents_ids,","); else $contents_ids = "''";
						$member_contribution_details = $this->content_model->combox("*","content_id IN ($contents_ids) AND                        story_date Like '".date("Y-m")."%'"); 
					}
					else
						$member_contribution_details = $this->content_model->combox("*","editor='".$row->mem_id."' AND story_date 
					Like '".date("Y-m")."%'");
 						
 					$status  = 'Connect'; 
					$connect_details = $this->connect_model->get_single_record("(from_id='".$this->mem_id."' AND to_id='".$row->mem_id."' ) OR  (from_id='".$row->mem_id."' AND to_id='".$this->mem_id."') ");
					if($connect_details!=NULL)
					{ 
						if($connect_details->status==0) 
						{
							if($connect_details->to_id==$this->mem_id)
								$status = 'Accept or Decline';
							else
								$status = 'Request sent';
						}
						if($connect_details->status==1) $status = 'Connected';
						if($connect_details->status==2) $status = 'Declined';
					}
					
   					?>
 					<div  id="user_details_<?php echo $row->mem_id?>" class="col-lg-6 bg-light pad-bottom user_details"
                      style="display:none;padding-bottom: 10px;">
 				    <h4>Result</h4>
				    <hr>
				    <div class="media">
					<div class="pull-left">
					 <img src="<?php echo $img_src?>" style="width: 65px; height: 65px;" class="media-object" alt="65x65">
					</div>
					<div class="media-body">
					<h4 class="media-heading"><?php echo $row->username; ?></h4>
					<h5><?php echo $connections?> <small>Connections</small></h5>
				    </div>
				    </div>
				    <hr>
				    <h6> 
				    <?php foreach($member_contribution_details as $row_contribution_details) : ?>
<?php /*?>                    <a href="<?php echo BASE_URL?>story/details?key=<?php echo $row_contribution_details->content_key ?>" >
<?php */?>            	  	<?php  echo $row_contribution_details->title; ?><br>
                  <!--  </a>-->
					<?php  endforeach;?>
				    </h6>
 				    <hr>	
					 <dl class="dl-horizontal">
						<dt>Experience:</dt>
						<dd><?php echo $row->experience;?></dd>
 						<dt>Expertise:</dt>
						<dd><?php					 
						  $exp = explode(',',$row->expertise);
 							if(!empty($exp))
							{
								foreach($exp as $val) echo $val."<br />";
							}
						 ?></dd>
 					</dl>
					<hr>
					
						<?php if($status=='Connect' || $status=='Declined') {?>
						<button class="btn btn-danger btn-sm" onclick="javascript:send_request(<?php echo $row->mem_id?>);" name="btntext
						<?php echo $row->mem_id?>" id="btntext<?php echo $row->mem_id?>" type="button">Connect</button>
						<?php } else if($status=='Accept or Decline'){?>
						<button class="btn btn-danger btn-sm" onclick="javascript:window.location.href='<?php echo BASE_URL?>account';"
                         name="btntext<?php echo $row->mem_id?>" id="btntext<?php echo $row->mem_id?>" type="button"><?php echo $status;?>
                         </button>
						<?php } else { ?>
						<button class="btn btn-danger btn-sm" onclick="javascript:void(0);" name="btntext<?php echo $row->mem_id?>"  
                        id="btntext<?php echo $row->mem_id?>" type="button"><?php echo $status;?></button>
						<?php } ?>
						
						<?php /*?><?php if($status=='Connect'){?>
						<button class="btn btn-danger btn-sm" onclick="javascript:send_request(<?php echo $row->mem_id?>);" name="btntext<?php                         echo $row->mem_id?>" id="btntext<?php echo $row->mem_id?>" type="button"><?php echo $status;?></button>
						<?php } else { ?>
						<button class="btn btn-danger btn-sm" onclick="javascript:void(0);" name="btntext<?php echo $row->mem_id?>" id="btntext                        <?php echo $row->mem_id?>" type="button"><?php echo $status;?></button>
						<?php } ?>
						<?php */?>
						<p></p>
						  <div class="alert alert-success" id="success_<?php echo $row->mem_id; ?>" style="display:none"></div>
      					  <div class="alert alert-danger" id="errors_<?php echo $row->mem_id; ?>" style="display:none"></div>
  						<?php /*?><button class="btn btn-primary btn-sm" name="btnfolio" type="button">View Folio</button><?php */?>
						<div class="clearfix pad-top pad-bottom"><textarea class="form-control" rows="3" name="messagetext<?php echo $row->                        mem_id ?>" id ="messagetext<?php echo $row->mem_id?>"></textarea></div>
						<button class="btn btn-danger btn-sm" onclick="javascript:send_message(<?php echo $row->mem_id?>);" type="button">Send                        Message </button> 
                        <button class="btn btn-default btn-sm" onclick="javascript:listing(<?php echo $row->mem_id?>);" type="button">Back</button>
				  </div>
				   <?php 
				    //}
				endforeach;?>
 				  <form  action="" method="get">
				  	<?php /*?><input type="hidden" name="raw_key" value="<?php echo $raw_key?>" /><?php */?>
					<div class="col-lg-6 col-md-6">
					<h4>Search</h4>
                    <hr>
 					    <label>Experience :</label>	
					<div class="form-group">
                        <select class="form-control input-sm" name="experience" id="experience">
                        <option value="" <?php if($experience=='') echo 'selected="selected"'; ?>>Select experience</option>
                        <option value="Less than 1 year" <?php if($experience=='Less than 1 year') echo 'selected="selected"'; ?>>Less than 1                         year</option>
                        <option value="1-2 years" <?php if($experience=='1-2 years') echo 'selected="selected"'; ?>>1-2 years</option>
                        <option value="2-5 years" <?php if($experience=='2-5 years') echo 'selected="selected"'; ?>>2-5 years</option>
                        <option value="5 years or more" <?php if($experience=='5 years or more') echo 'selected="selected"'; ?>>5 years or more
                        </option>
                        </select>
					</div>                  
					<label>Keywords :</label>
					<div class="form-group">
                        <textarea  class="form-control input-sm" placeholder="Keywords" name="keywords"><?php echo $keywords?></textarea>
                    </div>
					<label>Location :</label>
					<div class="form-group">
					<select class="form-control input-sm" name="country" id="country" onchange="javascript:getstates();">
					<option value="" selected="selected">Select Country</option>
					<?php foreach($countries as $row):?>
					<option value="<?php echo $row->code;?>" <? if($row->code==$country) echo 'selected="selected"';?>><?php echo $row->name;?>                    </option>
					<?php endforeach;?>	
					</select>
					</div>
  					<div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                               <select class="form-control input-sm" name="state" id="state"  onchange="javascript:getcities();">
								 <?php /*?> <option value="" selected="selected">Select State</option>
                                 <?php foreach($state as $row):?>
                                 <option value="<?php echo $row->name;?>" <? if($row->name) echo 'selected="selected"';?>><?php echo $row->name;?></option>
                                 <?php endforeach;?><?php */?>
						        </select>
                            </div>
                         </div>
                         <div class="col-lg-6"> 
                            <div class="form-group">
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
 					<div class="form-group"><input type="text" name="zipcode" value="<?php  echo $zipcode;?>" class="form-control input-sm"                     placeholder="Or Postal Code" /></div>
					<?php /*?><label>Radius:</label>
					<div class="form-group">
					<select class="form-control input-sm">
					<option>25 miles/40.23 km</option>
					<option>25 miles/40.23 km</option>
					</select>
					</div><?php */?>
					<div class="form-group">
                        <select multiple class="form-control" name="formattypes[]" style="min-height:120px;">
                        <option value="Web" <?php if(strpos($format,",Web,")!==false) echo 'selected="selected"'; ?>>Web</option>
                        <option value="Multimedia" <?php if(strpos($format,",Multimedia,")!==false) echo 'selected="selected"'; ?>>Multimedia
                        </option>
                        <option value="Sound Recordist" <?php if(strpos($format,",Sound Recordist,")!==false) echo 'selected="selected"'; ?>>                         Sound Recordist</option>
                        <option value="Text(Writer)" <?php if(strpos($format,",Text(Writer),")!==false) echo 'selected="selected"'; ?>>                        Text(Writer)</option>
                        <option value="Video" <?php if(strpos($format,",Video,")!==false) echo 'selected="selected"'; ?>>Video</option>
                        <option value="Voice Over" <?php if(strpos($format,",Voice Over,")!==false) echo 'selected="selected"'; ?>>Voice Over
                        </option> 
                        <option value="Photographer" <?php if(strpos($format,",Photographer,")!==false) echo 'selected="selected"'; ?>>                         Photographer</option> 
                        </select>
						<p><small class="text-muted">Hold down 'ctrl' key to select multiple types</small></p>
					</div>
					<div class="form-group">    
					<button type="submit" name="btnsubmit" class="btn btn-danger btn-sm">Search</button></div>
					</div>
					</form>	
				</div>
 			</div>
		</div>
 	</div>
</div>
<script>
$('.user_listing').click(function(event){
	var user_id = $(this).attr('dummy_var');
	$('#user_list').css('display','none');
	$('.user_details').css('display','none');
	$('#user_details_'+user_id).css('display','block');
})
function listing(user_id)
{
	$('#user_list').css('display','block');
	$('.user_details').css('display','none');
	$('#user_details_'+user_id).css('display','none');
}
</script>
<script type="text/javascript" language="javascript">
function send_message(mem_id)
{  
	var message = trim($('#messagetext'+mem_id).val());
	if(message!='')
	{
		$.ajax({
			type: "POST",
			url: "<?php echo BASE_URL;?>ajax/send_msg",
			data: "mem_id="+mem_id+"&message="+message,
			success: function(msg){
				if(msg!='')
				{
					msg = msg.replace(/^\s+|\s+$/g,"");
					$("#messagetext"+mem_id).val('');
					$("#errors_"+mem_id).hide();
					$("#success_"+mem_id).html("Message sent successfully");
					$("#success_"+mem_id).show();
				}
			}
		})
	}
	else{
	$("#success_"+mem_id).hide();
	$("#errors_"+mem_id).html("Please enter message");
	$("#errors_"+mem_id).show();
	}
}
function trim(str) 
{
	return str.replace(/^\s+|\s+$/g,"");
}
</script>
<script type="text/javascript" language="javascript">
function send_request(mem_id)
{	
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>editor/raw_media_pull/add_connect",
		data: "mem_id="+mem_id,
		success: function(msg){
			if(msg!='')
			{ 					
				msg = msg.replace(/^\s+|\s+$/g,"");
				$('#btntext'+mem_id).html('Request sent')
				alert(msg);
			}
		}
	})
}

function getstates()
{
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>editor/raw_media_pull/getstates",
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
		url: "<?php echo BASE_URL;?>editor/raw_media_pull/getcities",
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

</script>