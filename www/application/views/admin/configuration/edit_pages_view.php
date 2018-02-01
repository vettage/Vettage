<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/configuration_left_view'); ?></div>
		<div class="span19">
			<h2><?php echo $title?></h2>
            <?php $menu_title 	= ($this->input->post('menu_title')!=NULL) ? $this->input->post('menu_title') : $page_temp_data->menu_title; 
			$description 	= ($this->input->post('description')!=NULL) ? $this->input->post('description') : $page_temp_data->description; ?>
			<div id="admin_index_statistics">
				<div class="row">
					<div class="span19">
						<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
							<div class="row-fluid">
									
									<div class="control-group">
										<label class="control-label">Alias:</label>
										<div class="controls"><input type="text" name="subject" id="subject" class="input-xlarge" disabled="disabled" value="<?php echo $page_temp_data->alias ?>">
										</div>
									</div>
								
									<div class="control-group <?php echo ((form_error('menu_title')!=NULL)) ? 'error' : '' ?>">
										<label class="control-label">Title <font color="#FF0000">*</font> :</label>
										<div class="controls"><input type="text" name="menu_title" id="menu_title" class="input-xlarge" value="<?php echo $menu_title ?>">
										<?php echo ((form_error('menu_title')!=NULL)) ? '<br /><span class="help-inline">'.form_error('menu_title').'</span>' : '' ?>
										</div>
									</div>
                                      <div class="control-group <?php echo ((form_error('description')!=NULL)) ? 'error' : '' ?>">
										<label class="control-label">Description <font color="#FF0000">*</font> :</label>
										<div class="controls">
										<?php 	
											include FCKROOT; 
											$fck 			 = new FCKeditor('description') ;
											$fck->Height 	 = '300';
											$fck->Width 	 = '600';
											$fck->ToolbarSet = "Default";
											$fck->BasePath   = FCKBASEPATH; 
											$fck->Value      = $description;
											$fck->Create();
										?>
										<?php echo ((form_error('description')!=NULL)) ? '<br /><span class="help-inline">'.form_error('description').'</span>' : '' ?>
										</div>
									</div>
									
									<div class="control-group">
										<div class="controls">
											<font color="#FF0000">*</font> Marked Fields are Mandatory
										</div>
									</div>
									
									
									<div class="form-actions text-right">
										<input type="submit" class="btn btn-info" value="Edit page template" /> 
										<button type="button" class="btn" onClick="javascript: document.location = '<?php echo BASE_URL.'admin/page_template';?>';">Cancel</button>
									</div>
								
							</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>