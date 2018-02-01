<?php 
$format  	=''; if(!empty($_GET['format'])) $format = $_GET['format'] ;
$city 		=''; if($this->input->get('city')!=NULL)  $city = $this->input->get('city'); 
$state 		=''; if($this->input->get('state')!=NULL)  $state = $this->input->get('state'); 
$country 	=''; if ($this->input->get('country')!=NULL)  $country = $this->input->get('country'); 
$zipcode 	=''; if ($this->input->get('zipcode')!=NULL) $zipcode =  $this->input->get('zipcode'); 
$keywords   = ''; if($this->input->get('keywords')!=NULL) $keywords = $this->input->get('keywords');
$experience = ''; if($this->input->get('experience')!=NULL) $experience = $this->input->get('experience');
$picture 	= ''; if($this->input->get('picture')!=NULL) $picture = $this->input->get('picture');		
$expertise  = ''; if($this->input->get('expertise')!=NULL) $expertise = $this->input->get('expertise');		
$interests  = ''; if($this->input->get('interests')!=NULL) $interests = $this->input->get('interests');	
$title	    =''; if($this->input->get('title')!=NULL) $title = $this->input->get('title');	
$mem_id= $this->uri->segment(4)!=NULL?$this->uri->segment(4):0;
$this->level = $this->session->userdata('level');	 
?>
<div class="container">
	<div class="row">
        <div class="col-lg-4">
        	<br>
            <div class="btn-group">
                <a href="<?php echo BASE_URL?>account" class="btn btn-default btn-sm  ">PROFILE</a>  
                 <a href="<?php echo BASE_URL?>subscribers/search" class="btn btn-default btn-sm ">STORY SEARCH</a>
                  <?php   if($this->level==5){ ?>
                        <a class="btn btn-default btn-sm active" href="<?php echo BASE_URL?>subscribers/search/assign_story">ASSIGN</a>
                        <?php } ?>
                <?php /*?><a href="<?php echo BASE_URL?>subscribers/search/" class="btn btn-default btn-sm ">RESULT</a><?php */?>
               
             </div>
            <h3>RESULTS</h3>
        </div>
        <div class="col-lg-8 bg-light pad-bottom">
        	<div class="row">
				 <?php
                 foreach($member_requests as $row) :				
                        $member_file_path = getcwd().'/media/uploads/members/';
                        $member_path = BASE_URL.'media/uploads/members/';
                        $img_src = $member_path.'randombig.gif';
                        if($row->picture!='' && file_exists($member_file_path.$row->picture))
                        $img_src = $member_path.$row->picture;
						$connections = (int) sizeof($this->connect_model->combox("*","(to_id='".$row->mem_id."' OR from_id='".$row->mem_id."')
						AND  status=1")); 
					   $status = 'Connect';
					   $connect_details = $this->connect_model->get_single_record(" (from_id='".$this->mem_id."' AND to_id='".$row->mem_id."')                       OR (from_id='".$row->mem_id."' AND to_id='".$this->mem_id."') ");
 					if($connect_details!=NULL)
					{
						if($connect_details->status==0) $status= 'Request sent';
						if($connect_details->status==1) $status= 'Connected';
					}
					
					if($row->type==1)
					{
						$contents_ids = '';
						$allotments = $this->allotment_model->combox("distinct(content_id) as content_id","contributor_id='".$row->mem_id."'");
						foreach($allotments as $row_allotments) $contents_ids.=$row_allotments->content_id.",";		
						if($contents_ids!='') $contents_ids = trim($contents_ids,","); else $contents_ids = "''";
						$stories = $this->content_model->combox("*","content_id IN ($contents_ids)
						 AND story_date Like '".date("Y-m")."%' "); 
					}
					else
						$stories = $this->content_model->combox("*","editor='".$row->mem_id."' AND story_date Like '".date("Y-m")."%' "); 
                 ?>
                 <div  id="user_details_<?php echo $row->mem_id?>" class="col-lg-6 col-md-6 user_details" 
                 style="display:none<?php if($mem_id==$row->mem_id && empty($_GET)) echo "display:block" ;?>;padding-bottom: 10px;">
                     <h4>Result</h4>
                    <div class="media">
                        <?php /*?><div class="pull-left">
                            <img src="<?php echo $img_src?>" style="width: 32px; height: 32px;" class="media-object" alt="32x32">
                             <div class="carousel-caption">
                         <h4><?php //echo $row->title?></h4>
                        <h4>By <?php echo  $row->username ?></h4>
                  </div>
                        </div><?php */?>
                       
                         <div class="pull-left">
                            <img src="<?php echo $img_src?>" style="width: 32px; height: 32px;" class="media-object" alt="32x32">
                            </div>
                           <h4 class="media-heading"><?php echo $row->username; ?></h4>
                          <h5><?php echo $connections ?> <small>Connections</small></h5>
                        
                      </div>
                      <hr> 
 					   <ul class="list-group">
 						 <?php foreach($stories as $row_story) : ?>
                           <?php  if($this->session->userdata('level')==5)  { ?>
                         
							<a href="<?php echo BASE_URL?>story/details?key=<?php echo $row_story->content_key ?>" >
								<h5><?php  echo $row_story->title ?></h5>
							</a>
                           <?php } else { ?>
                           <h5><?php   echo $row_story->title ?></h5>
                           <?php  } ?>
 						<?php endforeach;?>
                   		</ul>
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
                          <?php if($this->session->userdata('level')==5)  { ?>
                         <?php if($status=='Connect'){?>
						<button class="btn btn-danger btn-sm" onclick="javascript:send_request(<?php echo $row->mem_id?>);" name="btntext<?php                         echo $row->mem_id?>" id="btntext<?php echo $row->mem_id?>" type="button"><?php echo $status;?></button>
						<?php } else { ?>
						<button class="btn btn-danger btn-sm" onclick="javascript:void(0);" name="btntext<?php echo $row->mem_id?>" id="btntext                        <?php echo $row->mem_id?>" type="button"><?php echo $status;?></button>
						<?php } ?><?php } ?>
						  <?php if($row->folio_link!=''){?>
                         	<a href="<?php echo $row->folio_link ?>" target="_blank"><button class="btn btn-primary btn-sm" type="button">View                            Folio</button></a>
						 <?php } ?>
                          <p></p>
						  <div class="alert alert-success" id="success_<?php echo $row->mem_id; ?>" style="display:none"></div>
      					  <div class="alert alert-danger" id="errors_<?php echo $row->mem_id; ?>" style="display:none"></div>
                          <div class="clearfix pad-top pad-bottom"><textarea class="form-control" rows="3" name="messagetext<?php echo $row->                          mem_id?>"  id="messagetext<?php echo $row->mem_id?>"></textarea></div>
                         <button class="btn btn-danger btn-sm" onclick="javascript:send_message(<?php echo $row->mem_id?>);" type="button">Send                          Message </button>
                         <button type="button" class=" btn btn-default btn-sm" onClick="javascript: document.location = '<?php echo BASE_URL.                         'subscribers/search/stories';?>';">Back</button>
                      </div>
                <?php endforeach;?>
                <div class="col-lg-6 col-md-6" id="user_list" style="display:none<?php if(!empty($_GET)) echo "display:block"?>">
					<?php /*?><?php if(!empty($_GET['experience'])) { ?>
						<h4><?php echo sizeof($member_requests)?> Results</h4>
					<?php } ?><?php */?>
                    <?php if(!empty($_GET['experience']) || !empty($_GET['country']) || !empty($_GET['city']) || 
					!empty($_GET['state']) || !empty($_GET['zipcode']) || !empty($_GET['keywords']) || !empty($_GET['interests'])
					 || !empty($_GET['experience'])) 
					 if($member_requests!=NULL) {  ?>
						<h4><?php echo "Results" ; ?></h4>
					<?php } if($member_requests==NULL) { ?>
 						<h4><?php echo "No Result Found" ;?></h4>
					<?php } ?>
					  <hr>
 					<div class="listing-wrap">
					<?php
					$member_file_path = getcwd().'/media/uploads/members/';
					$member_path = BASE_URL.'media/uploads/members/';
					foreach($member_requests as $row) :
						$member='';
						if($row->contributor_id>0){
						$details = $this->member_model->get_single_record("mem_id='".$row->contributor_id."'");
						if($details!="0") $member=$details->username;
						}
						$img_src = $member_path.'randombig.gif';
						if($row->picture!='' && file_exists($member_file_path.$row->picture))
							$img_src = $member_path.$row->picture;
					?>
                    <div dummy_var="<?php echo $row->mem_id?>" class="media user_listing" >
                    <div class="pull-left"><img src="<?php echo $img_src?>" style="width: 35px; height: 35px;" class="media-object" 
                    alt="64x64"></div>
                    <div class="media-body"><h5 class="less-mar-bottom"><?php echo $row->username; ?></h5></div>
                    </div>
					<?php endforeach;?>
                    </div>
				</div>
               </div>
        </div>
    </div>
    
</div>
 
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
</script>
<!--<script>
$('.user_listing').click(function(event){
	var user_id = $(this).attr('dummy_var');
	$('#user_list').css('display','none');
	$('.user_details').css('display','none');
	$('#user_details_'+user_id).css('display','block');
})
</script>-->
<script type="text/javascript" language="javascript">
function send_request(mem_id)
{	
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>subscribers/search/add_connect",
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


