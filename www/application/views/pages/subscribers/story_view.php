<div class="container">
	<br />
	<div class="row">
			<?php  
            $member = '';
			if(!empty($story_data)){
            if($story_data[0]->editor>0)
			{
				$details = $this->user_model->get_single_record("id='".$story_data[0]->editor."'" );
				if($details!="0") 
				{
					$member=$details->username; 
					if($details->type==2)
					{
						if($details->folio_link!='') $member = '<a href="'.$details->folio_link.'" target="_blank">'.$details->username."</a>"; 
					}
				}
           	 	?>
    		<div class="col-lg-8 col-nd-8 pad-top">
			<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	        <?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
            <div class="">
				<a href="<?php echo BASE_URL?>story/details?key=<?php echo $story_data[0]->content_key;?>" >
                <?php 
				$size=689; 
				if(!empty($story_data[0]->home_image)){ 
					$img = explode('.',$story_data[0]->home_image); 
					echo '<img  src="'.BASE_ASSETS.'uploads/stories/'.$img[0].'_'.$size.'.'.$img[1].'">'; 
				}
				else
				{
					$img = explode('.',$story_data[0]->image);
					echo '<img  src="'.BASE_ASSETS.'uploads/stories/'.$img[0].'_'.$size.'.'.$img[1].'">';
				} ?> 
               </a>
               </div>
				<div class="row">
				<div class="col-lg-8"><p><?php echo $story_data[0]->title ?></p></div>
				<div class="col-lg-4 text-right" style="padding-right: 75px;"><?php echo $member ?> </div>
				</div>
				<a href="<?php echo BASE_URL?>subscribers/search/" >
				Story Search</a>
          	</div>
          <?php }
			}?>
         <div class="col-lg-4 col-md-4 bg-light pad-bottom">
        	<h3>Search stories by :</h3>
            <h4><a href="<?php echo BASE_URL?>subscribers/search/keyword">KEYWORD</a></h4>
            <h4><a href="<?php echo BASE_URL?>subscribers/search/region">REGION</a></h4>
            <h4><a href="<?php echo BASE_URL?>subscribers/search/">SOURCE</a></h4>
            <h4><a href="<?php echo BASE_URL?>subscribers/rating/">RATING</a></h4>
        </div>
    </div>
</div>