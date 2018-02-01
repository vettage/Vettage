<div class="span10">
	<div class="pading-right">
	<div class="panel">		
		<div class="panel-header">
			 <i class="icon-book"></i><h2><?php echo $title?></h2>
		</div>
        	<form class="form-horizontal" method="post" enctype="multipart/form-data">
            	<div class="row-fluid">
                	<div class="span6">
                        <div class="control-group <?php echo ((form_error('title')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Title <font color="#3A87AD">*</font> :</label>
                            <div class="controls"><input type="text" name="title" id="title" class="input-xlarge" value="<?php echo $this->input->post('title');?>">
							<?php echo ((form_error('title')!=NULL)) ? '<br /><span class="help-inline">'.form_error('title').'</span>' : '' ?>
							</div>
                        </div>
                    	<div class="control-group <?php echo ((form_error('subject')!=NULL)) ? 'error' : '' ?>">
                            <label class="control-label">Subject <font color="#3A87AD">*</font> :</label>
                            <div class="controls"><input type="text" name="subject" id="subject" class="input-xlarge" value="<?php echo $this->input->post('subject');?>">
							<?php echo ((form_error('subject')!=NULL)) ? '<br /><span class="help-inline">'.form_error('subject').'</span>' : '' ?>
							</div>
                        </div>
                        
                        <div class="control-group <?php echo ((form_error('msg')!=NULL)) ? 'error' : '' ?>" 
                                      style="width: 68%;">
										<label class="control-label">Description <font color="#3A87AD">*</font> :</label>
							<div class="controls">
                          <?php (!empty($inpts['msg'])) ? $text=$inpts['msg'] : $text=''; ?>
                               <?php 	
								include_once CKEDITOR;
								include_once CKFINDER;
								$ckeditor = new CKEditor();
								$ckeditor->basePath = BASE_ASSETS.'ckeditor/';
								$ckfinder = new CKFinder();
								$ckfinder->BasePath = BASE_ASSETS.'ckfinder/'; 
								$ckfinder->SetupCKEditorObject($ckeditor);
								$ckeditor->editor('msg',$msg);
								?>
							<?php echo ((form_error('msg')!=NULL)) ? '<br /><span class="help-inline">'.form_error('msg').'</span>' : '' ?>
										</div>
									</div>
							<div class="control-group">
                            <div class="controls">
								<font color="#3A87AD">*</font> Marked Fields are Mandatory
							</div>
                        </div>
						
						<div class="form-actions text-right">
                        <input type="submit" class="btn btn-info" value="Add Email Template" /> 
					    <button type="button" class="btn" onClick="javascript: document.location = '<?php echo BASE_URL.'admin/email_temp';?>';">Cancel</button>
                    </div>
					 </div>
                </div>
                    
            </form>
    </div>
	</div>
</div>
    	
</div>

