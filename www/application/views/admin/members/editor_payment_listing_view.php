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
							<tr>
								<th  style="text-align:center;">ID</th>
								<th >Editor</th>
                                <th  style="text-align:center;">Content</th>    
                                <th>Total Price :</th>               
 								<th>Month</th>                                
						  </tr>
						</thead>
						<tbody>
							<?php if(empty($editor_data)){?>
								<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
								</tr>
							<?php }else{
								$i=0;$tot_price = 0;
								//print_r($editor_data); exit;
								foreach($editor_data as $row) :
								        $i++;
										$details = $this->member_model->get_single_record("id='".$row->editor."'");
										if($details!="0") 
										{
											$member[$i]=$details->firstname. ' '.$details->lastname;
										}
										
											$tot_price_details = $this->editor_payment_model->combox("sum(price) as price","editor='".$row->editor."'");
											$tot_price = !empty($tot_price_details[0]->price) ? $tot_price_details[0]->price : 0;
								?>
								<tr>
									<td style="text-align:center"><?php echo $i ?></td>
                                    <td>
									<?php if($i > 1) { if($member[$i] === $member[$i-1]) echo ''; else echo $member[$i]; } else echo $member[$i]; ?>
                                    </td>
                                    
                                    <td  style="text-align:center" > 
                                     <table style="border:none; width:100%;"> 
                                     <?php
									$payment_data = $this->editor_payment_model->combox('*',"editor=".$row->editor." ORDER BY id ASC");
									
									foreach($payment_data as $key) :										
										$content_details = $this->content_model->combox("title","content_id='".$key->content_id."'");
										
 								?>
                                    <tr>
                                    
                                      <td style="border:none;"><?php echo $content_details[0]->title;?></td>
                                      <td style="border:none;">$<?php echo number_format($key->price,2); ?></td>
                                    </tr>
                                    <?php 
								endforeach;
							?></table>
                                </td>    
                                    <td>$<?php echo number_format($tot_price,2); ?></td>
  									<td><?php echo $row->month ?></td>									
 								</tr>
								<?php 
								endforeach;
							}?>
						 </tbody>
					</table>					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
