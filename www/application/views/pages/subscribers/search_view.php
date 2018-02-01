<!--start page 14 -->
<div class="container">
	<div class="row">
    	<div class="col-lg-4">
        	<h3>PAGE NAME</h3>
        </div>
        <div class="col-lg-8 bg-light pad-bottom">
        	<h4>Chrissie Wellington by <i>Rebecca Marshall</i></h4>
            <div class="pad-bottom">
            	<object width="100%"><param name="movie" value="//www.youtube.com/v/xY_MUB8adEQ?version=3&amp;hl=en_US&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/xY_MUB8adEQ?version=3&amp;hl=en_US&amp;rel=0" type="application/x-shockwave-flash" width="100%" allowscriptaccess="always" allowfullscreen="true"></embed></object>
            </div>
            <div class="row">
            	<div class="col-lg-6"><p>20 Days Remaining</p></div>
                <div class="col-lg-6">
                	<h4 class="less-mar-top">Rate It :</h4>
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

<!--End page 14 -->





<hr>





<!--start page 13 -->
<div class="container">
	<div class="row">
    	<div class="col-lg-3">
        	<h3>NEW SEARCH</h3>
        </div>
    	<div class="col-lg-9 bg-light pad-bottom video-thumb">
        	<h4>result</h4>
            <div class="row">
            	<div class="col-lg-2 text-right">
                	<p>User Rating: 80%<br>
                    	<small class="text-muted">(20 days left)</small>
                    </p>
                </div>
                <div class="col-lg-10 text-right">
                	<a href="#"><img src="<?php echo BASE_ASSETS; ?>images/demo-img/demo-thumb-1.jpg" class="img-responsive"></a>
                </div>
            </div>
            <hr>
            <div class="row">
            	<div class="col-lg-2 text-right">
                	<p>User Rating: 50%<br>
                    	<small class="text-muted">(5 days left)</small>
                    </p>
                </div>
                <div class="col-lg-10 text-right">
                	<a href="#"><img src="<?php echo BASE_ASSETS; ?>images/demo-img/demo-thumb-2.jpg" class="img-responsive"></a>
                </div>
            </div>
            <hr>
            <div class="row">
            	<div class="col-lg-2 text-right">
                	<p>User Rating: 10%<br>
                    	<small class="text-muted">(1 days left)</small>
                    </p>
                </div>
                <div class="col-lg-10 text-right">
                	<a href="#"><img src="<?php echo BASE_ASSETS; ?>images/demo-img/demo-thumb-3.jpg" class="img-responsive"></a>
                </div>
            </div>
        </div>
    </div>
</div>	


<!--End page 13 -->






<hr>








<!--start page 5 -->
<div class="container">
	<div class="row">
		<div class="col-lg-4">
        	<h3>SEARCH BY KEYWORD</h3>
        </div>
        <div class="col-lg-5 bg-light pad-bottom pad-top">
        	<div class="input-group">
              <input type="text" class="form-control" placeholder="Enter Search Terms, Separated By Commas">
              <span class="input-group-btn">
                <button class="btn btn-danger" type="button"><i class="fa fa-search"></i></button>
              </span>
            </div>
            <hr>
            <div class="row">
            	<div class="col-lg-6">
                	<ul class="list-unstyled">
                    	<li>Lorem Ipsum is simply dummy tex</li>
                    	<li>Lorem Ipsum is simply dummy tex</li>
                        <li>Lorem Ipsum is simply dummy tex</li>
                    	<li>Lorem Ipsum is simply dummy tex</li>
                        <li>Lorem Ipsum is simply dummy tex</li>
                    	<li>Lorem Ipsum is simply dummy tex</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                	<ul class="list-unstyled">
                    	<li>Lorem Ipsum is simply dummy tex</li>
                    	<li>Lorem Ipsum is simply dummy tex</li>
                        <li>Lorem Ipsum is simply dummy tex</li>
                    	<li>Lorem Ipsum is simply dummy tex</li>
                        <li>Lorem Ipsum is simply dummy tex</li>
                    	<li>Lorem Ipsum is simply dummy tex</li>
                    </ul>
                </div>
            </div>
        </div>
	</div>
