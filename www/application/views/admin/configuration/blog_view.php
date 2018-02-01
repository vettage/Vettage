<div class="container">
	<div class="row">
		<?php  echo ($this->session->flashdata('success_msg')) ?  '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : '' ?>
		<?php  echo ($this->session->flashdata('delete_error')) ?  '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : '' ?>
		<div class="span5"><?php $this->load->view('admin/left_menu/configuration_left_view'); ?></div>
		<div class="span19">
			<h2><?php echo $title?></h2>
			<div id="admin_index_statistics">
				<div class="row">
				<div class="span19">
				<table class="table table-striped table-bordered table-condensed">
			   	<thead>
					<tr>
						<td colspan="7" style="text-align:right"><a href="<?php echo BASE_URL?>admin/blog_template/add_blog">Add Blogs</a> </td>
					</tr>
                	<tr>
                        <th width="119" style="text-align:left;">Title</th>
                        <th width="50" style="text-align:center;">Image</th>
						<th width="250" style="text-align:left;">Short description</th>
                        <th width="90" style="text-align:center;">Date</th>
                        <th width="36" style="text-align:center;">Status</th>
                        <th width="33" style="text-align:center;">Action</th>
                    </tr>
				</thead>
				<tbody>
					<?php if(empty($blog_data)){?>
						<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
						</tr>
					<?php }else{$sr_no =0;	
						foreach($blog_data as $row) :
						$short_desc = $row->short_desc;
						$sr_no++;
					?>
                	<tr>
                        <td><?php  echo $row->blog_title; ?></td>
                        
                        <td style="text-align:center;">
						<?php if(empty($row->image)) echo '<img src="'.BASE_ASSETS.'images/default_agent.png" class="thumb account-img" height="32" width="32">'; 
						   else if(!empty($row->image)){ 
								$arg = explode('.',$row->image); $size=35; 
								echo '<img  src="'.BASE_ASSETS.'uploads/blogs/'.$arg[0].'_'.$size.'.'.$arg[1].'">'; 
							}
						?>
						</td>
						<td><?php echo $short_desc; ?></td> 
                        
                        <td style="text-align:center;"><?php  echo $row->date_added; ?></td>
                       
                        <td style="text-align:center;"><a href="<?php echo BASE_URL?>admin/blog_template/change_status/<?php echo $row->blog_id;?>" ><?php echo ($row->status == 0) ? 'Inactive' : 'Active' ?></a></td>
                      
					    <td style="white-space:nowrap;text-align:center">
							<a href="<?php echo BASE_URL?>admin/blog_template/edit_blog/<?php echo $row->blog_id;?>" class="icon_link"><i class="icon icon-edit"></i></a>
							<a title="Delete" href="javascript:delete_record(<?php echo $row->blog_id;?>);" class="icon_link"><div class="icon icon_x_red"></div></a>
						</td>
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
<script type="text/javascript">
	function delete_record(record_id)
	{
		 if (confirm("Are you sure you want to delete the blog record."))
		 {
		 	 window.location ='<?php echo BASE_URL.'/admin/blog_template/delete/';?>'+record_id;
			 return true;
		 }
		 return false;
	}
	
</script>	
