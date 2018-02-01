<?php 
	$title 		= ($this->input->post('title')!=NULL) ? $this->input->post('title') : $family_data->title; 
	$firstname 	= ($this->input->post('firstname')!=NULL) ? $this->input->post('firstname') : $family_data->firstname; 
	$lastname 	= ($this->input->post('lastname')!=NULL) ? $this->input->post('lastname') : $family_data->lastname; 
	$middlename = ($this->input->post('middlename')!=NULL) ? $this->input->post('middlename') : $family_data->middlename; 
	$gender 	= ($this->input->post('gender')!=NULL) ? $this->input->post('gender') : $family_data->gender;
	$user_dob 	= ($this->input->post('user_dob')!=NULL) ? date("d-m-Y", strtotime($this->input->post('user_dob'))) :  $family_data->user_dob; 
	$email 		= ($this->input->post('email')!=NULL) ? $this->input->post('email') : $family_data->email; 
	$address1 	= ($this->input->post('address1')!=NULL) ? $this->input->post('address1') : $family_data->address1; 
	$address2 	= ($this->input->post('address2')!=NULL) ? $this->input->post('address2') : $family_data->address2; 
	$town 		= ($this->input->post('town')!=NULL) ? $this->input->post('town') : $family_data->town; 
	$postcode 	= ($this->input->post('postcode')!=NULL) ? $this->input->post('postcode') : $family_data->postcode; 
	$mob_no 	= ($this->input->post('mob_no')!=NULL) ? $this->input->post('mob_no') : $family_data->mob_no; 
	$home_phone = ($this->input->post('home_phone')!=NULL) ? $this->input->post('home_phone') : $family_data->home_phone; 
	$work_phone	= ($this->input->post('work_phone')!=NULL) ? $this->input->post('work_phone') : $family_data->work_phone;
	$area_zone 				= ($this->input->post('area_zone')!=NULL) ? $this->input->post('area_zone') : $family_data->area_zone;
	$bible_study_zone 		= ($this->input->post('bible_study_zone')!=NULL) ? $this->input->post('bible_study_zone') : $family_data->bible_study_zone;
	$prayer_zone 			= ($this->input->post('prayer_zone')!=NULL) ? $this->input->post('prayer_zone') : $family_data->prayer_zone;
	$marriage_status 		= ($this->input->post('marriage_status')!=NULL) ? $this->input->post('marriage_status') : $family_data->marriage_status;
	$baptism_status 		= ($this->input->post('baptism_status')!=NULL) ? $this->input->post('baptism_status') : $family_data->baptism_status; 
	$bible_study_group 		= ($this->input->post('bible_study_group')!=NULL) ? $this->input->post('bible_study_group') : $family_data->bible_study_group; 
	$employmt_status 		= ($this->input->post('employmt_status')!=NULL) ? $this->input->post('employmt_status') : $family_data->employmt_status; 
	$near_station 			= ($this->input->post('near_station')!=NULL) ? $this->input->post('near_station') : $family_data->near_station; 
	$skill 					= ($this->input->post('skill')!=NULL) ? $this->input->post('skill') : $family_data->skill; 
	$branch_attend 			= ($this->input->post('branch_attend')!=NULL) ? $this->input->post('branch_attend') : $family_data->branch_attend; 
	$ministr_area_now 		= ($this->input->post('ministr_area_now')!=NULL) ? $this->input->post('ministr_area_now') : $family_data->ministr_area_now; 
	$ministr_area_old 		= ($this->input->post('ministr_area_old')!=NULL) ? $this->input->post('ministr_area_old') : $family_data->ministr_area_old; 
	$spouse_name 			= ($this->input->post('spouse_name')!=NULL) ? $this->input->post('spouse_name') : $family_data->spouse_name; 
	$spouse_lname 			= ($this->input->post('spouse_lname')!=NULL) ? $this->input->post('spouse_lname') : $family_data->spouse_lname; 
	$spouse_dob 			= ($this->input->post('spouse_dob')!=NULL) ? date("d-m-Y", strtotime($this->input->post('spouse_dob'))) : $family_data->spouse_dob; 
	$spouse_email 			= ($this->input->post('spouse_email')!=NULL) ? $this->input->post('spouse_email') : $family_data->spouse_email; 
	$spouse_mob 			= ($this->input->post('spouse_mob')!=NULL) ? $this->input->post('spouse_mob') : $family_data->spouse_mob; 
	$spouse_work_phone 		= ($this->input->post('spouse_work_phone')!=NULL) ? $this->input->post('spouse_work_phone') : $family_data->spouse_work_phone; 
	$spouse_baptism_status 	= ($this->input->post('spouse_baptism_status')!=NULL) ? $this->input->post('spouse_baptism_status') : $family_data->spouse_baptism_status; 
	$spouse_picture 		= ($this->input->post('spouse_picture')!=NULL) ? $this->input->post('spouse_picture') : $family_data->spouse_picture; 
	$spouse_skills 			= ($this->input->post('spouse_skills')!=NULL) ? $this->input->post('spouse_skills') : $family_data->spouse_skills;
	$spouse_ministr_area_now= ($this->input->post('spouse_ministr_area_now')!=NULL) ? $this->input->post('spouse_ministr_area_now') : $family_data->spouse_ministr_area_now;
	$image 		    		= ($this->input->post('image')!=NULL) ? $this->input->post('image') : $family_data->image; 
	$member_since  		    = ($this->input->post('member_since')!=NULL) ? $this->input->post('member_since') : $family_data->member_since;
 ?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ecfcuk</title>

    <!-- Bootstrap -->
    <link href="<?php echo BASE_ASSETS?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo BASE_ASSETS?>css/custom.css" rel="stylesheet">
    <link href="<?php echo BASE_ASSETS?>css/datepicker.css" rel="stylesheet">
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
     <script src="<?php echo BASE_ASSETS?>js/jquery.js"></script>
    <script src="<?php echo BASE_ASSETS?>js/bootstrap.min.js"></script>
 	 <link href="<?php echo BASE_ASSETS?>css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container">
    	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
    <?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
    <div class="col-lg-12 tital_name">Application for ECFC UK</div>
    <div class="row g1-border">
        	<form  role="form" method="post"  action="">
                <div class="row">
                  <div class="col-lg-6 ">
                  <div class="form-horizontal paddinh5"  id="user_list">
                      <div class="form-group <?php echo ((form_error('title')!=NULL)) ? 'has-error' : '' ?>">
                        <label  class="col-sm-5 control-label">Title <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $title?>" placeholder="Title">
                          <?php echo ((form_error('title')!=NULL)) ? '<span class="help-block">'.form_error('title').'</span>' : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo ((form_error('firstname')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">First Name <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control"  name="firstname" id="inputfirstname" value="<?php echo $firstname?>" placeholder="First Name">
                          <?php echo ((form_error('firstname')!=NULL)) ? '<span class="help-block">'.form_error('firstname').'</span>' :                          '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('middlename')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Midle Name <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="inputmidlename" value="<?php echo $middlename?>" name="middlename" placeholder="Midle Name">
                          <?php //echo ((form_error('middlename')!=NULL)) ? '<span class="help-block">'.form_error('middlename').'</span>'                           : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo ((form_error('lastname')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Last Name <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="lastname"  value="<?php echo $lastname?>" id="inputlastname" placeholder="Last Name">
                          <?php echo ((form_error('lastname')!=NULL)) ? '<span class="help-block">'.form_error('lastname').'</span>' : '                           ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo ((form_error('gender')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Sex <font color="#FF0000">*</font></label>
                        <div class="col-sm-6">
                          <div style="float:left;" class="checkbox">
                              <label>
                                <input type="radio"  name="gender" value="1" <?php if($gender!=2) echo 'checked="checked"';?> >
                                Male
                              </label>
                             </div>
                          <div style="float:left; margin-left:20px;" class="checkbox">
                              <label>  
                                <input type="radio" name="gender" value="2" <?php  if($gender==2) echo 'checked'; ?> >
                                Female
                              </label>
                             </div>
                          <?php echo ((form_error('gender')!=NULL)) ? '<span class="help-block  col-sm-12" style="padding : 0px">'.form_error('gender').'</span>': '' ?>
                          </div>                          
                      </div>
                      <div class="form-group <?php echo ((form_error('user_dob')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">DOB<font color="#FF0000">*</font> :</label>
                       <div class="col-sm-5">
                           <div data-date-format="dd-mm-yyyy" data-date="<?php echo date("d-m-Y");?>" id="dp1" class="date input-group">
                          <input type="text" class="form-control" id="user_dob" name="user_dob" placeholder="DOB" 
                                   value="<?php echo $user_dob;?>">
					                  <span id="clickdate" class="add-on input-group-btn btn btn-default"><i class="fa fa-calendar"></i></span>
                                                   </div>
							<script type="text/javascript">
							 $(function(){
								$('#dp1').datepicker();
							 });
							 </script>
                        </div>
                       <?php echo ((form_error('user_dob')!=NULL)) ? '<span class="help-block"  style="margin-left:242px;">'.form_error('user_dob').'</span>' : '' ?>
                         </div>
                         
                      <div class="form-group <?php echo ((form_error('email')!=NULL)) ? 'has-error' : '' ?>">
                        <label for="inputEmail3" class="col-sm-5 control-label">Email <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control"  value="<?php echo $email?>" id="email" name="email" placeholder="Email">
                          <?php echo ((form_error('email')!=NULL)) ? '<span class="help-block">'.form_error('email').'</span>' : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo ((form_error('address1')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Address Line 1 <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control"  value="<?php echo $address1?>" id="inputaddress1" name="address1" placeholder="Address Line 1">
                          <?php echo ((form_error('address1')!=NULL)) ? '<span class="help-block">'.form_error('address1').'</span>' : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('address2')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Address Line 2 <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $address2?>" id="inputaddress2" name="address2" placeholder="Address Line 2">
                          <?php //echo ((form_error('address2')!=NULL)) ? '<span class="help-block">'.form_error('address2').'</span>' : '                           ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('town')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Town <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control"  value="<?php echo $town?>" id="inputtown" name="town" placeholder="Town">
                          <?php //echo ((form_error('town')!=NULL)) ? '<span class="help-block">'.form_error('town').'</span>' : '                         ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo ((form_error('postcode')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Post Code <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control phone_no" value="<?php echo $postcode?>" name="postcode" id="inputtown" placeholder="Post Code">
                          <?php echo ((form_error('postcode')!=NULL)) ? '<span class="help-block">'.form_error('postcode').'</span>' : '                         ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo ((form_error('mob_no')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Mobile Number : </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control phone_no"  value="<?php echo $mob_no?>" id="mobtext" name="mob_no" placeholder="Mobile Number">
                          <?php echo ((form_error('mob_no')!=NULL)) ? '<span class="help-block">'.form_error('mob_no').'</span>' : '                          ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('home_phone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Home Tel <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control phone_no" value="<?php echo $home_phone?>" id="teltext" name="home_phone" placeholder="Home Tel">
                          <?php //echo ((form_error('home_phone')!=NULL)) ? '<span class="help-block">'.form_error('home_phone').'</span>' : '                            ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('work_phone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Work Tel <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control phone_no" value="<?php echo $work_phone?>" id="worktext" name="work_phone" placeholder="Work Phone">
                          <?php //echo ((form_error('work_phone')!=NULL)) ? '<span class="help-block">'.form_error('work_phone').'</span>' : '                         ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('area_zone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Area Zone <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $area_zone?>" name="area_zone" id="areazone" placeholder="Area Zone">
						  <?php //echo ((form_error('area_zone')!=NULL)) ? '<span class="help-block">'.form_error('area_zone').'</span>' : '                         ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('bible_study_zone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Bible Study Zone <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" value="<?php echo $bible_study_zone?>" name="bible_study_zone" id="areazone"                            placeholder="Bible Study Zone">
                          <?php //echo ((form_error('bible_study_zone')!=NULL)) ? '<span class="help-block">'.form_error('bible_study_zone').'</span>' : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('prayer_zone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Prayer Zone <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" value="<?php echo $prayer_zone?>" id="prayerzone" name="prayer_zone"                             placeholder="Prayer Zone">
                          <?php //echo ((form_error('prayer_zone')!=NULL)) ? '<span class="help-block">'.form_error('prayer_zone').'                             </span>' : '' ?>
                        </div>
                      </div>
                      
                      <div class="form-group <?php echo ((form_error('marriage_status')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Marriage Status <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-4">
                         <select class="form-control" name="marriage_status" id="marriage_status">
                              <option value="">Select</option>
                              <option value="1"<?php if($marriage_status==1) echo 'selected="selected"'; ?>>Married</option> 
                              <option value="2"<?php if($marriage_status==2) echo 'selected="selected"'; ?>>Unmarried</option>
                            </select>
                          <?php echo ((form_error('marriage_status')!=NULL)) ? '<span class="help-block">'.form_error('marriage_status').'</span>' : '' ?> 
                        </div>
                      </div>

                          <div class="form-group <?php //echo ((form_error('baptism_status')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Baptism Status <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control"  value="<?php echo $prayer_zone?>" id="baptismstatus" placeholder="Baptism Status">
                           <?php //echo ((form_error('baptism_status')!=NULL)) ? '<span class="help-block">'.form_error('baptism_status                           ').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('bible_study_group')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Bible Study Group <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="study" value="<?php echo $prayer_zone?>" placeholder="Bible Study Group">
                           <?php 
						  // echo ((form_error('bible_study_group')!=NULL)) ? '<span class="help-block">'.form_error('bible_study_group').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('employmt_status')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Employment Status <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="emp" value="<?php echo $prayer_zone?>" placeholder="Employment Status">
                           <?php //echo ((form_error('employmt_status')!=NULL)) ? '<span class="help-block">'.form_error('employmt_status                           ').'</span>' : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('image')!=NULL)) ? 'has-error' : '' ?> spause_info">
                            <label class="col-sm-5  control-label">Profile Picture <font color="#FF0000">*</font>  :</label>
                        	<div class="col-sm-7">
								<input name="userfile" id="image" type="file" class="input-xlarge"> 
                        		 <?php
								  //echo ((form_error('image')!=NULL)) ? '<span class="help-block">'.form_error('image').'</span>' : '' ?> 
							</div>
                         </div>
                           <div class="form-group <?php //echo ((form_error('near_station')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Nearest Station <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $near_station?>" name="near_station"
                           placeholder="Nearest Station">
                           <?php //echo ((form_error('near_station')!=NULL)) ? '<span class="help-block">'.form_error('near_station                           ').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('skill')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Skill <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $skill?>" name="skill" placeholder="Skill">
                           <?php //echo ((form_error('skill')!=NULL)) ? '<span class="help-block">'.form_error('skill').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('member_since')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Member Since <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="member_since" value="<?php echo $member_since?>" placeholder="Member Since">
                           <?php //echo ((form_error('member_since')!=NULL)) ? '<span class="help-block">'.form_error('member_since').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('branch_attend')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Branch You Attending <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="branch_attend" value="<?php echo $branch_attend?>" placeholder="Branch You Attending">
                           <?php //echo ((form_error('branch_attend')!=NULL)) ? '<span class="help-block">'.form_error('branch_attend').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('ministr_area_now')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Ministering Area Now <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="ministr_area_now" value="<?php echo $ministr_area_now?>" 
                          placeholder="Ministering Area Now">
                           <?php //echo ((form_error('ministr_area_now')!=NULL)) ? '<span class="help-block">'.form_error('ministr_area_now').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('ministr_area_old')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Ministering Area Before <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="ministr_area_old" value="<?php echo $ministr_area_old?>" 
                          placeholder="Ministering Area Before">
                           <?php //echo ((form_error('ministr_area_old')!=NULL)) ? '<span class="help-block">'.form_error('ministr_area_old').'</span>' : '' ?>
                        </div>
                      </div>
                       
                      </div>
                 </div>
                  <div class="col-lg-6" id="user_details"
                   style=" <?php if($marriage_status == 1) echo "display : block "; else echo "display : none" ; ?>" >
                  <div  class="form-horizontal paddinh5" >
                <div class="form-group <?php echo ((form_error('spouse_name')!=NULL)) ? 'has-error' : '' ?>">
                <label  class="col-sm-5 control-label">Spouse Name <font color="#FF0000">*</font> :</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" value="<?php echo $spouse_name?>" name="spouse_name" placeholder="Spouse Name">
                   <?php echo ((form_error('spouse_name')!=NULL)) ? '<span class="help-block">'.form_error('spouse_name').'</span>' : '' ?>
                </div>
              </div>
                <div class="form-group <?php //echo ((form_error('spouse_lname')!=NULL)) ? 'has-error' : '' ?>">
                <label  class="col-sm-5 control-label">Spouse Surname <font color="#FF0000">*</font> :</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="spouse_lname" value="<?php echo $spouse_lname?>" placeholder="Spouse Surname">
                   <?php //echo ((form_error('spouse_lname')!=NULL)) ? '<span class="help-block">'.form_error('spouse_lname').'</span>' : '' ?>
                </div>
              </div>
                <?php /*?><div class="form-group <?php echo ((form_error('spouse_dob')!=NULL)) ? 'has-error' : '' ?>">
                <label class="col-sm-5 control-label">Spouse Dob <font color="#FF0000">*</font> :</label>
               <div class="col-sm-5">
                  <input type="text" class="form-control" id="spousesurname" placeholder="Spouse Surname">
                   <?php echo ((form_error('spouse_dob')!=NULL)) ? '<span class="help-block">'.form_error('spouse_dob').'</span>' : '' ?>
                </div>
              </div><?php */?>
              
              <div class="form-group <?php echo ((form_error('spouse_dob')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">DOB <font color="#FF0000">*</font> :</label>
                       <div class="col-sm-5">
                           <div data-date-format="dd-mm-yyyy" data-date="<?php echo date("d-m-Y");?>" id="dp2" class="date input-group">
                      <input type="text" class="form-control" id="spouse_dob" name="spouse_dob"  
                      placeholder="DOB"  value="<?php echo $spouse_dob;?>" />
                    <span id="clickdate" class="add-on input-group-btn btn btn-default"><i class="fa fa-calendar"></i></span>
</div>
							<script type="text/javascript">
							 $(function(){
								$('#dp2').datepicker();
							 });
							 </script>
                        </div>
                       <?php echo ((form_error('spouse_dob')!=NULL)) ? '<span class="help-block" style="margin-left:242px;">'.form_error('spouse_dob').'</span>' : '' ?>
                         </div>
                <div class="form-group <?php echo ((form_error('spouse_email')!=NULL)) ? 'has-error' : '' ?>">
                <label  class="col-sm-5 control-label">Spouse Email <font color="#FF0000">*</font> :</label>
                <div class="col-sm-7">
                  <input type="Email" class="form-control" name="spouse_email"  value="<?php echo $spouse_email?>" placeholder="Spouse Email">
                   <?php 
				   echo ((form_error('spouse_email')!=NULL)) ? '<span class="help-block">'.form_error('spouse_email').'</span>' : '' ?>
                </div>
              </div>
                <div class="form-group <?php echo ((form_error('spouse_mob')!=NULL)) ? 'has-error' : '' ?>">
                <label class="col-sm-5 control-label">Spouse Mobiler <font color="#FF0000">*</font> :</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control phone_no" value="<?php echo $spouse_mob?>" name="spouse_mob" placeholder="8007751234">
                   <?php echo ((form_error('spouse_mob')!=NULL)) ? '<span class="help-block">'.form_error('spouse_mob').'</span>' : '' ?>
                </div>
              </div>
                <div class="form-group <?php //echo ((form_error('spouse_work_phone')!=NULL)) ? 'has-error' : '' ?>">
                <label class="col-sm-5 control-label">Spouse Work Number <font color="#FF0000">*</font> :</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control phone_no" value="<?php echo $spouse_work_phone?>" name="spouse_work_phone" placeholder="1234567">
                   <?php
				    //echo ((form_error('spouse_work_phone')!=NULL)) ? '<span class="help-block">'.form_error('spouse_work_phone').'</span>' : '' ?>
                </div>
              </div>
                <div class="form-group <?php //echo ((form_error('spouse_baptism_status')!=NULL)) ? 'has-error' : '' ?>">
                <label class="col-sm-5 control-label">Spouse Baptism Status <font color="#FF0000">*</font> :</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" value="<?php echo $spouse_baptism_status?>" name="spouse_baptism_status" 
                  placeholder="Spouse Baptism Status">
        <?php
		 //echo ((form_error('spouse_baptism_status')!=NULL)) ? '<span class="help-block">'.form_error('spouse_baptism_status').'</span>' : '' ?>
                </div>
              </div>
                <!--<div class="form-group <?php //echo ((form_error('spouse_picture')!=NULL)) ? 'has-error' : '' ?>">
                <label class="col-sm-5 control-label">Spouse Profile Picture <font color="#FF0000">*</font> :</label>
                <div class="col-sm-7">
                  <input type="img" class="form-control" value="<?php echo $spouse_picture?>" id="spp" placeholder="Spouse Profile Picture">
                   <?php 
				   //echo ((form_error('spouse_picture')!=NULL)) ? '<span class="help-block">'.form_error('spouse_picture').'</span>' : '' ?>
                </div>
              </div>-->
              <div class="form-group <?php //echo ((form_error('image')!=NULL)) ? 'has-error' : '' ?>">
                            <label class="col-sm-5  control-label">Spouse Profile Picture <font color="#FF0000">*</font>  :</label>
                        	<div class="col-sm-7">
								<input name="spouse_picture" type="file" class="input-xlarge">  
                        		 <?php
								  //echo ((form_error('image')!=NULL)) ? '<span class="help-block">'.form_error('image').'</span>' : '' ?> 
							</div>
                         </div>
                <div class="form-group <?php //echo ((form_error('spouse_skills')!=NULL)) ? 'has-error' : '' ?>">
                <label class="col-sm-5 control-label">Spouse Skill <font color="#FF0000">*</font> :</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" value="<?php echo $spouse_skills?>" name="spouse_skills" placeholder="Spouse Skill">
                   <?php 
				   //echo ((form_error('spouse_skills')!=NULL)) ? '<span class="help-block">'.form_error('spouse_skills').'</span>' : '' ?>
                </div>
              </div>
                <div class="form-group <?php //echo ((form_error('spouse_ministr_area_now')!=NULL)) ? 'has-error' : '' ?>">
                <label class="col-sm-5 control-label">Spouse Ministering Area Now <font color="#FF0000">*</font> :</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" value="<?php echo $spouse_ministr_area_now?>" name="spouse_ministr_area_now" 
                  placeholder="Spouse Ministering Area Now">
                   <?php 
				   //echo ((form_error('spouse_ministr_area_now')!=NULL)) ? '<span class="help-block">'.form_error('spouse_ministr_area_now').'</span>' : ''
				    ?>
                </div>
              </div>
                <div id="child_info"><a href="#" id="child_info1">Child Info</a>
				
				   <?php 
					for($i=1;$i<=$this->child_count;$i++)
					{	
						$inpchildnameindex		= !empty($child_data[$i-1]->child_name) ? $child_data[$i-1]->child_name : '';
						$inpchildsurnameindex	= !empty($child_data[$i-1]->child_srname) ? $child_data[$i-1]->child_srname : '';
						$inpchilddobindex		= !empty($child_data[$i-1]->child_dob) ? $child_data[$i-1]->child_dob : '';
						$inpchildemailindex		= !empty($child_data[$i-1]->email) ? $child_data[$i-1]->email : '';
						$inpchildphoneindex		= !empty($child_data[$i-1]->phone) ? $child_data[$i-1]->phone : '';
						
						$inpchildnameindex 		= ($this->input->post('child'.$i.'name')!=NULL) ? $this->input->post('child'.$i.'name') : $inpchildnameindex;
						$inpchildsurnameindex 	= ($this->input->post('child'.$i.'surname')!=NULL) ? $this->input->post('child'.$i.'surname') : $inpchildsurnameindex;
						$inpchilddobindex 		= ($this->input->post('child'.$i.'dob')!=NULL) ? $this->input->post('child'.$i.'dob') : $inpchilddobindex;
						$inpchildemailindex 	= ($this->input->post('child'.$i.'email')!=NULL) ? $this->input->post('child'.$i.'email') : $inpchildemailindex;
						$inpchildphoneindex 	= ($this->input->post('child'.$i.'mob')!=NULL) ? $this->input->post('child'.$i.'mob') : $inpchildphoneindex;
						
						$style='';
						if($inpchildnameindex=='' && $inpchildsurnameindex=='' && $inpchilddobindex=='' && $inpchildemailindex=='' && $inpchildphoneindex=='')
							$style='style="display:none;"';
					?>
					<div  id="child<?php echo $i?>" <?php echo $style;?>>
						<div class="form-group <?php echo ((form_error('child'.$i.'name')!=NULL)) ? 'has-error' : '' ?>">
							<label class="col-sm-5 control-label">Child<?php echo $i?> Name <font color="#FF0000">*</font> :</label>
							<div class="col-sm-7">
								<input type="text" class="form-control"  value="<?php echo $inpchildnameindex?>" name="child<?php echo $i?>name" placeholder="Child Name">
								<?php echo ((form_error('child'.$i.'name')!=NULL)) ? '<span class="help-block">'.form_error('child'.$i.'name').'</span>' : '' ?>
							</div>
						</div>
						<div class="form-group <?php echo ((form_error('child'.$i.'surname')!=NULL)) ? 'has-error' : '' ?>">
							<label class="col-sm-5 control-label">Child<?php echo $i?> Surname <font color="#FF0000">*</font> :</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?php echo $inpchildsurnameindex?>" name="child<?php echo $i?>surname" 
								placeholder="Child Surname">
								<?php echo ((form_error('child'.$i.'surname')!=NULL)) ? '<span class="help-block">'.form_error('child'.$i.'surname').'</span>' : '' ?>
							</div>
						</div>
						<div class="form-group <?php echo ((form_error('child'.$i.'dob')!=NULL)) ? 'has-error' : '' ?>">
							<label class="col-sm-5 control-label">Child<?php echo $i?> Dob <font color="#FF0000">*</font> :</label>
							<div class="col-sm-5">
								<div data-date-format="dd-mm-yyyy" data-date="<?php echo date("d-m-Y");?>" id="dp<?php echo $i+2?>" class="date input-group">
								<input type="text" class="form-control" id="child<?php echo $i?>dob" name="child<?php echo $i?>dob"  
								placeholder="DOB" value="<?php echo $inpchilddobindex;?>" />
								<span id="clickdate" class="add-on input-group-btn btn btn-default" ><i class="fa fa-calendar"></i></span>
							</div>
							<script type="text/javascript">
							$(function(){
								$('#dp<?php echo $i+2?>').datepicker();
							});
							</script>
						</div>
						<?php echo ((form_error('child'.$i.'dob')!=NULL)) ? '<span class="help-block" style="margin-left:242px;">'.form_error('child'.$i.'dob').'</span>' : '' ?>
						</div>
						<div class="form-group <?php echo ((form_error('child'.$i.'email')!=NULL)) ? 'has-error' : '' ?>">
							<label class="col-sm-5 control-label">Child<?php echo $i?> Email <font color="#FF0000">*</font> :</label>
							<div class="col-sm-7">
								<input type="Email" class="form-control" value="<?php echo $inpchildemailindex?>" name="child<?php echo $i?>email" placeholder="Child Email">
								<?php echo ((form_error('child'.$i.'email')!=NULL)) ? '<span class="help-block">'.form_error('child'.$i.'email').'</span>' : '' ?>
							</div>
						</div>
						<div class="form-group <?php echo ((form_error('child'.$i.'phone')!=NULL)) ? 'has-error' : '' ?>">
							<label class="col-sm-5 control-label">Child<?php echo $i?> Mobile <font color="#FF0000">*</font> :</label>
							<div class="col-sm-6">
								<input type="text" class="form-control phone_no" value="<?php echo $inpchildphoneindex?>" name="child<?php echo $i?>mob"
								placeholder="8001124562">
								<?php echo ((form_error('child'.$i.'phone')!=NULL)) ? '<span class="help-block">'.form_error('child'.$i.'phone').'</span>' : '' ?>
							</div>
						</div>
						<?php if($i!=$this->child_count){?> <a href="#" id="child_info<?php echo $i+1?>">Add another</a> <?php } ?>
					</div>
					<?php } ?>
					
               		</div>
             	 </div> 
                 </div>
                 
                 </div>
                 <div class="text-center">
                 	<input style=" margin: 15px;" type="submit" class="btn btn-success" value="Submit"/>
                    <input style=" margin: 15px;" type="button" class="btn btn-danger" value="Cancel" onClick="javascript:window.location.href='<?php echo BASE_URL?>index.php/form';"/>
                    </div>
          	</form>
     </div>
     </div>
     
 </body>
</html>
<script src="<?php echo BASE_ASSETS?>js/bootstrap-datepicker.js"></script>
<script>
$('document').ready(function(){
	$('.spause_info').css('display','none');   
})
$('#marriage_status').change(function(event){
	showspouseinfo();
})
function showspouseinfo()
{
	var status = $('#marriage_status').val();
	if( status == "1"){
		$('.spause_info').css('display','block');
		$('#user_details').css('display','block');
	}
	else
	{
		$('.spause_info').css('display','none');
		$('#user_details').css('display','none');
	}
}
<?php if($marriage_status==1){?>
	$(function(event){
		showspouseinfo();
	})
<?php } for($i=1;$i<=$this->child_count;$i++){?>
$('#child_info<?php echo $i?>').click(function(event){
	$('#child<?php echo $i?>').css('display','block');
})
<?php } ?>
	
</script>

<script>
$(".phone_no").keydown(function(event) {
	// Allow: backspace, delete, tab, escape, enter and .
	if ( $.inArray(event.keyCode,[46,8,9,27,13,190]) !== -1 ||
	// Allow: Ctrl+A
	(event.keyCode == 65 && event.ctrlKey === true) ||
	// Allow: home, end, left, right
	(event.keyCode >= 35 && event.keyCode <= 39)) {
		// let it happen, don't do anything
		return;
	}
	else {
		// Ensure that it is a number and stop the keypress
		if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
			event.preventDefault();
		}
	}
});
</script>
 
 
