<?php $permissions = $this->session->userdata('permissions'); ?>
<div class="well" style="padding: 8px 0;">
	<ul class="nav nav-list">
		<li class="nav-header">Shortcuts</li>
		<li class="divider"></li>
		<li><a href="<?php echo BASE_URL?>admin/members">Users</a></li>
		<li><a href="<?php echo BASE_URL?>admin/blog_template">Blogs</a></li>
		<li><a href="<?php echo BASE_URL?>admin/faq">FAQ</a></li>
		<li><a href="<?php echo BASE_URL?>admin/email_template">Email Template</a></li>
		<li><a href="<?php echo BASE_URL?>admin/page_template">Page Template</a></li>
	</ul>
</div>
<?php $this->load->view('admin/left_menu/footer_left_view'); ?>