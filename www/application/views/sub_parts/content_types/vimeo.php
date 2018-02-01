<div class="col-lg-6">	

<script type="text/javascript" src="<?php echo BASE_URL?>media/embedplayer/embedplayer.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>media/embedplayer/youtube.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>media/embedplayer/vimeo.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>media/embedplayer/twitch.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>media/embedplayer/soundcloud.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>media/embedplayer/dailymotion.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>media/embedplayer/html5.js"></script>

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
	link = '<?php 
			echo htmlspecialchars_decode($valid_embed,ENT_NOQUOTES);
	?>';
	loadVideo('iframe', link);
}
$(document).ready(updateVideo);
// ]]>
</script>
	
				
						<div id="video"></div>
						
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
						
		


</div>