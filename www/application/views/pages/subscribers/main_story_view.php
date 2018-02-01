<div class="container">
	<div class="row">
    	<div class="col-lg-4">
        
        </div>
        <div class="col-lg-8 bg-light pad-bottom">
        	<h4>Chrissie Wellington by <i>Rebecca Marshall</i></h4>
            <div class="pad-bottom">
            	<object width="100%"><param name="movie" value="//www.youtube.com/v/xY_MUB8adEQ?version=3&amp;hl=en_US&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/xY_MUB8adEQ?version=3&amp;hl=en_US&amp;rel=0" type="application/x-shockwave-flash" width="100%" allowscriptaccess="always" allowfullscreen="true"></embed></object>
            </div>
            <div class="row">
            	<div class="col-lg-6"><p>20 Days Remaining</p></div>
                <div class="col-lg-6">
                	<div class="row">
                    	<div class="col-lg-4 text-right">IMPORTANCE</div>
                        <div class="col-lg-7">
                        	 <div id="impslide"></div>
                        </div>
                        <div class="col-lg-1">
                        	<div id="defaultval"><span id="impval">0</span></div>
            			</div>
                    </div>
                    <div class="row">
                    	<div class="col-lg-4 text-right">CREDIBILITY</div>
                        <div class="col-lg-7">
                        	 <div id="creditslide"></div>
                        </div>
                        <div class="col-lg-1">
                        	<div id="defaultval"><span id="creditval">0</span></div>
            			</div>
                    </div>
                    <div class="row">
                    	<div class="col-lg-4 text-right">TIMELINE</div>
                        <div class="col-lg-7">
                        	 <div id="timeslide"></div>
                        </div>
                        <div class="col-lg-1">
                        	<div id="defaultval"><span id="timeval">0</span></div>
            			</div>
                    </div>
                    <div class="row">
                    	<div class="col-lg-4 text-right">APPEARANCE</div>
                        <div class="col-lg-7">
                        	 <div id="appslide"></div>
                        </div>
                        <div class="col-lg-1">
                        	<div id="defaultval"><span id="appval">0</span></div>
            			</div>
                    </div>
                     <div class="text-right pad-top">
                    	<button type="submit" class="btn btn-danger">SUBMIT</button>
                    </div>
                </div>
            </div>
            
            <script type="text/javascript">
				$(function(){
					  $('#impslide').slider({ 
						max: 10,
						min: 0,
						value: 0,
						slide: function(e,ui) {
						  $('#impval').html(ui.value);
						}
					  });
				  
					  $('#creditslide').slider({ 
						max: 10,
						min: 0,
						value: 0,
						slide: function(e,ui) {
						  $('#creditval').html(ui.value);
						}
					  });
					  
					  $('#timeslide').slider({ 
						max: 10,
						min: 0,
						value: 0,
						slide: function(e,ui) {
						  $('#timeval').html(ui.value);
						}
					  });
					  
					  $('#appslide').slider({ 
						max: 10,
						min: 0,
						value: 0,
						slide: function(e,ui) {
						  $('#appval').html(ui.value);
						}
					  });
					  
					  
			  	  });
			
				
			</script>
        </div>
    </div>
</div>