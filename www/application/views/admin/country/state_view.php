<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/countries_left_view'); ?></div>
		<div class="span19">
			<h1><?php echo $title?></h1>
			<div id="admin_index_statistics">
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
					<table class="table table-striped table-bordered table-condensed">
					   <thead>
							<tr><td colspan="3" style="text-align:right"><a href="<?php echo BASE_URL?>admin/country/add_states/<?php echo $country_id;?>">Add</a> </td></tr>
                            <tr>
 								<th width="50" style="text-align:center;">ID</th>
								<th width="90" >All States</th>
								<th width="90" >Action</th>
 							</tr>
						</thead>
						<tbody>
							<?php if(empty($states)){?>
								<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
								</tr>
							<?php }else{
								foreach($states as $row) :
 								?>
                                    <tr>
 									<td style="text-align:center;"><?php echo $row->state_id;?></td>
									<td><?php echo $row->name?></td>
                                     <td style="text-align:center">
                                      <a title="Edit" href="<?php echo BASE_URL?>admin/country/edit_states/<?php echo $row->state_id;?>" 
                                      class="icon_link"><div class="icon icon_edit"></div></a> |
						              <a href="javascript:delete_record('<?php echo $row->state_id;?>');" >Del</a> |
                                      <a href="<?php echo BASE_URL?>admin/country/cities/<?php echo $row->state_id;?>">Cities</a></td>
                                      </td>
								</tr>
								<?php 
								endforeach;
							}?>
						 </tbody>
					</table>
					<?php /*?><?php if($this->pagination->create_links()){?>
						<div class="pagination pagination-right"><?php echo $this->pagination->create_links();?></div>
					<?php }?><?php */?>
					</div>
				</div>
              <button type="button" class="btn" onClick="javascript: document.location = '<?php echo BASE_URL.'admin/country/';?>';">Back</button>
 			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function delete_record(record_id)
{
	 if (confirm("Are you sure you want to delete the state record.")){
		 window.location ='<?php echo BASE_URL.'admin/country/delete_state/';?>'+record_id;
	 }
}
</script>	