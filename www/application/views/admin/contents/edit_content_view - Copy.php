<?php 			
$title           = $content_details->title;if(!empty($_POST['title'])) $title = $_POST['title'];
$embed_code_link = $content_details->embed_code_link; if($this->input->post('embed_code_link')!=NULL) $embed_code_link = $this->input->post( 'embed_code_link'); 
$date  	= date("Ymd",strtotime($content_details->story_date)); if(!empty($_POST['date'])) 
$date = $_POST['date'];


?>  
<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/contents_left_view'); ?></div>
		<div class="span19">
			<h1>Edit Content: <?php echo $title?></h1>
			<div id="admin_index_statistics">
				<div class="row">
					<div class="span19">
		               
						<form action="" method="post" id="frmrawmedia" onsubmit="javascript:return chkErrors();" enctype="multipart/form-data">
						<div class="row-fluid">
						
							<div class="form-group">
								<div class="form-group"> 
								<label>Title :</label>
								<input type="text" name="title" value="<?php  echo $title;?>" class="form-control input-sm">
								<?php echo ((form_error('title')!=NULL)) ? '<span class="text-error">'.form_error('title').'</span>' : '' ?>
								</div>
								<div class="clearfix pad-top pad-bottom">
								<label>Download Link:</label>
								<textarea class="form-control" rows="3" name="embed_code_link"><?php echo $embed_code_link ?></textarea>
								<?php echo ((form_error('embed_code_link')!=NULL)) ? '<span class="text-error">'.form_error('embed_code_link').'</span>' : '' ?>                    
								<?php 
								/*$title 	= ($this->input->post('title')!=NULL) ? $this->input->post('title') : $content_details->title; 
								$embed_code_link = ($this->input->post('embed_code_link')!=NULL) ? $this->input->post('embed_code_link') : $content_details->embed_code_link; 
								*/					           ?>
								
								
								</div>
							</div>
							
							<div class="form-group">
								<label>Date (YYYYMMDD) :</label>
								<input type="text" name="date" value="<?php  echo $date;?>" class="form-control input-sm"  />
								<?php echo ((form_error('date')!=NULL)) ? '<span class="text-error">'.form_error('date').'</span>' : '' ?>  
							</div>
							<div class="control-group">
								<label class="control-label">Image<font color="#FF0000">*</font>  :</label>
								<div class="controls">
									<?php if($content_details->image!=''){?>
									<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $content_details->image; ?>" width="100" height="75">
									<?php } ?>
									<input name="userfile" id="photoInput" type="file" class="input-xlarge">
								</div>
							</div>
							
						</div> 
						<hr>
						<div class="text-center"><input type="submit" class="btn btn-danger" value="Update"/></div>
						<input type="hidden" id="photoInputWidth" value="" />
						<input type="hidden" id="photoInputHeight" value="" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function chkErrors()
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
</script>
		
