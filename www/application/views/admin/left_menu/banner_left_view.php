<div class="well" style="padding: 8px 0;">
	<ul class="nav nav-list">
		<li class="nav-header">Navigation</li>
		<li class="divider"></li>
		<li <? if($this->uri->segment(2)=='banner_types' && ($this->uri->segment(3)=='' || $this->uri->segment(3)=='edit') ) echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/banner_types"><i class="icon icon_layout"></i>Banner Types</a>
		</li>
		<li <? if($this->uri->segment(2)=='banner_types' && ($this->uri->segment(3)=='add') ) echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/banner_types/add"><i class="icon icon_layout_add"></i>Add Banner Type</a>
		</li>
		<li <? if($this->uri->segment(2)=='banner' && ($this->uri->segment(3)=='' || $this->uri->segment(3)=='edit') ) echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/banner"><i class="icon icon_box"></i>Banners</a>
		</li>
		<li <? if($this->uri->segment(2)=='banner' && ($this->uri->segment(3)=='add') ) echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/banner/add"><i class="icon icon_box_add"></i>Add Banner</a>
		</li>
	</ul>
</div>
<?php $this->load->view('admin/left_menu/footer_left_view'); ?>