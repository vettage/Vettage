<div class="well" style="padding: 8px 0;">
	<ul class="nav nav-list">
		<li class="nav-header">Navigation</li>
		<li class="divider"></li>
		<li <? if($this->uri->segment(2)=='categories' && ($this->uri->segment(3)=='' || $this->uri->segment(3)=='edit') ) echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/categories"><i class="icon icon_folder"></i>Categories</a>
		</li>
		<li <? if($this->uri->segment(2)=='categories' && ($this->uri->segment(3)=='add') ) echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/categories"><i class="icon icon_folder_add"></i>Add Category</a>
		</li>
	</ul>
</div>
<?php $this->load->view('admin/left_menu/footer_left_view'); ?>