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
						<td colspan="4" style="text-align:right"><a href="<?php echo BASE_URL?>admin/page_template/add_pages">Add Page</a> </td>
					</tr>
                	<tr>
                    	<th width="39" style="text-align:center;">Sr No</th>
                        <th width="100">Title</th>
						<th width="500">Description</th>
                        <th width="43" style="text-align:center;">Action</th>
                    </tr>
				</thead>
				<tbody>
					<?php if(empty($page_data)){?>
						<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
						</tr>
					<?php }else{$sr_no =0;	
						foreach($page_data as $row) :
					?>
                	<tr>
                    	<td style="text-align:center;"><?php  echo $sr_no+1; $sr_no++; ?></td>
                        <td><?php  echo $row->menu_title; ?></td>
						<td><?php echo substr($row->description,0,100).'....'; ?></td>                       
					    <td style="white-space:nowrap;text-align:center">
							<a href="<?php echo BASE_URL?>admin/page_template/edit_pages/<?php echo $row->page_id;?>" title="Edit" class="icon_link"><i class="icon icon-edit"></i></a>
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