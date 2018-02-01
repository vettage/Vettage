<script src="<?php echo BASE_ASSETS;?>panda/js/libs/jquery.ui.highlight.min.js"></script>
<script src="<?php echo BASE_ASSETS;?>panda/js/pandalocker.2.1.0.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo BASE_ASSETS;?>panda/css/pandalocker.2.1.0.min.css">

	<div class="container">
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
			<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
    		<div class="row">
    	
    	<div class="col-lg-5 bg-light pad-bottom" id="user_list"><!--style="background-color:#f8d273;font-size:28px;color:#FFF"-->
        	<h3><?php echo $story_details->title;?> | Rating: <?php echo $story_rating?></h3>

             </div>
             </div>

			<div class="row to-lock">
    			

		<?php if ($embed_type=='text/html' || $embed_type=='text/plain' || $embed_type=='plain' || $embed_type=='text') {
			$this->load->view('sub_parts/content_types/html_text.php',$story_details);
		} else if (strstr($embed_type,'image')) {
			$this->load->view('sub_parts/content_types/image.php',$story_details);
		} else if ($embed_type=='invalid') {			
			$this->load->view('sub_parts/content_types/invalid.php',$story_details);
		} else if ($embed_type=='youtube') { 
			$this->load->view('sub_parts/content_types/youtube.php',$story_details);
		} else if ($embed_type=='iframe') {
				$this->load->view('sub_parts/content_types/iframe.php',$story_details);
		} else if ($embed_type=='vimeo') {
			$this->load->view('sub_parts/content_types/vimeo.php',$story_details);
		} else if ($embed_type=='quicktime') { 
		$this->load->view('sub_parts/content_types/quicktime.php',$story_details);
		} else if ($embed_type=='pdf') { 
			$this->load->view('sub_parts/content_types/pdf.php',$story_details);
		} else {
			$this->load->view('sub_parts/content_types/invalid.php',$story_details);
		} ?>

	

		</div>
		<div class="row">
		<form method="post" action="" onsubmit="javascript:return checkerrors();">


			<?php
			$importance = $credibility = $timeline 	= $appearance = 1;
			
				if($rating_details!=NULL)
				{
					$importance = $rating_details->importance;
					$credibility = $rating_details->credibility;
					$timeline = $rating_details->timeline;
					$appearance = $rating_details->appearance;
					$percent = round((($importance + $credibility + $timeline + $appearance)*100)/40,2);
				}
			
				/*
				$rating_details = $this->content_ratings_model->custom_query("SELECT AVG(importance) as importance,AVG(credibility) as credibility,AVG(timeline) as timeline,AVG(appearance) as appearance from content_ratings WHERE content_id='".$story_details->content_id."'");
				
				if($rating_details!=NULL)
				{
					if($rating_details[0]->importance!=NULL) $importance = $rating_details[0]->importance;
					if($rating_details[0]->importance!=NULL) $credibility = $rating_details[0]->credibility;
					if($rating_details[0]->importance!=NULL) $timeline = $rating_details[0]->timeline;
					if($rating_details[0]->importance!=NULL) $appearance = $rating_details[0]->appearance;
				}
				*/
			
			$daysremaining = $this->content_model->daysremaining($story_details->story_date);
			?>

					
					
<div class="col-lg-4">	
<h3>Contributors</h3>				 				 
<?php
foreach ($contributors as $c ) {?>

					<div class="row"> 


<div class="summary-view">
  				              
							<?php 
							if ($c['id']==$editor_details['id']) {

								$picture = $editor_details['picture'];
								$member_file_path = getcwd().'/media/uploads/members/';
								$member_path = BASE_URL.'media/uploads/members/';
								$img_src = $member_path.'randombig.gif';
								if($picture!='' && file_exists($member_file_path.$picture))
									$img_src = $member_path.$picture;
									?>
								                            <img src="<?php echo $img_src?>" width="50px" />                 
								 
								
							
                          <h4><a href="/account/profile/<?php echo $editor_details['id']?>">Editor <?php echo $editor_details['username']?></a></h4>
                           <h6>Story earnings: $<?php echo round($editor_details['this_money'],2)?></h6>
                           <h6>Total earnings: $<?php echo round($editor_details['all_money'],2)?></h6>
 								
							<?php 
							} else { 
								
								$picture = $c['picture'];
								$member_file_path = getcwd().'/media/uploads/members/';
								$member_path = BASE_URL.'media/uploads/members/';
								$img_src = $member_path.'randombig.gif';
								if($picture!='' && file_exists($member_file_path.$picture))
									$img_src = $member_path.$picture;
									?>
								                            <img src="<?php echo $img_src?>" width="50px" />   
						
                          
                           <h4><a href="/account/profile/<?php echo $c['id']?>">Contributor <?php echo $c['username']?></a></h4>
                           <h6>Story earnings: $<?php echo round($c['this_money'],2)?></h6>
                           <h6>Total earnings: $<?php echo round($c['all_money'],2)?></h6>
                           
                           <?php } ?>
</div>                          

	</div>
<?php } ?>
</div>
<div class="col-lg-4">	

