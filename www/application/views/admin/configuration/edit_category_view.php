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
									 
									<div class="control-group <?php echo ((form_error('category_title')!=NULL)) ? 'error' : '' ?>">
										<label class="control-label">Title <font color="#3A87AD">*</font> :</label>
										<div class="controls"><input type="text" name="category_title" id="category_title" class="input-xlarge" value="<?php echo ((form_error('category_title')!=NULL)) ? $this->input->post('category_title') : $category_temp_data->category_title ?>">
										<?php echo ((form_error('category_title')!=NULL)) ? '<br /><span class="help-inline">'.form_error('category_title').'</span>' : '' ?>
										</div>
									</div>
									 
									<div class="control-group">
										<div class="controls">
											<font color="#3A87AD">*</font> Marked Fields are Mandatory
										</div>
									</div>
									
 									<div class="form-actions text-right">
										<input type="submit" class="btn btn-info" value="Edit Category" name="sbmt_edit_category" /> 
										<button type="button" class="btn" onClick="javascript: document.location = '<?php echo BASE_URL.'admin/category';?>';">Cancel</button>
									</div>
 							</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>