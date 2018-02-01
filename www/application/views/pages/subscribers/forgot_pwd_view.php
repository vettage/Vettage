	<div class="container">
 <div class="alert alert-success" id="success_new" style="display:none"></div>
	<div class="alert alert-error" id="error_new" style="display:none"></div>   
     <div class="col-lg-12 tital_name">Forgot Password</div>
    <div class="row g1-border">
        	<form  role="form" method="post" id="frmforgot" action="" name="forgot_password">
                   <div class="row">
                     <div class="col-lg-6" align="center"><br>
                         <div class="form-horizontal paddinh5"  id="user_list">
                            <div class="form-group <?php echo ((form_error('email')!=NULL)) ? 'has-error' : '' ?>" id="e_id">
                              <label class="col-sm-5 control-label" for="email">E-mail <font color="#FF0000">*</font></label>
                              <div class="col-sm-6">
                              <input type="text" placeholder="Username or email" id="forgot_email"
                               name="forgot_email" value="<?php echo $this->input->post('forgot_email');?>" class="form-control"> 
                            <span class="help-block" id="e_err" style="color:#B94A48;"></span>
                         <?php echo ((form_error('email')!=NULL)) ? '<span class="help-block">'.form_error('email').'</span>' : '' ?>
 		             </div>
		             </div>  
                        <font color="#FF0000">*</font><span class="inline-meta">Marked Fields are Mandatory</span>
                       </div>
                    </div>
                   </div><br />
                   <div class="controls" align="center" style="margin-right:600px;">
<!--                  	 <button class="btn btn-success" type="submit" style="margin-top:30px;" id="submit" name="sbmt_forgot">Submit                   </button>
-->                     <button class="btn btn-danger btn-sm" type="submit" id="btnforgot">Reset password</button>&nbsp;
					<button class="btn btn-sm" type="button" onclick="javascript:history.go(-1);" id="btnforgotcancel">Cancel
                    </button>
                 </div><br />
              </form>
     </div>
     </div>
<?php if($this->session->userdata('fv_logged_in')==FALSE){?>
<script type="text/javascript" language="javascript">
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
			url: "<?php echo BASE_URL;?>index.php/forgot_pwd/forgot",
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
 
