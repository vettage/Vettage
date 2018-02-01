<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>  -->
<script type="text/javascript" src="<?php echo BASE_URL?>embedplayer/embedplayer.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>embedplayer/youtube.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>embedplayer/vimeo.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>embedplayer/twitch.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>embedplayer/soundcloud.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>embedplayer/dailymotion.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>embedplayer/html5.js"></script>

<script type="text/javascript">
// <![CDATA[
function initEmbed() {
	$(this).on('embedplayer:statechange', function (event) {
		$('#state').text(event.state);
	}).on('embedplayer:error', function (event) {
		var message = event.error||'';
		if (event.title)        { message += " "+event.title; }
		else if (event.message) { message += " "+event.message; }
		$('#error').text(message);
	}).on('embedplayer:durationchange', function (event) {
		if (isFinite(event.duration)) {
			$('#currenttime').show().prop('max', event.duration);
		}
		else {
			$('#currenttime').hide();
		}
		$('#duration').text(event.duration.toFixed(2)+' seconds');
	}).on('embedplayer:timeupdate', function (event) {
		$('#currenttime').val(event.currentTime);
		$('#currenttime-txt').text(event.currentTime.toFixed(2)+' seconds');
	}).on('embedplayer:volumechange', function (event) {
		$('#volume').val(event.volume);
		$('#volume-label').text(
				event.volume <=   0 ? '🔇' :
				event.volume <= 1/3 ? '🔈' :
				event.volume <= 2/3 ? '🔉' :
				'🔊'
				);
		$('#volume-txt').text(event.volume.toFixed(2));
	}).on('embedplayer:ready', function (event) {
		var link = $(this).embedplayer('link');
		if (link) {
			$('#link').attr('href', link);
			$('#link-wrapper').show();
		}
	}).
	embedplayer("listen").
	embedplayer('volume', function (volume) {
		$('#volume').text(volume.toFixed(2));
	});
}
function loadVideo(tag, url) {
	try {
		var attrs = {
			id: 'video',
			src: url
		};
		switch (tag) {
			case 'iframe':
				attrs.allowfullscreen = 'allowfullscreen';
				attrs.frameborder = '0';
				attrs.width = '640';
				attrs.height = '360';
				break;
			case 'video':
				attrs.width = '640';
				attrs.height = '360';
			case 'audio':
				attrs.controls = 'controls';
				attrs.preload = 'auto';
				break;
		}
		$('#link-wrapper').hide();
		var $embed = $('<'+tag+'>').attr(attrs).replaceAll('#video');
		if (tag === 'iframe') {
			$embed.load(initEmbed);
		}
		else {
			initEmbed.call($embed[0]);
		}
	}
	catch (e) {
		$('#error').text(String(e));
	}
}
function updateVideo () {
	//	var value = $('#embed').val().split('|');
	$('#duration, #currenttime, #volume').text('?');
	$('#state').text('loading...');
	$('#error').text('');
	foo = $('#my_url').text();
	//	loadVideo('iframe', 'https://www.youtube.com/embed/vUEw2RoWkSM');
}
//$(document).ready(updateVideo);
// ]]>
</script>

<?php $this->level = $this->session->userdata('level');	?>
	<div class="container">
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
			<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
    	<div class="col-lg-12 bg-light pad-bottom" id="user_list"><!--style="background-color:#f8d273;font-size:28px;color:#FFF"-->
        	<h4><?php echo $story_details->title;?> by <i><?php echo $editor_details->username?></i></h4>
             </div>
	</div>
	<div class="pad-bottom" style="position: relative;">
				

<p>
<div id="my_url"><?php 
$embed_code_link = htmlspecialchars_decode($story_details->embed_code_link,ENT_NOQUOTES);
echo $embed_code_link;
?></div>
<div id="video"></div>
</p>

<p>
<button onclick="$('#video').embedplayer('play');" title="Play">▶</button>
<button onclick="$('#video').embedplayer('pause');" title="Pause">⏸</button>
<button onclick="$('#video').embedplayer('toggle');" title="Play/Pause">⏯</button>
<button onclick="$('#video').embedplayer('stop');" title="Stop">◼</button>
<button onclick="$('#video').embedplayer('prev');" title="Previous">⏮</button>
<button onclick="$('#video').embedplayer('next');" title="Next">⏭</button>

<label for="volume" id="volume-label">🔊</label>
<input id="volume" type="range" min="0" max="1" value="1" step="0.01" oninput="$('#video').embedplayer('volume', +this.value);" />
</p>

<input id="currenttime" type="range" min="0" max="0" value="0" step="0.1" oninput="$('#video').embedplayer('seek', +this.value);" />

