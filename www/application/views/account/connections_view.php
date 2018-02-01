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
			<h3 class="less-mar-bottom">CONNECTIONS</h3>
		</div>
		<div class="col-lg-12  pad-top">
         	<div class="row">
            	<table class="table table-striped table-bordered table-condensed">
					   <thead>
							<tr>
								<th width="200">Request</th>
								<th width="120">Date</th>
								<th width="120" style="text-align:center">Status</th>
								<th width="120" style="text-align:center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if(empty($connect_data)){?>
								<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td>
								</tr>
							<?php }else {
								foreach($connect_data as $row) :
									
									$label = "";
									$member='Unknown';
									if($this->user_id == $row->to_id)
									{
										$details = $this->user_model->get_single_record("id='".$row->from_id."'");
										if($details!=NULL) $member=$details->username;
										$label = "From: ";
									}
									if($this->user_id == $row->from_id)
									{
										$details = $this->user_model->get_single_record("id='".$row->to_id."'");
										if($details!=NULL) $member=$details->username;
										$label = "To: ";
									}
									
									$status = '';
									if($row->status==0)
									{
										if($this->user_id == $row->to_id){
											$status = '<a class="btn btn-primary" href="'.BASE_URL.'account/request_status/'.$row->conn_id.'/1">Accept</a>  <a class="btn btn-danger" href="'.BASE_URL.'account/request_status/'.$row->conn_id.'/2">Decline</a>';
										}
										else
											$status = 'Request sent';
									}
									if($row->status==1)
									{
										$status = 'Connected';
									}
									if($row->status==2)
									{
										$status = 'Declined';
									}
									
								?>
								<tr>
									 <td><?php echo $label?><?php echo $member?></td>
									 <td><?php echo date("F n, Y h:i:s a",strtotime($row->date));?></td>
									 <td style="text-align:center"><?php echo $status?></td>
									 <td style="text-align:center"> 
									 <?php if($status == 'Connected'){?>
                                         <a href="javascript:message('<?php echo $member;?>','<?php echo $row->conn_id;?>');"
                                         title="Message" ><span class="glyphicon glyphicon-envelope"></span></a>

									 	<a href="javascript:delete_record('<?php echo $row->conn_id;?>');"
                                         title="Remove Connection" ><i class="fa fa-trash-o"></i></a>
                                         
                                         
									 <?php } else echo "--" ?>
									 </td>
								</tr>
								<?php 
								endforeach;
							}?>
						 </tbody>
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
	$('#m_username').html('');
	$('#m_user_id').val('');

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
	$( "#message_pop" ).show( 'blind', options, 300 );
}
function hide_message(speed=300) {
	var options = {};
	// Run the effect
	$( "#message_pop" ).hide( 'blind', options, speed );
}

</script>