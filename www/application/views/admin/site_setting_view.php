<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/site_setting_left_view'); ?></div>
		<div class="span19">
			<h2><?php echo $title?></h2>
			<div id="admin_index_statistics">
				<div class="row">
					<div class="span19">
						<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <div class="control-group <?php echo ((form_error('adm_login')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Username <font color="#FF0000">*</font> :</label>
                            <div class="controls"><input type="text" name="adm_login" id="adm_login" class="input-xlarge" value="<?php echo ((form_error('adm_login')!=NULL)) ? $this->input->post('adm_login') : $account_data->adm_login ?>">
							<?php echo ((form_error('adm_login')!=NULL)) ? '<br /><span class="help-inline">'.form_error('adm_login').'</span>' : '' ?>
							</div>
                        </div>
                    	<div class="control-group <?php echo ((form_error('adm_password')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Password :</label>
                            <div class="controls"><input type="password" name="adm_password" id="adm_password" class="input-xlarge" value="" autocomplete="off">
							<br />
							<span class="help-inline" style="color:#000000"><em>keep it blank if you don't want to change password</em></span>
							</div>
                        </div>
						
						<div class="control-group <?php echo ((form_error('adm_name')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Name <font color="#FF0000">*</font>:</label>
                            <div class="controls"><input type="text" name="adm_name" id="adm_name" class="input-xlarge" value="<?php echo ((form_error('adm_name')!=NULL)) ? $this->input->post('adm_name') : $account_data->adm_name ?>">
							<br />
							</div>
                        </div>
						
						<div class="control-group <?php echo ((form_error('adm_email')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Email Address <font color="#FF0000">*</font> :</label>
                            <div class="controls"><input type="text" name="adm_email" id="adm_email" class="input-xlarge" value="<?php echo ((form_error('adm_email')!=NULL)) ? $this->input->post('adm_email') : $account_data->adm_email ?>">
							<?php echo ((form_error('adm_email')!=NULL)) ? '<br /><span class="help-inline">'.form_error('adm_email').'</span>' : '' ?>
							</div>
                        </div>
						<div class="control-group <?php echo ((form_error('adm_support_email')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Support Email <font color="#FF0000">*</font> :</label>
                            <div class="controls"><input type="text" name="adm_support_email" id="adm_support_email" class="input-xlarge" value="<?php echo ((form_error('adm_support_email')!=NULL)) ? $this->input->post('adm_support_email') : $account_data->adm_support_email ?>">
							<?php echo ((form_error('adm_support_email')!=NULL)) ? '<br /><span class="help-inline">'.form_error('adm_support_email').'</span>' : '' ?>
							</div>
                        </div>
						<div class="control-group <?php echo ((form_error('adm_info_email')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Info Email <font color="#FF0000">*</font> :</label>
                            <div class="controls"><input type="text" name="adm_info_email" id="adm_info_email" class="input-xlarge" value="<?php echo ((form_error('adm_info_email')!=NULL)) ? $this->input->post('adm_info_email') : $account_data->adm_info_email ?>">
							<?php echo ((form_error('adm_info_email')!=NULL)) ? '<br /><span class="help-inline">'.form_error('adm_info_email').'</span>' : '' ?>
							</div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Twitter Link :</label>
                            <div class="controls"><input type="text" name="twitter_link" id="twitter_link" class="input-xlarge" value="<?php echo ((form_error('twitter_link')!=NULL)) ? $this->input->post('twitter_link') : $account_data->twitter_link ?>">
							</div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Facebook Link :</label>
                            <div class="controls"><input type="text" name="facebook_link" id="facebook_link" class="input-xlarge" value="<?php echo ((form_error('facebook_link')!=NULL)) ? $this->input->post('facebook_link') : $account_data->facebook_link ?>">
							</div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Linkedin Link :</label>
                            <div class="controls"><input type="text" name="linked_in_link" id="linked_in_link" class="input-xlarge" value="<?php echo ((form_error('linked_in_link')!=NULL)) ? $this->input->post('linked_in_link') : $account_data->linked_in_link ?>">
							</div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Pinterest Link :</label>
                            <div class="controls"><input type="text" name="pinterest_link" id="pinterest_link" class="input-xlarge" value="<?php echo ((form_error('pinterest_link')!=NULL)) ? $this->input->post('pinterest_link') : $account_data->pinterest_link ?>">
							</div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Dribble Link  :</label>
                            <div class="controls"><input type="text" name="dribble_link" id="dribble_link" class="input-xlarge" value="<?php echo ((form_error('dribble_link')!=NULL)) ? $this->input->post('dribble_link') : $account_data->dribble_link ?>">
							</div>
                        </div>
						<div class="control-group">
                            <div class="controls">
								<font color="#FF0000">*</font> Marked Fields are Mandatory
							</div>
                        </div>
						
						<div class="form-actions">
                        	<input type="submit" class="btn btn-info" name="sbmt_edit" value="Edit" /> 
                   	</div>
            </form>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>