<p>
<span>duration: <span id="duration">?</span></span>,
<span>current time: <span id="currenttime-txt">?</span></span>,
<span>volume: <span id="volume-txt">?</span></span>,
<span id="link-wrapper"><a id="link" href="javascript:;">link</a>, </span>
<span id="state">loading...</span>
<span id="error"></span>
</p>


				<?php  
				/*
				$embed_code_link = htmlspecialchars_decode($story_details->embed_code_link,ENT_NOQUOTES);
				
				if(strpos($embed_code_link,"<embed")!==false || strpos($embed_code_link,"<iframe")!==false){?>
					<div class="video-container" ><?php echo $embed_code_link;?></div>
				<?php } 
				elseif(substr(trim($embed_code_link),0,4)=="http"){?>
					<div class="textcontent" >
					<p>
						<a href="javascript:windowopen('<?php echo trim($embed_code_link); ?>');" class="pull-right"  style="margin-right:115px;"><strong><i class="fa fa-external-link"></i> View Full</strong>
</a>
						<iframe src="<?php echo trim($embed_code_link); ?>" style="width:1120px; height:400px;margin-left:115px;border:1px solid #CCCCCC"></iframe>
					</p></div>
<!--  				
					<script type="text/javascript">
						function windowopen(url){
							window.open(url,'<?php echo $story_details->title;?>'
							,'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=768,directories=no,location=no') 
						}
					</script>
-->
				<?php } 
				elseif(substr(trim($embed_code_link),0,4)=="http" && $story_details->image!=''){?>
					<div class="video-container" style="">
						<a style="min-height:100%; min-width:100%;" href="<?php echo $story_details->embed_code_link;?>" >
							<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $story_details->image; ?>" style="min-height:100%; min-width:100%;">
						</a>
					</div>
				<?php } 
				elseif(substr(trim($embed_code_link),0,4)=="http" && $story_details->image==''){?>
					<a  href="<?php echo $story_details->embed_code_link;?>" >
						<div class="video-container" ></div>
                        <div class="carousel-caption" >
							<h4><?php echo $story_details->title?></h4>
							<h4>By <?php echo $editor_details->username ?></h4>
						</div>
					</a>
				<?php }
				elseif($story_details->image!='') { ?>
					<div class="video-container">
						<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $story_details->image; ?>" style="min-height:100%; min-width:100%;">
						<div class="carousel-caption" style="bottom:0px;">
							<h4><?php echo $story_details->title?></h4>
							<h4>By <?php echo $editor_details->username ?></h4>
						</div>
					</div>
				<?php } else { ?> 
                	<div class="textcontent"><p>
						<!--//http://192.168.1.6/vettage/story/details?key=1f05929369ca0ed2b8a32c912bfcffdd-->
						<!--http://firedust.makewebapp.com/vettage/story/details?key=0cfd94ac170e4874b167deec04380405-->
						<?php 
						$content_key = $story_details->content_key;
						$file_name = getcwd()."/media/uploads/contents/$content_key.html";
						$content_desc = ''; if(file_exists($file_name)) $content_desc = file_get_contents($file_name);
						//echo htmlspecialchars_decode($content_desc);
						?>
						<iframe src="<?php echo BASE_URL; ?>home/getcontenttexts/<?php echo $story_details->content_id; ?>" style="width:1120px; height:400px;margin-left:115px;border:1px solid #CCCCCC"></iframe>
					</p></div>
				<?php 
				
				
				} 
				
								*/
				

				?>
				
				<?php /*?><?php if(empty($story_details->embed_code_link))
				{?>
					<img src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $story_details->image; ?>" width="716" height="205" >
				<?php 
				} else { 
					if(strpos($story_details->embed_code_link,"<embed")===false || strpos($story_details->embed_code_link,"<iframe")===false){
						echo $story_details->embed_code_link;
					}elseif(strpos($story_details->embed_code_link,"http")===false){?>
						<a href="<?php echo $story_details->embed_code_link;?>" ><?php echo $story_details->embed_code_link;?></a>
					<?php } else{
						echo $story_details->embed_code_link;?>
					<?php } 
				} ?><?php */?>
				  <!-- </div> -->
            	<?php /*?><object width="100%"><param name="movie" value="//www.youtube.com/v/xY_MUB8adEQ?version=3&amp;hl=en_US&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/xY_MUB8adEQ?version=3&amp;hl=en_US&amp;rel=0" type="application/x-shockwave-flash" width="100%" allowscriptaccess="always" allowfullscreen="true"></embed></object><?php */?>
				
				<?php /*?><object width="560" height="315"><param name="movie" value="//www.youtube.com/v/g-Zj4_A6ITE?versi"><embed src="//www.youtube.com/v/g-Zj4_A6ITE?versi" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>
				
				<object width="560" height="315"><param name="movie" value="//www.youtube.com/v/g-Zj4_A6ITE?versi"><embed src="//www.youtube.com/v/g-Zj4_A6ITE?versi" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object> <?php */?>
				
            </div>
			
			<?php
			$importance = $credibility = $timeline 	= $appearance = 1;
			if($this->type==3)
			{
				if($rating_details!=NULL)
				{
					$importance = $rating_details->importance;
					$credibility = $rating_details->credibility;
					$timeline = $rating_details->timeline;
					$appearance = $rating_details->appearance;
				}
			}
			else
			{
				$rating_details = $this->content_ratings_model->custom_query("SELECT AVG(importance) as importance,AVG(credibility) as credibility,AVG(timeline) as timeline,AVG(appearance) as appearance from content_ratings WHERE content_id='".$story_details->content_id."'");
				
				if($rating_details!=NULL)
				{
					if($rating_details[0]->importance!=NULL) $importance = $rating_details[0]->importance;
					if($rating_details[0]->importance!=NULL) $credibility = $rating_details[0]->credibility;
					if($rating_details[0]->importance!=NULL) $timeline = $rating_details[0]->timeline;
					if($rating_details[0]->importance!=NULL) $appearance = $rating_details[0]->appearance;
				}
			}
			$daysremaining = $this->content_model->daysremaining($story_details->story_date);
			?>
			<div class="container">
				<div class="pt-20">
					<div class="row">
					<div class="col-lg-6"><p style="padding-left: 15px;">
					<?php if($this->session->userdata('fv_logged_in') == TRUE){?>
					 <button style="margin-right: 15px;" class="btn btn-default btn-sm" 
                     onclick="javascript: document.location = '<?php echo BASE_URL.'subscribers/search/';?>';"  type="button">Back
                     </button>
                      <?php /*?><button type="button" class="btn btn-default btn-sm pull-right active"
                       onClick="javascript: document.location = '<?php echo BASE_URL.'subscribers/search/';?>';">Back</button><?php */?>
					 
	 
							 <?php } ?><span class="pull-right rateit">RATE IT :</span></p>
					<div class="text-right pad-top">
							<?php if($this->session->userdata('fv_logged_in') == FALSE){?>
								<button style=" margin-right:-15px; margin-top: -20px;" type="button" class="btn btn-info submit_btn" onClick="javascript:document.location='<?php echo BASE_URL;?>';"><h6>Sign in to RATE</h6></button> <br /> 
	 
							<?php }
							 elseif($this->type==1 || $this->type==2 || $this->session->userdata('level')==1){?> 
                             <button type="button" class="btn btn-info submit_btn" onclick="showupgrademessage();"><h6>SUBMIT</h6></button> <br />
							<?php } 
							elseif($rating_details==NULL && $this->session->userdata('level')>1)
							{
								$rating_check_details = NULL;
								if($this->session->userdata('level')==2 || $this->session->userdata('level')==3)
								{
									$upgrade_date = $this->session->userdata('level_date');
									$where_ratings = '';if($upgrade_date!='' && $upgrade_date!='0000-00-00 00:00:00') $where_ratings = "AND rating_date>='".$upgrade_date."'";
									$rating_check_details = $this->content_ratings_model->custom_query("SELECT rating_id from content_ratings WHERE rating_by='".$this->mem_id."' $where_ratings");
									if($rating_check_details!=NULL) $rating_check_details = 1;
								}
								if($rating_check_details==NULL){
								?>
							  
								<form method="post" action="" onsubmit="javascript:return checkerrors();">
								 <?php /*?><div class="pull-right" style="margin-top: -35px; margin-right: 86px; width: 150px; padding-top: 0px;">
								 <?php echo $daysremaining;?> Days Remaining</div><?php */?>
									<input type="hidden" id="importance" name="importance" value="0" />
									<input type="hidden" id="credibility" name="credibility" value="0" />
									<input type="hidden" id="timeline" name="timeline" value="0" />
									<input type="hidden" id="appearance" name="appearance" value="0" />
									 <!--<div><button class="btn btn-danger submit_btn" type="submit">SUBMIT</button></div>-->
									 <div>
                                     <div class="pull-right" style="width: 150px; padding-top: 0px; margin-top: -35px; margin-right: 84px;">
	                                 <?php echo $daysremaining;?> Days Remaining
                               <button class="btn btn-danger submit_btn" type="submit" style="margin: 5px -85px 10px 10px;">SUBMIT</button></div></div>
	
								</form>
                                 <?php                                       
								} else {  ?>
									<button type="button" class="btn btn-info submit_btn" onclick="showmessage();"><h6>SUBMIT</h6></button> <br />
								<?php } ?>
							
							<?php 
							} else { 
							?>
								<button type="button" class="btn btn-info submit_btn" ><h6>Already RATED</h6></button> <br />
							<?php } ?>
                            
							 <br />
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-4 text-right">IMPORTANCE</div>
							<div class="col-lg-7">
								 <div id="impslide"></div>
							</div>
							<div class="col-lg-1">
								<div id="defaultval"><span id="impval"><?php echo round($importance);?></span></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 text-right">CREDIBILITY</div>
							<div class="col-lg-7">
								 <div id="creditslide"></div>
							</div>
							<div class="col-lg-1">
								<div id="defaultval"><span id="creditval"><?php echo round($credibility);?></span></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 text-right">TIMELINESS</div>
							<div class="col-lg-7">
								 <div id="timeslide"></div>
							</div>
							<div class="col-lg-1">
								<div id="defaultval"><span id="timeval"><?php echo round($timeline);?></span></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 text-right">APPEARANCE</div>
							<div class="col-lg-7">
								 <div id="appslide"></div>
							</div>
							<div class="col-lg-1">
								<div id="defaultval"><span id="appval"><?php echo round($appearance);?></span></div>
							</div>
						</div>
					</div>
				</div>
				</div>
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