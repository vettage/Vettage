<div class="container">
	<div class="row">
    	<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		
		<div class="col-lg-4">
			<div role="toolbar" class="btn-toolbar pad-top">
				<div class="btn-group">
					<a class="btn btn-default btn-sm" href="<?php echo BASE_URL?>account">PROFILE</a>
					<?php if($this->type==1){ ?>
					<a class="btn btn-default btn-sm" href="<?php echo BASE_URL?>contributor/raw_media">RAW MEDIA</a>
					<?php } ?>
					<?php if($this->type==2){ ?>
					<a class="btn btn-default btn-sm" href="<?php echo BASE_URL?>editor/raw_media_pull/submitted_final_pieces">SUBMITTED FINAL PIECES</a>
					<?php } ?>
					<?php if($this->type==3){ ?>
					<a href="<?php echo BASE_URL?>subscribers/search" class="btn btn-default btn-sm">STORY SEARCH</a>
					<?php } ?>
					<a class="btn btn-default btn-sm active" href="javascript:void(0);">CONNECTIONS</a>
				</div>
			</div>
			<h3 class="less-mar-bottom">CONNECTIONS (<?php echo sizeof($connect_data) ?>)</h3>
		</div>
    	<div class="col-lg-8 col-nd-7 pad-top">
         	<div class="row">
            	<table class="table table-striped table-bordered table-condensed">
					   <thead>
							<tr>
								<th width="60" style="text-align:center;">Sr No</th>
								<th width="200">Request</th>
								<th width="120">Date</th>
								<th width="120" style="text-align:center">Status</th>
								<th width="120" style="text-align:center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if(empty($connect_data)){?>
								<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
								</tr>
							<?php }else {
								foreach($connect_data as $row) :
									
									$label = "";
									$member='Unknown';
									if($this->mem_id == $row->to_id)
									{
										$details = $this->member_model->get_single_record("mem_id='".$row->from_id."'");
										if($details!=NULL) $member=$details->username;
										$label = "From: ";
									}
									if($this->mem_id == $row->from_id)
									{
										$details = $this->member_model->get_single_record("mem_id='".$row->to_id."'");
										if($details!=NULL) $member=$details->username;
										$label = "To: ";
									}
									
									$status = '';
									if($row->status==0)
									{
										if($this->mem_id == $row->to_id){
											$status = '<a class="btn btn-primary" href="'.BASE_URL.'account/request_status/'.$row->conn_id.'/1">Accept</a>  <a class="btn btn-danger" href="'.BASE_URL.'account/request_status/'.$row->conn_id.'/2">Decline</a>';
										}
										else
											$status = 'Request sent';
									}
									if($row->status==1)
									{
										$status = 'Connected';
									}
									if($row->status==2)
									{
										$status = 'Declined';
									}
									
								?>
								<tr>
									 <td style="text-align:center;"><?php echo $row->conn_id;?></td>
									 <td><?php echo $label?><?php echo $member?></td>
									 <td><?php echo date("H:i, d-m-Y",strtotime($row->date));?></td>
									 <td style="text-align:center"><?php echo $status?></td>
									 <td style="text-align:center"> 
									 <?php if($status == 'Connected'){?>
									 	<a href="javascript:delete_record('<?php echo $row->conn_id;?>');" title="Remove Connection" ><i class="fa fa-trash-o"></i></a>
									 <?php } else echo "--" ?>
									 </td>
								</tr>
								<?php 
								endforeach;
							}?>
						 </tbody>
					</table>
            </div>
        </div>
     </div>
</div>

<script type="text/javascript">
function delete_record(id)
{
	 if (confirm("Are you sure you want to remove this connection.")){
		 window.location ='<?php echo BASE_URL.'account/request_delete/';?>'+id;
	 }
}
</script>