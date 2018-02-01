<?php $this->load->view('admin/sub_parts/header_view'); ?>
<div class="container">
	<div class="row">
    <?php  echo ($this->session->flashdata('error_msg')) ?  '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : '' ?>
        
        <?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<div class="span24">
			<div class="form-container">
				<form method="post" name="login" id="login_form" action="" class="form-horizontal">    
				<fieldset>
					<legend>Login</legend>
					<div class="alert alert-success" id="success" style="display:none"></div>
					<div class="alert alert-error" id="error" style="display:none"></div>
					<div class="control-group <?php echo ((form_error('txt_username')!=NULL)) ? 'error' : '' ?>">
						<label for="admin_login" class="control-label ">Username: <em>*</em></label>
						<div class="controls">
						 	<input type="text" value="" id="adm_login" name="txt_username" class="text">
						 	<?php echo ((form_error('txt_username')!=NULL)) ? '<br /><span class="help-inline">'.form_error('txt_username').'</span>' : '' ?>
						 </div>
					</div>
					<div class="control-group <?php echo ((form_error('txt_username')!=NULL)) ? 'error' : '' ?>">
						<label for="admin_login" class="control-label "><?php echo $this->lang->line("home_login_password");?>Password: <em>*</em></label>
						<div class="controls">
							<input type="password" value="" id="adm_password" name="txt_password" class="text">
							<?php  echo ((form_error('txt_password') != NULL)) ?   '<br /><span class="help-inline">'.form_error('txt_password').'</span>' : '' ?>
						</div>
					</div>
					<div class="form-actions">
						<button class="btn btn-info" id="login"><?php echo $this->lang->line("home_login_login");?>Login</button>&nbsp;
					</div>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
</script>
<?php $this->load->view('admin/sub_parts/footer_view'); ?>