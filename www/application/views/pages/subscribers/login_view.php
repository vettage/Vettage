<div class="container">
    	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
    <?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
    <div class="col-lg-12 tital_name">Login</div>
    <div class="row g1-border">
        	<form  role="form" method="post"  action="" name="login">
                <div class="row">
                  <div class="col-lg-6 "><br>
                      <div class="form-horizontal paddinh5"  id="user_list">
                        <div class="form-group <?php echo ((form_error('username')!=NULL)) ? 'has-error' : '' ?>">
                        <label  class="col-sm-5 control-label">Username <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="username" name="username" 
                          value="<?php echo $this->input->post('username');?>" placeholder="UserName">
                          <?php echo ((form_error('username')!=NULL)) ? '<span class="help-block">'.form_error('username').'</span>' : '' ?>
                        </div>
                      </div>
                        <div class="form-group <?php echo ((form_error('password')!=NULL)) ? 'has-error' : '' ?>">
                        <label class="col-sm-5 control-label">Password <font color="#FF0000">*</font> :</label>
                        <div class="col-sm-6">
                          <input type="password" class="form-control"  name="password" id="password" 
                          value="<?php echo $this->input->post('password');?>" 
                          placeholder="Password">
                          <?php echo ((form_error('password')!=NULL)) ? '<span class="help-block">'.form_error('password').'</span>' :                          '' ?>
                          </div>
                        </div>
                      </div>
                    </div>
                   </div>
                   <div class="col-sm-offset-4 col-sm-8">
                   <small ><a href="<?php echo BASE_URL?>index.php/forgot_pwd">Forgot Username and Password</a></small><br />
                 	<input style="margin: 15px;" type="submit" class="btn btn-success" id="login" value="Login"/>
                    </div>
            </form>
     </div>
     </div>
  