</div>

<!-- end page 5 -->







<hr>



<!--start page-->
<div class="container">
	<div class="row">
    	<div class="col-lg-7 col-nd-7 pad-top">
        	<a href="#"><img src="<?php echo BASE_ASSETS; ?>images/demo-img/demo-img.jpg" class="img-responsive"></a>
            <div class="row">
            	<div class="col-lg-8"><p>your text your text your text</p></div>
                <div class="col-lg-4 text-right"><a href="#">Shannon L. Frady</a></div>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 bg-light pad-bottom">
        	<h3>Search stories by :</h3>
        </div>
    </div>
</div>
<!--end-->






<!--start-->

<?php /*?><div  id="user_details_<?php echo $row->mem_id?>" class="col-lg-6 bg-light pad-bottom user_details"  style="display:none">
         <br />
        	<h3 class="less-mar-top">Result</h3>
            <div class="media">
                <div class="pull-left">
                    <img src="<?php echo $img_src?>" style="width: 35px; height: 35px;" class="media-object" alt="32x32">
                </div>
                <div class="media-body">
                  <h5 class="media-heading"><?php echo $row->username; ?></h5>
                  <h5><?php echo $connections?> <small>Connections</small></h5>
                 </div>
              </div>
              <hr>
              <h6>New life at Song Tra, Vietnam<br>
              A Soldier's Tale: Memoirs from Special Forces</h6>
              <hr>	
              
                <dl class="dl-horizontal">
                    <dt>Experience:</dt>
                    <dd><?php echo $row->experience;?></dd>
                    
                    <dt>Expertise:</dt>
                    <dd><?php					 
					  $exp = explode(',',$row->expertise);
					  
					 	if(!empty($exp))
						{
							foreach($exp as $val) echo $val."<br />";
						}
					 ?></dd>
                    
                </dl>
				<hr>
                  <button class="btn btn-danger btn-sm" type="button" onclick="javascript:send_request(<?php echo $row->mem_id?>);" name=                  "btntext<?php echo $row->mem_id?>" id="btntext<?php echo $row->mem_id?>" type="button" value="Connect">Connect</button>
                  <button class="btn btn-primary btn-sm" type="button">View Follo</button>
                  <div class="clearfix pad-top pad-bottom">
                  <textarea class="form-control" rows="3" name="messagetext<?php echo $row->mem_id?>"id="messagetext<?php echo $row->mem_id?>">                  </textarea></div>
                  <button class="btn btn-danger btn-sm" onclick="javascript:send_message(<?php echo $row->mem_id?>);" type="button">Send                   Message</button><br /><br />
         </div><?php */?>
<!--end-->
<?php /*?><div  id="user_details_<?php echo $row->mem_id?>" class="col-lg-6 bg-light pad-bottom user_details"  style="display:none">
         <br />
        	<h3 class="less-mar-top">Result</h3>
            <div class="media">
                <div class="pull-left">
                    <img src="<?php echo $img_src?>" style="width: 35px; height: 35px;" class="media-object" alt="32x32">
                </div>
                <div class="media-body">
                  <h5 class="media-heading"><?php echo $row->username; ?></h5>
                  <h5><?php echo $connections?> <small>Connections</small></h5>
                 </div>
              </div>
              <hr>
              <h6>New life at Song Tra, Vietnam<br>
              A Soldier's Tale: Memoirs from Special Forces</h6>
              <hr>	
              
                <dl class="dl-horizontal">
                    <dt>Experience:</dt>
                    <dd><?php echo $row->experience;?></dd>
                    
                    <dt>Expertise:</dt>
                    <dd><?php					 
					  $exp = explode(',',$row->expertise);
					  
					 	if(!empty($exp))
						{
							foreach($exp as $val) echo $val."<br />";
						}
					 ?></dd>
                    
                </dl>
				<hr>
                  <button class="btn btn-danger btn-sm" type="button" onclick="javascript:send_request(<?php echo $row->mem_id?>);" name=                  "btntext<?php echo $row->mem_id?>" id="btntext<?php echo $row->mem_id?>" type="button" value="Connect">Connect</button>
                  <button class="btn btn-primary btn-sm" type="button">View Follo</button>
                  <div class="clearfix pad-top pad-bottom">
                  <textarea class="form-control" rows="3" name="messagetext<?php echo $row->mem_id?>"id="messagetext<?php echo $row->mem_id?>">                  </textarea></div>
       
	              <button class="btn btn-danger btn-sm" onclick="javascript:send_message(<?php echo $row->mem_id?>);" type="button">Send                   Message</button><br /><br />
         </div><?php */?>

