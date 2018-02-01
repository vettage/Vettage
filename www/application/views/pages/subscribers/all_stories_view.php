<div class="container">
	<div class="row">
 		<div class="col-lg-3">
             <h3><?php echo $title ;?></h3>
		</div>
		<div class="col-lg-9 bg-light pad-top pad-bottom video-thumb">
 			<?php if($story_data==NULL){?>
				<div class="row" style="padding:5px;"><h4> No search result found.</h4>
				</div>
			<?php } else { ?>
			<div class="row" style="height: 500px; overflow: auto;">
 				<?php  	
				 foreach($story_data as $row):
					 $daysremaining = $this->content_model->daysremaining($row->story_date);	
					 $editor='';
					  if($row->editor>0)
					  {
					  	
						$details = $this->user_model->get_single_record("id='".$row->editor."'");
						if($details!="0") $editor=$details->username;
					  }
				?> 	
                <div class="col-lg-2 text-right">
					<p style="margin-top:85% !important;">
						User Rating: <br /><?php echo round(($row->percent*100)/40,2)?>%<br>
						<small class="text-muted">(<?php echo $daysremaining;?> days left)</small>
					</p>
				</div>
				<div class="col-lg-10 text-right">
					<a href="<?php echo BASE_URL?>story/details?key=<?php echo $row->content_key;?>">
						<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $row->image; ?>" width="701" height="258">
					</a>
                     <div class="carousel-caption">
                <h4><?php echo $row->title?></h4>
               <a href="<?php echo BASE_URL?>subscribers/search/assign_story/<?php echo $details->id ?>"><h4>By <?php echo  $editor ?></h4>               </a>            
                 </div>
				</div>
 				<?php endforeach;?>
			</div>
			<?php } ?>
             <br />
             <button type="button" class="btn btn-default btn-sm pull-right active" onClick="javascript: document.location = '<?php echo BASE_URL.'subscribers/search/';?>';">Back</button>
 		</div>
     </div>
 </div>	