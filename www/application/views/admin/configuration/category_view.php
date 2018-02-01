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
						<td colspan="7" style="text-align:right"><a href="<?php echo BASE_URL?>admin/category/add_category">Add Category</a> </td>
					</tr>
                	<tr>
                    	<th width="39" style="text-align:center;">Sr No</th>
                        <th width="100" style="text-align:center;">Title</th>
                        
                        <th width="43" style="text-align:center;">Action</th>
                    </tr>
				</thead>
				<tbody>
					<?php if(empty($category_data)){?>
						<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
						</tr>
					<?php }else{$sr_no =0;	
						foreach($category_data as $row) :
 					?>
                	<tr>
                    	<td style="text-align:center;"><?php  echo $sr_no+1; $sr_no++; ?></td>
                        <td><?php  echo $row->category_title; ?></td>
                         
 					    <td style="white-space:nowrap;text-align:center">
							<a href="<?php echo BASE_URL?>admin/category/edit_category/<?php echo $row->category_id;?>" class="icon_link"><i class="icon icon-edit"></i></a>
							<a title="Delete" href="javascript:delete_record(<?php echo $row->category_id;?>);" class="icon_link"><div class="icon icon_x_red"></div></a>
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
		 if (confirm("Are you sure you want to delete the category record."))
		 {
		 	 window.location ='<?php echo BASE_URL.'/admin/category/delete/';?>'+record_id;
			 return true;
		 }
		 return false;
	}
	
</script>	
