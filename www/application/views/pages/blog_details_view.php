<?php

$link = BASE_URL.'blog/index';

$category='';
$details = $this->category_model->get_single_record("category_id='".$blog_details->category_id."'");
if($details!="0") $category=$details->category_title;

$member='Administrator';
if($blog_details->mem_id>0){
	$details = $this->member_model->get_single_record("mem_id='".$blog_details->mem_id."'");
	if($details!=NULL) $member=$details->username;
}

$image = $thum_image = BASE_ASSETS.'uploads/blogs/45-472x266.jpg';
if($blog_details->image!='')
{  
	$arg=explode('.', $blog_details->image); 
	$thum_name = $arg[0]."_220.".$arg[1];
	if(file_exists(getcwd().'/media/uploads/blogs/'.$thum_name))
	{
		$image  	= BASE_ASSETS.'uploads/blogs/'.$blog_details->image; 
		$thum_image	= BASE_ASSETS.'uploads/blogs/'.$thum_name;
	}
}

$newDate = date("d-m-Y",strtotime($blog_details->date_added));

$tags = '';
if($blog_details->tags!='')
{
	$tags  = $blog_details->tags;
	$explode = explode(",",$blog_details->tags);
	if(sizeof($explode)>1)
	{
		$tags = '';
		for($i=0;$i<sizeof($explode);$i++){
			if(trim($explode[$i])!='') $tags.= '<a href="#">'.trim($explode[$i]).'&nbsp;&nbsp;</a> ';
		}
	}
}
?>

<div class="container">
	<div class="row">
		<div class="col-lg-4">
        	<h3 less-mar-bottom><?php echo $blog_details->blog_title?></h3>
			<p class="text-muted">By <a href="#" class="user"><?php echo $member?></a> on  <?php  echo $newDate;?> 
			in <a href="<?php echo $link?>?category=<?php echo $category;?>" class="tag"><?php echo $category;?></a></p>
        </div>
		<div class="col-lg-8 bg-light pad-top pad-bottom">
			<p><img src="<?=$image?>" data-original="<?=$image?>" style="max-width:840px"/></p>
			<p><?php echo $blog_details->blog_desc; ?></p>
			<?php if($tags!=''){?><div class="tags"><?php echo $tags?></div><?php }?>
			<br/>
            <?php  $alias = ''; if($this->input->post('alias')!=NULL) $alias = $this->input->post('alias');?>
			
			<h4>Comments</h4>
           
			<table class="table table-hover" cellpadding="5" cellspacing="5" width="100%" id="comments"  >
			
			<?php /*?><?php foreach($blog_cmt as $row) :?>
				<tr>
					<td valign="top">
						<?php echo $row->comment; ?><br/>
						<strong style="color:#006600">User</strong> commented on <strong><?php echo date("d M y, H:i A",strtotime($row->date_added))?></strong>
					</td>
				</tr>
			<?php 
			endforeach; ?><?php */?>
			</table>
			
			<?php if($this->session->userdata('fv_logged_in')!=FALSE){?>
				<div class="alert alert-success" id="success_new" style="display:none"></div>
				<div class="alert alert-danger" id="error_new" style="display:none"></div>
				<textarea class="form-control" name="comment" id="comment"  rows="2" ></textarea>
				<?php echo ((form_error('comment')!=NULL)) ? '<br /><span class="help-inline">'.form_error('comment').'</span>' : '' ?>
				<p>&nbsp;</p>
				<button type="add_comment"  id="add_comment" value="comment" class="btn btn-info"><h6>Add Comment</h6></button>
			<?php } else { ?>
				<button type="add_comment"  id="add_comment" value="comment" class="btn btn-info pull-right" onClick="javascript:document.location='<?php echo BASE_URL;?>';">
                
                <h6>Sign in for comments</h6></button>
			<?php } ?>
			<br/><br/>
				
				
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript">
<?php if($this->session->userdata('fv_logged_in')!=FALSE){?>
$(document).ready(function(){
	$('#add_comment').click(function(){
	
		var comment = trim($('#comment').val());
		if(comment=='')
		{
			$("#error_new").html("Please enter comment.");
			$('#success_new').hide();
			$('#error_new').show();
			return false;
		}
		else
		{
			$.ajax({
				type: "POST",
				url: "<?php echo BASE_URL;?>blog/comment",
				data: "comment="+comment+"&blog_id=<?php echo $blog_details->blog_id;?>",
				success: function(msg)
				{
					if(msg=='')
					{
						$('#success_new').hide();
						$("#error_new").html("The Information you entered is incorrect");
						$('#error_new').show();
					}
					else{
						$("#success_new").html("Comment added successfully ");
						getcomments();
						$('#error_new').hide();
						$('#success_new').show();
						$('#comment').val('')
					}
				}
			});
			return false;				
		}
	});
});
<?php } ?>

function getcomments()
{
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>blog/getcomments",
		data: "blog_id=<?php echo $blog_details->blog_id;?>",
		success: function(msg)
		{
			$("#comments").html(msg);
		}
	});
	return false;				
}
function trim(str) 
{
	return str.replace(/^\s+|\s+$/g,"");
}
getcomments();
setInterval( "getcomments()", 10000);

function deletecomment(comment_id)
{
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>blog/deletecomment",
		data: "blog_id=<?php echo $blog_details->blog_id;?>&comment_id="+comment_id,
		success: function(msg)
		{
			alert(msg);
			getcomments();
		}
	});
}


</script>


<?php /*?><div class="content-section container">
	<section class="row-fluid">
		<div class="span9 post post-single">
				<div class="inner-spacer-right-lrg">
					<div class="post-title">
						<h3>Single Post Example Title Here</h3>
						<div class="post-meta">
							By <a href="#" class="user">Donagh</a> on 10/2/2013 in <a href="#" class="tag">category-name</a>
						</div>
					</div>
					<div class="post-media"><a href="#"><img src="<?php echo BASE_ASSETS; ?>img/blank/640x360.gif" data-original="<?php echo BASE_ASSETS; ?>img/content/dark/45-640x360.jpg" width="640" height="360" alt="alt text" /></a></div>
					<div class="post-body"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna. Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus. Mauris nibh felis, adipiscing varius, adipiscing in, lacinia vel, tellus. Suspendisse ac urna. Etiam pellentesque mauris ut lectus. Nunc tellus ante, mattis eget, gravida vitae, ultricies ac, leo. Integer leo pede, ornare a, lacinia eu, vulputate vel, nisl.</p>
					</div>
				</div>
		</div>
 	</section>
</div><?php */?>