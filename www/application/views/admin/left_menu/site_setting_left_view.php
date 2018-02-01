<?php $permissions = $this->session->userdata('permissions'); ?>
<div class="well" style="padding: 8px 0;">
	<ul class="nav nav-list">
		<li <? if($this->uri->segment(2)=='site_settings' && $this->uri->segment(3)=='') echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/site_settings"><i class="icon-list-alt icon-aqua"></i> My Account</a>
		</li>
	</ul>
</div>
<?php $this->load->view('admin/left_menu/footer_left_view'); ?>        