<?php 
$tags = '';if(!empty($_GET['tags'])) $types = $_GET['tags'];
?>
<div class="container">
	<div class="row">
    <div class="col-lg-4">
            <h3>SEARCH BY KEYWORD</h3>
 
         <form method="get" action="<?php echo BASE_URL?>search/keyword"> 
 
 			<h4>By Tag:</h4>
            <ul class="list-unstyled">
            
				<?php
				if(!empty($type_data))
				{
					$tags=',';$tagarrvalue = "";$tagarr = array();
					foreach($type_data as $row )
					{					 
						$exp = explode(',',$row->tags);
						foreach($exp as $val) 
						{	
							$val = trim($val);
							if(strpos($tags,",".$val.",")===false)
							{
								$tags.=$val.",";
								$tagarrvalue .= '"'.$val.'",';
								$tagarr[$val] = (string) strtolower($val);
							}
						}
					}
					asort($tagarr);
					foreach($tagarr as $key=>$val) 
					{
						?>
						<li><a href="<?php echo BASE_URL?>search/keyword?tags=<?php echo $key?>">
							<?php echo $key?></a>
						</li>
						<?php
					}
				} 
				else echo "No tags found."; ?>
            </ul>
 <h4>By Keyword:</h4>
            <div class="input-group"> 
            <input type="text" name="keywords" id="sbt_srch"  class="form-control" value="<?php //echo $tags ?>" 
            placeholder="Enter Keyword">
            <span class="input-group-btn">
            <button class="btn btn-danger"  type="submit" name="sbt_srch" value="search"><i class="fa fa-search"></i></button>
            </span>

            </div>        
 
            </form>
 
 	<h4>Search Results:</h4>
	<div id="result_details">
	<?php echo count($story_data). ' stories found ';
	
	if (isset($search_term)) echo $search_term;
	?>
	
		<a href="<?php echo BASE_URL?>search/keyword"><span class="glyphicon glyphicon-remove-circle"></span></a>
	</div>
 
 		</div>
        
   		<div class="col-lg-8 bg-light pad-bottom pad-top">
<div class="row">
<?php 


foreach ($story_data as $story) {

	?>

        <div class="item  col-lg-6">
            <div  role="button" class="thumbnail" data-href="<?php echo BASE_URL; ?>story/<?php echo $story->alias?>">
                        <div class="v-tags">
                            Tags: 
                            <?php
                            
                            $tags = explode(',',$story->tags);
                            foreach($tags as $tag) {
                            	$tag = trim($tag);
                            	echo '<a onclick="event.stopPropagation();" href="'.BASE_URL.'home/'.$tag.'">'.$tag.'</a> ';	
                            }
                            
 ?>
                        </div>
 
                <img class="group list-group-image" src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $story->image; ?>" alt="<?php echo $story->title?>" />
                    <div class="v-heading"><h3><?php echo $story->title?></h3></div>

				<div class="v-caption">

 						<p class="group inner list-group-item-text">
                        <?php echo $story->content_desc?></p>
                      
                </div>
            </div>
            </a>
        </div>

  

	<?php } ?>	
	</div>

        </div>
	</div>
    <br />
    
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#stories .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#stories .item').removeClass('list-group-item');$('#stories .item').addClass('grid-group-item');});

    $(".thumbnail").click(function() {
    	 window.location = $(this).attr("data-href");
    	 return false;
    });
        

});
</script>