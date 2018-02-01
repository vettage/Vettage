<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		
		<div class="span5"><?php $this->load->view('admin/left_menu/members_left_view'); ?></div>
		<div class="span19">
			<h1><?php echo $title?></h1>
			<?php 
			$level 			= ($this->input->post('level')!=NULL) ? $this->input->post('level') : ''; 
			$email 			= ($this->input->post('email')!=NULL) ? $this->input->post('email') : ''; 
			$price 			= ($this->input->post('price')!=NULL) ? $this->input->post('price') : ''; 
			$payment_type 	= ($this->input->post('payment_type')!=NULL) ? $this->input->post('payment_type') : ''; 
			?>      
			<style type="text/css">
			.form-horizontal .control-label {
				width: 110px;
				text-align:left;
			}
			.form-horizontal .controls {
				margin-left: 100px;
			}
			</style>
			<form method="post" name="form-52202d724965c" id="form-52202d724965c" action="" class="form-horizontal"> 
			<div class="row">
				<div class="span12">
					<fieldset>
					
						<div class="control-group">
							<label for="user_organization" class="control-label ">Payment Type:</label>        
							<div class="controls" id="user_organization_controls" style="margin-top:6px">
								<strong>Bitwall/Bitcoin</strong>
							</div>
						</div>
						
						<div class="control-group <?php echo ((form_error('email')!=NULL)) ? 'error' : '' ?>" id="user_email-control-group">
							<label for="user_email" class="control-label ">Email:<em>*</em></label>        
							<div class="controls" id="user_email_controls">
								<input type="text" name="email" id="email" class="input-xlarge" value="<?php echo $email?>">
								<?php echo ((form_error('email')!=NULL)) ? '<br /><span class="help-inline">'.form_error('email').'</span>' : '' ?>
							</div>
						</div>
                        <div class="control-group <?php echo ((form_error('level')!=NULL)) ? 'error' : '' ?>" id="user_organization-control-group_level">
							<label for="user_organization" class="control-label ">Level:</label>        
							<div class="controls" id="user_organization_controls">
								<select name="level" id="level" class="input-xlarge" style="width:285px" >
									<option value=""  <?php if($level=='') echo 'selected="selected"';?>>Select Level</option>
									<option value="3" <?php if($level==3) echo 'selected="selected"';?>>PER STORY</option>
									<option value="4" <?php if($level==4) echo 'selected="selected"';?>>MONTHLY</option>
                                    <option value="5" <?php if($level==5) echo 'selected="selected"';?>>INSTITUTIONAL</option>
								</select>
								<?php echo ((form_error('level')!=NULL)) ? '<br /><span class="help-inline">'.form_error('level').'</span>' : '' ?>
							</div>
						</div>
						<div class="control-group <?php echo ((form_error('price')!=NULL)) ? 'error' : '' ?>" id="user_email-control-group">
							<label for="user_email" class="control-label ">Price:<em>*</em></label>        
							<div class="controls" id="user_email_controls">
								<input type="text" name="price" id="price" class="input-xlarge" value="<?php echo $price?>">
								<?php echo ((form_error('price')!=NULL)) ? '<br /><span class="help-inline">'.form_error('price').'</span>' : '' ?>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">&nbsp;</label>
							<div class="controls">
								<input type="submit" class="btn btn-info" value="Create" />
								<button type="button" class="btn" onClick="javascript: document.location = '<?php echo BASE_URL.'admin/members/payment';?>';">Cancel</button>
							</div>
						</div>
						
					</fieldset>    
				</div>
				
				
				
				
			</div>	
			 
			
			
			</form>   
			
		</div>
	</div>
</div>