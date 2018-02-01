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
                    <div class="toggle_link">
						<p><i class="icon-search"></i> <a href="javascript:void(0);" class="toggle_link" id="users_search_link">Search Country</a></p>
						<div style="display: none" id="users_search">
							<form method="get" action="" class="well form-inline"> 
							<?php 
							$fields=array("Country"=>"country");
							$field = !empty($_GET['field']) ? $_GET['field'] : '';
							?>
                            <label for="keyword" class="control-label "> </label> 
							<input type="text" name="keyword" id="keyword" value="<?php echo @$_GET['keyword'];?>" class="input-large" placeholder="Country">
							<input type="submit" name="action" id="submit" value="Search" class="btn ">            
							</form>
						</div>
						 <script type="text/javascript">
							$(document).ready(function() {
								$("#users_search_link").click(function(){
									$("#users_search").slideToggle();
								});
							});
							<?php if(!empty($_GET['action']) && $_GET['action']=="Search"){?>$("#users_search").slideToggle();<?php }?>
						</script>
					</div>
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
							<tr>
								<th width="50" style="text-align:center;">Code</th>
								<th width="90" >Name</th>
								<th width="90" style="text-align:center">Action</th>
 							</tr>
						</thead>
						<tbody>
							<?php if(empty($countries)){?>
								<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
								</tr>
							<?php }else{
								foreach($countries as $row) :
 								?>
								<tr>
									<td style="text-align:center;"><?php echo $row->code;?></td>
									<td><?php echo $row->name?></td>
                                     <td style="text-align:center">
                                      <a title="Edit" href="<?php echo BASE_URL?>admin/country/edit_country/<?php echo $row->country_id;?>" 
                                      class="icon_link"><div class="icon icon_edit"></div></a> |
						              <a href="javascript:delete_record('<?php echo $row->country_id;?>');" >Del</a> |
                                      <a href="<?php echo BASE_URL?>admin/country/states/<?php echo $row->country_id;?>">States</a></td>
                                     </td>
								</tr>
								<?php 
								endforeach;
							}?>
						 </tbody>
					</table>
					<?php if($this->pagination->create_links()){?>
						<div class="pagination pagination-right"><?php echo $this->pagination->create_links();?></div>
					<?php }?>
					</div>
				</div>
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