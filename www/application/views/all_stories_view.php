<div class="container">
	<div class="row">
		
		<div class="col-lg-3">
			<div role="toolbar" class="btn-toolbar pad-top">
				<div class="btn-group">
					<a class="btn btn-default btn-sm active" href="javascript:void(0);">RESULT</a>
					<a class="btn btn-default btn-sm" href="<?php echo BASE_URL?>subscribers/search">NEW SEARCH</a>
				</div>
			</div>
		</div>
		<div class="col-lg-9 bg-light pad-top pad-bottom video-thumb">
			<div class="row">
				<?php  	
				foreach($story_data as $row): 	
					$daysremaining = $this->content_model->daysremaining($row->story_date);	
				?>
				<div class="col-lg-2 text-right">
					<p>
						User Rating: 80%<br>
						<small class="text-muted">(<?php echo $daysremaining;?> days left)</small>
					</p>
				</div>
				<div class="col-lg-10 text-right">
					<a href="<?php echo BASE_URL?>story/details?key=<?php echo $row->content_key;?>">
						<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $row->image; ?>" width="701" height="258">
					</a>
				</div>
				<?php endforeach;?>
			</div>
		</div>
		
    </div>
</div>	