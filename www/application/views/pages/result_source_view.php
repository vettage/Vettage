<!--main-->
<?php 
$picture 	= ''; if($this->input->get('picture')!=NULL) $picture = $this->input->get('picture');				
?>
<div class="container">
	<div class="row">
		<div class="col-lg-5">
         <br>
        <div class="btn-group">
           <a  class="btn btn-default btn-sm " href="<?php echo BASE_URL?>subscribers/search" >STORY SEARCH</a>
           <a  class="btn btn-default btn-sm active" href="javascript:void(0);" >RESULT</a>
           <a  class="btn btn-default btn-sm"  href="<?php echo BASE_URL?>subscribers/search/assign_story" >PROFILE</a>
           <a  class="btn btn-default btn-sm"  href="javascript:void(0);">STORY</a>
         </div>
        <h3>NEW SEARCH</h3>
        
        </div>
		<div class="col-lg-6 bg-light pad-bottom">
        	<div class="row">
        		<div class="col-lg-6 col-md-6" id="user_list">
        	<h4>Results</h4>
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
						 
						 $stories = $this->content_model->combox("*","editor='".$row->mem_id."'"); 
 					?>
                <div  id="user_details_<?php echo $row->mem_id?>" class="col-lg-6 user_details"  style="display:none">
					<h4>Results</h4>
                    <hr>
					<div class="media">
						<div class="pull-left">
                    		<a href="<?php echo BASE_URL?>subscribers/search/assign_story/<?php echo $row->mem_id ?>">
								<img src="<?php echo $img_src?>" style="width: 65px; height: 65px;" class="media-object" alt="65x65">
							</a>
						</div>
						<div class="media-body">
							<h4 class="media-heading">
								<a href="<?php echo BASE_URL?>subscribers/search/assign_story/<?php echo $row->mem_id ?>"><?php echo $row->username; ?></a>
							</h4>
                        <!--<h5>3 <small>Connections</small></h5>-->
 						</div>
					</div>
					<hr>
					<h5>Stories by <?php echo $row->username; ?></h5>
                     <ul class="list-group">
						 <?php foreach($stories as $row_story) : ?>
							<a href="<?php echo BASE_URL?>story/details?key=<?php echo $row_story->content_key ?>" target="_blank">
								<li class="list-group-item"><span class="pull-right">
									<?php echo date("Ymd",strtotime($row_story->story_date));?> </span><?php echo $row_story->title ?>
								</li>
							</a>
						<?php endforeach;?>
                   </ul>
                  </div>
                   <?php endforeach;?>
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
</script>
<!--<script>
$('.story_listing').click(function(event){
	var user_id = $(this).attr('dummy_var');
	$('#story_list').css('display','none');
	$('.story_details').css('display','none');
	$('#story_details_'+user_id).css('display','block');
})
</script>-->

