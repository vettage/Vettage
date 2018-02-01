<div class="container">
	<br />
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('delete_error')) ? '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : ''?>
	
	<div class="row">
		<div class="col-lg-4">
			<h3 class="less-mar-bottom">RAW MEDIA</h3>
		</div>
		<div class="col-lg-12  pad-top">
         	<div class="row">
			<div class="row">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th>Format</th>
						<th>Tags</th>
						<th>Location</th>
						<th>Date/Time</th>
						<th>Link</th>
						<th style="text-align:center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if(empty($raw_list)){?>
					<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td></tr>
					<?php }else{
					foreach($raw_list as $row) :
						$member='';
						if($row->contributor_id>0){
							$details = $this->user_model->get_single_record("id='".$row->contributor_id."'");
							if($details!="0") $member=$details->username;
						}
						$location = $row->city.", ".$row->state.", ".$row->country;
						
						$time_event='';
						if($row->time_event!='')
							$time_event="/".substr($row->time_event,0,2).":".substr($row->time_event,2,2);
						$date = date("Ymd",strtotime($row->date)).$time_event;
						
						$content_details = $this->content_model->get_single_record("raw_id='".$row->raw_id."'");
					?>
					<tr>
						<td><?php echo trim($row->format,",");?></td>
						<td><?php echo $row->tags;?></td>
						<td><?php echo $location;?></td>
						<td><?php echo $date;?></td>
						<td><?php echo $row->links;?></td>
						<td style="text-align:center">
							<a href="<?php echo BASE_URL ?>collaborate/raw_media/submit?raw_key=<?php echo $row->raw_key?>"><i class="fa fa-pencil-square-o"></i></a> 
							<?php //if($content_details==NULL){?>
								| <a href="javascript:delete_raw_record('<?php echo $row->raw_key;?>');" >
                                <i class="fa fa-trash-o"></i></a>
							<?php //} ?>
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
</div>

