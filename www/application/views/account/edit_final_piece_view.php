<?php
$types  	     = $content_details->types;if(!empty($_POST['types'])) $types  = $_POST['types'];

if($this->input->post('content_desc')!=NULL) $content_desc = $this->input->post('content_desc'); 


$embed_code_link = $content_details->embed_code_link; if($this->input->post('embed_code_link')!=NULL) $embed_code_link = $this->input->post( 'embed_code_link'); 
$tags 		     = $content_details->tags;if($this->input->post('tags')!=NULL) $tags = $this->input->post('tags'); 
$copyright       = 1;if(!empty($_POST['copyright']))   $copyright = $_POST['copyright'];
$date  		     = date('Ymd',strtotime($content_details->story_date)); if(!empty($_POST['date'])) $date = $_POST['date'];
$title           = $content_details->title;if(!empty($_POST['title'])) $title = $_POST['title'];
//$image 		 = ''; if($this->input->post('image')!=NULL)  $image = $this->input->post('image');				
?>
<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
<div class="container">
	<div class="row">
		<div class="col-lg-5">
			<h3 class="less-mar-bottom">EDIT FINAL PIECE</h3>
		</div>
        <div class="col-lg-7 bg-light pad-bottom pad-top">
        	<form action="" method="post" id="frmrawmedia" onsubmit="javascript:return chkErrors();" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-8">
									<label>Media Type</label>
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
                                    </option>
								</select>
									<p><small class="text-muted">Hold down 'ctrl' key to select multiple types</small></p>
                                 <?php echo ((form_error('types')!=NULL)) ? '<span class="text-error">'.form_error('types').'</span>' : '' ?> 								</div>
							</div>
                            <div class="form-group"> 
								<label>Title :</label>
							    <input type="text" name="title" value="<?php  echo $title;?>" class="form-control input-sm">
					            <?php echo ((form_error('title')!=NULL)) ? '<span class="text-error">'.form_error('title').'</span>' : '' ?>
 							</div>
                            <div class="form-group">
								<label>Date (YYYYMMDD) :</label>
								<input type="text" name="date" value="<?php  echo $date;?>" class="form-control input-sm"  />
								<?php echo ((form_error('date')!=NULL)) ? '<span class="text-error">'.form_error('date').'</span>' : '' ?>  
							</div>
                            <div class="clearfix pad-top pad-bottom">
 							<label>Embed/Link :</label>
							 <textarea class="form-control" placeholder="Embed/Link" rows="3" name="embed_code_link"><?php echo $embed_code_link ?></textarea>
                              <?php echo ((form_error('embed_code_link')!=NULL)) ? '<span class="text-error">'.form_error('embed_code_link').'</span>' : '' ?>
                            </div>
                            <div class="form-group"> 
								<label>Tags (Separate by commas) :</label>
							    <input type="text" name="tags" value="<?php  echo $tags;?>" class="form-control input-sm">
					            <?php echo ((form_error('tags')!=NULL)) ? '<span class="text-error">'.form_error('tags').'</span>' : '' ?>
 							</div><br />
							<?php /*?>
							<div class="control-group <?php echo ((form_error('content_desc')!=NULL)) ? 'error' : '' ?>">
								<label class="control-label">Description <font color="#3A87AD">*</font> :</label>
								<div class="controls">
									<?php 	
									include_once CKEDITOR;
									include_once CKFINDER;
									$ckeditor = new CKEditor();
									$ckeditor->basePath = BASE_ASSETS.'ckeditor/';
									$ckfinder = new CKFinder();
									$ckfinder->BasePath = BASE_ASSETS.'ckfinder/'; 
									$ckfinder->SetupCKEditorObject($ckeditor);
									$ckeditor->editor('content_desc',$content_desc);
									?>
									<?php echo ((form_error('content_desc')!=NULL)) ? '<br /><span class="help-inline">'.form_error('content_desc').'</span>' : '' ?>
								</div>
							</div>
							<?php */?>
						</div>
					</div>
					
                  	<div class="col-lg-6">
						<div class="form-group">
							    <label>Location :</label>
							    <select class="form-control input-sm" name="country"  id="country"  onchange="javascript:getstates();">
							    <option value=""  selected="selected">Select Country</option>
							    <?php foreach($countries as $row):?>
								<option value="<?php echo $row->name;?>" <? if($row->name==$country) echo 'selected="selected"';?>><?php echo $row->name;?></option>
							    <?php endforeach;?>
						        </select>
                                <?php echo ((form_error('country')!=NULL)) ? '<span class="text-error">'.form_error('country').'</span>' : '' ?> 
						</div>
                        
						    <div class="form-group">
							<div class="row">
                            <div class="col-lg-6">
                          <select class="form-control input-sm" name="state" id="state"  onchange="javascript:getcities();">
