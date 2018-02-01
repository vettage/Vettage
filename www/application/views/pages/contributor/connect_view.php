<script src="<?php echo BASE_URL?>media/tag-it/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo BASE_URL?>media/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">

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
		<div class="col-lg-5">
        	<h3>MY CONNECTIONS</h3>
        	
               	<div class="listing-wrap">
					<?php
                    foreach($connections as $row) :

						$img_src = BASE_URL.'media/uploads/members/randombig.gif';
						if($row['picture']!='' && file_exists(getcwd().$row['picture']))
						$img_src = $row['picture'];

						$roles = array();
						if (substr($row['type'],-1)=='1') $roles[] = 'Subscriber';
						if (substr($row['type'],0,1)=='1')  $roles[] = 'Editor';
						if (substr($row['type'],1,1)=='1')  $roles[] = 'Content Contributor';
						$role_string = implode (' | ',$roles);
						
						?>
						 <div dummy_var="<?php echo $row['id'];?>" class="media user_listing">
							<div class="pull-left">
								<img src="<?php echo $img_src?>" style="width: 35px; height: 35px;" class="media-object" alt="32x32">
							</div>
							<div class="media-body">
							<h5 class="less-mar-bottom"><?php echo $row['username']; ?> (<?php echo $role_string?>)</h5>
							</div>
						</div>
                      <?php  
					  endforeach;?>
                    </div>
        	
        </div>


        <div class="col-lg-7 bg-light pad-bottom">
                <div class="col-lg-6 col-md-6" id="user_list">
					<?php 
	//				if($_GET)
	//				{  
						if($member_requests!=NULL) echo '<h4>Results</h4><hr>';
						else echo '<h4>No result found</h4>';
