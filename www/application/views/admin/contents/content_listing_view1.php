<?php
$title  	= '';if($this->input->get('title')!=NULL)  $title = $this->input->get('title'); 
$city 		= '';if($this->input->get('city')!=NULL)  $city = $this->input->get('city'); 
$state 		= '';if($this->input->get('state')!=NULL) $state = $this->input->get('state'); 
$country 	= '';if($this->input->get('country')!=NULL) $country = $this->input->get('country'); 
$tags 		= '';if($this->input->get('tags')!=NULL) $tags = $this->input->get('tags'); 
$date  		= ''; if(!empty($_GET['date'])) $date = $_GET['date'];
//$location = $row->city.", ".$row->state.", ".$row->country;
?>
<div class="container">
	<div class="row">
		<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
		<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
		<div class="col-lg-4">
			<!--<div role="toolbar" class="btn-toolbar pad-top">
				<div class="btn-group">
					<a class="btn btn-default btn-sm" href="<?php echo BASE_URL?>account">PROFILE</a>
					<a class="btn btn-default btn-sm" href="<?php echo BASE_URL?>account/connections">CONNECTIONS</a>
					<a class="btn btn-default btn-sm active" href="javascript:void(0);">SUBMITTED FINAL PIECES</a>
				</div>
			</div>-->
			<h3 class="less-mar-bottom">SUBMITTED FINAL PIECES</h3>
		</div>
		<div class="col-lg-8 col-nd-7 pad-top">
			<div class="row">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th width="150">Title</th>
						<th>Tags</th>
						<th>Location</th>
						<th>Download Link</th>
						<th>Date</th>
						<th style="text-align:center" width="60">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($content_details as $row) { 
						$location = $row->city.", ".$row->state.", ".$row->country;
						$date = date("Ymd",strtotime($row->story_date));
						
						$raw_details = $this->raw_media_model->get_single_record("raw_id='".$row->raw_id."'");
						$link = $raw_details->links;
					?>
					<tr>
						<td><?php echo $row->title ?></td>
						<td><?php echo $row->tags ?></td>
						<td><?php echo $location ?></td>
						<td><a href="<?php echo $link?>" target="_blank"><?php echo $link ?></a></td>
						<td><?php echo $date ?></td>
						<td>abc</td>
					</tr>
					<?php } ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
 </div>     
