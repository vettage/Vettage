<?php $this->load->view('admin/sub_parts/header_view'); ?>
<?php $permissions = $this->session->userdata('permissions'); ?>
<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('error_msg')) ?  '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : '' ?>
        
        <?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/home_left_view'); ?></div>
		<div class="span19">
			<h1>Summary</h1>
			<div id="admin_index_statistics">
				
					<div class="row">
					<div class="span6">
						<h3>Users</h3>
						<ul>
							<li>
								Users
								<a class="badge <?php if($user_count>0) echo "badge-success";?>" href="<?php echo BASE_URL?>admin/members"><?php echo $user_count?></a>
							</li>
							<li>
								Registered this Week
								<a class="badge <?php if($user_reg_week>0) echo "badge-success";?>" href="javascript:void(0);"><?php echo $user_reg_week?></a>
							</li>
							<li>
								Total Today Registered Users
								<a class="badge <?php if($today_user>0) echo "badge-success";?>" href="javascript:void(0);"><?php echo $today_user?></a>
							</li>
							
							<li>
								Raw Media Contributors
								<a class="badge <?php if($today_user>0) echo "badge-success";?>" href="javascript:void(0);"><?php echo $contributors?></a>
							</li>
							<li>
								Editors
								<a class="badge <?php if($today_user>0) echo "badge-success";?>" href="javascript:void(0);"><?php echo $editors?></a>
							</li>
							
							<li>
								Subscribers
								<a class="badge <?php if($today_user>0) echo "badge-success";?>" href="javascript:void(0);"><?php echo $subscribers?></a>
							</li>
							
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('admin/sub_parts/footer_view'); ?>
