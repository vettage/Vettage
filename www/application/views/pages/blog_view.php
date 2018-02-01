<div class="container">
	<div class="row blog">
		
		<?php 
		$link = BASE_URL.'blog/index';
		$getcat = $gettags = '';
		if(!empty($_GET['category']) &&  trim($_GET['category'])!='') $getcat = '?category='.trim($_GET['category']);
		if(!empty($_GET['tags']) &&  trim($_GET['tags'])!='') 
		{
			if($getcat!='') $gettags = '?tags='.trim($_GET['tags']); else $gettags = '&tags='.trim($_GET['tags']);
		}
		if(!empty($blog_data))
		{
			$total_rows = ceil(sizeof($blog_data)/3);
			$count=0;$rowcount=0;
			foreach($blog_data as $row)
			{ 
				$count++;
				
				$category='';
				$details = $this->category_model->get_single_record("category_id='".$row->category_id."'");
				if($details!="0") $category=$details->category_title;
				
				$member='Administrator';
				if($row->mem_id>0){
					$details = $this->member_model->get_single_record("mem_id='".$row->mem_id."'");
					if($details!="0") $member=$details->username;
				}
				
				$image = $thum_image = BASE_ASSETS.'uploads/blogs/45-472x266.jpg';
				if($row->image!='')
				{  
					$arg=explode('.', $row->image); 
					$thum_name = $arg[0]."_220.".$arg[1];
					if(file_exists(getcwd().'/media/uploads/blogs/'.$thum_name))
					{
						$image  	= BASE_ASSETS.'uploads/blogs/'.$row->image; 
						$thum_image	= BASE_ASSETS.'uploads/blogs/'.$thum_name;
					}
				}
				
				$newDate = date("d-m-Y",strtotime($row->date_added));
				$class = ''; if($count%2==0) $class = 'bg-light';
				
				$tags = '';
				if($row->tags!='')
				{
					$tags  = $row->tags;
					$explode = explode(",",$row->tags);
					if(sizeof($explode)>1)
					{
						$tags = '';
						for($i=0;$i<sizeof($explode);$i++){
							if(trim($explode[$i])!='') $tags.= '<a href="#">'.trim($explode[$i]).'&nbsp;&nbsp;</a> ';
						}
					}
				}
				?>
				<div class="col-lg-4 pad-bottom <?php echo $class?>">
					<h4 class="less-mar-bottom"><a href="<?php echo BASE_URL;?>blog/details/<?=$row->blog_id?>_<?=$row->alias?>"><?php echo $row->blog_title?></a></h4>
					<p class="text-muted">By <a href="#" class="user"><?php echo $member?></a> on  <?php  echo $newDate;?> 
					in <a href="<?php echo $link?>?category=<?php echo $category;?>" class="tag"><?php echo $category;?></a></p>
					<p>
						<a href="<?php echo BASE_URL;?>blog/details/<?=$row->blog_id?>_<?=$row->alias?>">
							<img src="<?=$thum_image?>" data-original="<?=$thum_image?>" width="360" height="166"/>
						</a>
					</p>
					<p style="min-height:100px"><?php echo $row->short_desc ?></p>
                    <p class="text-right"><a href="<?php echo BASE_URL;?>blog/details/<?=$row->blog_id?>_<?=$row->alias?>" class="more-link">Continue Reading..</a></p>
					<div class="tags">
                    	
						<?php if($tags!=''){?> <?php echo $tags?><?php }?>
                    </div>
				</div>
				<?php
				 if($count%3==0) { $rowcount++;  echo '</div>'; if($rowcount!=$total_rows) echo '<div class="row blog">'; $count=0; };
			 }
		} ?>
		
	</div>
</div>

