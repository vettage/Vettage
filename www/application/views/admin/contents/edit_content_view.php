<?php 	
die('badlink');
$title           = $content_details->title;if(!empty($_POST['title'])) $title = $_POST['title'];
$embed_code_link = $content_details->embed_code_link; if($this->input->post('embed_code_link')!=NULL) $embed_code_link = $this->input->post( 'embed_code_link'); 
$content_desc 	 = $content_details->content_desc;if($this->input->post('content_desc')!=NULL)$content_desc = $this->input->post('content_desc'); 
$date  	= date("Ymd",strtotime($content_details->story_date)); if(!empty($_POST['date'])) 
$date = $_POST['date'];
$types  	     = $content_details->types;if(!empty($_POST['types'])) $types  = $_POST['types'];
$city 		     = $content_details->city;if($this->input->post('city')!=NULL)   $city = $this->input->post('city'); 
$state 		     = $content_details->state;if($this->input->post('state')!=NULL)  $state = $this->input->post('state'); 
$country 	     = $content_details->country;if($this->input->post('country')!=NULL) $country = $this->input->post('country'); 
$postal_code 	 = $content_details->postal_code;if($this->input->post('postal_code')!=NULL) $postal_code= $this->input->post('postal_code'); 
$tags 		     = $content_details->tags;if($this->input->post('tags')!=NULL) $tags = $this->input->post('tags'); 
$copyright       = 1;if(!empty($_POST['copyright']))   $copyright = $_POST['copyright'];
?>  
<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/contents_left_view'); ?></div>
		<div class="span19">
			<h3>Edit Content: <?php echo $title?></h3>
			<div id="admin_index_statistics">
				<div class="row">
					<div class="span19">
                    <div class="row-fluid">
                   <form action="" method="post" id="frmrawmedia"  onsubmit="javascript:return chkErrors();return chkPhotoErrors();"  enctype="multipart/form-data">
 		                <div class="span12">
                       	<fieldset>
                       <div class="form-group"> 
								<div class="form-group">
 								<div class="col-lg-8 <?php echo ((form_error('types')!=NULL)) ? 'error' : '' ?>">
									<label>Media Type</label>
									<select multiple class="form-control" name="formattypes[]" style="min-height:110px;">
									<option value="Animation" <?php if(strpos($types,",Animation,")!==false) echo 'selected="selected"'; ?>>                                     Animation</option>
									<option value="Audio" <?php if(strpos($types,",Audio,")!==false) echo 'selected="selected"'; ?>>Audio                                     </option>
									<option value="Graphic" <?php if(strpos($types,",Graphic,")!==false) echo 'selected="selected"'; ?>>                                      Graphic</option>
									<option value="Photo" <?php if(strpos($types,",Photo,")!==false) echo 'selected="selected"'; ?>>Photo
                                    </option>
									<option value="Text" <?php if(strpos($types,",Text,")!==false) echo 'selected="selected"'; ?>>Text
                                    </option> 
									<option value="Video" <?php if(strpos($types,",Video,")!==false) echo 'selected="selected"'; ?>>Video
                                    </option>
								</select>
									<p><small class="text-muted">Hold down 'ctrl' key to select multiple types</small></p>
                                 <?php echo ((form_error('types')!=NULL)) ? '<span class="help-inline">'.form_error('types').'</span>' : '' ?> 					
                             </div>
                             
                             <div class="form-group  <?php echo ((form_error('title')!=NULL)) ? 'error' : '' ?>"> 
								<label>Title :</label>
							    <input type="text" placeholder="Title" name="title" value="<?php  echo $title;?>" class="form-control input-sm">
					            <?php echo ((form_error('title')!=NULL)) ? '<span class="help-inline">'.form_error('title').'</span>' : '' ?>
 							</div>
                            
                              <div class="form-group">
						   <label class="control-label">Image<font color="#FF0000">*</font>  :</label>
							<div class="controls">
								<?php if($content_details->image!=''){?>
									<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $content_details->image; ?>" width="100" height="75">
								<?php } ?><br />
								<input name="userfile" id="photoInput" type="file" class="input-xlarge"><br />
                                <br /><strong>(Image dimension must be 1679 x 502 in pixel)</strong><br /> <br />
								<input type="button" class="btn btn-default" value="Clear Image" onclick="clearimageinput();"  />
 						   </div>
						  </div><br />
                          <div class="form-group">
						   <label class="control-label">Home Page Image<font color="#FF0000">*</font>  :</label>
							<div class="controls">
								<?php if($content_details->home_image!=''){?>
									<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $content_details->home_image; ?>" width="100" height="75">
								<?php } ?><br />
								<input name="home_image" id="photo" type="file" class="input-xlarge">
                                <br /><br /><strong>(Image dimension must be 689 x 459  in pixel)</strong> <br /><br />
								<input type="button" class="btn btn-default" value="Clear Image" onclick="clearphotoimageinput();"  />
 						   </div>
						  </div><br />
                          
                                    <div class="control-group <?php echo ((form_error('content_desc')!=NULL)) ? 'error' : '' ?>">
										<label class="control-label">Description <font color="#FF0000">*</font> :</label>
										<div class="controls" sty>
 										<?php 	 
											include FCKROOT; 
											$fck 			 = new FCKeditor('content_desc') ;
											$fck->Height 	 = '300';
											$fck->Width 	 = '600';
											$fck->ToolbarSet = "Default";
											$fck->BasePath   = FCKBASEPATH; 
											$fck->Value      = $description;
											$fck->Create();
										?>
										<?php echo ((form_error('content_desc')!=NULL)) ? '<span class="help-inline">'.form_error('content_desc').'</span>' : '' ?>
										</div>
									</div>
  						</div>
							<div class="text-center">
						 		<input type="submit" class="btn btn-danger" name="action" value="Update"/>
							</div>
                       </div>
                       </fieldset>
                        </div>
						 <div class="span12">
                       	<fieldset>
                       <div class="control-group <?php echo ((form_error('country')!=NULL)) ?  'error' : ''?>" id="user_country-control-group">
							<label for="user_country" class="control-label ">Country:<font color="#FF0000">*</font></label>        
							<div class="controls" id="user_country_controls">
								<select name="country" id="country" style="width:285px;" onchange="javascript:getstates();">
								<option value="" selected="selected" >Select country</option>
								<?php foreach($countries as $row):?>
									<option value="<?php echo $row->name;?>" <? if($row->name==$country) echo 'selected="selected"';?>><?php echo $row->name;?></option>
								<?php endforeach;?>
								</select>
								<?php echo ((form_error('country')!=NULL)) ? '<span class="help-inline">'.form_error('country').'</span>' : '' ?>
							</div>
					   </div>
                       
                           <div class="control-group  <?php echo ((form_error('state')!=NULL)) ?  'error' : ''?>" id="user_state-control-group">
							<label for="user_state" class="control-label ">State:</label>        
							<div class="controls" id="user_state_controls">
								<select class="form-control input-sm" name="state" id="state" style="width:285px;" onchange="javascript:getcities();">
                                    <?php /*?> <option value="" selected="selected">Select State</option>
                                     <?php foreach($state as $row):?>
                                     <option value="<?php echo $row->name;?>" <? if($row->name) echo 'selected="selected"';?>><?php echo $row->name;?></option>
                                     <?php endforeach;?><?php */?>
						        </select>
								<?php echo ((form_error('state')!=NULL)) ? '<br /><span class="help-inline">'.form_error('state').'</span>' : '' ?>
							</div>
                          </div>
                        <div class="form-group">
                           	<div class="control-group <?php echo ((form_error('city')!=NULL)) ?  'error' : ''?>" 
                            id="user_city-control-group">
							<label for="user_city" class="control-label ">City:</label>        
							<div class="controls" id="user_city_controls">
								<select class="form-control input-sm" style="width:285px;" name="city" id="city">
                                     <?php /*?><option value="" selected="selected">Select City</option>
                                     <?php foreach($city as $row):?>
                                     <option value="<?php echo $row->name;?>" <? if($row->name) echo 'selected="selected"';?>><?php echo $row->name;?></option>
                                     <?php endforeach;?><?php */?>
						        </select>
								<?php echo ((form_error('city')!=NULL)) ? '<br /><span class="help-inline">'.form_error('city').'</span>' : '' ?>
							</div>
						</div>
                        
  						</div>
						<div class="control-group <?php echo ((form_error('postal_code')!=NULL)) ?  'error' : ''?>">
                        <input type="text" name="postal_code" value="<?php  echo $postal_code;?>" class="form-control input-sm" 
                        placeholder="Or Postal Code" />
                        <?php echo ((form_error('postal_code')!=NULL)) ? '<span class="help-inline">'.form_error('postal_code').'</span>' : '' ?>   
                        </div>
                          
 						<div class="form-group">
							<label>Date (YYYYMMDD) :</label>
							<input type="text" name="date" value="<?php  echo $date;?>" class="form-control input-sm"  />
                            <?php echo ((form_error('date')!=NULL)) ? '<span class="text-error">'.form_error('date').'</span>' : '' ?>  
						</div>
                        <div class="form-group  <?php echo ((form_error('tags')!=NULL)) ?  'error' : ''?>"> 
								<label>Tags (Separate by commas) :</label>
							    <input type="text" name="tags" placeholder="Tags (Separate by commas)" value="<?php  echo $tags;?>" class="form-control input-sm">
					            <?php echo ((form_error('tags')!=NULL)) ? '<span class="text-error">'.form_error('tags').'</span>' : '' ?>
 							</div>
                           <div class="control-group  <?php echo ((form_error('embed_code_link')!=NULL)) ?  'error' : ''?>">
 							<label>Embed/Link :</label>
							 <textarea class="form-control" placeholder="Embed/Link " rows="3" name="embed_code_link"><?php echo $embed_code_link ?></textarea>
                              <?php echo ((form_error('embed_code_link')!=NULL)) ? '<span class="help-inline">'.form_error('embed_code_link').'</span>' : '' ?>
                            </div>
                            
                        <div>&nbsp;</div>
                        <div class="form-group  <?php echo ((form_error('copyright')!=NULL)) ?  'error' : ''?>">
 								<label class="checkbox">Copyright Agreement Read & Agreed<input name="copyright" id="copyright" 
                                 type="checkbox" value="1" <?php if($copyright==1) echo 'checked="checked"'; ?> ></label> &nbsp;
                             <?php echo ((form_error('copyright')!=NULL)) ? '<span class="text-error">'.form_error('copyright').'</span>' : '' ?> 			  			</div>
							 
                        </fieldset>
 					</div>
                   	
						 <input type="hidden" id="photoInputWidth" value="" />
						 <input type="hidden" id="photoInputHeight" value="" />
						 <input type="hidden" id="photoWidth" value="" />
						 <input type="hidden" id="photoHeight" value="" />
                     </form>
				</div>
			</div>
		</div>
	</div>
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
			alert("Image dimension must be 1679 x 502  ");
			return false;
		}
	}
	return true;
}

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
			alert("Image dimension must be 689 x 459  ");
			return false;
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

function getstates()
{
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>admin/members/getstates",
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
		url: "<?php echo BASE_URL;?>admin/members/getcities",
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
	getcities();//include
});

getcities('<?php echo $state?>');

</script>
<!--$config['width'] = 689;
$config['height'] =459;	-->	

