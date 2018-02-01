<link href="<?php echo BASE_ASSETS; ?>bootstrap-multiselect/dist/css/bootstrap-multiselect.css" rel="stylesheet">
<script src="<?php echo BASE_ASSETS;?>bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>


<?php
$types     	= '';if(!empty($_GET['formattypes'])) $types = implode(',',$_GET['formattypes']);
$city 		=  '';if($this->input->get('city')!=NULL)  $city = $this->input->get('city');
$state 		= '';if($this->input->get('state')!=NULL) $state = $this->input->get('state');
$country 	= '';if($this->input->get('country')!=NULL) $country = $this->input->get('country');
$zipcode 	= '';if($this->input->get('zipcode')!=NULL) $zipcode = $this->input->get('zipcode');
$tags 		= '';if($this->input->get('tags')!=NULL) $tags = $this->input->get('tags');
$date 		=''; if ($this->input->get('date')!=NULL) $date =  $this->input->get('date');
$editor     =''; if ($this->input->get('editor')!=NULL) $editor =  $this->input->get('editor');

?>
<div class="container">
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<div class="row">
	<div class="col-lg-4">
		<h3>Search</h3>
		<form action="" method="get">

                                     <div class="control-group">
                                        <label class="control-label">Media Type<font color="#FF0000">*</font>  :</label>
									<select multiple class="form-control" id="multimedia" name="formattypes[]" style="min-height:110px;">
									<option value="360 Video" <?php if(strpos($types,"360 Video")!==false) echo 'selected="selected"'; ?>>360 Video</option>
									<option value="Animated image" <?php if(strpos($types,"Animated image")!==false) echo 'selected="selected"'; ?>>Animated image(s)</option>
									<option value="Infographic" <?php if(strpos($types,"Infographic")!==false) echo 'selected="selected"'; ?>>Infographic</option>
									<option value="Interactive" <?php if(strpos($types,"Interactive")!==false) echo 'selected="selected"'; ?>>Interactive</option>
									<option value="Multimedia" <?php if(strpos($types,"Multimedia")!==false) echo 'selected="selected"'; ?>>Multimedia</option>
									<option value="Sound" <?php if(strpos($types,"Sound")!==false) echo 'selected="selected"'; ?>>Sound</option>
									<option value="Still image" <?php if(strpos($types,"Still image")!==false) echo 'selected="selected"'; ?>>Still image(s)</option> 
									<option value="Video" <?php if(strpos($types,"Video")!==false && strpos($types,"360 Video")==false) echo 'selected="selected"'; ?>>Video</option>
									<option value="Writing" <?php if(strpos($types,"Writing")!==false) echo 'selected="selected"'; ?>>Writing</option>
								</select>
								</div>
															
			   <div class="form-group"> <label>Editor :</label>
						<input  name="editor" placeholder="Enter editor username"  value="<?php echo $editor;?>" class="form-control input-sm"/>
						<?php echo ((form_error('editor')!=NULL)) ? '<span class="text-error">'.form_error('editor').'</span>' : '' ?>   
				 </div>

					      <div class="form-group">
						<label>Location :</label>
							<?php $this->load->view('sub_parts/forms/location.php'); ?>
						</div>
				  <div class="form-group">
						<label>Date (YYYYMMDD) :</label>
							<?php $this->load->view('sub_parts/forms/datepicker.php',array('date'=>$date)); ?>
					</div>
			<input type="submit" id="submit" class="btn btn-danger" name="Search" value="Search"  />

		</form>

 	<h4>Search Results:</h4>
	<div id="result_details">
	<?php echo count($story_data). ' stories found ';
	
	if (isset($search_term)) echo $search_term;
	?>
	
		<a href="<?php echo BASE_URL?>search"><span class="glyphicon glyphicon-remove-circle"></span></a>
	</div>

	 </div>
		<div class="col-lg-8 bg-light pad-bottom pad-top">

<div class="row">
<?php 

if (empty($story_data)) echo '<h4>No results found</h4>';
foreach ($story_data as $story) {

	?>

        <div class="item  col-lg-6">
            <div  role="button" class="thumbnail" data-href="<?php echo BASE_URL; ?>story/<?php echo $story->alias?>">
                        <div class="v-tags">
                            Tags: 
                            <?php
                            
                            $tags = explode(',',$story->tags);
                            foreach($tags as $tag) {
                            	$tag = trim($tag);
                            	echo '<a onclick="event.stopPropagation();" href="'.BASE_URL.'home/'.$tag.'">'.$tag.'</a> ';	
                            }
                            
 ?>
                        </div>
 
                <img class="group list-group-image" src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $story->image; ?>" alt="<?php echo $story->title?>" />
                    <div class="v-heading"><h3><?php echo $story->title?></h3></div>

				<div class="v-caption">

 						<p class="group inner list-group-item-text">
                        <?php echo $story->content_desc?></p>
                      
                </div>
            </div>
            </a>
        </div>

  

	<?php } ?>	
	</div>




		</div>
	</div> 

</div>
<script>

$(document).ready(function() {
    $('#multimedia').multiselect();
});


$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#stories .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#stories .item').removeClass('list-group-item');$('#stories .item').addClass('grid-group-item');});

    $(".thumbnail").click(function() {
    	 window.location = $(this).attr("data-href");
    	 return false;
    });
        

});
</script>