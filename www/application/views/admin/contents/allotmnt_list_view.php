<div class="container">
	<div class="row">
 		<div class="span5"><?php $this->load->view('admin/left_menu/contents_left_view'); ?></div>
		<div class="span19">
			<h1>CONTRIBUTORS / EARNINGS:</h1>
			<div id="admin_index_statistics">
				<div class="row">
					<div class="span19">
					<table class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                        <th width="50" style="text-align:center;">User Name</th>
                        <th width="100">%</th>
                        <th >Earned</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
							foreach($allotments as $row) : 
							if ($row->contributor_id==0) continue;
							$member='';
							if($row->contributor_id>0){
							$details = $this->user_model->get_single_record("id='".$row->contributor_id."'");
							if($details!="0") $member=$details->username;
							}
					
                        ?> 
                        <tr>
                        <td style="text-align:center;"><?php echo $member;?></td>
                        <td><?php echo $row->percent ?></td>
                         <td><?php echo $distributions[$row->contributor_id]; ?></td>
                        </tr>
                        <?php 
                        endforeach;?>
                        <tr>
                        <td style="text-align:center;">Payment Processing</td>
                        <td>10%</td>
                         <td><?php echo $distributions[99998]; ?></td>
                        </tr>
                        <tr>
                        <td style="text-align:center;">Vettage Operations</td>
                        <td>10%</td>
                         <td><?php echo $distributions[99999]; ?></td>
                        </tr>
                        <tr>
                        <td style="text-align:center;">Vettage Contests</td>
                        <td>Remaining</td>
                         <td><?php echo $distributions[99997]; ?></td>
                        </tr>
  
                        </tbody>
					</table>
                    <a href="<?php echo BASE_URL;?>admin/contents" class="btn btn-default btn-sm">
                     Back</a>
					<?php if($this->pagination->create_links()){?>
						<div class="pagination pagination-right"><?php echo $this->pagination->create_links();?></div>
					<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
