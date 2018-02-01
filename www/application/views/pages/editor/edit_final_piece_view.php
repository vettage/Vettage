<?php
die('dead?');
$types  	     = $content_details->types;if(!empty($_POST['types'])) $types  = $_POST['types'];
$city 		     = $content_details->city;if($this->input->post('city')!=NULL)   $city = $this->input->post('city'); 
$state 		     = $content_details->state;if($this->input->post('state')!=NULL)  $state = $this->input->post('state'); 
$country 	     = $content_details->country;if($this->input->post('country')!=NULL) $country = $this->input->post('country'); 
$postal_code 	 = $content_details->postal_code;if($this->input->post('postal_code')!=NULL) $postal_code= $this->input->post('postal_code'); 
$embed_code_link = $content_details->embed_code_link; if($this->input->post('embed_code_link')!=NULL) $embed_code_link = $this->input->post( 'embed_code_link'); 
$tags 		     = $content_details->tags;if($this->input->post('tags')!=NULL) $tags = $this->input->post('tags'); 
$copyright       = 1;if(!empty($_POST['copyright']))   $copyright = $_POST['copyright'];
$date  		     = date('Ymd',strtotime($content_details->story_date)); if(!empty($_POST['date'])) $date = $_POST['date'];
$title           = $content_details->title;if(!empty($_POST['title'])) $title = $_POST['title'];
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
                                 <?php echo ((form_error('types')!=NULL)) ? '<span class="text-error">'.form_error('types').'</span>' : '' ?> 								</div>
							</div>
                            <br />
                            <div class="form-group"> 
								<label>Title :</label>
							    <input type="text" name="title" value="<?php  echo $title;?>" class="form-control input-sm">
					            <?php echo ((form_error('title')!=NULL)) ? '<span class="text-error">'.form_error('title').'</span>' : '' ?>
 							</div>
                            
							<div class="form-group"> 
								<label>Tags (Separate by commas) :</label>
							    <input type="text" name="tags" value="<?php  echo $tags;?>" class="form-control input-sm">
					            <?php echo ((form_error('tags')!=NULL)) ? '<span class="text-error">'.form_error('tags').'</span>' : '' ?>
 							</div>
                            <div class="clearfix pad-top pad-bottom">
 							<label>Embed/Link :</label>
							 <textarea class="form-control" rows="3" name="embed_code_link"><?php echo $embed_code_link ?></textarea>
                              <?php echo ((form_error('embed_code_link')!=NULL)) ? '<span class="text-error">'.form_error('embed_code_link').'</span>' : '' ?>
                            </div>
 							<div class="col-lg-12">
 								<label class="checkbox">Copyright Agreement Read & Agreed<input name="copyright" id="copyright" 
                                 type="checkbox" value="1" <?php if($copyright==1) echo 'checked="checked"'; ?> ></label> &nbsp;
                                <?php echo ((form_error('copyright')!=NULL)) ? '<span class="text-error">'.form_error('copyright').'</span>' : '' ?>  
			  			</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							    <label>Location :</label>
							    <select class="form-control input-sm" name="country" >
							    <option value="" selected="selected">Select Country</option>
							    <?php foreach($countries as $row):?>
								<option value="<?php echo $row->name;?>" <? if($row->name==$country) echo 'selected="selected"';?>><?php echo $row->name;?></option>
							    <?php endforeach;?>
						        </select>
                                <?php echo ((form_error('country')!=NULL)) ? '<span class="text-error">'.form_error('country').'</span>' : '' ?> 
						</div>
						    <div class="form-group">
							<div class="row">
                            <div class="col-lg-6">
                           <input type="state" name="state" placeholder="State" value="<?php  echo $state;?>" class="form-control input-sm"  />
                             <?php echo ((form_error('state')!=NULL)) ? '<span class="text-error">'.form_error('state').'</span>' : '' ?> 
                             </div>
                            <div class="col-lg-6">
                            <input type="city" name="city" placeholder="City" value="<?php  echo $city;?>" class="form-control input-sm"  />
                            <?php echo ((form_error('city')!=NULL)) ? '<span class="text-error">'.form_error('city').'</span>' : '' ?>   
                               </div>
							</div>
						</div>
						<div class="form-group">
                        <input type="text" name="postal_code" value="<?php  echo $postal_code;?>" class="form-control input-sm" 
                        placeholder="Or Postal Code" />
                        <?php echo ((form_error('postal_code')!=NULL)) ? '<span class="text-error">'.form_error('postal_code').'</span>' : ''                         ?>   
                        </div>
                        
						<div class="form-group">
							<label>Date (YYYYMMDD) :</label>
							<input type="text" name="date" value="<?php  echo $date;?>" class="form-control input-sm"  />
                            <?php echo ((form_error('date')!=NULL)) ? '<span class="text-error">'.form_error('date').'</span>' : '' ?>  
						</div>
                        <div>&nbsp;</div>
                        <div class="control-group">
						   <label class="control-label">Image<font color="#FF0000">*</font>  :</label>
							<div class="controls">
								<?php if($content_details->image!=''){?>
									<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $content_details->image; ?>" width="100" height="75">
								<?php } ?>
								<input name="userfile" id="image" type="file" class="input-xlarge">
						   </div>
						  </div>
					</div>
				</div> 
				<hr>
				<div class="text-center"><input type="submit" class="btn btn-danger" value="Update"/></div>
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
	return true;
}
</script>		

		

        
		
	

