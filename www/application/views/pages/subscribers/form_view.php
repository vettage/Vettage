<?php 
			$title 	= ($this->input->post('title')!=NULL) ? $this->input->post('title') : ''; 
			$firstname 	= ($this->input->post('firstname')!=NULL) ? $this->input->post('firstname') : ''; 
			$lastname 	= ($this->input->post('lastname')!=NULL) ? $this->input->post('lastname') : ''; 
			$middlename = ($this->input->post('middlename')!=NULL) ? $this->input->post('middlename') : ''; 
			$gender 	= ($this->input->post('gender')!=NULL) ? $this->input->post('gender') : '';
  			$user_dob 	= ($this->input->post('user_dob')!=NULL) ? date("d-m-Y", strtotime($this->input->post('user_dob'))) :  '';
		    $username 	= ($this->input->post('username')!=NULL) ? $this->input->post('username') : ''; 
 			$email 		= ($this->input->post('email')!=NULL) ? $this->input->post('email') : ''; 
			$password 	= ($this->input->post('password')!=NULL) ? $this->input->post('password') : ''; 
 			$address1 	= ($this->input->post('address1')!=NULL) ? $this->input->post('address1') : ''; 
			$address2 	= ($this->input->post('address2')!=NULL) ? $this->input->post('address2') : ''; 
			$town 		= ($this->input->post('town')!=NULL) ? $this->input->post('town') : ''; 
			$postcode 	= ($this->input->post('postcode')!=NULL) ? $this->input->post('postcode') : ''; 
			$mob_no 	= ($this->input->post('mob_no')!=NULL) ? $this->input->post('mob_no') : ''; 
			$home_phone = ($this->input->post('home_phone')!=NULL) ? $this->input->post('home_phone') : ''; 
			$work_phone = ($this->input->post('work_phone')!=NULL) ? $this->input->post('work_phone') : '';
			$area_zone 	= ($this->input->post('area_zone')!=NULL) ? $this->input->post('area_zone') : '';
 			$bible_study_zone 	= ($this->input->post('bible_study_zone')!=NULL) ? $this->input->post('bible_study_zone') : '';
			$prayer_zone 	= ($this->input->post('prayer_zone')!=NULL) ? $this->input->post('prayer_zone') : '';
 			$marriage_status = ($this->input->post('marriage_status')!=NULL) ? $this->input->post('marriage_status') : '';
			$baptism_status 	= ($this->input->post('baptism_status')!=NULL) ? $this->input->post('baptism_status') : ''; 
 			$bible_study_group 	= ($this->input->post('bible_study_group')!=NULL) ? $this->input->post('bible_study_group') : ''; 
 			$employmt_status 	= ($this->input->post('employmt_status')!=NULL) ? $this->input->post('employmt_status') : ''; 
			$picture 	= ($this->input->post('picture')!=NULL) ? $this->input->post('picture') : ''; 
			$near_station 	= ($this->input->post('near_station')!=NULL) ? $this->input->post('near_station') : ''; 
			$skill 	= ($this->input->post('skill')!=NULL) ? $this->input->post('skill') : ''; 
			//$member_since 	= ($this->input->post('member_since')!=NULL) ? $this->input->post('member_since') : ''; 
			$branch_attend 	= ($this->input->post('branch_attend')!=NULL) ? $this->input->post('branch_attend') : ''; 
			$ministr_area_now 	= ($this->input->post('ministr_area_now')!=NULL) ? $this->input->post('ministr_area_now') : ''; 
			$ministr_area_old 	= ($this->input->post('ministr_area_old')!=NULL) ? $this->input->post('ministr_area_old') : ''; 
			$spouse_name 	= ($this->input->post('spouse_name')!=NULL) ? $this->input->post('spouse_name') : ''; 
			$spouse_lname 	= ($this->input->post('spouse_lname')!=NULL) ? $this->input->post('spouse_lname') : ''; 
			$spouse_dob 	= ($this->input->post('spouse_dob')!=NULL) ? date("d-m-Y", strtotime($this->input->post('spouse_dob'))) : ''; 
			$spouse_email 	= ($this->input->post('spouse_email')!=NULL) ? $this->input->post('spouse_email') : ''; 
		    $spouse_mob 	= ($this->input->post('spouse_mob')!=NULL) ? $this->input->post('spouse_mob') : ''; 
 			$spouse_work_phone 	= ($this->input->post('spouse_work_phone')!=NULL) ? $this->input->post('spouse_work_phone') : ''; 
			$spouse_baptism_status 	= ($this->input->post('spouse_baptism_status')!=NULL) ? $this->input->post('spouse_baptism_status') : ''; 
			$spouse_picture 	= ($this->input->post('spouse_picture')!=NULL) ? $this->input->post('spouse_picture') : ''; 
 			$spouse_skills 	= ($this->input->post('spouse_skills')!=NULL) ? $this->input->post('spouse_skills') : '';
		    $spouse_ministr_area_now 	= ($this->input->post('spouse_ministr_area_now')!=NULL) ? $this->input->post('spouse_ministr_area_now') : '';
			$image 		    =  ($this->input->post('image')!=NULL) ? $this->input->post('image') :''; 
			$member_since  		     = date('Ymd'); if(!empty($_POST['member_since'])) $date = $_POST['member_since'];
			
			
			/*$child1_name 	= ($this->input->post('child1_name')!=NULL) ? $this->input->post('child_name') : ''; 
			$child1_srname 	= ($this->input->post('child1_srname')!=NULL) ? $this->input->post('child_srname') : ''; 
			$child1_dob 	= ($this->input->post('child1_dob')!=NULL) ? $this->input->post('child_dob') : ''; 
			$child1_email 	= ($this->input->post('child1_email')!=NULL) ? $this->input->post('email') : ''; 
			$child1_phone 	= ($this->input->post('child1_phone')!=NULL) ? $this->input->post('phone') : ''; 
			
			$child2_name 	= ($this->input->post('child2_name')!=NULL) ? $this->input->post('child2_name') : ''; 
			$child2_sname 	= ($this->input->post('child2_sname')!=NULL) ? $this->input->post('child2_sname') : ''; 
			$child2_dob 	= ($this->input->post('child2_dob')!=NULL) ? $this->input->post('child2_dob') : ''; 
			$child2_email 	= ($this->input->post('child2_email')!=NULL) ? $this->input->post('child2_email') : ''; 
			$child2_phone 	= ($this->input->post('child2_phone')!=NULL) ? $this->input->post('child2_phone') : ''; 
			
			$child3_name 	= ($this->input->post('child3_name')!=NULL) ? $this->input->post('child3_name') : ''; 
			$child3_sname 	= ($this->input->post('child3_sname')!=NULL) ? $this->input->post('child3_sname') : ''; 
 			$child3_dob 	= ($this->input->post('child3_dob')!=NULL) ? $this->input->post('child3_dob') : ''; 
 			$child3_email 	= ($this->input->post('child3_email')!=NULL) ? $this->input->post('child3_email') : ''; 
			$child3_phone 	= ($this->input->post('child3_phone')!=NULL) ? $this->input->post('child3_phone') : ''; 
			
			$child4_sname 	= ($this->input->post('child4_sname')!=NULL) ? $this->input->post('child4_sname') : ''; 
			$child4_email 	= ($this->input->post('child4_email')!=NULL) ? $this->input->post('child4_email') : ''; 
			$child4_phone 	= ($this->input->post('child4_phone')!=NULL) ? $this->input->post('child4_phone') : ''; 
		    $child4_dob	= ($this->input->post('child2_dob')!=NULL) ? $this->input->post('child2_dob') : ''; 
 			$child4_name 	= ($this->input->post('child2_name')!=NULL) ? $this->input->post('child2_name') : ''; */


 ?>

 <?php //include('/sub_parts/header_view.php'); ?>
 <?php //include getcwd().'/sub_parts/header_view.php'; ?>
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
                        <label class="col-sm-5 control-label">Midle Name :</label>
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
                       <?php echo ((form_error('user_dob')!=NULL)) ? '<br /><span class="help-block"  style="margin-left:242px;">'.form_error('user_dob').'</span>' : '' ?>
                         </div>
                         <div class="form-group <?php echo ((form_error('username')!=NULL)) ? 'has-error' : '' ?>">
                        <label for="inputEmail3" class="col-sm-5 control-label">User Name <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control"  value="<?php echo $username?>" id="username" name="username" 
                          placeholder="User Name">
                          <?php echo ((form_error('username')!=NULL)) ? '<span class="help-block">'.form_error('username').'</span>' : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo ((form_error('email')!=NULL)) ? 'has-error' : '' ?>">
                        <label for="inputEmail3" class="col-sm-5 control-label">Email <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control"  value="<?php echo $email?>" id="email" name="email" placeholder="Email">
                          <?php echo ((form_error('email')!=NULL)) ? '<span class="help-block">'.form_error('email').'</span>' : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php echo ((form_error('password')!=NULL)) ? 'has-error' : '' ?>">
                        <label for="password" class="col-sm-5 control-label">Password<font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control"  value="<?php echo $password?>" id="password" name="password" placeholder="Password">
                          <?php echo ((form_error('password')!=NULL)) ? '<span class="help-block">'.form_error('password').'</span>' : '' ?>
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
                        <label class="col-sm-5 control-label">Address Line 2 :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $address2?>" id="inputaddress2" name="address2" placeholder="Address Line 2">
                          <?php //echo ((form_error('address2')!=NULL)) ? '<span class="help-block">'.form_error('address2').'</span>' : '                           ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('town')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Town :</label>
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
                        <label class="col-sm-5 control-label">Home Tel :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control phone_no" value="<?php echo $home_phone?>" id="teltext" name="home_phone" placeholder="Home Tel">
                          <?php //echo ((form_error('home_phone')!=NULL)) ? '<span class="help-block">'.form_error('home_phone').'</span>' : '                            ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('work_phone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Work Tel :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control phone_no" value="<?php echo $work_phone?>" id="worktext" name="work_phone" placeholder="Work Phone">
                          <?php //echo ((form_error('work_phone')!=NULL)) ? '<span class="help-block">'.form_error('work_phone').'</span>' : '                         ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('area_zone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Area Zone :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $area_zone?>" name="area_zone" id="areazone" placeholder="Area Zone">
						  <?php //echo ((form_error('area_zone')!=NULL)) ? '<span class="help-block">'.form_error('area_zone').'</span>' : '                         ' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('bible_study_zone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Bible Study Zone :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" value="<?php echo $bible_study_zone?>" name="bible_study_zone" id="areazone"                            placeholder="Bible Study Zone">
                          <?php //echo ((form_error('bible_study_zone')!=NULL)) ? '<span class="help-block">'.form_error('bible_study_zone').'</span>' : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('prayer_zone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Prayer Zone :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" value="<?php echo $prayer_zone?>" id="prayerzone" name="prayer_zone"                             placeholder="Prayer Zone">
                          <?php //echo ((form_error('prayer_zone')!=NULL)) ? '<span class="help-block">'.form_error('prayer_zone').'                             </span>' : '' ?>
                        </div>
                      </div>
                      
                      <div class="form-group <?php echo ((form_error('marriage_status')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Marriage Status :</label>
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
                        <label class="col-sm-5 control-label">Baptism Status :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control"  value="<?php echo $baptism_status?>" name="baptism_status" placeholder="Baptism Status">
                           <?php //echo ((form_error('baptism_status')!=NULL)) ? '<span class="help-block">'.form_error('baptism_status                           ').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('bible_study_group')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Bible Study Group :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="bible_study_group" value="<?php echo $bible_study_group?>" placeholder="Bible Study Group">
                           <?php 
						  // echo ((form_error('bible_study_group')!=NULL)) ? '<span class="help-block">'.form_error('bible_study_group').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('employmt_status')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Employment Status :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="employmt_status" value="<?php echo $employmt_status?>" placeholder="Employment Status">
                           <?php //echo ((form_error('employmt_status')!=NULL)) ? '<span class="help-block">'.form_error('employmt_status                           ').'</span>' : '' ?>
                        </div>
                      </div>
                      <div class="form-group <?php //echo ((form_error('image')!=NULL)) ? 'has-error' : '' ?> spause_info">
                            <label class="col-sm-5  control-label">Profile Picture  :</label>
                        	<div class="col-sm-7">
								<input name="image" id="image" type="file" class="input-xlarge"> 
                        		 <?php
								  //echo ((form_error('image')!=NULL)) ? '<span class="help-block">'.form_error('image').'</span>' : '' ?> 
							</div>
                         </div>
                           <div class="form-group <?php //echo ((form_error('near_station')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Nearest Station :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $near_station?>" name="near_station"
                           placeholder="Nearest Station">
                           <?php //echo ((form_error('near_station')!=NULL)) ? '<span class="help-block">'.form_error('near_station                           ').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('skill')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Skill :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $skill?>" name="skill" placeholder="Skill">
                           <?php //echo ((form_error('skill')!=NULL)) ? '<span class="help-block">'.form_error('skill').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('member_since')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Member Since :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="member_since" value="<?php echo $member_since?>" placeholder="Member Since">
                           <?php //echo ((form_error('member_since')!=NULL)) ? '<span class="help-block">'.form_error('member_since').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('branch_attend')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Branch You Attending :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="branch_attend" value="<?php echo $branch_attend?>" placeholder="Branch You Attending">
                           <?php //echo ((form_error('branch_attend')!=NULL)) ? '<span class="help-block">'.form_error('branch_attend').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('ministr_area_now')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Ministering Area Now :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="ministr_area_now" value="<?php echo $ministr_area_now?>" 
                          placeholder="Ministering Area Now">
                           <?php //echo ((form_error('ministr_area_now')!=NULL)) ? '<span class="help-block">'.form_error('ministr_area_now').'</span>' : '' ?>
                        </div>
                      </div>
                          <div class="form-group <?php //echo ((form_error('ministr_area_old')!=NULL)) ? 'has-error' : '' ?> spause_info">
                        <label class="col-sm-5 control-label">Ministering Area Before :</label>
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
                <label  class="col-sm-5 control-label">Spouse Surname :</label>
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
                       <?php echo ((form_error('spouse_dob')!=NULL)) ? '<br /><span class="help-block" style="margin-left:242px;">'.form_error('spouse_dob').'</span>' : '' ?>
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
                <label class="col-sm-5 control-label">Spouse Work Number :</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control phone_no" value="<?php echo $spouse_work_phone?>" name="spouse_work_phone" placeholder="1234567">
                   <?php
				    //echo ((form_error('spouse_work_phone')!=NULL)) ? '<span class="help-block">'.form_error('spouse_work_phone').'</span>' : '' ?>
                </div>
              </div>
                <div class="form-group <?php //echo ((form_error('spouse_baptism_status')!=NULL)) ? 'has-error' : '' ?>">
                <label class="col-sm-5 control-label">Spouse Baptism Status :</label>
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
                <label class="col-sm-5 control-label">Spouse Skill :</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" value="<?php echo $spouse_skills?>" name="spouse_skills" placeholder="Spouse Skill">
                   <?php 
				   //echo ((form_error('spouse_skills')!=NULL)) ? '<span class="help-block">'.form_error('spouse_skills').'</span>' : '' ?>
                </div>
              </div>
                <div class="form-group <?php //echo ((form_error('spouse_ministr_area_now')!=NULL)) ? 'has-error' : '' ?>">
                <label class="col-sm-5 control-label">Spouse Ministering Area Now :</label>
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
					  
					  //Array ( [title] => [firstname] => [middlename] => [lastname] => [user_dob] => 01-01-1970 [email] => [address1] => [address2] => [town] => [postcode] => [mob_no] => [home_phone] => [work_phone] => [area_zone] => [bible_study_zone] => [prayer_zone] => [marriage_status] => 1 [userfile] => [spouse_dob] => [child1name] => sadsada [child1surname] => [child1dob] => sadsa [child1email] => [child1mob] => [child2name] => fdgdfg [child2surname] => fdgdfg [child2dob] => dfdgfdfd [child2email] => [child2mob] => [child3name] => [child3surname] => [child3dob] => [child3email] => [child3mob] => [child4name] => [child4surname] => [child4dob] => [child4email] => [child4mob] => [gender] => ) 
					  
					  for($i=1;$i<=$this->child_count;$i++){
					  
						$inpchildnameindex 		= $this->input->post('child'.$i.'name');
						$inpchildsurnameindex 	= $this->input->post('child'.$i.'surname');
						$inpchilddobindex 		= $this->input->post('child'.$i.'dob');
						$inpchildemailindex 	= $this->input->post('child'.$i.'email');
						$inpchildphoneindex 	= $this->input->post('child'.$i.'mob');
						
						$style='';
						if($inpchildnameindex=='' && $inpchildsurnameindex=='' && $inpchilddobindex=='' && $inpchildemailindex=='' && $inpchildphoneindex=='')
							$style='style="display:none;"';
					  ?>
					  	<div  id="child<?php echo $i?>" <?php echo $style;?>>
                        <div class="form-group <?php echo ((form_error('child'.$i.'name')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child<?php echo $i?> Name  :</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control"  value="<?php echo $inpchildnameindex?>" name="child<?php echo $i?>name" placeholder="Child Name">
                        <?php
						 echo ((form_error('child'.$i.'name')!=NULL)) ? '<span class="help-block">'.form_error('child'.$i.'name').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('child'.$i.'surname')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child<?php echo $i?> Surname  :</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?php echo $inpchildsurnameindex?>" name="child<?php echo $i?>surname" 
                        placeholder="Child Surname">
                        <?php
						echo ((form_error('child'.$i.'surname')!=NULL)) ? '<span class="help-block">'.form_error('child'.$i.'surname').'</span>' : '' ?>
                        </div>
                        </div>
                         <div class="form-group <?php echo ((form_error('child'.$i.'dob')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child<?php echo $i?> Dob :</label>
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
                       <?php echo ((form_error('child'.$i.'dob')!=NULL)) ? '<br /><span class="help-block" style="margin-left:242px;">'.form_error('child'.$i.'dob').'</span>' : '' ?>
                         </div>
                          <div class="form-group <?php echo ((form_error('child'.$i.'email')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child<?php echo $i?> Email  :</label>
                        <div class="col-sm-7">
                        <input type="Email" class="form-control" value="<?php echo $inpchildemailindex?>" name="child<?php echo $i?>email" placeholder="Child Email">
                        <?php 
						echo ((form_error('child'.$i.'email')!=NULL)) ? '<span class="help-block">'.form_error('child'.$i.'email').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('child'.$i.'mob')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child<?php echo $i?> Mobile :</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control phone_no" value="<?php echo $inpchildphoneindex?>" name="child<?php echo $i?>mob"
                         placeholder="8001124562">
                        <?php
						 echo ((form_error('child'.$i.'mob')!=NULL)) ? '<span class="help-block">'.form_error('child'.$i.'mob').'</span>' : '' ?>
                        </div>
                        </div>
                       <?php if($i!=$this->child_count){?> <a href="#" id="child_info<?php echo $i+1?>">Add another</a> <?php } ?>
                      </div>
					  <?php } ?>
					
                     <?php /*?> <div  id="child1" style="display:none;"  >
                        <div class="form-group <?php echo ((form_error('child_name')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child Name  :</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?php echo $child_name?>" id="childname" placeholder="Child Name">
                        <?php echo ((form_error('child_name')!=NULL)) ? '<span class="help-block">'.form_error('child_name').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('child_srname')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child Surname <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?php echo $child_srname?>" id="childsurname" 
                        placeholder="Child Surname">
                        <?php 
						echo ((form_error('child_srname')!=NULL)) ? '<span class="help-block">'.form_error('child_srname').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('child_dob')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child Dob <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?php echo $child_dob?>" id="childdob" placeholder="Child Dob">
                        <?php echo ((form_error('child_dob')!=NULL)) ? '<span class="help-block">'.form_error('child_dob').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('email')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child Email <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                        <input type="Email" class="form-control" value="<?php echo $email?>" id="email" placeholder="Child Email">
                        <?php echo ((form_error('email')!=NULL)) ? '<span class="help-block">'.form_error('email').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('phone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child Mobile <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control phone_no" value="<?php echo $phone?>" id="childmob" 
                        placeholder="8001124562">
                        <?php echo ((form_error('phone')!=NULL)) ? '<span class="help-block">'.form_error('phone').'</span>' : '' ?>
                        </div>
                        </div>
                      <a href="#" id="child_info1">Add another</a>
                      </div>
                      <div  id="child2" style="display:none;">
                        <div class="form-group <?php echo ((form_error('child2_name')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child2 Name <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control"  value="<?php echo $child2_name?>" id="child2name" placeholder="Child Name">
                        <?php
						 echo ((form_error('child2_name')!=NULL)) ? '<span class="help-block">'.form_error('child2_name').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('child2_sname')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child2 Surname <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?php echo $child2_sname?>" id="child2surname" 
                        placeholder="Child Surname">
                        <?php
						 echo ((form_error('child2_sname')!=NULL)) ? '<span class="help-block">'.form_error('child2_sname').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('child2_dob')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child2 Dob <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?php echo $child2_dob?>" id="childdob" placeholder="Child Dob">
                        <?php
						 echo ((form_error('child2_dob')!=NULL)) ? '<span class="help-block">'.form_error('child2_dob').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('child2_email')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child2 Email <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                        <input type="Email" class="form-control" value="<?php echo $child2_email?>" id="2email" placeholder="Child Email">
                        <?php 
						echo ((form_error('child2_email')!=NULL)) ? '<span class="help-block">'.form_error('child2_email').'</span>' : '' ?>
                        </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('child2_phone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child2 Mobile <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control phone_no" value="<?php echo $child2_phone?>" id="child2mob"
                         placeholder="8001124562">
                        <?php
						 echo ((form_error('child2_phone')!=NULL)) ? '<span class="help-block">'.form_error('child2_phone').'</span>' : '' ?>
                        </div>
                        </div>
                       <a href="#" id="child_info2">Add another</a>
                      </div>
                      <div  id="child3" style="display:none;">
                         <div class="form-group <?php echo ((form_error('child3_name')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child3 Name <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $child3_name?>" id="child3name" placeholder="Child Name">
                           <?php
						    echo ((form_error('child3_name')!=NULL)) ? '<span class="help-block">'.form_error('child3_name').'</span>' : '' ?>
                        </div>
                      </div>
                         <div class="form-group <?php echo ((form_error('child3_sname')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child3 Surname <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $child3_sname?>" id="child3surname"
                           placeholder="Child Surname">
                           <?php 
						   echo ((form_error('child3_sname')!=NULL)) ? '<span class="help-block">'.form_error('child3_sname').'</span>' : '' ?>
                        </div>
                      </div>
                         <div class="form-group <?php echo ((form_error('child3_dob')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child3 Dob <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $child3_dob?>" id="child3dob" placeholder="Child Dob">
                           <?php 
						   echo ((form_error('child3_dob')!=NULL)) ? '<span class="help-block">'.form_error('child3_dob').'</span>' : '' ?>
                        </div>
                      </div>
                         <div class="form-group <?php echo ((form_error('child3_email')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child3 Email <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="Email" class="form-control" value="<?php echo $child3_email?>" id="3email" placeholder="Child Email">
                           <?php
						    echo ((form_error('child3_email')!=NULL)) ? '<span class="help-block">'.form_error('child3_email').'</span>' : '' ?>
                        </div>
                      </div>
                         <div class="form-group <?php echo ((form_error('child3_phone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child3 Mobile <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control phone_no" value="<?php echo $child3_phone?>" id="child3mob" 
                          placeholder="8001124562">
                           <?php
						    echo ((form_error('child3_phone')!=NULL)) ? '<span class="help-block">'.form_error('child3_phone').'</span>' : '' ?>
                        </div>
                      </div>
                       <a href="#" id="child_info3">Add another</a>
                      </div>
                      <div  id="child4" style="display:none;">
                        <div class="form-group <?php echo ((form_error('child4_name')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child4 Name <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $child4_name?>" id="child4name" placeholder="Child Name">
                           <?php 
						   echo ((form_error('child4_name')!=NULL)) ? '<span class="help-block">'.form_error('child4_name').'</span>' : '' ?>
                        </div>
                      </div>
                        <div class="form-group <?php echo ((form_error('child4_sname')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child4 Surname <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $child4_sname?>"  id="child4surname" 
                          placeholder="Child Surname">
                           <?php 
						   echo ((form_error('child4_sname')!=NULL)) ? '<span class="help-block">'.form_error('child4_sname').'</span>' : '' ?>
                        </div>
                      </div>
                        <div class="form-group <?php echo ((form_error('child4_dob')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child4 Dob <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="<?php echo $child4_dob?>" id="child4dob" placeholder="Child Dob">
                           <?php
						    echo ((form_error('child4_dob')!=NULL)) ? '<span class="help-block">'.form_error('child4_dob').'</span>' : '' ?>
                        </div>
                      </div>
                        <div class="form-group <?php echo ((form_error('child4_email')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child4 Email <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="Email" class="form-control"  value="<?php echo $child4_email?>" id="4email" placeholder="Child Email">
                           <?php
						    echo ((form_error('child4_email')!=NULL)) ? '<span class="help-block">'.form_error('child4_email').'</span>' : '' ?>
                        </div>
                      </div>
                        <div class="form-group <?php echo ((form_error('child4_phone')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Child4 Mobile <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control phone_no"  value="<?php echo $child4_phone?>"id="child4mob" 
                          placeholder="8001124562">
                           <?php echo ((form_error('child4_phone')!=NULL)) ? '<span class="help-block">'.form_error('child4_phone').'</span>' : '' ?>
                        </div>
                        
                      </div>
                      </div><?php */?>
               </div>
              </div> 
                 </div>
                 </div>
                 <div class="text-center">
                 	<input style=" margin: 15px;" type="submit" class="btn btn-success" value="Submit"/>
                    <input style=" margin: 15px;" type="button" class="btn btn-danger" value="Cancel" onClick="javascript:window.location.href='<?php echo BASE_URL?>index.php/form';" />
                    </div>
          	</form>
     </div>
     </div>
	 
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

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
<?php } 
for($i=1;$i<=$this->child_count;$i++){?>
	$('#child_info<?php echo $i?>').click(function(event){
		$('#child<?php echo $i?>').css('display','block');
	})
<?php } ?>
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
 
 
