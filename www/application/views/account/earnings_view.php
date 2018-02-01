<div class="container">
	<br />
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('delete_error')) ? '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : ''?>
	

	<div class="row">
		<div class="col-lg-4">
			<h3 class="less-mar-bottom">EARNINGS</h3>
		</div>
		<div class="col-lg-12  pad-top">
			<div class="row">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th width="300">Title</th>
						<th>Amount</th>
						<th>Rating Date</th>

					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($earnings_details as $row) { 
						$date = date("F j, Y",strtotime($row->rating_date));
						
					?>
					<tr>
						<td><a href="<? echo BASE_URL?>story/<?php echo $row->alias ?>"><?php echo $row->title ?></a></td>
						<td>$<?php echo $row->amount ?></td>
						<td><?php echo $date ?></td>
					</tr>
					<?php } ?>
					
				</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>