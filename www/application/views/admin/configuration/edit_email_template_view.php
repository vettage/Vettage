<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/configuration_left_view'); ?></div>
		<div class="span19">
			<h2><?php echo $title?></h2>
			<div id="admin_index_statistics">
				<div class="row">
					<div class="span19">
						<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
						<div class="row-fluid">
							<div class="control-group <?php echo ((form_error('title')!=NULL)) ? 'error' : '' ?>">
								<label class="control-label">Title <font color="#FF0000">*</font> :</label>
								<div class="controls" style="margin-top:5px;"><strong><?php echo $email_temp_data->title?></strong></div>
							</div>
							<input type="hidden" name="title" id="title" class="input-xlarge" 
							value="<?php echo ((form_error('title')!=NULL)) ? $this->input->post('title') : $email_temp_data->title ?>">
							<div class="control-group <?php echo ((form_error('subject')!=NULL)) ? 'error' : '' ?>">
								<label class="control-label">Subject <font color="#FF0000">*</font> :</label>
								<div class="controls"><input type="text" name="subject" id="subject" class="input-xlarge" value="<?php echo ((form_error('subject')!=NULL)) ? $this->input->post('subject') : $email_temp_data->subject ?>">
								<?php echo ((form_error('subject')!=NULL)) ? '<br /><span class="help-inline">'.form_error('subject').'</span>' : '' ?>
								</div>
							</div>
							
                            <div class="control-group <?php echo ((form_error('msg')!=NULL)) ? 'error' : '' ?>">
								<label class="control-label">Message <font color="#FF0000">*</font> :</label>
								<div class="controls">
								<?php (!empty($inpts['msg'])) ? $text=$this->input->post('msg'): $text=$email_temp_data->msg ; ?>
								<?php 	
									include FCKROOT; 
									$fck 			 = new FCKeditor('msg') ;
									$fck->Height 	 = '300';
									$fck->Width 	 = '600';
									$fck->ToolbarSet = "Default";
									$fck->BasePath   = FCKBASEPATH; 
									$fck->Value      = $text;
									$fck->Create();
								?>
								<?php echo ((form_error('msg')!=NULL)) ? '<br /><span class="help-inline">'.form_error('msg').'</span>' : '' ?>
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label">Status <font color="#FF0000">*</font> :</label>
								<div class="controls">
                                <?php $status = ((form_error('status')!=NULL)) ? $this->input->post('status') : $email_temp_data->status ?>
                                <select name="status" id="status">
                                	<option value="1" <?php echo($status==1) ? 'selected="selected"' : ''?>>Enabled</option>
                                    <option value="0" <?php echo($status==0) ? 'selected="selected"' : ''?>>Disabled</option>
                                </select>
								</div>
							</div>
                            
							<div class="control-group">
								<div class="controls">
									<font color="#FF0000">*</font> Marked Fields are Mandatory
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<div class="form-actions text-left" style="width:550px;padding-left:0px;">
										<input type="submit" class="btn btn-info" value="Edit email template" /> 
										<button type="button" class="btn" onClick="javascript: document.location = '<?php echo BASE_URL.'admin/email_template';?>';">Cancel</button>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>