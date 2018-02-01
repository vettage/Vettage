<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/story_left_view'); ?></div>
		<div class="span19">
			<h1><?php echo $title?></h1>
			<div id="admin_index_statistics">
				<div class="row">
					<div class="span19">
 		            			<?php /*?><div class="toggle_link">
						<p><i class="icon-search"></i> <a href="javascript:void(0);" class="toggle_link" id="users_search_link">Search Contents</a></p>
						<div style="display: none" id="users_search">
							<form method="get" action="" class="well form-inline"> 
							<?php 
							$fields=array("Title"=>"title","Tags"=>"tags","City"=>"city","State"=>"state","Country"=>"country","Zipcode"=>"postal_code");
							$field = !empty($_GET['field']) ? $_GET['field'] : '';
							?>
							<label for="field" class="control-label ">Search in</label> 
							<select name="field" id="field" class="">
								<option value="" selected="selected"></option>
								<option value="user" <?php if($field=="user") echo 'selected="selected"';?>>Username</option>
								<?php 
								foreach($fields as $key=>$val){
								?>
								<option value="<?php echo $val?>" <?php if($field==$val) echo 'selected="selected"';?>><?php echo $key?></option>
								<?php } ?>
							</select>
							&nbsp;
							<label for="keyword" class="control-label ">for</label> 
							<input type="text" name="keyword" id="keyword" value="<?php echo @$_GET['keyword'];?>" class="input-large" placeholder="Search by name">
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
					</div><?php */?>
					<table class="table table-striped table-bordered table-condensed">
					   <thead>
							<tr>
								<th width="50" style="text-align:center;">ID</th>
								<th width="200">Title</th>
 								<th width="200">Ratings</th>
                                <th width="80">Total(%)</th>
                                <th width="190">Distribution(%)</th>
								<th width="90" style="text-align:center">Date</th>
 							</tr>
						</thead>
						<tbody> 							
                                <?php 
								foreach($story_data as $row): 
								$rating_details = $this->content_ratings_model->custom_query("SELECT AVG(importance) as importance,AVG(credibility) as credibility,AVG(timeline) as timeline,AVG(appearance) as appearance from content_ratings WHERE content_id='".$row->content_id."'");
								$importance = (int) $rating_details[0]->importance;
								$credibility = (int) $rating_details[0]->credibility;
								$timeline = (int) $rating_details[0]->timeline;
								$appearance = (int) $rating_details[0]->appearance;
                                 
								?>
								<tr>
                                
									<td style="text-align:center;"><?php echo $row->content_id;?></td>
									<td><?php echo $row->title?></td>
									<td>
                                        <table width="100%" style="border:none">
                                         <tr>
                                              <td style="border:none" width="40%">IMPORTANCE</td><td style="border:none" width="10%">:</td><td                                              style="border:none"><?php echo $importance?>
                                           </td>
                                         </tr>
                                        <tr>
                                           <td style="border:none">CREDIBILITY</td><td style="border:none">:</td><td style="border:none"><?php                                            echo $credibility?>
                                           </td>
                                        </tr>
                                        <tr>
                                            <td style="border:none">TIMELINESS</td><td style="border:none">:</td><td style="border:none">
										    <?php echo $timeline?>
                                           </td>
                                         </tr>
                                        <tr>
                                           <td style="border:none">APPEARANCE</td><td style="border:none">:</td><td style="border:none">
										   <?php echo $appearance?>
                                           </td>
                                        </tr>
                                        </table>
									</td>
                                   	<td><?php  echo $total = round(($row->percent*100)/40,2)?>%</td>
                                    <td>
                                    <table  style="border:none" width="100%">
                                      <tr>
                                      <td style="border:none" width="70%">Admin </td><td style="border:none" >:</td>
                                      <td style="border:none" width="30%" >
									    <?php if($total==0) $admin=0; else $admin=10; echo $admin ; ?>%</td>
                                      </tr>
                                      <tr><td style="border:none" width="70%" >Editor <td style="border:none" >:</td><td style="border:none" width="30%">
									     <?php if($total==0) $editor=0; else if($total==100) $editor=90; else $editor=$total; echo $editor ;?>%</td>
                                      </tr>
                                   <tr><td style="border:none" width="70%">Award Fund<td style="border:none" >:</td><td style="border:none" width="30%" >
									    <?php if($total==0 || $total==100) $award=0; else $award=100-$total-$admin; echo $award ; ?>%</td>
                                      </tr>
                                      </table>
                                     </td>
									<td style="text-align:center"><?php echo date("d-m-Y",strtotime($row->story_date));?></td>
								   </tr>
								<?php 
								endforeach;
							?>
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
<script type="text/javascript">
function delete_record(record_id)
{
	 if (confirm("Are you sure you want to delete the content record.")){
		 window.location ='<?php echo BASE_URL.'admin/contents/delete/';?>'+record_id;
	 }
}
</script>	