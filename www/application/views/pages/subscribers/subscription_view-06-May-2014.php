<form id="frmsubscriptions" method="post" action="" onsubmit="javascript:return confirmpayment();">
<div class="container">

		<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
		<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	
      	<h3>CHANGE SUBSCRIPTION:</h3>
		<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th width="15%">RATE</th>
				<th width="15%" <?php if($level==1){?>style="background:#FED108;" <?php } ?>>Free</th>
                <th width="15%" <?php if($level==2){?>style="background:#FED108;" <?php } ?>>Micropayments / Sharing</th>
				<th width="17%" <?php if($level==3){?>style="background:#FED108;" <?php } ?>>99 Cents Per View</th>
				<th width="18%" <?php if($level==4){?>style="background:#FED108;" <?php } ?>>$9.99 Per Month</th>
				<th width="20%" <?php if($level==5){?>style="background:#FED108;" <?php } ?>>$1250 Institutional</th>
			</tr> 
		</thead>
		<tbody>
		<tr>
			<td>ACCESS</td>
			<td <?php if($level==1){?>style="color:#fff;background:#357EBD;"<?php } ?>>Trailers / Headlines<br/>1 story per month</td>
            <td <?php if($level==2){?>style="color:#fff;background:#357EBD;" <?php } ?>>Per Story</td>
			<td <?php if($level==3){?>style="color:#fff;background:#357EBD;" <?php } ?>>1 Story</td>
			<td <?php if($level==4){?>style="color:#fff;background:#357EBD"<?php } ?>>Unlimited Monthly</td>
			<td <?php if($level==5){?>style="color:#fff;background:#357EBD;" <?php } ?>>Unlimited Annually<br/>Request Stories / Assign Reporters</td>
		</tr>
		<tr>
			<td>RATING PRIVILEGES</td>
			<td <?php if($level==1){?>style="color:#fff;background:#357EBD"<?php } ?>>None</td>
            <td <?php if($level==2){?>style="color:#fff;background:#357EBD"<?php } ?>>Per Story</td>
			<td <?php if($level==3){?>style="color:#fff;background:#357EBD"<?php } ?>>1 Story</td>
			<td <?php if($level==4){?>style="color:#fff;background:#357EBD"<?php } ?>>Unlimited Monthly</td>
			<td <?php if($level==5){?>style="color:#fff;background:#357EBD"<?php } ?>>Unlimited Annually</td>
		</tr>
		<tr>
			<td></td>
			<td <?php if($level==1){?>style="color:#fff;background:#357EBD"<?php } ?>>
				<?php if($level<=1){?><input type="radio" name="level" value="1" /> <?php }?>
			</td>
            <td <?php if($level==2){?>style="color:#fff;background:#357EBD"<?php } ?>>
				<?php if($level<=2){?><input type="radio"  name="level" value="2" /><?php }?>
			</td>
			<td <?php if($level==3){?>style="background:#357EBD"<?php } ?>>
				<?php if($level<=3){?><input type="radio" name="level" value="3" /><?php }?>
			</td>
			<td <?php if($level==4){?>style="background:#357EBD"<?php } ?>>
				<?php if($level<=4){?><input type="radio" name="level" value="4" /><?php }?>
			</td>
			<td <?php if($level==5){?>style="background:#357EBD"<?php } ?>>
				<?php if($level<=5){?><input type="radio" name="level" value="5" /><?php }?>
			</td>
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
						<input type="radio" name="payment" value="paypal"> PayPal
					</label>
				</div>
				<div class="col-lg-8">
					<img src="<?php echo BASE_ASSETS; ?>img/paypal.gif">
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-4">
					<label class="checkbox">
						<input type="radio" name="payment" value="paypal_credit"> Credit card <br>(Through PayPal)
					</label>
				</div>
				<div class="col-lg-8">
					<img src="<?php echo BASE_ASSETS; ?>img/visa_card.gif">
					<img src="<?php echo BASE_ASSETS; ?>img/master_card.gif">
					<img src="<?php echo BASE_ASSETS; ?>img/discover-card.gif">
					<img src="<?php echo BASE_ASSETS; ?>img/express_card.gif">
				</div>
			</div>
			<?php /*?><hr>
			<div class="row">
				<div class="col-lg-4">
					<label class="checkbox">
						<input type="radio" name="payment" value="echeck"> eCheck <br>(Through PayPal)
					</label>
				</div>
				<div class="col-lg-8">
					<img src="<?php echo BASE_ASSETS; ?>img/echeck.gif">
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-4">
					<label class="checkbox">
						<input type="radio" name="payment" value="ecurrency"> E-Currency*
					</label>
				</div>
				<div class="col-lg-8">
					<img src="<?php echo BASE_ASSETS; ?>img/egold.gif">
					<img src="<?php echo BASE_ASSETS; ?>img/e-bullion.gif">
					<img src="<?php echo BASE_ASSETS; ?>img/pecuix.gif">
					<img src="<?php echo BASE_ASSETS; ?>img/goldmoney.gif">
					<img src="<?php echo BASE_ASSETS; ?>img/mdc.gif">
				</div>
			</div>
			<hr><?php */?>
            <hr>
			<div class="row">
				<div class="col-lg-4">
					<label class="checkbox">
						<input type="radio" name="payment" value="bitcoin" id="bitcoin"> Bitcoin
					</label>
				</div>
				<div class="col-lg-8">
					<img src="<?php echo BASE_ASSETS; ?>img/bitcoin.gif">
				</div>
			</div>
			<div class="form-group pull-right">
				<button class="btn btn-danger btn-sm"  type="submit" id="btnsubscriptions">Continue</button>
			</div>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
function confirmpayment()
{
	var Form = document.getElementById('frmsubscriptions');  
	var level = '';var payment = '';
	for (Count = 0; Count < 5; Count++) {
		if (Form.level[Count])
		{
			if (Form.level[Count].checked)
			{
				level = Form.level[Count].value;
				break;
			}
		}
	}
	for (Count = 0; Count < 3; Count++) {
		if (Form.payment[Count].checked)
		{
			payment = Form.payment[Count].value;
			break;
		}
	}
	
	if(level=='')
		alert('Please select subscription level');
	else if(level==1)
	{
		if (confirm("Are you sure, you want to continue with limited access for free membership."))
			 return true;
	}
	else if(payment=='' && level>2) //check
		alert('Please select payment method');
	else
	{
		 var cf = confirm("Are you sure you want to continue with selected details.")
		/* if (cf && payment == 'bitcoin')
		  {
			  window.setTimeout('location.reload()', 1);
			/*  $('#bitcoin_script').triggerevent(function(){*/
					/*$('#bitcoin_script').html('<script src="//www.bitwall.io/javascripts/widget.js" id="bitwallWidgetScript" data-title="Buy with bitcoin" data-key="if4pkoc">');
				/*});	*/		
				/*var tag = document.createElement("script");
				tag.innerHTML='';
				document.body.appendChild(tag);	*/	
		 /* }*/
		 if(cf) return true; 
	}
	return false;
}
</script>