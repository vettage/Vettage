<?php   
$alias 			= $blog_temp_data->alias; if($this->input->post('alias')!=NULL) $alias = $this->input->post('alias');
$tags 			= $blog_temp_data->tags; if($this->input->post('tags')!=NULL) $tags = $this->input->post('tags');
$blog_title 	= $blog_temp_data->blog_title; if($this->input->post('blog_title')!=NULL) $blog_title = $this->input->post('blog_title');
$blog_desc 		= $blog_temp_data->blog_desc; if($this->input->post('blog_desc')!=NULL) $blog_desc = $this->input->post('blog_desc');
$short_desc 	= $blog_temp_data->short_desc; if($this->input->post('short_desc')!=NULL) $short_desc = $this->input->post('short_desc');
$category_id 	= $blog_temp_data->category_id; if($this->input->post('category_id')!=NULL) $category_id = $this->input->post('category_id');
?>

<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/configuration_left_view'); ?></div>
		<div class="span19">
			<h2><?php echo $title?></h2>
			<div id="admin_index_statistics">
				<div class="row">
					<div class="span19">
						<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
							<div class="row-fluid">
									
									<div class="control-group">
										<label class="control-label">Alias:</label>
										<div class="controls"><input type="text" name="alias" id="alias" class="input-xlarge" disabled="disabled" value="<?php echo $alias ?>">
										</div>
									</div>
								
									<div class="control-group <?php echo ((form_error('blog_title')!=NULL)) ? 'error' : '' ?>">
										<label class="control-label">Title <font color="#3A87AD">*</font> :</label>
										<div class="controls"><input type="text" name="blog_title" id="blog_title" class="input-xlarge" value="<?php echo $blog_title ?>">
										<?php echo ((form_error('blog_title')!=NULL)) ? '<br /><span class="help-inline">'.form_error('blog_title').'</span>' : '' ?>
										</div>
									</div>
                                    <div class="control-group <?php echo ((form_error('tags')!=NULL)) ? 'error' : '' ?>">
										<label class="control-label">Tags <font color="#3A87AD">*</font> :</label>
										<div class="controls"><input type="text" name="tags" id="tags" class="input-xlarge" value="<?php echo $tags ?>">
										<?php echo ((form_error('tags')!=NULL)) ? '<br /><span class="help-inline">'.form_error('tags').'</span>' : '' ?>
										</div>
									</div>
									
									<div class="control-group <?php echo ((form_error('short_desc')!=NULL)) ? 'error' : '' ?>">
										<label class="control-label">Short Description : <font color="#3A87AD">*</font> :</label>
										<div class="controls">
											<textarea name="short_desc" id="short_desc" style="height:100px;width:420px"><?php echo $short_desc ?></textarea>
											<?php echo ((form_error('short_desc')!=NULL)) ? '<br /><span class="help-inline">'.form_error('short_desc').'</span>' : '' ?>
										</div>
									</div>
                                     <div class="control-group <?php echo ((form_error('blog_desc')!=NULL)) ? 'error' : '' ?>">
										<label class="control-label">Description <font color="#3A87AD">*</font> :</label>
										<div class="controls">
										<?php 	
											include FCKROOT; 
											$fck 			 = new FCKeditor('blog_desc') ;
											$fck->Height 	 = '300';
											$fck->Width 	 = '600';
											$fck->ToolbarSet = "Default";
											$fck->BasePath   = FCKBASEPATH; 
											$fck->Value      = $blog_desc;
											$fck->Create();
										?>
										<?php echo ((form_error('blog_desc')!=NULL)) ? '<br /><span class="help-inline">'.form_error('blog_desc').'</span>' : '' ?>
										</div>
									</div>
                                    <div class="control-group <?php echo ((form_error('category_id')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Category :<font color="#3A87AD">*</font>  :</label>
                            <div class="controls">
							<select name="category_id" id="category_id">
                                <option value="">Please choose an option</option>
								<?php foreach($category  as $category_rec){?>
								<option value="<?php echo $category_rec->category_id;?>"<? if($category_rec->category_id==$category_id) echo 'selected="selected"';?>><?php echo $category_rec->category_title;?></option>                              
								<?php 	
								}
							   ?>
                               </select>
							<?php echo ((form_error('category_id')!=NULL)) ? '<br /><span class="help-inline">'.form_error('category_id').'</span>' : '' ?>
							</div>
                        </div>
                                               
                                         <div class="control-group">
                                      <label class="control-label">Image<font color="#3A87AD">*</font>  :</label>
                                      <div class="controls">
									  	<input name="userfile" id="photoInput" type="file" class="input-xlarge"> 
										<input type="button" class="btn btn-default" value="Clear Image" onclick="clearimageinput();"  /><br/>
										<strong>(Image dimension must be minimum 360 x 166  in pixel)</strong><br/>
							         </div>
                                      </div>
						 
						            <div class="control-group">
                                 <label class="control-label"></label>
                                    <div class="controls"><?php if(empty($blog_temp_data->image)) echo '<img src="'.BASE_ASSETS. 'images/images6.png" class="thumb account-img" height="32" width="32">'; 
						         else if(!empty($blog_temp_data->image)){ 
						            $arg = explode('.',$blog_temp_data->image); $size=50; 
						            echo '<img  src="'.BASE_ASSETS.'uploads/blogs/'.$arg[0].'_'.$size.'.'.$arg[1].'">'; 
								}
						     ?>
							</div>
                        </div>
									
									<div class="control-group">
										<div class="controls">
											<font color="#3A87AD">*</font> Marked Fields are Mandatory
										</div>
									</div>
									
									
									<div class="form-actions text-right">
										<input type="submit" class="btn btn-info" value="Edit blog template"  /> 
										<button type="button" class="btn" onClick="javascript: document.location = '<?php echo BASE_URL.'admin/blog_template';?>';">Cancel</button>
									</div>
								
							</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>

<script>
function chkImage()
{ 	
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
		if(photoInputWidth < 360 || photoInputHeight < 166 )
		{
			alert("Image dimension must be  minimum 360 x 166   ");
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
</script>