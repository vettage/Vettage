<?php   

$type 			= $member_details->type; 
$username 		= $member_details->username; if($this->input->post('username')!=NULL) $username = $this->input->post('username');
$username 		= $member_details->username; if($this->input->post('username')!=NULL) $username = $this->input->post('username');
$email 			= $member_details->email; if($this->input->post('email')!=NULL) $email = $this->input->post('email');
$address 		= $member_details->address;if($this->input->post('address')!=NULL) $address = $this->input->post('address'); 
$address1 		= $member_details->address1;if($this->input->post('address1')!=NULL) $address1 = $this->input->post('address1'); 
$city 			= $member_details->city;if($this->input->post('city')!=NULL) $city =  $this->input->post('city'); 
$state 			= $member_details->state;if($this->input->post('state')!=NULL) $state =  $this->input->post('state'); 
$country 		= $member_details->country;if($this->input->post('country')!=NULL) $country =  $this->input->post('country'); 
$zipcode 		= $member_details->zipcode;if($this->input->post('zipcode')!=NULL) $zipcode =  $this->input->post('zipcode'); 
$fax 			= $member_details->fax;if($this->input->post('fax')!=NULL) $fax =  $this->input->post('fax');
$phone 			= $member_details->phone; if($this->input->post('phone')!=NULL) $phone = $this->input->post('phone');
$experience  	= $member_details->experience; if($this->input->post('experience')!=NULL) $experience = $this->input->post('experience');
$expertise 	 	= $member_details->expertise; if($this->input->post('expertise')!=NULL) $expertise = $this->input->post('expertise');
$interests 	 	= $member_details->interests; if($this->input->post('interests')!=NULL) $interests = $this->input->post('interests');
$keywords 	 	= $member_details->keywords; if($this->input->post('keywords')!=NULL) $keywords = $this->input->post('keywords');
$picture 		= $member_details->picture; if($this->input->post('picture')!=NULL) $picture = $this->input->post('picture');
$folio_link 	= $member_details->folio_link; if($this->input->post('folio_link')!=NULL) $folio_link = $this->input->post('folio_link');				

$bit_address = $member_details->bit_address; if($this->input->post('bit_address')!=NULL) $bit_address = $this->input->post('bit_address');


?>
<script src="<?php echo BASE_URL?>media/tag-it/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo BASE_URL?>media/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css">

         <link href="<?php echo BASE_ASSETS; ?>croppic/assets/css/croppic.css" rel="stylesheet">
  
	<script src="<?php echo BASE_ASSETS;?>croppic/croppic.js"></script>
	<script src="<?php echo BASE_ASSETS;?>croppic/assets/js/jquery.mousewheel.min.js"></script>

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">

