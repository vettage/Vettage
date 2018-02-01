

	<div class="container">
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
			<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
    						<div class="row">
    	
    	<div class="col-lg-5 bg-light pad-bottom" id="user_list"><!--style="background-color:#f8d273;font-size:28px;color:#FFF"-->
        	<h3><?php echo $story_details->title;?> | Rating: <?php echo $story_rating?></h3>

             </div>
             </div>

					<div class="row">

		<?php 
			$this->load->view('sub_parts/content_types/notlogged.php',$story_details);
		 ?>


					<div class="col-lg-4">	
					
					 				 
<?php foreach ($contributors as $c ) {?>
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


		<div class="row">
				<h3>Login or Join to Rate!</h3>
 				<form action="<?php echo $_SERVER['PHP_SELF']?>" class="signin" method="post" id="frmsignin" role="form">
				<div class="form-group">
					<input type="text" id="signin_email" name="signin_email" value="" placeholder="Username or email" 
                    class="form-control input-sm" > 
				</div>
				<div class="form-group">
					<input type="password" id="signin_password" name="signin_password" placeholder="Password" 
                     class="form-control input-sm" autocomplete="off" value="">
 				</div>
				<div class="form-group">
					<small class="pull-right"><a href="javascript:void(0);" id="hreforgot">Forgot password?</a></small>
					<div class="checkbox less-mar-top">
                    <label  class="text-muted">
                    <input type="checkbox" value="1" name="remember" checked="checked">Remember me</label>
                    </div>
				</div>
				<input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']?>"/>
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
				<input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']?>"/>

			  </form>
 		

                         
                            
							
					</div>


<?php /*?><?php if($this->session->userdata('level')==2){?>
<script src="//www.bitwall.io/javascripts/widget.js" id="bitwallWidgetScript" data-title="Buy with bitcoin" data-key="if4pkoc"></script> 
<?php }?><?php */?>

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