<div class="container">
	<div class="row">
    	
        <div class="col-lg-6 bg-light pad-bottom">
        	<h3>Result</h3>
            <div class="media">
                <div class="pull-left">
                  <img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAABi0lEQVR4nO2VrZLCMBRGef9HuSImoiIC05maiogaRERMJa9wVyXD37K7FDjD7CfOTIH0zuEk0N3xePT/zI4WoFEAWoBGAWgBGgWgBWgUgBagUQBagEYBaAEaBaAFaBSAFqBRAFqARgFoARoFoAVoFIAWoNkcIOfsMUY3M48xeq31ak0Iwc0MnfmSAIfDwc3Mc85ea3Uz8/1+f7Zmnmc3s1/LvmLmywKklO5KrOvad7Kta19qGIa+bhgGNzOvtT40EwvQjmiTTimdfT6Ooy/LciXbdjDn3K/ned40EwtgZl5K6Ue3Hddaa9/lW7IxRg8heAjBY4xPmYkFuPU6peSllG9lc879/WmanjLz7QEu/4lPpdr1Jaf3np6CdV03z3x7gGma+m+5lOJm5uM4/nhS2n3LsvST0O57dCYSoAm3Xbsleil77ynQjvdfZ6IBPh0FoAVoFIAWoFEAWoBGAWgBGgWgBWgUgBagUQBagEYBaAEaBaAFaBSAFqBRAFqARgFoARoFoAVoFIAWoPkClAggzoBQdWcAAAAASUVORK5CYII=">
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Media heading</h4>
                  <h5>49 <small>Connections</small></h5>
                </div>
              </div>
              <hr>
              <h5>New life at Song Tra, Vietnam</h5> 
              <h5>A Soldier's Tale: Memoirs from Special Forces</h5>
              <hr>	
              
                <dl class="dl-horizontal">
                    <dt>Experience:</dt>
                    <dd>6 Years</dd>
                    
                    <dt>Expertise:</dt>
                    <dd>Multimedia</dd>
					<dd>Blogs</dd>
					<dd>Photoshop</dd>
                    
                </dl>
				<hr>
                 <button class="btn btn-danger btn-sm" type="button">Connect</button>
                 <button class="btn btn-primary btn-sm" type="button">View Follo</button>
                 <div class="clearfix pad-top pad-bottom"><textarea class="form-control" rows="3"></textarea></div>
                 <button class="btn btn-danger btn-sm" type="button">Send Message</button>
           
        </div>
        <div class="col-lg-4 col-lg-offset-2">
        	<h3>Search</h3>
          	<form role="form">
            <label>Experience</label>
            <div class="form-group">
            	<select class="form-control input-sm">
                  	<option>Less than 1 year</option>
                    <option>1-2 years</option>
                    <option>2-5 years</option>
                    <option>5 years or more</option>
                </select>
            </div>
            <label>Interests (Separate by commas):</label>
            <div class="form-group">
            	<input type="text" class="form-control input-sm">
            </div>
            <label>Location:</label>
            <div class="form-group">
            	<select class="form-control input-sm">
                  	<option>India</option>
                    <option>China</option>
                </select>
            </div>
            <div class="row">
            	<div class="col-lg-6">
            		<div class="form-group">
            	<select class="form-control input-sm">
                  	<option>Maharastra</option>
                    <option>Gujrat</option>
                  </select>
             </div>
            	</div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <select class="form-control input-sm">
                            <option>Jalgaon</option>
                            <option>nashik</option>
                          </select>
                     </div>
                </div>
            </div>
            <div class="form-group">
            	<input type="text" placeholder="Or Postal Code" class="form-control input-sm">
            </div>
            <label>Radius:</label>
            <div class="form-group">
            	<select class="form-control input-sm">
                  	<option>25 miles/40.23 km</option>
                    <option>25 miles/40.23 km</option>
                </select>
            </div>
            
            <label>Expertise (Separate by commas):</label>
            <div class="form-group">
            	<input type="text" class="form-control input-sm">
            </div>
            <label>Keyword (Separate by commas):</label>
            <div class="form-group">
            	<input type="text" class="form-control input-sm">
            </div>
            <div class="form-group"><button type="button" class="btn btn-danger btn-sm">Submit</button></div>
            
          </form>
          
        </div>
    </div>
	
    <hr>
    
    <h3>SUBSCRIPTION RATES:</h3>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>RATE</th>
          <th>Free</th>
          <th>99 Cents Per View</th>
          <th>$9.99 Per Month</th>
          <th>$1250 Institutional</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>ACCESS</td>
          <td>Trailers / Headlines</td>
          <td>1 Story</td>
          <td>Unlimited Monthly</td>
          <td>Unlimited Annually</td>
        </tr>
        <tr>
          <td>ACCESS</td>
          <td>Trailers / Headlines</td>
          <td>1 Story</td>
          <td>Unlimited Monthly</td>
          <td>Unlimited Annually</td>
        </tr>
      </tbody>
    </table>
    <h4>SUBSCRIBERS <small>The final authority</small></h4>
    <div class="row">
        <div class="col-lg-5">
        	<p>This is Photoshop's version  of Lorem Ipsum.</p>
    		<p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. </p>
    		<p>Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
        </div>
        <div class="col-lg-7 bg-light pad-top pad-bottom">
            <div class="row">
                <div class="col-lg-4">
                    <label class="checkbox">
                    <input type="checkbox"> PayPal
                    </label>
                </div>
                <div class="col-lg-8">
                    <img src="http://192.168.1.6/vettage/media/img/paypal.gif">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4">
                    <label class="checkbox">
                    <input type="checkbox"> Credit card <br>(Through PayPal)
                    </label>
                </div>
                <div class="col-lg-8">
                    <img src="http://192.168.1.6/vettage/media/img/visa_card.gif">
                    <img src="http://192.168.1.6/vettage/media/img/master_card.gif">
                    <img src="http://192.168.1.6/vettage/media/img/discover-card.gif">
                    <img src="http://192.168.1.6/vettage/media/img/express_card.gif">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4">
                    <label class="checkbox">
                    <input type="checkbox"> eCheck <br>(Through PayPal)
                    </label>
                </div>
                <div class="col-lg-8">
                    <img src="http://192.168.1.6/vettage/media/img/echeck.gif">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4">
                    <label class="checkbox">
                    <input type="checkbox"> E-Currency*
                    </label>
                </div>
                <div class="col-lg-8">
                    <img src="http://192.168.1.6/vettage/media/img/egold.gif">
                    <img src="http://192.168.1.6/vettage/media/img/e-bullion.gif">
                    <img src="http://192.168.1.6/vettage/media/img/pecuix.gif">
                    <img src="http://192.168.1.6/vettage/media/img/goldmoney.gif">
                    <img src="http://192.168.1.6/vettage/media/img/mdc.gif">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4">
                    <label class="checkbox">
                    <input type="checkbox"> Bitcoin
                    </label>
                </div>
                <div class="col-lg-8">
                    <img src="http://192.168.1.6/vettage/media/img/bitcoin.gif">
                </div>
            </div>
        </div>
    </div>
    
</div>