s                           </select>
                             <?php echo ((form_error('state')!=NULL)) ? '<span class="text-error">'.form_error('state').'</span>' : '' ?> 
                             </div>
                             
                            <div class="col-lg-6">
                            <select class="form-control input-sm" name="city" id="city">
 						        </select>
                            <?php echo ((form_error('city')!=NULL)) ? '<span class="text-error">'.form_error('city').'</span>' : '' ?>   
                               </div>
							</div>
						</div>
						<div class="form-group">
                        <input type="text" name="postal_code" value="<?php  echo $postal_code;?>" class="form-control input-sm" 
                        placeholder="Or Postal Code" />
                        <?php echo ((form_error('postal_code')!=NULL)) ? '<span class="text-error">'.form_error('postal_code').'</span>' : ''                         ?>   
                        </div>
				        <div class="control-group">
						   <label class="control-label">Image :</label>
							<div class="controls">
								<?php if($content_details->image!=''){?>
									<span id="img<?php echo $content_details->content_id?>">
										<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $content_details->image; ?>" width="100" height="75">
									</span>
								<?php } ?>
								<input name="userfile" id="photoInput" type="file" class="input-xlarge">
                                <strong>(Image dimension must be 1679 x 502 in pixel)</strong><br/>
                                <?php echo ((form_error('image')!=NULL)) ? '<span class="text-error">'.form_error('image').'</span>' : '' ?>
                                <input type="button" class="btn btn-default" value="Clear Image" onclick="clearimageinput();"  />
						   </div>
						  </div> 
                          <div class="form-group">
						   <label class="control-label">Home Page Image<font color="#FF0000">*</font>  :</label>
							<div class="controls">
								<?php if($content_details->home_image!=''){?>
									<span id="imgphoto<?php echo $content_details->content_id?>">
										<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $content_details->home_image; ?>" width="100" height="75">
									</span>
								<?php } ?>
								<input name="home_image" id="photo" type="file" class="input-xlarge">
                                <strong>(Image dimension must be 689 x 459  in pixel)</strong>  
								<input type="button" class="btn btn-default" value="Clear Image" onclick="clearphotoimageinput();"  />
 						   </div>
						  </div>
                      </div>
					  
					<div class="col-lg-12">
						<div class="control-group <?php echo ((form_error('content_desc')!=NULL)) ? 'error' : '' ?>">
							<label class="control-label">Description <font color="#3A87AD">*</font> :</label>
							<div class="controls"  for="content_desc">
								<textarea cols="150" id="content_desc" name="content_desc" rows="10"><?php echo $content_desc?></textarea>
								<script>
								CKEDITOR.replace( 'content_desc', {
								fullPage: true,
								allowedContent: true
								});
								</script>
								<?php /*?><?php 	
								include FCKROOT; 
								$fck 			 = new FCKeditor('content_desc') ;
								$fck->Height 	 = '300';
								$fck->Width 	 = '600';
								$fck->ToolbarSet = "Default";
								$fck->BasePath   = FCKBASEPATH; 
								$fck->Value      = $content_desc;
								$fck->Create();
								?><?php */?>
								<?php echo ((form_error('content_desc')!=NULL)) ? '<br /><span class="help-inline">'.form_error('content_desc').'</span>' : '' ?>
							</div>
						</div>
						<div class="control-group">
							<label class="checkbox">Copyright Agreement Read & Agreed<input name="copyright" id="copyright" 
							type="checkbox" value="1" <?php if($copyright==1) echo 'checked="checked"'; ?> ></label> &nbsp;
							<?php echo ((form_error('copyright')!=NULL)) ? '<span class="text-error">'.form_error('copyright').'</span>' : '' ?>  
						</div>
					</div>
					  
				</div> 
				<hr>
				<div class="text-center"><input type="submit" class="btn btn-danger" value="Update"/></div>
				<input type="hidden" id="photoInputWidth" value="" />
				<input type="hidden" id="photoInputHeight" value="" />
				<input type="hidden" id="photoWidth" value="" />
				<input type="hidden" id="photoHeight" value="" />
				<input type="hidden" id="fileuploaded" value="" />
			</form>
         </div>
		<p>Allocations<br />As editor,to ensure success of future projects,it is your responsibility to divide earnings fairly with your <br />raw content contributors.
		You can automatically set allotements from earnings to your team members 
		<a href="<?php echo BASE_URL?>editor/raw_media_pull/edit_allotment?content_key=<?php echo $content_details->content_key?>">here</a></p>
	</div>
