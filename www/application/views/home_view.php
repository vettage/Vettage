	<script src="<?php echo BASE_ASSETS;?>tweetie/tweetie.js"></script>
<style>

        .example1 {
            width: 350px;
            margin: 50px auto;
        }
        .example1 .tweet {
            padding: 15px;
            position: relative;
            background: white;
            -webkit-border-radius: 3px;
               -moz-border-radius: 3px;
                    border-radius: 3px;
        }
        .example1 .tweet:after {
            content: "";
            position: absolute;
            width: 0;
            height: 0;
            border-width: 10px;
            border-style: solid;
            border-color: white transparent transparent transparent;
            bottom: -20px;
            left: 50%;
            margin-left: -10px;
        }
        .example1 .tweet .date {
            margin-top: 5px;
            font-weight: bold;
            font-size: 11px;
        }
        .example1 .button {
            background-color: rgb(105, 210, 231);
            background-repeat: no-repeat;
            background-position: center;
            background-image: url(data:image/png;base64,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);
            width: 50px;
            height: 50px;
            margin: 20px auto 0;
            -webkit-border-radius: 6px;
               -moz-border-radius: 6px;
                    border-radius: 6px;
            -webkit-box-shadow: rgba(87, 169, 185, 0.9) 0px 3px 0px 0px, transparent 0 0 0;
               -moz-box-shadow: rgba(87, 169, 185, 0.9) 0px 3px 0px 0px, transparent 0 0 0;
                    box-shadow: rgba(87, 169, 185, 0.9) 0px 3px 0px 0px, transparent 0 0 0;
        }
        .example1 .button:hover {
            -webkit-box-shadow: rgb(105, 210, 231) 0px 3px 0px 0px, transparent 0 0 0;
               -moz-box-shadow: rgb(105, 210, 231) 0px 3px 0px 0px, transparent 0 0 0;
                    box-shadow: rgb(105, 210, 231) 0px 3px 0px 0px, transparent 0 0 0;
        }

</style>


<?php $level = '';if($this->input->post('level')!=NULL) $type = $this->input->post('level');
 ?>
<div data-ride="carousel" class="carousel slide" id="carousel-example-generic">  
    <div class="carousel-inner">
      
	  <?php 

	  $user_details = $this->member_model->get_single_record("mem_id='".$this->session->userdata('mem_id')."'");
	  if($slider_images!=NULL)
	  {
	  	$count = 0;
	  	foreach($slider_images as $slider)
		{
			$editor='';
			if($slider->editor>0){

				$details = $this->member_model->get_single_record("mem_id='".$slider->editor."'");

				if($details!=null) $editor=$details->username;
			}
			
			$slider_link=BASE_URL.'story/'.$slider->alias;
			
	  	?>
		  <div class="item <?php if($count==0) echo "active";?>">
			<a href="<?php echo $slider_link;?>" >
				<img alt="<?php echo $slider->title?>" src="<?php echo BASE_ASSETS; ?>/uploads/stories/<?php echo $slider->image; ?>" title="<?php echo $slider->title?>">
			</a>
            <div class="carousel-caption">
            <a href="<?php echo $slider_link;?>" >
                <h3><?php echo $slider->title?></h3>
             </a>
                <h4><a href="<?php echo BASE_URL?>/account/profile/<?php echo $slider->editor?>">By <?php echo  $editor ?></a></h4>
             </div>
		  </div>
	  	<?php 
		  $count++;
	 	 }
	  } else { $count = 4; ?>
		  <div class="item active">
			<img alt="First slide" src="<?php echo BASE_ASSETS; ?>images/slider/slider1.jpg">
            <div class="carousel-caption">
                <h1>First slide label</h1>
                <h4>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</h4>
             </div>
		  </div>
		  <div class="item">
			<img alt="First slide" src="<?php echo BASE_ASSETS; ?>images/slider/slider2.jpg">
            <div class="carousel-caption">
            	<h1>Second slide label</h1>
            	<h4>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</h4>
          	</div>
		  </div>
		  <div class="item">
			<img alt="First slide" src="<?php echo BASE_ASSETS; ?>images/slider/slider3.jpg">
            <div class="carousel-caption">
            	<h1>Third slide label</h1>
            	<h4>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</h4>
          	</div>
		  </div>
		  <div class="item">
			<img alt="First slide" src="<?php echo BASE_ASSETS; ?>images/slider/slider4.jpg">
            <div class="carousel-caption">
            	<h1>Fourth slide label</h1>
            	<h4>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</h4>
          	</div>
		  </div>
	  <?php } ?>
	  
    </div>
	
	<a data-slide="prev" href="#carousel-example-generic" class="left carousel-control">
	  <?php if($count>1){?><span class="glyphicon glyphicon-chevron-left"></span><?php } ?>
	</a>
	<a data-slide="next" href="#carousel-example-generic" class="right carousel-control">
	 <?php if($count>1){?> <span class="glyphicon glyphicon-chevron-right"></span><?php } ?>
	</a>
	
</div>

<div class="container">
 <br />
		<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<div class="row">
   
		<div class="col-lg-4">
