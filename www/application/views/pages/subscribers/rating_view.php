<div class="container">
	<div class="row">
		<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
    <?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>

		<div class="col-lg-4">
			 <h3>STORIES BY RATING</h3>
        </div>
 		<form action="" method="post">
		<div class="col-lg-8 bg-light pad-bottom">
			<h4>Ratings:</h4>
			<table class="table table-striped table-bordered table-condensed">
			<thead>
			<tr>
				<th width="300">Title</th>
				<th width="120">Image</th>
				<th width="100" style="text-align:center">Ratings</th>
			</tr>
			</thead>
			<tbody>
            <?php
			 /*$rating_check_details = NULL;
							if($this->session->userdata('level')==2 || $this->session->userdata('level')==3)
							{
								$upgrade_date = $this->session->userdata('level_date');
								$where_ratings = '';if($upgrade_date!='' && $upgrade_date!='0000-00-00 00:00:00') $where_ratings = "AND rating_date>='".$upgrade_date."'";
								$rating_check_details = $this->content_ratings_model->custom_query("SELECT rating_id from content_ratings WHERE rating_by='".$this->mem_id."' $where_ratings");
								if($rating_check_details!=NULL) $rating_check_details = 1;
							}
							if($rating_check_details==NULL) {*/
			 if(empty($content_details)){?>
			<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td></tr>
			<?php }else{
			foreach($content_details as $row) :
			?>
			<tr>
				<td><a href="<?php echo BASE_URL?>story/details?key=<?php echo $row->content_key ?>"><?php echo $row->title?></a></td>
				<td>
					<?php if($row->image!=''){?>
					<a href="<?php echo BASE_URL?>story/details?key=<?php echo $row->content_key ?>">
						<img src="<?php echo BASE_ASSETS; ?>uploads/stories/<?php echo $row->image; ?>" width="100">
					</a><br/>
					<?php  } ?>
				</td>
				<td style="text-align:center"><?php echo round($row->percent,2);?> (<?php echo round(($row->percent*100)/40,2)?>%)</td>
			</tr>
			<?php 
			  endforeach;
			 // }
		    }
			?>
			</tbody>
			</table>
 		</div>
		</form>
	</div>
    <br />
    <button type="button" class="btn btn-default btn-sm pull-right active" onClick="javascript: document.location = '<?php echo BASE_URL.'subscribers/search/source';?>';">Back</button>
</div>
