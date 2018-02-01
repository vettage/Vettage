<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/members_left_view'); ?></div>
		<div class="span19">
			<h1><?php echo $title?></h1>
			<div id="admin_index_statistics">
				<div class="row">
					<div class="span19">
 				<?php /*?>	<div class="toggle_link">
						<p><i class="icon-search"></i> <a href="javascript:void(0);" class="toggle_link" id="users_search_link">Search Users</a></p>
						<div style="display: none" id="users_search">
							<form method="get" action="" class="well form-inline"> 
							<?php $fields=array("First Name"=>"firstname","Last Name"=>"lastname","Username"=>"username","Email"=>"email","Address Line 1"=>"address","Address Line 2"=>"address1","City"=>"city","State"=>"state","Country"=>"country","Zipcode"=>"zipcode","Phone"=>"phone","Fax"=>"fax");?>
							<label for="field" class="control-label ">Search in</label> 
							<select name="field" id="field" class="">
								<option value="" selected="selected"></option>
								<?php 
								$field = !empty($_GET['field']) ? $_GET['field'] : '';
								foreach($fields as $key=>$val){
								?>
								<option value="<?php echo $val?>" <?php if($field==$val) echo 'selected="selected"';?>><?php echo $key?></option>
								<?php } ?>
							</select>
							&nbsp;
							<label for="keyword" class="control-label ">for</label> 
							<input type="text" name="keyword" id="keyword" value="<?php echo @$_GET['keyword'];?>" class="input-large" placeholder="Search by name" style="width:150px;">
							&nbsp;
							<label for="group_id" class="control-label ">level</label> 
							<select name="level" id="level" class="" style="width:150px;">
								<option value="" selected="selected">All</option>
								<?php $level = !empty($_GET['level']) ? $_GET['level'] : ''; ?>
								<option value="1" <?php if($level==1) echo 'selected="selected"';?>>FREE</option>
								<option value="2" <?php if($level==2) echo 'selected="selected"';?>>MICROPAYMENTS / SHARING</option>
								<option value="3" <?php if($level==3) echo 'selected="selected"';?>>PER STORY</option>
								<option value="4" <?php if($level==4) echo 'selected="selected"';?>>MONTHLY</option>
								<option value="5" <?php if($level==5) echo 'selected="selected"';?>>INSTITUTIONAL</option>
							</select>
							&nbsp;
							<!--<label for="group_id" class="control-label ">in type</label> 
							<select name="type" id="type" class="" style="width:150px;">
								<option value="" selected="selected">All</option>
								<?php //$type = !empty($_GET['type']) ? $_GET['type'] : ''; ?>
								<option value="1" <?php //if($type==1) echo 'selected="selected"';?>>Raw Media Contributor</option>
								<option value="2" <?php //if($type==2) echo 'selected="selected"';?>>Editor</option>
								<option value="3" <?php //if($type==3) echo 'selected="selected"';?>>Subscriber</option>
							</select>-->
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
					</div><?php */?>
 					<div class="pull-right">
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
					</div>
					<table class="table table-striped table-bordered table-condensed">
						
					   <thead>
					   		<tr><td colspan="6" style="text-align:right"><a href="<?php echo BASE_URL?>admin/members/new_payment"><strong>New Payment</strong></a></td></tr>
							<tr>
								<th width="50" style="text-align:center;">ID</th>
								<th width="100">Username</th>
                                <th width="100">Payment type</th>
								<th width="100">Price</th>
								<th width="100">Date</th>
                                <th width="150" style="text-align:center">Membership</th>
								<?php /*?><th width="60" style="text-align:center">Status</th><?php */?>
						  </tr>
						</thead>
						<tbody>
							<?php if(empty($member_data)){?>
								<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
								</tr>
							<?php }else{
								foreach($member_data as $row) :
 								    if($row->level==1 || $row->level==0) 	$level = "FREE";
									if($row->level==2) 	$level = "MICROPAYMENTS / SHARING";
									if($row->level==3) 	$level = "PER STORY";
									if($row->level==4) 	$level = "MONTHLY";
									if($row->level==5) 	$level = "INSTITUTIONAL";
									
									$member='';$payment_status=0;
									if($row->mem_id>0){
										$details = $this->member_model->get_single_record("mem_id='".$row->mem_id."'");//print_r($details);exit;
										if($details!=NULL) 
										{
											$member=$details->username;
											$payment_status=$details->payment_status;
										}
									} 
									
									$payment_type = '';
									if($row->payment_type==1)  $payment_type = 'PayPal';
									if($row->payment_type==2)  $payment_type = 'Bitwall';
 								?>
								<tr>
									<td style="text-align:center;"><?php echo $row->upgrade_id;?></td>
									<td><?php echo $member ?></td>
 									<td><?php echo $payment_type ?></td>
									<td><?php echo $row->price ?></td>
									<td><?php echo date("Y-m-d H:i:s",strtotime($row->date)) ?></td>
                                      <td style="text-align:center">
										<?php echo $level ?>
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
			</div>
		</div>
	</div>
</div>
