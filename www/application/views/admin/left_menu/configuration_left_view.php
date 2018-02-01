<div class="well" style="padding: 8px 0;">
	<ul class="nav nav-list">
		
		<li <? if($this->uri->segment(2)=='blog_template' || $this->uri->segment(3)=='edit_blog') echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/blog_template"><i class="icon-list-alt icon-aqua"></i> Blogs</a>
		</li>
		 <li <? if($this->uri->segment(2)=='category' || $this->uri->segment(3)=='edit_category') echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/category"><i class="icon-list-alt icon-aqua"></i> Blog Category</a>
		</li>
		<li <? if($this->uri->segment(2)=='faq' && ($this->uri->segment(3)=='' || $this->uri->segment(3)=='index' || $this->uri->segment(3)=='add' || $this->uri->segment(3)=='edit') ) echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/faq"><i class="icon-list-alt icon-aqua"></i> FAQ</a>
		</li>
		<li <? if($this->uri->segment(2)=='email_template') echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/email_template"><i class="icon-list-alt icon-aqua"></i> Email Template</a>
		</li>
		<li <? if($this->uri->segment(2)=='page_template' || $this->uri->segment(3)=='edit_pages') echo 'class="active"';?>>
			<a href="<?php echo BASE_URL?>admin/page_template"><i class="icon-list-alt icon-aqua"></i> Page Template</a>
		</li>
        
	</ul>
</div>
<?php $this->load->view('admin/left_menu/footer_left_view'); ?>
	