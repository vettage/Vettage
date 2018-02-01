<?php


$type 		= "";


if (!empty($_POST)) {
$type = $_POST['type'];

$s = $e = $r = 0;

foreach ($type as $t) {
	if ($t=='subscriber') $s = 1;
	if ($t=='raw') $r = 1;
	if ($t=='editor') $e = 1;
}

$type = $e.$r.$s;
}



$username 		= "";if($this->input->post('username')!=NULL) $username = $this->input->post('username');
$email 			= ""; if($this->input->post('email')!=NULL) $email = $this->input->post('email');
$experience  	= ""; if($this->input->post('experience')!=NULL) $experience = $this->input->post('experience');
$expertise 	 	= ""; if($this->input->post('expertise')!=NULL) $expertise = $this->input->post('expertise');
$interests 	 	= ""; if($this->input->post('interests')!=NULL) $interests = $this->input->post('interests');
$keywords 	 	= "";; if($this->input->post('keywords')!=NULL) $keywords = $this->input->post('keywords');
$folio_link 	= ""; if($this->input->post('folio_link')!=NULL) $folio_link = $this->input->post('folio_link');


?>
<script src="<?php echo BASE_URL?>media/tag-it/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo BASE_URL?>media/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">

<div class="container">
	<br />
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('delete_error')) ? '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : ''?>
	
	<div class="row">
			<div class="span24">
	
 			<h3 class="">MEMBER PROFILE</h3>
        	<form  method="post" name="frmaccount" id="frmaccount" action=""  enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label">I am a:<font color="#FF0000">*</font></label>
                            <input type="checkbox" name="type[]" value="subscriber" <?php if (substr($type,2,1)==1) echo 'checked=cheecked';?>/>Subscriber<br />
							<input type="checkbox" name="type[]" value="raw" <?php if (substr($type,1,1)==1) echo 'checked=cheecked';?>/>Content Contributor<br />
							<input type="checkbox" name="type[]" value="editor" <?php if (substr($type,0,1)==1) echo 'checked=cheecked';?>/>Editor
                            
                            <?php echo ((form_error('type[]')!=NULL)) ? '<span class="text-error">'.form_error('type[]').'</span>' : '' ?>
                        </div>
                
                        <div class="form-group">
                            <label class="control-label">Username :</label>
                            <div class=""><input type="text" placeholder="Username" class="form-control input-sm" name="username" id="username" 
                            value="<?php echo $username?>">
                            <?php echo ((form_error('username')!=NULL)) ? '<span class="text-error">'.form_error('username').'</span>' : '' ?>                           </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label">Email :</label>
                            <div ><input type="text" placeholder="Email" class="form-control input-sm" name="email" id="email" 
                            value="<?php echo $email?>">
                            <?php echo ((form_error('email')!=NULL)) ? '<span class="text-error">'.form_error('email').'</span>' : '' ?></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label">Password :</label>
                            <div class="col-sm-8"><input placeholder="Password" type="password" class="form-control input-sm" name="password" id="password" value="" autocomplete="off">
                            <?php echo ((form_error('password')!=NULL)) ? '<span class="text-error">'.form_error('password').'</span>' : '' ?></div>
                        </div>
                        
							<div class="form-group">
								<label class="control-label">Folio Link :<font color="#FF0000">*</font></label>
								<div><textarea placeholder="Folio Link" class="form-control input-sm" name="folio_link"><?php echo $folio_link?></textarea>
								<?php echo ((form_error('folio_link')!=NULL)) ? '<span class="text-error">'.form_error('folio_link').'</span>' : '' ?></div>
							</div>
 						
  					<div class="form-group">
                            <label class="control-label">Experience :</label>
                            <div>
									<?php /*?><input type="text" class="form-control input-sm" name="experience" id="experience" value="<?php                                        echo $experience?>"><?php */?>
                                    <select class="form-control input-sm" name="experience" id="experience">
                                    <option value="Less than 1 year" <?php if($experience=='Less than 1 year') echo 'selected="selected"'; ?>>                                     Less than 1 year</option>
                                    <option value="1-2 years" <?php if($experience=='1-2 years') echo 'selected="selected"'; ?>>1-2 years
                                    </option>
                                    <option value="2-5 years" <?php if($experience=='2-5 years') echo 'selected="selected"'; ?>>2-5 years
                                    </option>
                                    <option value="5 years or more" <?php if($experience=='5 years or more') echo 'selected="selected"'; ?>>
                                    5 years or more</option>
                                    </select>
                           	       <?php echo ((form_error('experience')!=NULL)) ? '<br/><span class="text-error">'.form_error('experience').'                                   </span>' : '' ?>
							</div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Fields of Expertise:<font color="#FF0000">*</font></label>
                            
                            <div>
                            <ul id="expertiseTags"></ul>
                            <input type="hidden" name="expertise" id="expertise" value="<?php echo $expertise?>" />
                            <?php echo ((form_error('expertise')!=NULL)) ? '<span class="text-error">'.form_error('expertise').'</span>' : '' ?></div>
                        </div>

						
                        <div class="form-group">
                            <label class="control-label">Interests :</label>
                            <div class=""><textarea placeholder="Interests" class="form-control input-sm" name="interests"><?php echo $interests?></textarea>
                            <?php echo ((form_error('interests')!=NULL)) ? '<span class="text-error">'.form_error('interests').'</span>' : ''                          ?></div>
                        </div>
				        </div>
                <div class="text-center"><button class="btn btn-danger" type="submit">Update</button></div>
            </form>
	</div>
<script>
$(function(){
 	$('#expertiseTags').tagit({
		autocomplete: {delay: 0, minLength: 2,
			source: function(request, response) {
            $.ajax({
                url: "<?php echo BASE_URL?>/ajax/expertise",
                dataType: "json",
                data: request,
                success: function( data, textStatus, jqXHR) {
                    console.log( data);
                    var items = data;
                    response(items);
                },
                error: function(jqXHR, textStatus, errorThrown){
                     console.log( textStatus);
                }
            });
        },},
		
	    // This will make Tag-it submit a single form value, as a comma-delimited field.
	    singleField: true,
	    singleFieldNode: $('#expertise')
	});

});



</script>
	</div>
 