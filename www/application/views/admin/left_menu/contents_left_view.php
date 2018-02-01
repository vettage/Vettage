<?php $permissions = $this->session->userdata('permissions'); ?>
<div class="well" style="padding: 8px 0;">
	<ul class="nav nav-list">
		<li class="nav-header">Navigation</li>
		<li class="divider"></li>
		
		<li>
			<a href="<?php echo BASE_URL?>admin/contents"><i class="icon icon_users"></i>Contents</a>
		</li>
  	</ul>
</div>
<?php $this->load->view('admin/left_menu/footer_left_view'); ?>