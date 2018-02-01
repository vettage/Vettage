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
						<form method="post" class="form-inline" >
						<div style="float:left"> 
						<span>
						<input type="text" name="srch_question" class="input-medium" value="<?php echo $this->input->post('srch_question');?>" placeholder="Search by question"/>
						</span>
						<input type="submit" name="sbt_srch" value="Search" class="btn btn-info" /> 
						</div>	
						<div style="float:right">
						<a href="<?php echo BASE_URL?>admin/faq/add/" class="btn btn-info">Add New</a>
						</div>
						</form>
						<p>&nbsp;</p><p>&nbsp;</p>
						
						<table class="table table-striped table-bordered table-condensed">
						<thead>
						<tr>
							<th width="25" style="text-align:center;">Sr No</th>
							<th width="200">Question</th>
							<th width="300">Answer</th>
							<th width="25" style="text-align:center;">Status</th>
							<th width="15" style="text-align:center;">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php if(empty($details)){?>
							<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
							</tr>
						<?php }else{$sr_no =$page;	
							foreach($details as $row) :
							$answer = $row->answer;
							if(strlen($answer)>140) $answer = substr($answer,0,140)."...";
						?>
						<tr>
							<td style="text-align:center;"><?php  echo $sr_no+1; $sr_no++; ?></td>
							<td><?php  echo $row->question; ?></td>
							<td><?php  echo $answer; ?></td>
							<td style="text-align:center"><a href="<?php echo BASE_URL?>admin/faq/status_change/<?php echo $row->faq_id?>"><?php echo($row->status =='1') ? 'Active' : 'Inactive'?></a></td>
							<td style="white-space:nowrap;text-align:center">
								<a title="Edit" href="<?php echo BASE_URL?>admin/faq/edit/<?php echo $row->faq_id;?>" class="icon_link">
									<div class="icon icon_edit"></div>
								</a>
								<a href="javascript:void(0);" onclick="return delete_record(<?php echo $row->faq_id;?>)" class="icon_link"><i class="icon icon_x_red"></i></a>
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
	 if (confirm("Are you sure you want to delete the FAQ record."))
	 {
		 window.location ='<?php echo BASE_URL.'admin/faq/delete/';?>'+record_id;
		 return true;
	 }
	 return false;
}
</script>