<h3>Rate It!</h3>						 
						<div class="row">
							<div class="col-lg-5 text-right">IMPORTANCE</div>
							<div class="col-lg-5">
								 <div id="impslide"></div>
							</div>
							<div class="col-lg-1">
								<div id="defaultval"><span id="impval"><?php echo round($importance);?></span></div>
							
							</div>
						</div>
						<div class="row">
							<div class="col-lg-5 text-right">CREDIBILITY</div>
							<div class="col-lg-5">
								 <div id="creditslide"></div>
							</div>
							<div class="col-lg-1">
								<div id="defaultval"><span id="creditval"><?php echo round($credibility);?></span></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-5 text-right">TIMELINESS</div>
							<div class="col-lg-5">
								 <div id="timeslide"></div>
							</div>
							<div class="col-lg-1">
								<div id="defaultval"><span id="timeval"><?php echo round($timeline);?></span></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-5 text-right">APPEARANCE</div>
							<div class="col-lg-5">
								 <div id="appslide"></div>
							</div>
							<div class="col-lg-1">
								<div id="defaultval"><span id="appval"><?php echo round($appearance);?></span></div>
							</div>
						</div>
									<input type="hidden" id="importance" name="importance" value="0" />
									<input type="hidden" id="credibility" name="credibility" value="0" />
									<input type="hidden" id="timeline" name="timeline" value="0" />
									<input type="hidden" id="appearance" name="appearance" value="0" />
			</div>		
				<div class="col-lg-4">
				<h3></h3>		
						
							<?php if (!empty($rating_details)) { ?> 

							
							<button type="button" class="btn btn-info submit_btn" value="Already RATED">Already RATED:<?php echo $percent?>%</button>
							
							<?php } elseif (empty($rating_details) &&  (empty($can_rate)|| $can_rate<=0)) { 
								
								?>
<script>
jQuery(document).ready(function ($) {
   $('.to-lock').sociallocker({
	text:{
	   header: 'Purchase Ratings or Share to view',
	   message: 'Please support the Vettage and Share to view'
	},
	theme: 'glass',
	overlap:{
	   mode: 'transparence'
	},
	buttons:{
	   order: ["facebook-like","twitter-tweet","linkedin-share"],
	   counters: true,
	   lazy: true
	}
   });
});
</script>				
							<button type="button" onClick="location.href='/subscribers/subscription?return=<?php echo urlencode(base64_encode($_SERVER['REQUEST_URI']))?>';" class="btn btn-info submit_btn" value="Purchase">Purchase Ratings</button>
						
							<?php } else { ?>
							
					 <button class="btn btn-danger submit_btn" type="submit" style="margin: 5px -85px 10px 10px;">SUBMIT</button></div></div>
							
							<?php } ?>
                            
                             
                         
         		</div>                   
								</form>
							

				</div>


			<script type="text/javascript">
			$(function(){
				  $('#impslide').slider({ 
					max: 10,
					min: 1,
					value: <?php echo $importance;?>,
					slide: function(e,ui) {
					  $('#impval').html(ui.value);
					  $('#importance').val(ui.value);
					}
				  });
				  $('#creditslide').slider({ 
					max: 10,
					min: 1,
					value: <?php echo $credibility;?>,
					slide: function(e,ui) {
					  $('#creditval').html(ui.value);
					  $('#credibility').val(ui.value);
					}
				  });
				  $('#timeslide').slider({ 
					max: 10,
					min: 1,
					value: <?php echo $timeline;?>,
					slide: function(e,ui) {
					  $('#timeval').html(ui.value);
					  $('#timeline').val(ui.value);
					}
				  });
				  $('#appslide').slider({ 
					max: 10,
					min: 1,
					value: <?php echo $appearance;?>,
					slide: function(e,ui) {
					  $('#appval').html(ui.value);
					  $('#appearance').val(ui.value);
					}
				  });
			  });
			</script>
			
			<script type="text/javascript">
			function checkerrors()
			{     
				var importance 	= parseInt($('#importance').val());
				var credibility = parseInt($('#credibility').val());
				var timeline 	= parseInt($('#timeline').val());
				var appearance 	= parseInt($('#appearance').val());
				if(importance==0 && credibility==0 && timeline==0 && appearance==0 )
				{
					alert('Select ratings');
					return false;
				}
				else
				{
					if(importance<=0 || importance>10)
					{
						alert('Select valid ratings for IMPORTANCE');
						return false;
					}
					if(credibility<=0 || credibility>10)
					{
						alert('Select valid ratings for CREDIBILITY');
						return false;
					}
					if(timeline<=0 || timeline>10)
					{
						alert('Select valid ratings for TIMELINE');
						return false;
					}
					if(appearance<=0 || appearance>10)
					{
						alert('Select valid ratings for APPEARANCE');
						return false;
					}
				}
				return true;
			}
			function showmessage()
			{   
				<?php 
				$subsc_plan = '';
				if($this->session->userdata('level')== 2) $subsc_plan = "PER STORY";
				if($this->session->userdata('level')== 3) $subsc_plan = "1 STORY";
				if($this->session->userdata('level')==4)  $subsc_plan = "MONTHLY";
				if($this->session->userdata('level')== 5) $subsc_plan = "INSTITUTIONAL"; 
				?>
				alert('Your current subscription "<?php echo $subsc_plan?>" has expired, Please upgrade your subscription to rate this story');
			}
			</script>
       

<?php /*?><?php if($this->session->userdata('level')==2){?>
<script src="//www.bitwall.io/javascripts/widget.js" id="bitwallWidgetScript" data-title="Buy with bitcoin" data-key="if4pkoc"></script> 
<?php }?><?php */?>

<script>
function showupgrademessage()
{
	error = 'Upgrade to rate this story <br/>';
	$(function () { 
			var $news_modal = $('#error_dispaly');
			$news_modal.modal({
				show: true
			});
			$('#model_body').html('<p class="text-danger">'+error+'</p>');
			//window.location.href='<?php echo BASE_URL;?>subscribers/subscription';
		});
	
}
</script>	
</div>
</div>

