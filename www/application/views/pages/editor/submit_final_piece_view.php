         <link href="<?php echo BASE_ASSETS; ?>bootstrap-multiselect/dist/css/bootstrap-multiselect.css" rel="stylesheet">
         <link href="<?php echo BASE_ASSETS; ?>croppic/assets/css/croppic.css" rel="stylesheet">
  
	<script src="<?php echo BASE_ASSETS;?>croppic/croppic.js"></script>
	<script src="<?php echo BASE_ASSETS;?>croppic/assets/js/jquery.mousewheel.min.js"></script>
	<script src="<?php echo BASE_ASSETS;?>bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>

<?php

$types  	     = !empty($content_details) ? $content_details->types :'';if(!empty($_POST['types'])) $types = $_POST['types'];
$city 		     = !empty($city) ? $content_details->city :'';if($this->input->post('city')!=NULL)   $city = $this->input->post('city'); 
$state 		     = !empty($state) ? $content_details->state :'';if($this->input->post('state')!=NULL)  $state = $this->input->post('state'); 
$country 	     = !empty($country) ? $content_details->country :'';if($this->input->post('country')!=NULL) $country = $this->input->post('country'); 
$postal_code 	 = !empty($postal_code) ? $content_details->postal_code :'';if($this->input->post('postal_code')!=NULL) 
                   $postal_code= $this->input->post('postal_code'); 
$embed_code_link =  !empty($content_details) ? $content_details->embed_code_link :'';if($this->input->post('embed_code_link')!=NULL) 
                    $embed_code_link = $this->input->post( 'embed_code_link'); 
$tags 		     =  !empty($content_details) ? $content_details->tags :'';if(!empty($_POST['tags'])) $tags = $_POST['tags']; 
$content_desc    =  !empty($content_details) ? $content_details->content_desc :'';if($this->input->post('content_desc')!=NULL) $content_desc = $this->input->post('content_desc'); 
 $copyright       = '';if(!empty($_POST['copyright']))   $copyright = $_POST['copyright'];
$date  		     = !empty($content_details) ? date('Ymd',strtotime($content_details->story_date)) :''; if(!empty($_POST['date'])) $date = $_POST['date'];
$title           = !empty($content_details) ? $content_details->title :'';if(!empty($_POST['title'])) $title = $_POST['title'];
$image 		     =!empty($content_details) ? $content_details->image :'';if(!empty($_POST['userfile'])) $image = $_POST['userfile'];			


// HACK
if (!empty($image) && !strstr($image,'media/uploads')) {
	$image = BASE_ASSETS.'uploads/stories/'.$image;
}

?>

<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>

<div class="container">
	<div class="row">
			<div class="col-lg-5">
			<h3 class="less-mar-bottom">SUBMIT FINAL PIECE</h3>
			</div>

	</div>
	<div class="row">
         <div class="col-lg-12 bg-light pad-bottom pad-top">
        	<form action="" method="post" id="frmrawmedia" onsubmit="javascript:return chkErrors();" enctype="multipart/form-data">
				<div class="row">

							<div class="col-lg-5">
                             <div class="form-group"> 
								<label>Title :</label>
							    <input type="text" placeholder="Title" name="title" value="<?php  echo $title;?>" class="form-control input-sm">
					            <?php echo ((form_error('title')!=NULL)) ? '<span class="text-error">'.form_error('title').'</span>' : '' ?>
 							</div>

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
									<option value="Video" <?php if(strpos($types,"Video")!==false) echo 'selected="selected"'; ?>>Video</option>
									<option value="Writing" <?php if(strpos($types,"Writing")!==false) echo 'selected="selected"'; ?>>Writing</option>
								</select>
															
                                 <?php echo ((form_error('types')!=NULL)) ? '<span class="text-error">'.form_error('types').'</span>' : '' ?> 			
                                </div>	 

						<div class="form-group">
							<label>Date :</label>
							<?php $this->load->view('sub_parts/forms/datepicker.php',array('date'=>$date)); ?>
						</div>
                                
 						<div class="form-group">
						    <label>Location:</label>
							 <?php 
							 
							 if (!empty($content_details)) $this->load->view('sub_parts/forms/location.php',array('content_details'=>$content_details));
							 	else $this->load->view('sub_parts/forms/location.php'); 
							 		?>
						</div>
				
                        <div class="form-group">
 							<label>Embed/Link :</label>
							 <textarea class="form-control" placeholder="Embed/Link " rows="3" name="embed_code_link"><?php echo $embed_code_link ?></textarea>
                              <?php echo ((form_error('embed_code_link')!=NULL)) ? '<span class="text-error">'.form_error('embed_code_link').'</span>' : '' ?>
                            </div>
                            <div class="form-group"> 
								<label>Tags (Separate by commas) :</label>
							    <input type="text" placeholder="Tags" name="tags" value="<?php  echo $tags;?>" class="form-control input-sm">
					            <?php echo ((form_error('tags')!=NULL)) ? '<span class="text-error">'.form_error('tags').'</span>' : '' ?>
 							</div>
 						<?php /*?> <div class="form-group">
						<label>Radius :</label>
						<select class="form-control input-sm">
						<option>25 miles/40.23 km</option>
						<option>25 miles/40.23 km</option>
						</select>
						</div><?php */?> 
						
					                                     <div class="control-group <?php echo ((form_error('content_desc')!=NULL)) ? 'error' : '' ?>">
								<label class="control-label">Description <font color="#3A87AD">*</font> :</label>
								<div class="controls">
								<textarea rows="4" cols="50" id="content_desc" name="content_desc"><?php echo $content_desc?></textarea>
								<?php echo ((form_error('content_desc')!=NULL)) ? '<br /><span class="help-inline">'.form_error('content_desc').'</span>' : '' ?>
								</div>
 							</div>
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
						
                                	<hr><br />
				<div class="text-center"><input type="submit" class="btn btn-danger" value="submit"/></div>
                <?php /*?><?php if($content_key==NULL){ ?>
				<div class="text-center"><input type="submit" class="btn btn-danger" value="submit"/></div>
                 <?php } else { ?>
				<div class="text-center"><input type="submit" class="btn btn-primary" value="Update"/></div>
				<?php } ?><?php */?>
 
 							</div>
 							<div class="col-lg-7">
 
                                 					                       
                                     <div class="control-group">
                                        <label class="control-label">Image<font color="#FF0000">*</font>  :</label>
                                        <div class="controls">
                                        	<div id="main_photo"></div>
											<input type="hidden" id="userfile" name="userfile" value="<?php echo $image?>">
                                        </div>
                                     </div>
                                     
 

 						</div>
					</div>

				</div> 
			
            </form>
            
         </div>
               
 	    </div>
