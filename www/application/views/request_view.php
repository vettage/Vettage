<div class="container">
	<div class="row">
    	<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		
		<div class="col-lg-4">
			<div role="toolbar" class="btn-toolbar pad-top">
				<div class="btn-group">
					<a class="btn btn-default btn-sm" href="<?php echo BASE_URL?>account">PROFILE</a>
					<a class="btn btn-default btn-sm active" href="<?php echo BASE_URL?>editor/raw_media_pull">CONNECTIONS</a>
				</div>
			</div>
			<h3 class="less-mar-bottom">CONNECTIONS</h3>
		</div>
    	<div class="col-lg-8 col-nd-7 pad-top">
         <div class="row">
            	<table class="table table-striped table-bordered table-condensed">
					   <thead>
							<tr>
								<th width="60" style="text-align:center;">Sr No</th>
								<th width="120">From/To</th>
								<th width="200">Date</th>
								<th width="120" style="text-align:center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if(empty($connect_data)){?>
								<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
								</tr>
							<?php }else {
								foreach($connect_data as $row) :
									
									$member='Unknown';
									if($this->mem_id == $row->to_id)
									{
										$details = $this->member_model->get_single_record("mem_id='".$row->from_id."'");
										if($details!="0") $member=$details->username;
									}
									if($this->mem_id == $row->from_id)
									{
										$details = $this->member_model->get_single_record("mem_id='".$row->to_id."'");
										if($details!="0") $member=$details->username;
									}
									
									$status = '';
									if($row->status==0)
									{
										if($this->mem_id == $row->to_id){
											$status = '<a class="btn btn-primary" href="'.BASE_URL.'account/request_status/'.$row->conn_id.'/1">Accept</a>  <a class="btn btn-danger" href="'.BASE_URL.'account/request_status/'.$row->conn_id.'/2">Reject</a>';
										}
										else
											$status = 'Request sent';
									}
									if($row->status==1)
									{
										$status = 'Accepted';
									}
									if($row->status==2)
									{
										$status = 'Rejected';
									}
									
								?>
								
								<tr>
									 <td style="text-align:center;"><?php echo $row->conn_id;?></td>
									 <td><?php echo $member?></td>
									 <td><?php echo date("H:i, d-m-Y",strtotime($row->date));?></td>
									 <td style="text-align:center"><?php echo $status?></td>
									 
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