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
			
                        <div class="control-group <?php echo ((form_error('question')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Question <font color="#3A87AD">*</font> :</label>
                            <div class="controls"><input type="text" name="question" id="question" class="input-xlarge" value="<?php echo ($this->input->post('question')!=NULL) ? $this->input->post('question') : $faq_data->question?>">
							<?php echo (form_error('question')!=NULL) ? '<span class="help-inline">'.form_error('question').'</span>' : '' ?>
							</div>
                        </div>
                            <div class="control-group <?php echo ((form_error('answer')!=NULL)) ? 'error' : '' ?>">
                                                        <label class="control-label">Answer <font color="#3A87AD">*</font> :</label>
                                                        <div class="controls">
                                                        <?php $text= ($this->input->post('answer')!=NULL) ? $this->input->post('answer'): $faq_data->answer ; ?>
                                                        <?php 	
                                                            include FCKROOT; 
                                                            $fck 			 = new FCKeditor('answer') ;
                                                            $fck->Height 	 = '300';
                                                            $fck->Width 	 = '600';
                                                            $fck->ToolbarSet = "Default";
                                                            $fck->BasePath   = FCKBASEPATH; 
                                                            $fck->Value      = $text;
                                                            $fck->Create();
                                                        ?>
                                                        <?php echo ((form_error('answer')!=NULL)) ? '<br /><span class="help-inline">'.form_error('answer').'</span>' : '' ?>
                                                        </div>
                                                    </div>
						<div class="control-group">
                            <div class="controls">
								<font color="#3A87AD">*</font> Marked Fields are Mandatory
							</div>
                        </div>
						
						<div class="form-actions">
                        	<input type="submit" class="btn btn-info"  value="Edit" /> 
                   	</div>
            </form>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>