</div>   
<!--<script>
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
	return true;
}
</script>		-->
<script>
function chkErrors()
{
	if(document.getElementById('fileuploaded').value==1) 
		return true;
		
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
	
	var content_desc = CKEDITOR.instances.content_desc.getData();
	var content_id = '<?php echo $content_details->content_id?>';
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>putcontenttexts.php",
		data: "content_id="+content_id+"&content_desc="+escape(content_desc),
		cache: false,
		async: true,
		success: function(result)
		{
			document.getElementById('fileuploaded').value = 1;
			$('#frmrawmedia').submit();
		},
		error: function(request, textStatus, errorThrown)
		{
			//alert('error');
			document.getElementById('fileuploaded').value = 1;
			$('#frmrawmedia').submit();
		}
	});
	
	if(document.getElementById('photo').value==1) 
		return true;
	else
		return false;
	//sleep(10000);
	

	//alert($(".cke_editable").html());
	//document.getElementById('editor').value = document.getElementById('content_desc').value;
}


function sleep(miliseconds) {
	var currentTime = new Date().getTime();
	while (currentTime + miliseconds >= new Date().getTime()) {
	}
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
function clearimageinput()
{  
	var content_id = '<?php echo $content_details->content_id?>';
	if(document.getElementById('img'+content_id) && document.getElementById('img'+content_id).innerHTML!='')
	{
		var featured = '<?php echo $content_details->featured?>';
		$imagetype = ''; if(featured==1) $imagetype = "FEATURED";
		if (confirm("Are you sure you want to remove this "+$imagetype+" image."))
		{
			$.ajax({
				type: "POST",
				url: "<?php echo BASE_URL;?>editor/raw_media_pull/clearimageinput",
				data: "content_id="+content_id,
				cache: false,
				async: true,
				success: function(result)
				{
					clearconsole();
					document.getElementById('img'+content_id).innerHTML='';
					$("#photoInput").val('');
					$("#photoInputWidth").val('');
					$("#photoInputHeight").val('');
				},
				error: function(request, textStatus, errorThrown)
				{
					//alert('error');
				}
			});
		}
	}
	else
	{
		$("#photoInput").val('');
		$("#photoInputWidth").val('');
		$("#photoInputHeight").val('');
	}
}

function clearconsole() { 
  console.log(window.console);
  if(window.console || window.console.firebug) {
   console.clear();
  }
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
	
	var content_desc = CKEDITOR.instances.content_desc.getData();
	var content_id = '<?php echo $content_details->content_id?>';
	if(content_desc!='' && content_desc!='<html> <head> <title></title> </head> <body>&nbsp;</body> </html>')
	{
		$.ajax({
			type: "POST",
			url: "<?php echo BASE_URL;?>putcontenttexts.php",
			data: "content_id="+content_id+"&content_desc="+escape(content_desc),
			cache: false,
			async: true,
			success: function(result)
			{
				//clearconsole();
			},
			error: function(request, textStatus, errorThrown)
			{
				alert('error');
			}
		});
	}
	
	return false;
}

function clearphotoimageinput()
{
	var content_id = '<?php echo $content_details->content_id?>';
	if(document.getElementById('imgphoto'+content_id) && document.getElementById('imgphoto'+content_id).innerHTML!='')
	{
		if (confirm("Are you sure you want to remove this image."))
		{
			$.ajax({
				type: "POST",
				url: "<?php echo BASE_URL;?>editor/raw_media_pull/clearphotoimageinput",
				data: "content_id="+content_id,
				cache: false,
				async: true,
				success: function(result)
				{
					clearconsole();
					document.getElementById('imgphoto'+content_id).innerHTML='';
					$("#photo").val('');
					$("#photoWidth").val('');
					$("#photoHeight").val('');
				},
				error: function(request, textStatus, errorThrown)
				{
					//alert('error');
				}
			});
		}
	}
	else
	{
		$("#photo").val('');
		$("#photoWidth").val('');
		$("#photoHeight").val('');
	}
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
	getcities();//include
});

getcities('<?php echo $state?>');

</script>