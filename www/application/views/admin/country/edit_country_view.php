<?php 	$name 		= ($this->input->post('name')!=NULL) ? $this->input->post('name') : $country_details->name;
 
?>
<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/countries_left_view'); ?></div>
		<div class="span19">
			<h1><?php echo $title?></h1>
			<div id="admin_index_statistics">
            <form method="post" name="form" id="form" action="" class="form-horizontal">
				<div class="row">
                 <div class="span19">
                    <?php /*?><div class="pull-right">
						<form name="frm_item_per_page" method="post" action="" style="margin:0px;"> 
					<select name="items_per_page" id="items_per_page" class="input-small" onchange="javascript:frm_item_per_page.submit();">
							<?php 
							$items_per_page = $this->session->userdata('items_per_page');
							for($i=0;$i<sizeof($this->per_pages);$i++){
							?>
							<option value="<?php echo $this->per_pages[$i]?>" <?php if($items_per_page==$this->per_pages[$i]) echo 'selected="selected"';?>><?php echo $this->per_pages[$i]?></option>
							<?php } ?>
						</select>
						</form>
					</div><?php */?>
					 <div class="control-group" id="user_name-control-group">
							<label for="user_name" class="control-label ">Country:</label>        
							<div class="controls" id="user_city_controls">
								<input type="text" name="name" id="name" class="input-xlarge" value="<?php echo $name?>">
								<?php echo ((form_error('name')!=NULL)) ? '<br /><span class="help-inline">'.form_error('name').'</span>' : '' ?>
							</div>
						</div>
					<?php /*?><?php if($this->pagination->create_links()){?>
						<div class="pagination pagination-right"><?php echo $this->pagination->create_links();?></div>
					<?php }?><?php */?>
					</div><br /><br /><br />
                    <div class="controls">
                     <input type="submit" class="btn btn-info"  value="Edit" />
                     </div>
                  </div>
                 </form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function delete_record(record_id)
{
	 if (confirm("Are you sure you want to delete the country record.")){
		 window.location ='<?php echo BASE_URL.'admin/country/delete/';?>'+record_id;
	 }
}
</script>	