<?php echo $left_column ?>	
	</div>	
		<div class="col-lg-5 bg-light">
<?php echo $right_column ?>
        </div>
		
		<?php 
		$cookie_data = get_cookie('rememberMe');
		$username = $password = '';
		if($cookie_data!=NULL)
		{
			$explode = explode("#",$cookie_data);
			if(sizeof($explode)==2) $username = $explode[0]; $password = $explode[1];
		}
		if($this->session->userdata('fv_logged_in')==FALSE){?>
			<div class="col-lg-3 pad-top">
 				<form action="<?php echo $_SERVER['PHP_SELF']?>" class="signin" method="post" id="frmsignin" role="form">
				<div class="form-group">
					<input type="text" id="signin_email" name="signin_email" value="<?php echo $username; ?>" placeholder="Username or email" 
                    class="form-control input-sm" > 
				</div>
				<div class="form-group">
					<input type="password" id="signin_password" name="signin_password" placeholder="Password" 
                     class="form-control input-sm" autocomplete="off" value="<?php echo $password; ?>">
 				</div>
				<div class="form-group">
					<small class="pull-right"><a href="javascript:void(0);" id="hreforgot">Forgot password?</a></small>
					<div class="checkbox less-mar-top">
                    <label  class="text-muted">
                    <input type="checkbox" value="1" name="remember" <?php if($cookie_data!=NULL) echo 'checked="checked"';?> checked="checked">Remember me</label>
                    </div>
				</div>
				<div class="form-group"><button class="btn btn-danger btn-sm" type="button" name="doLogin" id="btnsignin">Sign in</button>
                </div>
			  </form>
 				<form action="" class="signin" method="post" id="frmforgot" role="form">
				<div class="form-group">
					<input type="text" id="forgot_email" name="forgot_email" placeholder="Username or email" class="form-control input-sm">
				</div>
				<div class="form-group">
					<button class="btn btn-danger btn-sm" type="button" id="btnforgot">Reset password</button>
					<button class="btn btn-sm" type="button" id="btnforgotcancel">Cancel</button>
				</div>
			  	</form>
 				<h3>New to Vettage? <small>Sign up</small></h3>
				<form role="form" id="frmregister" action="">
				<div class="form-group">
					<input type="text" name="username" id="username" placeholder="Username" class="form-control input-sm">
				</div>
				<div class="form-group">
					<input type="text" name="email" id="email" placeholder="Email" class="form-control input-sm">
				</div>
				<div class="form-group">
					<input type="password" name="password" id="password" placeholder="Password" autocomplete="off" 
                    class="form-control input-sm">
				</div>
				<div class="form-group">
					<button class="btn btn-danger btn-sm"  type="button" id="btnregister">Sign up for Vettage </button>
 				</div>
			  </form>
			  	 <div class="example1">
        <div class="tweet"></div>
    </div>

   <script class="source" type="text/javascript">
        $('.example1 .tweet').twittie({
            dateFormat: '%b. %d, %Y',
            template: '{{tweet}} <div class="date">{{date}}</div>',
            count: 1,
            loadingText: 'Loading!'
        });
    </script>
			  
 			</div>
		<?php } else {  ?>
			<div class="col-lg-3">
			
	 <div class="example2">
        <div class="tweet"></div>
    </div>

    <script class="source2" type="text/javascript">
        $('.example2 .tweet').twittie({
            dateFormat: '%b. %d, %Y',
            template: '<strong class="date">{{date}}</strong> - {{screen_name}} {{tweet}}',
            count: 10
        }, function () {
            setInterval(function() {
                var item = $('.example2 .tweet ul').find('li:first');
                item.animate( {marginLeft: '-220px', 'opacity': '0'}, 500, function() {
                    $(this).detach().appendTo('.example2 .tweet ul').removeAttr('style');
                });
            }, 5000);
        });
    </script>
		<?php } ?>
		
	</div>
</div>
 
<script type="text/javascript">
function paid() {  
	window.location = "<?php echo BASE_URL?>register/rates"
}
<?php /*?>function listing(type)
{
	if(type==3)
	{
		$('#level_list').css('display','block');
		$('.level_details').css('display','none');
	}
	else
	{
		$('#level_list').css('display','none');
		$('.level_details').css('display','block');
	}
}<?php */?>
</script>

<script>
  !function ($) {
    $(function(){
      $('#myCarousel').carousel()
    })
  }(window.jQuery)
</script>