</div>   


<script>
function chkErrors()
{
 	var Form = document.getElementById('frmrawmedia');  
	var copyright = '';
	if(Form.copyright.checked) copyright = 1;
	if(copyright=='')
	{
		alert("You must be verify that you are the joint copyright holder with your raw content contributors ");
		return false;
	}
	
	var fup = document.getElementById('photoInput');
	var fileName = fup.value;
	if(fileName!='')
	{
		var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		if(ext != "gif" && ext != "GIF" && ext != "JPEG" && ext != "jpeg" && ext != "jpg" && ext != "JPG" && ext != "png" && ext != "PNG")
		{
			alert("Please select valid image file");
			return false;
		}
		
		var photoInputWidth  = $("#photoInputWidth").val();
		var photoInputHeight = $("#photoInputHeight").val();
		if(photoInputWidth!=1679 || photoInputHeight!=502)
		{
	//		alert("Image dimension must be 1679 x 502  ");
	//		return false;
		}
	}
	
	return true;
}

$(document).ready(function(){
    $("#copy").click(function(){
        $("#myModal").toggle();
    });
});
function clearimageinput()
{
	$("#photoInput").val('');
	$("#photoInputWidth").val('');
	$("#photoInputHeight").val('')
}

$("#photoInput").change(function (e) {
    var F = this.files;
	file = F[0];
	
	var reader = new FileReader();
    var image  = new Image();
    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height;
				
				$("#photoInputWidth").val(w);
				$("#photoInputHeight").val(h)
        };
        image.onerror= function() {
            alert('Please select valid image file');
        };      
    };
});


function chkPhotoErrors()
{
 	var Form = document.getElementById('frmrawmedia');  
	var copyright = '';
	if(Form.copyright.checked) copyright = 1;
	if(copyright=='')
	{
		alert("You must be verify that you are the joint copyright holder with your raw content contributors ");
		return false;
	}
	var fup = document.getElementById('photo');
	var fileName = fup.value;
	if(fileName!='')
	{
		var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		if(ext != "gif" && ext != "GIF" && ext != "JPEG" && ext != "jpeg" && ext != "jpg" && ext != "JPG" && ext != "png" && ext != "PNG")
		{
			alert("Please select valid image file");
			return false;
		}
		
		var photoInputWidth  = $("#photoWidth").val();
		var photoInputHeight = $("#photoHeight").val();
		if(photoInputWidth<689 || photoInputHeight<459)
		{
	//		alert("Image dimension must be 689 x 459  ");
	//		return false;
		}
	}
	return true;
}

function clearphotoimageinput()
{
	$("#photo").val('');
	$("#photoWidth").val('');
	$("#photoHeight").val('')
}

$("#photo").change(function (e) {
    var F = this.files;
	file = F[0];
	
	var reader = new FileReader();
    var image  = new Image();
    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height;
				$("#photoWidth").val(w);
				$("#photoHeight").val(h)
        };
        image.onerror= function() {
            alert('Please select valid image file');
        };      
    };
});

var croppicContainerModalOptions = {
		<?php if (empty($image)) { ?>uploadUrl:'<?php echo BASE_URL;?>img_save_to_file.php', <?php } ?>
		cropUrl:'<?php echo BASE_URL;?>img_crop_to_file.php',
		outputUrlId:'userfile',
		<?php if (empty($image)) { ?>outputUrlId:'userfile',modal:true,<?php } ?>
		<?php if (!empty($image)) { ?>loadPicture:'<?php echo BASE_URL;?><?php echo $image;?>', <?php } ?>
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		}
var cropperHeader = new Croppic('main_photo', croppicContainerModalOptions);
$(document).ready(function() {
    $('#multimedia').multiselect();
});
</script>