<div class="container">
	<br />
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('delete_error')) ? '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : ''?>
	
	<div class="row">
    	<div class="col-lg-5">
			<h3 class="">PROFILE</h3>
 			</div>
		<div class="col-lg-7 bg-light pad-top pad-bottom">
        	<form  class="form-horizontal" method="post" name="frmaccount" id="frmaccount" action=""  enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">I am a:<font color="#FF0000">*</font></label>
                            <div class="col-sm-8">
                            <input type="checkbox" name="type[]" value="subscriber" <?php if ($this->user->isSubscriber()) echo 'checked=cheecked';?>/>Subscriber<br />
							<input type="checkbox" name="type[]" value="raw" <?php if ($this->user->isRaw()) echo 'checked=cheecked';?>/>Content Contributor<br />
							<input type="checkbox" name="type[]" value="editor" <?php if ($this->user->isEditor()) echo 'checked=cheecked';?>/>Editor
                            
                            <?php echo ((form_error('type[]')!=NULL)) ? '<span class="text-error">'.form_error('type[]').'</span>' : '' ?></div>
                        </div>
                
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Username :</label>
                            <div class="col-sm-8"><input type="text" placeholder="Username" class="form-control input-sm" name="username" id="username" 
                            value="<?php echo $username?>">
                            <?php echo ((form_error('username')!=NULL)) ? '<span class="text-error">'.form_error('username').'</span>' : '' ?>                           </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email :</label>
                            <div class="col-sm-8"><input type="text" placeholder="Email" class="form-control input-sm" name="email" id="email" 
                            value="<?php echo $email?>">
                            <?php echo ((form_error('email')!=NULL)) ? '<span class="text-error">'.form_error('email').'</span>' : '' ?></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Password :</label>
                            <div class="col-sm-8"><input placeholder="Password" type="password" class="form-control input-sm" name="password" id="password" value="" autocomplete="off">
                            <?php echo ((form_error('password')!=NULL)) ? '<span class="text-error">'.form_error('password').'</span>' : '' ?></div>
                        </div>
                        
						
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Image :</label>
                            <div class="col-sm-8">

                            <?php
                            
                            $member_file_path = getcwd().'/media/uploads/stories/';
                            $member_path = BASE_URL.'media/uploads/stories/';
                            $img_src = BASE_URL.'media/uploads/members/randombig.gif';
                            if($picture!='' && file_exists(getcwd().$picture))
                                $img_src = $picture;
                            ?>

								<div id="my_picture"><img src="<?php echo $img_src?>" width="200px" /></div>
								<input type="text" id="picture" name="picture">
                            
                            
                            
                            </div>
                        </div>
						
							<div class="form-group">
								<label class="col-sm-4 control-label">Folio Link :<font color="#FF0000">*</font></label>
								<div class="col-sm-8"><textarea placeholder="Folio Link" class="form-control input-sm" name="folio_link"><?php echo $folio_link?></textarea>
								<?php echo ((form_error('folio_link')!=NULL)) ? '<span class="text-error">'.form_error('folio_link').'</span>' : '' ?></div>
							</div>
 						
                    </div>
                    <div class="col-lg-6">
						<div class="form-group">
                            <label class="col-sm-4 control-label">Experience :</label>
                            <div class="col-sm-8">
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
                            <label class="col-sm-4 control-label">Fields of Expertise:<font color="#FF0000">*</font></label>
                            
                            <div class="col-sm-8">
                            <ul id="expertiseTags"></ul>
                            <input type="hidden" name="expertise" id="expertise" value="<?php echo $expertise?>" />
                            <?php echo ((form_error('expertise')!=NULL)) ? '<span class="text-error">'.form_error('expertise').'</span>' : '' ?></div>
                        </div>

 					 <div class="form-group" id="user_phone-control-group">
					<label class="col-sm-4 control-label ">Locations of Expertise:<font color="#FF0000">*</font></label>        
						<?php 
							foreach($location_details as $row) { 
						echo $row->city.", ".$row->state.", ".$row->country.'<br />';
							}
						?>		
						<div class="col-sm-8">
							<a href="/account/locations">Add Location</a>
 						</div>
 						</div>
						
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Interests :</label>
                            <div class="col-sm-8"><textarea placeholder="Interests" class="form-control input-sm" name="interests"><?php echo $interests?></textarea>
                            <?php echo ((form_error('interests')!=NULL)) ? '<span class="text-error">'.form_error('interests').'</span>' : ''                          ?></div>
                        </div>
				        </div>
                </div>
                <hr>
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

var croppicContainerModalOptions = {
		uploadUrl:'<?php echo BASE_URL;?>/img_save_to_file.php',
		cropUrl:'<?php echo BASE_URL;?>/img_crop_to_file.php',
		outputUrlId:'picture',
		modal:true,
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		onBeforeImgUpload: function(){  },
		onAfterImgUpload: function(){  },
		onImgDrag: function(){ console.log('onImgDrag') },
		onImgZoom: function(){ console.log('onImgZoom') },
		onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
		onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
		onReset:function(){ console.log('onReset') },
		onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
var cropperHeader = new Croppic('my_picture', croppicContainerModalOptions);



</script>
	</div>
 