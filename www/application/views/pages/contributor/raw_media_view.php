<?php
$type  	= '';if(!empty($_GET['format'])) $format = $_GET['format'];
$city 		= '';if($this->input->get('city')!=NULL)  $city = $this->input->get('city'); 
$state 		= '';if($this->input->get('state')!=NULL) $state = $this->input->get('state'); 
$country 	= '';if($this->input->get('country')!=NULL) $country = $this->input->get('country'); 
$zipcode 	= '';if($this->input->get('zipcode')!=NULL) $zipcode = $this->input->get('zipcode'); 
$links 		= '';if($this->input->get('links')!=NULL) $links = $this->input->get('links'); 
$time_event = '';if($this->input->get('time_event')!=NULL) $time_event = $this->input->get('time_event'); 
$tags 		= '';if($this->input->get('tags')!=NULL) $tags = $this->input->get('tags'); 
$copyright  = '';if(!empty($_GET['copyright'])) $copyright = $_GET['copyright'];
$date  		= date('Ymd'); if(!empty($_GET['date'])) $date = $_GET['date'];
?>
 <div class="container">
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<div class="row">
		<div class="col-lg-4">
			<h3 class="less-mar-bottom">RAW MEDIA (<?php echo sizeof($raw_details) ?>)</h3>
		</div>
		<div class="col-lg-8 col-nd-7 pad-top">
			<div class="row">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th>Format</th>
						<th>Tags</th>
						<th>Location</th>
						<th>Date/Time</th>
						<th>Link</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if(empty($raw_details)){?>
					<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td></tr>
					<?php }else{
					foreach($raw_details as $row) :
						$member='';
						if($row->contributor_id>0){
							$details = $this->member_model->get_single_record("mem_id='".$row->contributor_id."'");
							if($details!="0") $member=$details->username;
						}
						$location = $row->city.", ".$row->state.", ".$row->country;
						
						$time_event='';
						if($row->time_event!='')
							$time_event="/".substr($row->time_event,0,2).":".substr($row->time_event,2,2);
						$date = date("Ymd",strtotime($row->date)).$time_event;
					?>
					<tr>
						<td><?php echo trim($row->format,",");?></td>
						<td><?php echo $row->tags;?></td>
						<td><?php echo $location;?></td>
						<td><?php echo $date;?></td>
						<td><?php echo $row->links;?></td>
						<td>
							<a href="<?php echo BASE_URL ?>contributor/raw_media/submit?raw_key=<?php echo $row->raw_key?>"><i class="fa fa-pencil-square-o"></i></a> | 
							<a href="javascript:delete_record('<?php echo $row->raw_key;?>');" ><i class="fa fa-trash-o"></i></a>
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
 	<br/>
	<div class="row">
		
	</div>
 </div>     
<script type="text/javascript">
function delete_record(raw_key)
{
	 if (confirm("Are you sure you want to delete the raw media record.")){
		 window.location ='<?php echo BASE_URL.'contributor/raw_media/delete?raw_key=';?>'+raw_key;
	 }
}
</script>