<div class="container">
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('delete_error')) ? '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : ''?>
	

	<div class="row">
		<div class="col-lg-4">
			<h3 class="less-mar-bottom">Locations of Expertise</h3>
		</div>
		<div class="col-lg-12  pad-top">
			<div class="row">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th width="150">City</th>
						<th>State</th>
						<th>Country</th>
						<th style="text-align:center" width="60">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($location_details as $row) { 
					?>
					<tr>
						<td><?php echo $row->city ?></td>
						<td><?php echo $row->state ?></td>
						<td><?php echo $row->country ?></td>
						<td style="text-align:center">
							<a href="<?php echo BASE_URL ?>account/locations?action=delete&id=<?php echo $row->location_id?>" >Delete</a>
						</td>
					</tr>
					<?php } ?>
					
				</tbody>
				</table>
			</div>
		</div>
	</div>
<?php $this->load->view('sub_parts/forms/location_map.php'); ?>
</div>




