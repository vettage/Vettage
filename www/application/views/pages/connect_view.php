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
$expertise = ''; if($this->input->get('expertise')!=NULL) $expertise = $this->input->get('expertise');		
$interests = ''; if($this->input->get('interests')!=NULL) $interests = $this->input->get('interests');		
?>
<div class="container">
	<div class="row">
		<div class="col-lg-4">
			<div role="toolbar" class="btn-toolbar pad-top">
                <div class="btn-group">
                  <a href="<?php echo BASE_URL?>contributor/raw_media/submit" class="btn btn-default btn-sm">SUBMIT RAW MEDIA</a> 
                  <a href="<?php echo BASE_URL?>contributor/raw_media/connect" 
                  class="btn btn-default btn-sm active">CONNECT</a>
					<a href="<?php echo BASE_URL?>account" class="btn btn-default btn-sm">PROFILE</a>
 					<?php /*?><a href="<?php echo BASE_URL?>contributor/raw_media/connect" class="btn btn-default btn-sm active">CONNECT</a><?php */?>
					<?php /*?><a href="<?php echo BASE_URL?>contributor/raw_media/submit?raw_key=<?php echo $raw_key;?>" class="btn btn-default btn-sm">UPDATE</a><?php */?>
                </div>
            </div>
        	<h3>CONNECT</h3>
        </div>
        <div class="col-lg-8 bg-light pad-bottom">
                <div class="col-lg-6 col-md-6" id="user_list">
					<?php 
					if($_GET)
					{  
						if($member_requests!=NULL) echo '<h4>Results</h4>';
						else echo '<h4>No result found</h4>';
					}
					else
					{
						if($member_requests!=NULL) 
						{
							echo '<h4>Requests From Editors</h4>';
							if($new_member_requests==NULL) 
								echo '<span style="color:#FF0000">No new connecton requests</span>';
							else
								echo '<span style="color:#009900">'.sizeof($new_member_requests).' new connecton request(s)</span>';
						}
						else echo '<h4>There are no requests</h4>';
						//else echo '<h4>There are no new requests</h4>';
					}
					?>
                	<hr>
                	<div class="listing-wrap">
					<?php
                    foreach($member_requests as $row) :
						$status  = 'Connect';
						$connect_details = $this->connect_model->get_single_record("(from_id='".$this->mem_id."' AND to_id='".$row->mem_id."' ) OR  (from_id='".$row->mem_id."' AND to_id='".$this->mem_id."') ");
						if($connect_details!=NULL)
						{
							if($connect_details->status==0) $status = 'Request sent';
							if($connect_details->status==1) $status = 'Connected';
						}
							/*$member='';
							if($row->contributor_id>0){
							$details = $this->member_model->get_single_record("mem_id='".$row->contributor_id."'");
							if($details!="0") $member=$details->username;
							}*/
							$member_file_path = getcwd().'/media/uploads/members/';
							$member_path = BASE_URL.'media/uploads/members/';
							$img_src = $member_path.'randombig.gif';
							if($row->picture!='' && file_exists($member_file_path.$row->picture))
							$img_src = $member_path.$row->picture;
							?>
							 <div dummy_var="<?php echo $row->mem_id;?>" class="media user_listing">
								<div class="pull-left">
									<img src="<?php echo $img_src?>" style="width: 35px; height: 35px;" class="media-object" alt="32x32">
								</div>
								<div class="media-body">
								<h5 class="less-mar-bottom"><?php echo $row->username; ?></h5>
								</div>
							</div>
                      <?php   endforeach;?>
                    </div>
                </div>
        	 <?php
			foreach($member_requests as $row) :	
				
				$status  = 'Connect';
				$connect_details = $this->connect_model->get_single_record("(from_id='".$this->mem_id."' AND to_id='".$row->mem_id."' ) 
				OR (from_id='".$row->mem_id."' AND  to_id='".$this->mem_id."') ");
				if($connect_details!=NULL)
				{
					if($connect_details->status==0) $status = 'Request sent';
					if($connect_details->status==1) $status = 'Connected';
				}
					$member_file_path = getcwd().'/media/uploads/members/';
					$member_path = BASE_URL.'media/uploads/members/';
					$img_src = $member_path.'randombig.gif';
					if($row->picture!='' && file_exists($member_file_path.$row->picture))
					$img_src = $member_path.$row->picture;
					$connections = sizeof($this->connect_model->combox("*","(to_id='".$row->mem_id."' OR from_id='".$row->mem_id."')
					 AND status=1"));
					$stories = $this->content_model->combox("*","editor='".$row->mem_id."'");
		 		?> 
         		<div  id="user_details_<?php echo $row->mem_id?>" class="col-lg-6 bg-light pad-bottom user_details"  style="display:none">
 					<h4>Results</h4>
                    <hr>
					<div class="media">
						<div class="pull-left">
							<img src="<?php echo $img_src?>" style="width: 65px; height: 65px;" class="media-object" alt="32x32" />
						</div>
						<div class="media-body">
							<h4 class="media-heading"><?php echo $row->username; ?></h4>
                        <h5><?php echo $connections?> <small>Connections</small></h5>
                          <?php /*?> <?php foreach($connect_data as $data) : ?>
                           <h5><?php echo $data->from_id?></h5>
						  <?php endforeach ; ?><?php */?> 
						</div>
					</div>
					<?php if($stories!=NULL){?>
					<hr>
					<h6>
					<?php foreach($stories as $row_story) : ?>
                        <?php if($this->session->userdata('level')==4) { ?>
                    	<a href="<?php echo BASE_URL?>story/details?key=<?php echo $row_story->content_key ?>" >
            	  		<?php echo $row_story->title; ?><br>
                    </a>
                    <?php } else {?>
                      <?php echo $row_story->title; ?>
                    <?php } ?>
                    
					<?php endforeach; ?>
					</h6>
					<?php } ?>
					
					<?php /*?><h6>New life at Song Tra, Vietnam<br /> 
					A Soldier's Tale: Memoirs from Special Forces</h6><?php */?>
					<hr>	
 					<dl class="dl-horizontal">
					<dt>Experience:</dt>
					<dd><?php echo $row->experience;?></dd>
 					<dt>Expertise:</dt>
						<dd>
						<?php					 
						$exp = explode(',',$row->expertise);
						if(!empty($exp)){
							foreach($exp as $val) echo $val."<br />";
						}
						?>
						</dd>
					</dl>
					<hr>
					    <?php if($status=='Connect'){?>
						<button class="btn btn-danger btn-sm" onclick="javascript:send_request(<?php echo $row->mem_id?>);" name="btntext<?php               
						          echo $row->mem_id?>" id="btntext<?php echo $row->mem_id?>" type="button"><?php echo $status;?></button>
					    <?php } else { ?>
						<button class="btn btn-danger btn-sm" onclick="javascript:void(0);" name="btntext<?php echo $row->mem_id?>" id="btntext                 
						       <?php echo $row->mem_id?>" type="button"><?php echo $status;?></button>
 					    <?php } ?>
						
						<?php if($row->type==2 && $row->folio_link!=''){?>
 							<a href="<?php echo $row->folio_link?>" ><button class="btn btn-primary btn-sm" type="button">View Follo</button>
                            </a>
						<?php } else { ?>
							<button class="btn btn-primary btn-sm" type="button">View Follo</button>
						<?php } ?>
 					<div class="clearfix pad-top pad-bottom">
                       <textarea class="form-control" rows="3" name="messagetext<?php echo $row->mem_id?>" id="messagetext<?php                        echo $row-> mem_id?>"></textarea>
					   
                    </div>
                    <button class="btn btn-danger btn-sm" onclick="javascript:send_message(<?php echo $row->mem_id?>);" type="button">Send                    
					 Message</button>
					<button class="btn btn-default btn-sm" onclick="javascript:listing(<?php echo $row->mem_id?>);" type=                     
					  "button">Back</button><br /><br />
                    <label>Public Key</label>
                   <div class="clearfix pad-top pad-bottom"><textarea class="form-control" name="keytext" rows="3"></textarea></div>
                  <p><small class="text-muted"><u>Learn more about public key cryptography</u></small></p>
				</div>
		    <?php  endforeach;?>
			
			
			
			
            <div class="col-lg-6 col-md-6">
            	<h4>Search</h4>
                <hr>
                <form role="form" method="get">
				<input type="hidden" name="raw_key" value="<?php //echo $raw_key?>" />
                <label>Experience :</label>
                <div class="form-group">
                    <select class="form-control input-sm" name="experience" id="experience">
						<option value="" <?php if($experience=='') echo 'selected="selected"'; ?>>Select Experience</option>
						<option value="Less than 1 year" <?php if($experience=='Less than 1 year') echo 'selected="selected"'; ?>>
                        Less than 1   						   year</option>
						<option value="1-2 years" <?php if($experience=='1-2 years') echo 'selected="selected"'; ?>>1-2 years</option>
						<option value="2-5 years" <?php if($experience=='2-5 years') echo 'selected="selected"'; ?>>2-5 years</option>
						<option value="5 years or more" <?php if($experience=='5 years or more') echo 'selected="selected"'; ?>>5 years or more						                       </option> 
                    </select>
                </div>
                <label>Interests (Separate by commas) :</label>
                <div class="form-group">
					<textarea  class="form-control input-sm" name="interests"><?php echo $interests?></textarea>
                </div>
                <label>Location :</label>
                <div class="form-group">
                    <select class="form-control input-sm" name="country">
					<option value="" selected="selected">Select Country</option>
					<?php foreach($countries as $row):?>
					<option value="<?php echo $row->code;?>" <? if($row->code==$country) echo 'selected="selected"';?>><?php echo $row->name;?>                
					    </option>
					<?php endforeach;?>	
					
					</select>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                        <input type="state" name="state" placeholder="State" value="<?php  echo $state;?>" class="form-control input-sm"  />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <input type="city" name="city" placeholder="City" value="<?php  echo $city;?>" class="form-control input-sm"  />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                     <input type="text" name="code" value="<?php  echo $zipcode;?>" class="form-control input-sm" placeholder="Postal Code" />
                </div>
                 <?php /*?><label>Radius:</label>
                <div class="form-group">
                    <select class="form-control input-sm">
                        <option>25 miles/40.23 km</option>
                        <option>25 miles/40.23 km</option>
                    </select>
                </div><?php */?>
                
                <label>Expertise (Separate by commas) :</label>
                <div class="form-group">
					<textarea  class="form-control input-sm" name="expertise"><?php echo $expertise?></textarea>
                </div>
                <label>Keyword (Separate by commas) :</label>
                <div class="form-group">
                   <textarea  class="form-control input-sm" name="keywords"><?php echo $keywords?></textarea>
                </div>
                <div class="form-group"><button type="submit" class="btn btn-danger btn-sm">Search</button></div>
               </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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
					alert(msg);
				}
			}
		})
	}
	else
	{
		alert('Please enter message');
	}
}
function trim(str) 
{
	return str.replace(/^\s+|\s+$/g,"");
}
function send_request(mem_id)
{
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>contributor/raw_media/add_connect",
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
</script>