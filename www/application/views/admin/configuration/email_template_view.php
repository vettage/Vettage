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
                        <div style="margin-bottom: 10px;" class="btn-group">
							<?php foreach($email_types as $key=>$val) { ?>
								 <?php if($key==0){?>                                
									<a class="btn btn-small <?php echo($filter==0) ? 'active':''?>" href="<?php echo BASE_URL?>admin/email_template/">All</a>
								<?php } else {?>
									<a class="btn btn-small <?php echo($filter==$key) ? 'active':''?>" href="<?php echo BASE_URL?>admin/email_template/index?filter=<?php echo $key?>"><?php echo $val?></a>
							<?php }
							} ?>
                        
                        </div>
						<table class="table table-striped table-bordered table-condensed">
						<thead>
						<tr>
						<th width="39" style="text-align:left;">Type</th>
						<!--<th width="160">Name</th>-->
						<th width="500" style="text-align:left;">Subject</th>
						<!--<th width="160">Message</th>-->
                        <th width="39" style="text-align:center;">Status</th>
						<th width="43" style="text-align:center;">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php if(empty($email_temp_data)){?>
						<tr><td colspan="100%" align="center"><strong>No Records Available</strong></td>
						</tr>
						<?php }else{$sr_no =1;	
						foreach($email_temp_data as $row) :
						?>
						<tr>
						<td style="text-align:left;"><?php  echo $email_types[$row->type] ?></td>
						<?php /*?><td><?php  echo $row->title; ?></td><?php */?>
						<td><?php  echo $row->subject; ?></td>
						<?php /*?><td><?php  echo strip_tags(substr($row->msg,0,100).'...'); ?></td><?php */?>
                        <td style="text-align:center;">
                        <?php echo($row->status==1)? '<div class="icon icon_1"></div>':'<div class="icon icon_0"></div>'?>
                        </td>
						<td style="white-space:nowrap; text-align:center; vertical-align:middle;">
						<a href="<?php echo BASE_URL?>admin/email_template/edit_email/<?php echo $row->temp_id ;?>" class="icon_link"><i class="icon icon_edit"></i></a>
						<?php /*?><a onclick="return delete_record(<?php echo $row->temp_id;?>)" class="btn btn-mini btn-danger"><i class="icon-white icon-trash"></i></a><?php */?>
						</td>
						</tr>
						<?php 
						endforeach;
						}?>
						</tbody>
						</table>
						
						<?php if($this->pagination->create_links()){?>
							<div class="pagination pagination-right"><?php echo $this->pagination->create_links();?></div>
						<?php }?>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>


    	

<script type="text/javascript">
	function delete_record(record_id)
	{
		 if (confirm("Are you sure you want to delete the email record."))
		 {
		 	 window.location ='<?php echo BASE_URL.'admin/email_template/delete/';?>'+record_id;
			 return true;
		 }
		 return false;
	}
</script>	



