<div id="stories" class="row list-group pad p-3">

<?php 

if (!empty($title)) echo '<div class="tag-result">Showing results for Tag: '.$title.' <a href="'.BASE_URL.'home"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

foreach ($stories as $story) { 

	?>
        <div class="item  col-xs-4 col-lg-4">
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
        </div>

  

	<?php } ?>	

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
	
	
