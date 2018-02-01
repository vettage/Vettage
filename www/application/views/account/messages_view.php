<div class="container">
	<br />
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('delete_error')) ? '<div class="alert alert-error">'.$this->session->flashdata('delete_error').'</div>' : ''?>
	
	<div class="row">
 		 		<div class="col-lg-4" style="display:none" id="message_pop">
 		<form>
 		                  <div class="alert alert-success" id="msuccess" style="display:none"></div>
                  <div class="alert alert-danger" id="merrors" style="display:none"></div>
				<div>Message: <em><span id="m_username"></span></em></div>
 			 	  <div class="clearfix pad-top pad-bottom">
				   <textarea class="form-control" rows="3" name="messagetext" id="messagetext"></textarea>
				 </div>
				 <input type="hidden" id="m_user_id" name="m_user_id" value="" />
				<button class="btn btn-danger btn-sm" onclick="javascript:send_message();" type="button">
                Send Message</button>
				<button class="btn btn-default btn-sm" onclick="javascript:cancel()" type="button">Cancel</button>
				</form>
 		</div>
 		
 	</div>

	<div class="row">
		<div class="col-lg-4">
			<h3 class="less-mar-bottom">MESSAGES</h3>
		</div>
		<div class="col-lg-12  pad-top">
         	<div class="row">
            	<table class="table table-striped table-bordered table-condensed">
					   <thead>
							<tr>
								<th width="20%">To</th>
								<th width="20%">Date</th>
								<th width="50%" style="text-align:center">Message</th>
								<th width="10%" style="text-align:center">Reply</th>
							</tr>
						</thead>
							<?php if(empty($message_data)){?>
								<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
								</tr>
							<?php }else {
								foreach($message_data as $row) :
								// TODO:  ha!
									// I sent it 
								
										$from = 'me';
										$you = $this->user_model->get_single_record("id='".$row->from_id."'");	
										$to= $you->username;
										// you sent it
									
								
								?>
								<tr>
									
									 <td><?php echo $to?></td>
									 <td><?php echo date("F n, Y h:i:s a",strtotime($row->date));?></td>
									 <td><?php echo $row->message?></td>
									  <td align="center">  <a href="javascript:message('<?php echo $to;?>','<?php echo $row->from_id;?>');"
                                         title="Message" ><span class="glyphicon glyphicon-envelope"></span></a>
									  </td>
								</tr>
								<?php 
								endforeach;
							}?>


				</table>
				</div>
		</div>
	</div>
</div>
<script>
function message(user,id) {
	$('#m_username').html(user);
	$('#m_user_id').val(id);
	show_message();
	//$('#message_pop').show();
}
function cancel() {
	hide_message();
}
function trim(str) 
{
	return str.replace(/^\s+|\s+$/g,"");
}
function send_message()
{

	var id = $('#m_user_id').val();
	
	var message = trim($('#messagetext').val());
	
	if(message!='')
	{
		$.ajax({
			type: "POST",
			url: "<?php echo BASE_URL;?>ajax/send_msg",
			data: "mem_id="+id+"&message="+message,
			success: function(msg){
				if(msg!='')
				{
					msg = msg.replace(/^\s+|\s+$/g,"");
  					$("#messagetext").val('');
					$("#merrors").hide();
					$("#msuccess").html("Message sent successfully");
					$("#msuccess").show();
					hide_message(2000);
				}
			}
		})
	}
	else
	{
	$("#msuccess").hide();
	$("#merrors").html("Please enter message");
	$("#merrors").show();
	}
}

function show_message() {
	var options = {};
	// Run the effect
	$( "#message_pop" ).show( 'blind', options, 500 );
}
function hide_message(speed=500) {
	var options = {};
	// Run the effect
	$( "#message_pop" ).hide( 'blind', options, speed );
	$('#m_username').html('');
	$('#m_user_id').val('');
	
}

</script>