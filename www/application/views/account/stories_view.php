<div class="container">
	<br />
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('delete_error')) ? '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : ''?>
	
	<div class="row">
		<div class="col-lg-4">
			<h3 class="less-mar-bottom">SUBMITTED FINAL PIECES</h3>
		</div>
		<div class="col-lg-12  pad-top">
			<div class="row">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th width="150">Title</th>
						<th>Tags</th>
						<th>Location</th>
						<!--<th>Download Link</th>-->
						<th>Date</th>
						<th style="text-align:center" width="60">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($content_details as $row) { 
						$location = $row->city.", ".$row->state.", ".$row->country;
						$date = date("F j, Y",strtotime($row->story_date));
						
						//$raw_details = $this->raw_media_model->get_single_record("raw_id='".$row->raw_id."'");
						//$link = $raw_details->links;
					?>
					<tr>
						<td><?php echo $row->title ?></td>
						<td><?php echo $row->tags ?></td>
						<td><?php echo $location ?></td>
						<!--<td><a href="<?php echo $link?>" target="_blank"><?php echo $link ?></a></td>-->
						<td><?php echo $date ?></td>
						<td style="text-align:center">
							<a href="<?php echo BASE_URL ?>collaborate/raw_media_pull/edit_submitted_final_piece?content_key=<?php echo $row->content_key?>"><i class="fa fa-pencil-square-o"></i></a> |
							<a href="<?php echo BASE_URL ?>collaborate/raw_media_pull/allotment?content_key=<?php echo $row->content_key?>" ><i class="fa fa-sitemap"></i></a>
						</td>
					</tr>
					<?php } ?>
					
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>