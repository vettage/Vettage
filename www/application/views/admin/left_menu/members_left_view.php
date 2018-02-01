<?php $permissions = $this->session->userdata('permissions'); ?>
<div class="well" style="padding: 8px 0;">
	<ul class="nav nav-list">
		<li class="nav-header">Navigation</li>
		<li class="divider"></li>
		
		<li <? if($this->uri->segment(2)=='members' && empty($_GET['action']) && ($this->uri->segment(3)=='' || $this->uri->segment(3)=='edit_member')) echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/members"><i class="icon icon_users"></i>Users</a>
		</li>
		<li <? if($this->uri->segment(2)=='members' && !empty($_GET['action'])) echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/members?action=Search" ><div class="icon icon_users_search"></div>Search Users</a>
		</li>
		<li <? if($this->uri->segment(2)=='members' && $this->uri->segment(3)=='new_member') echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/members/add"><div class="icon icon icon_users_add"></div>Add User</a>
		</li>
		
	</ul>
</div>
<?php $this->load->view('admin/left_menu/footer_left_view'); ?>