/*	
}
					else
					{
						echo '<h4>Requests</h4>';
						/*if($member_requests!=NULL) 
							echo '<h4>Requests From Editors</h4>';
						else 
							echo '<h4>There are no requests</h4>';*/
						/*
						if($new_member_requests==NULL) 
							echo '<span style="color:#FF0000">No new connection requests</span>';
						else
							echo '<span style="color:#009900">'.sizeof($new_member_requests).' new connection request(s)</span>';
						//else echo '<h4>There are no new requests</h4>';
					}
*/
					?>
                
                	<div class="listing-wrap">
					<?php
                    foreach($member_requests as $row) :
                    if ($row->id==$this->user_id) continue;
                    
                    $img_src = BASE_URL.'media/uploads/members/randombig.gif';
                    if($row->picture!='' && file_exists(getcwd().$row->picture))
                    	$img_src = $row->picture;
                    
                    	$roles = array();
                    	if (substr($row->type,-1)=='1') $roles[] = 'Subscriber';
                    	if (substr($row->type,0,1)=='1')  $roles[] = 'Editor';
                    	if (substr($row->type,1,1)=='1')  $roles[] = 'Content Contributor';
                    	$role_string = implode (' | ',$roles);
                    	 
                    	
                    	
                    ?>
						 <div dummy_var="<?php echo $row->id;?>" class="media user_listing">
							<div class="pull-left">
								<img src="<?php echo $img_src?>" style="width: 35px; height: 35px;" class="media-object" alt="32x32">
							</div>
							<div class="media-body">
							<h5 class="less-mar-bottom"><?php echo $row->username; ?> (<?php echo $role_string?>)</h5>
							</div>
						</div>
                      <?php  
					  endforeach;?>
                    </div>
                </div>
        	 <?php
			foreach($member_requests as $row) :	
				
				$status  = 'Connect';
				$connect_details = $this->connect_model->get_single_record("(from_id='".$this->user_id."' AND to_id='".$row->id."' ) OR  (from_id='".$row->id."' AND to_id='".$this->user_id."') ");
				if($connect_details!=NULL)
				{ 
					if($connect_details->status==0) 
					{
						if($connect_details->to_id==$this->user_id) 
							$status = 'Accept or Decline';
						else
							$status = 'Request sent';
					}
					if($connect_details->status==1) $status = 'Connected';
					if($connect_details->status==2) $status = 'Declined';
				}
				
				/*$status  = 'Connect';
				$connect_details = $this->connect_model->get_single_record("(from_id='".$this->mem_id."' AND to_id='".$row->mem_id."' ) 
				OR (from_id='".$row->mem_id."' AND  to_id='".$this->mem_id."') ");
				if($connect_details!=NULL)
				{
					if($connect_details->status==0) $status = 'Request sent';
					if($connect_details->status==1) $status = 'Connected';
					if($connect_details->status==2) $status = 'Declined';
				}*/
				
				$img_src = BASE_URL.'media/uploads/members/randombig.gif';
				if($row->picture!='' && file_exists(getcwd().$row->picture))
				$img_src = $row->picture;
				$roles = array();
				if (substr($row->type,-1)=='1') $roles[] = 'Subscriber';
				if (substr($row->type,0,1)=='1')  $roles[] = 'Editor';
				if (substr($row->type,1,1)=='1')  $roles[] = 'Content Contributor';
				$role_string = implode (' | ',$roles);
				
				$connections = sizeof($this->connect_model->combox("*","(to_id='".$row->id."' OR from_id='".$row->id."') AND status=1"));
				$stories = $this->content_model->combox("*","editor='".$row->id."'");
				?> 
				<div  id="user_details_<?php echo $row->id?>" class="col-lg-6 bg-light pad-bottom user_details"  style="display:none">
				<h4>Profile</h4>
				<hr>
				<div class="media">
					<div class="pull-left">
						<img src="<?php echo $img_src?>" style="width: 65px; height: 65px;" class="media-object" alt="32x32" />
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $row->username; ?> (<?php echo $role_string?>)</h4>
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
					
							<a href="<?php echo BASE_URL?>story/details?key=<?php echo $row_story->content_key ?>" >
							<?php echo $row_story->title; ?><br>
							<br>
						</a>
					<?php endforeach; ?>
					</h6>
				<?php } ?>
				
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
					
					<?php if($status=='Connect' || $status=='Declined')  {?>
					<button class="btn btn-danger btn-sm" onclick="javascript:send_request(<?php echo $row->id?>);" name="btntext<?php						          echo $row->id?>" id="btntext<?php echo $row->id?>" type="button">Connect</button>
					<?php  } else if($status=='Accept or Decline'){?>
					<button class="btn btn-danger btn-sm" onclick="javascript:window.location.href='<?php echo BASE_URL?>account';"
                     name="btntext<?php echo $row->id?>" id="btntext<?php echo $row->id?>" type="button"><?php echo $status;?></button>
					<?php } else { ?>
					<button class="btn btn-danger btn-sm" onclick="javascript:void(0);" name="btntext<?php echo $row->id?>" id="btntext						       <?php echo $row->id?>" type="button"><?php echo $status;?></button>
					<?php } ?>
 					<?php if($row->folio_link!=''){?>
						<a href="<?php echo $row->folio_link?>" ><button class="btn btn-primary btn-sm" type="button">View Follo</button>
						</a>
					<?php } else { ?>
						<button class="btn btn-primary btn-sm" disabled="disabled" type="button">View Follo</button>
					<?php } ?>
                   <p></p>
                  <div class="alert alert-success" id="success_<?php echo $row->id; ?>" style="display:none"></div>
                  <div class="alert alert-danger" id="errors_<?php echo $row->id; ?>" style="display:none"></div>
 			 	  <div class="clearfix pad-top pad-bottom">
				   <textarea class="form-control" rows="3" name="messagetext<?php echo $row->id?>" id="messagetext<?php                        echo $row->id?>"></textarea>
				 </div>
				<button class="btn btn-danger btn-sm" onclick="javascript:send_message(<?php echo $row->id?>);" type="button">
                Send Message</button>
				<button class="btn btn-default btn-sm" onclick="javascript:listing(<?php echo $row->id?>);" type=                     
				  "button">Back</button><br /><br />
				<label>Public Key</label>
			   <div class="clearfix pad-top pad-bottom"><textarea class="form-control" name="keytext" rows="3"></textarea></div>
			  <p><small class="text-muted"><a href="http://en.wikipedia.org/wiki/Pretty_Good_Privacy">Learn more about public key cryptography</a></small></p>
			</div>
			<?php  
			
			endforeach;?>
              <div class="col-lg-6 col-md-6">
            	<h4>Search</h4>
                <hr>
                <form role="form" method="get">
                <label>Location :</label>
                <div class="form-group">
                    <select class="form-control input-sm" name="country" id="country" onchange="javascript:getstates();">
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
                         <select class="form-control input-sm" name="state" id="state"  onchange="javascript:getcities();">
                                <?php /*?> <option value="" selected="selected">Select State</option>
                                 <?php foreach($state as $row):?>
                                 <option value="<?php echo $row->name;?>" <? if($row->name) echo 'selected="selected"';?>><?php                                  echo $row->name;?></option>
                                 <?php endforeach;?><?php */?>
                          </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                              <select class="form-control input-sm" name="city" id="city">
                                 <?php /*?><option value="" selected="selected">Select City</option>
                                 <?php foreach($city as $row):?>
                                 <option value="<?php echo $row->name;?>" <? if($row->name) echo 'selected="selected"';?>><?php                                 echo $row->name;?></option>
                                 <?php endforeach;?><?php */?>
                            </select>
                    </div>
                </div>
                 </div>
                
                <label>Field of Expertise:</label>
                <div class="form-group">
                            <ul id="expertiseTags"></ul>
                            <input type="hidden" name="expertise" id="expertise" value="<?php echo $expertise?>" />
                </div>

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
					<textarea  class="form-control input-sm" placeholder="Interests(Separate by commas)" name="interests"><?php echo $interests?></textarea>
                </div>
                 <?php /*?><label>Radius:</label>
                <div class="form-group">
                    <select class="form-control input-sm">
                        <option>25 miles/40.23 km</option>
                        <option>25 miles/40.23 km</option>
                    </select>
                </div><?php */?>
                
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
  					$("#messagetext"+mem_id).val('');
					$("#errors_"+mem_id).hide();
					$("#success_"+mem_id).html("Message sent successfully");
					$("#success_"+mem_id).show();
				}
			}
		})
	}
	else
	{
	$("#success_"+mem_id).hide();
	$("#errors_"+mem_id).html("Please enter message");
	$("#errors_"+mem_id).show();
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
		url: "<?php echo BASE_URL;?>collaborate/raw_media/add_connect",
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
		url: "<?php echo BASE_URL;?>collaborate/raw_media/getstates",
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
		url: "<?php echo BASE_URL;?>collaborate/raw_media/getcities",
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

$(function(){
 	$('#expertiseTags').tagit({
		autocomplete: {delay: 0, minLength: 2,
			source: function(request, response) {
            $.ajax({
                url: "<?php echo BASE_URL?>/ajax/expertise",
                dataType: "json",
                data: request,
                success: function( data, textStatus, jqXHR) {
                    console.log( data);
                    var items = data;
                    response(items);
                },
                error: function(jqXHR, textStatus, errorThrown){
                     console.log( textStatus);
                }
            });
        },},
		
	    // This will make Tag-it submit a single form value, as a comma-delimited field.
	    singleField: true,
	    singleFieldNode: $('#expertise')
	});

});

</script>