<?php if($this->session->userdata('fv_logged_in')==FALSE){?>
<script>
$('#frmforgot').hide();
function submitlogin()
{
	var error = ''
	if($('#signin_email').val()=='')
	{
		error += 'Please enter your email address or username <br/>';
	}
	if($('#signin_password').val()=='')
	{
		error += 'Please enter your password <br/>';
	}
	if(error!='')
	{
		$(function () { 
			var $news_modal = $('#error_dispaly');
			$news_modal.modal({
				show: true
			});
			$('#model_body').html('<p class="text-danger">'+error+'</p>');
		});
	}
	else
	{	
		$.ajax({
			type: "POST",
			url: "<?php echo BASE_URL;?>login/ajax",
			data: $('#frmsignin').serialize(),
			cache: false,
			async: true,
			success: function(result)
			{
				var explode = result.split('#');
				if(explode[0]=='error')
				{
					$(function () { 
						var $news_modal = $('#error_dispaly');
						$news_modal.modal({
							show: true
						});
						$('#model_body').html('<p class="text-danger">'+explode[1]+'</p>');	
					});
				}
				else
				{
					window.location.href=explode[1];
				}
					clearconsole();

			},
			error: function(request, textStatus, errorThrown)
			{
				//alert('error');
			}
		});
	}
}
function clearconsole() { 
  console.log(window.console);
  if(window.console || window.console.firebug) {
   console.clear();
  }
}
$(function() {
	$('#signin_email').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){ submitlogin(); }
	});
});
$(function() {
	$('#signin_password').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){ submitlogin(); }
	});
});
$('#btnsignin').click( function(){
	submitlogin();
})

$('#btnregister').click( function(){
	var Form = document.getElementById('frmregister');  
/*
	var type = '';
	for (Count = 0; Count < 3; Count++) {
		if (Form.type[Count].checked)
		{
			type = Form.type[Count].value;
			break;
		}
	}
	*/
	var error = ''
	if($('#username').val()=='')
	{
		error += 'Please enter username<br/>';
	}
	if($('#email').val()=='')
	{
		error += 'Please enter your email address <br/>';
	}
	if($('#password').val()=='')
	{
		error += 'Please enter your password <br/>';
	}
	
	//if(type=='')
	//{
	//	error += 'Please select type <br/>';
	//}
	//else
	//{
	//	if(type==1 && $('#contribute_bit_address').val()=='') error += 'Please enter wallet bitcoin address <br/>';
	//	if(type==2 && $('#editor_bit_address').val()=='') error += 'Please enter wallet bitcoin address <br/>';
	//	if(type==1) $('#editor_bit_address').val('');
	//	if(type==2) $('#contribute_bit_address').val('');
	//	if(type==3) 
	//	{
	//		$('#contribute_bit_address').val('');
	//		if($('#level').val()=='')
	//		{
	//			error += 'Please select level <br/>';
	//		}
	//	}
	//}
	if(error!='')
	{
		$(function () { 
			var $news_modal = $('#error_dispaly');
			$news_modal.modal({
				show: true
			});
			$('#model_body').html('<p class="text-danger">'+error+'</p>');
		});
	}
	else
	{	
		$.ajax({
			type: "POST",
			url: "<?php echo BASE_URL;?>register/ajax",
			data: $('#frmregister').serialize(),
			cache: false,
			async: true,
			success: function(result)
			{
				var explode = result.split('#');
				if(explode[0]=='error')
				{
					$(function () { 
						var $news_modal = $('#error_dispaly');
						$news_modal.modal({
							show: true
						});
						$('#model_body').html('<p class="text-danger">'+explode[1]+'</p>');	
					});
				}
				else {
				
					window.location.href=explode[1];
					clearconsole();

				}
			},
			error: function(request, textStatus, errorThrown)
			{
				//alert('error');
			}
		});
	}
})

/*$(function() {
	$('#forgot_email').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){ submitforgot(); }
	});
});*/

function submitforgot()
{
	var Form = document.getElementById('frmforgot');  
	var error = ''
	if($('#forgot_email').val()=='')
	{
		error += 'Please enter your email address or username <br/>';
	}
	
	if(error!='')
	{
		$(function () { 
			var $news_modal = $('#error_dispaly');
			$news_modal.modal({
				show: true
			});
			$('#model_body').html('<p class="text-danger">'+error+'</p>');
		});
	}
	else
	{	
		$.ajax({
			type: "POST",
			url: "<?php echo BASE_URL;?>login/reset_password",
			data: "email="+$('#forgot_email').val(),
			cache: false,
			async: true,
			success: function(result)
			{
				var explode = result.split('#');
				$(function () { 
					var $news_modal = $('#error_dispaly');
					$news_modal.modal({
						show: true
					});
					
					if(explode[0]=="error")
						$('#model_body').html('<p class="text-danger">'+explode[1]+'</p>');	
					else
						$('#model_body').html('<p class="text-success">'+explode[1]+'</p>');	
					//$('#model_body').html('<p class="text-"'+explode[0]+'">'+explode[1]+'</p>');	
				});
				if(explode[0]=='success')
				{
					$('#frmsignin').show();
					$('#frmforgot').hide();
					$('#forgot_email').val('')
				}
			},
			error: function(request, textStatus, errorThrown)
			{
				//alert('error');
			}
		});
	}
}


$('#btnforgot').click( function(){
	submitforgot();
})

$('#hreforgot').click( function(){
	$('#frmsignin').hide();
	$('#frmforgot').show();
})

$('#btnforgotcancel').click( function(){
	$('#frmsignin').show();
	$('#frmforgot').hide();
	$('#forgot_email').val('')
})


</script>
<?php } ?>