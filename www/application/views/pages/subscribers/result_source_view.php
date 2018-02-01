<!--main-->
<?php 
$picture = ''; if($this->input->get('picture')!=NULL) $picture = $this->input->get('picture');				
?>
<div class="container">
	<div class="row">
       <div class="col-lg-7">
        <a href="<?php echo BASE_URL?>subscribers/search/source"><h4>NEW SEARCH</h4></a>
        </div>
       
		<div class="col-lg-6 bg-light pad-bottom">
        	<div class="row">
        	<div class="col-lg-6 col-md-6" id="user_list">
        	<!--<h4>Results</h4>-->
            <?php if($_GET)
					  {  
					   if($source_data!=NULL) echo '<h4>Results</h4>';
					   else echo '<h4>No results found</h4>';
					 }
 			 ?>
        	<div class="listing-wrap">
            <?php
					foreach($source_data as $row) :
						 $member_file_path = getcwd().'/media/uploads/members/';
						$member_path = BASE_URL.'media/uploads/members/';
						$img_src = $member_path.'randombig.gif';
						if($row->picture!='' && file_exists($member_file_path.$row->picture))
						$img_src = $member_path.$row->picture;
					?>
               	 <div dummy_var="<?php echo $row->mem_id?>" class="media user_listing">
                    <div class="pull-left">
                        <img src="<?php echo $img_src?>" style="width: 35px; height: 35px;" class= "media-object" alt="64x64">
                    </div>
                    <div class="media-body">
                    <h5 class="less-mar-bottom"><?php echo $row->username; ?></h5>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
               </div>
               <?php
				foreach($source_data as $row) :	
 					$member_file_path = getcwd().'/media/uploads/members/';
					$member_path = BASE_URL.'media/uploads/members/';
					$img_src = $member_path.'randombig.gif';
					if($row->picture!='' && file_exists($member_file_path.$row->picture))
					$img_src = $member_path.$row->picture;
					
					if($row->type==1)
					{
						$contents_ids = '';
						$allotments = $this->allotment_model->combox("distinct(content_id) as content_id","contributor_id='".$row->mem_id."'");
						foreach($allotments as $row_allotments) $contents_ids.=$row_allotments->content_id.",";		
						if($contents_ids!='') $contents_ids = trim($contents_ids,","); else $contents_ids = "''";
						$stories = $this->content_model->combox("*"," content_id IN ($contents_ids)"); 
					}
					else
						$stories = $this->content_model->combox("*"," editor='".$row->mem_id."'"); 
				?>
                <div  id="user_details_<?php echo $row->mem_id?>" class="col-lg-6 user_details"  style="display:none">
					<h4>Results</h4>
                    <hr>
					<div class="media">
						<div class="pull-left">
							 <?php //if($this->session->userdata('level')==5) { ?>
								<a href="<?php echo BASE_URL?>subscribers/search/assign_story/<?php echo $row->mem_id ?>">
									<img src="<?php echo $img_src?>" style="width: 65px; height: 65px;" class="media-object" alt="65x65">
								</a>
							<?php /*?><?php } else { ?>
								<img src="<?php echo $img_src?>" style="width: 65px; height: 65px;" class="media-object" alt="65x65">
							<?php } ?><?php */?>
						</div>
						<div class="media-body">
							<h4 class="media-heading">
								<?php //if($this->session->userdata('level')==5) { ?>
									<a href="<?php echo BASE_URL?>subscribers/search/assign_story/<?php echo $row->mem_id ?>"><?php echo $row->username; ?></a>
								<?php //} else { ?>
									<?php //echo $row->username; ?>
								<?php //} ?>
							</h4>
                        <!--<h5>3 <small>Connections</small></h5>-->
 						</div>
					</div>
					<hr>
					<h5>Stories by <?php echo $row->username; ?></h5>
                     <ul class="list-group">
						 <?php foreach($stories as $row_story) : ?>
                         <?php if($this->session->userdata('level')!=5) { ?>
                         <li class="list-group-item"><span class="pull-right">
									<?php echo date("Ymd",strtotime($row_story->story_date));?> </span>
 									<?php echo $row_story->title ?>
								</li>
                                <?php }else { ?>
							<a href="<?php echo BASE_URL?>story/details?key=<?php echo $row_story->content_key ?>" >
								<li class="list-group-item"><span class="pull-right">
									<?php echo date("Ymd",strtotime($row_story->story_date));?> </span>
 									<?php echo $row_story->title ?>
								</li>
							</a>
                            <?php } ?>
 						<?php endforeach;?>
                   </ul>
                   <button class="btn btn-default btn-sm" onclick="javascript:listing(<?php echo $row->mem_id?>);" type=                   "button">Back</button>
                    <button class="btn btn-default btn-sm pull-right" onclick="javascript:location.href='<?php echo BASE_URL?>subscribers/search/source';" type="button">Back To Search</button>
                  </div>
                   <?php  endforeach;?>
                </div>
             
			 <br/>
			
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
$('.user_listing_cancel').click(function(event){
	var user_id = $(this).attr('dummy_var');
	$('#user_list').css('display','none');
	$('.user_details').css('display','none');
	$('#user_details_'+user_id).css('display','block');
})
</script>

<!--<script>
$('.story_listing').click(function(event){
	var user_id = $(this).attr('dummy_var');
	$('#story_list').css('display','none');
	$('.story_details').css('display','none');
	$('#story_details_'+user_id).css('display','block');
})
</script>-->

