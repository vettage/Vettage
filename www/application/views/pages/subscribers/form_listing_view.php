<?php 
$title 			 = ($this->input->post('title')!=NULL) ? $this->input->post('title') : ''; 
$firstname 		 = ($this->input->post('firstname')!=NULL) ? $this->input->post('firstname') : ''; 
$lastname 		 = ($this->input->post('lastname')!=NULL) ? $this->input->post('lastname') : ''; 
$town 			 = ($this->input->post('town')!=NULL) ? $this->input->post('town') : ''; 
$marriage_status = ($this->input->post('marriage_status')!=NULL) ? $this->input->post('marriage_status') : '';
$spouse_name 	 = ($this->input->post('spouse_name')!=NULL) ? $this->input->post('spouse_name') : ''; 
?>
		<div class="container">
			<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
			<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
            
			<div class="col-lg-12 tital_name">Application for ECFC UK
            <div>
            <?php if($this->session->userdata('fv_logged_in')!=FALSE){?>
            <li style="text-align:right;margin-top:-20px;"><a href="<?php echo BASE_URL?>index.php/form/logout">Log Out</a></li>
            <?php }else { ?>
             <li style="text-align:right;margin-top:-20px;"><a href="<?php echo BASE_URL?>index.php/login">Login</a></li>
            <?php } ?>
            </div>
            </div>
			<div class="row g1-border">
				<table class="table table-bordered">
				<thead>
				<tr>
					<td colspan="7" align="right"><a href="<?php echo BASE_URL ?>index.php/form/add">Add New</a></td>
				</tr>
				<tr>
					<th width="100">Title</th>
					<th width="50">First Name</th>
					<th width="50">Last Name</th>
					<th width="50">Marriage Status</th>
					<th width="60">Town</th>
					<th width="50">Spouse Name</th>
					<th style="text-align:center" width="60">Action</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				foreach($family_data as $row) { 
				?>
				<tr>
					<td><?php echo $row->title ?></td>
					<td><?php echo $row->firstname ?></td>
					<td><?php echo $row->lastname ?></td>
					<td><?php echo $row->marriage_status ?></a></td>
					<td><?php echo $row->town ?></td>
					<td><?php echo $row->spouse_name ?></td>
					<td style="text-align:center">
						<a href="<?php echo BASE_URL ?>index.php/form/edit/<?php echo $row->family_id?>"><i class="fa fa-pencil-square-o"></i></a> |
						<a href="javascript:delete_record('<?php echo $row->family_id;?>');" ><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
				<?php } ?>
				</tbody>
				</table>  
			</div>
		</div>
  
<script type="text/javascript">
function delete_record(id)
{
	if (confirm("Are you sure you want to remove this connection.")){
		window.location ='<?php echo BASE_URL.'index.php/form/request_delete/';?>'+id;
	}
}
</script>