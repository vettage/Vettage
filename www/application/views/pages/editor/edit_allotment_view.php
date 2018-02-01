GOOOBAR
<div class="container">
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>
	<div class="row">
		<div class="col-lg-5">
			<h3>Allotments</h3>
		</div>
        <div class="col-lg-7 bg-light pad-bottom">
		<form action="" method="post" onsubmit="return checkerrors();">
		
			<h4>CONTRIBUTORS:</h4>
			<table class="table table-bordered table-striped" id="username_tbl">
			<thead>
				<tr>
					<th>User Name</th>
					<th>%</th>
					<th>SET</th>
				</tr>
			</thead>
			<tbody>
				<?php $count=0; foreach($member_requests as $row) : $count++;   
					$percentage = $checked = '';
					$allotment_details = $this->allotment_model->get_single_record("content_id='".$content_details->content_id."' AND contributor_id='".$row->id."' AND editor_id='".$this->user_id."'");
					if($allotment_details!=NULL) 
					{ 
						$percentage = $allotment_details->percent; 
						if($percentage>0) $checked = 'checked="checked"';
					} 
					?>
					<tr> 
						<td><?php  echo $row->username;  ?></td>
						<td><input type="text" id="percent<?php echo $count;?>" name="percent<?php echo $count;?>" value="<?php echo                             $percentage?>" class="form-control input-sm" style="width:200px;" /></td>
						<td><input type="checkbox" id="user<?php  echo $count;?>" name="user<?php echo $count;?>" 
                           value="<?php  echo $row->id;?>" <?php echo $checked?> >
                       </td>
					</tr>
				<?php endforeach;?>
			</tbody>
			</table>
			<div class="row" id="inputdiv">
             <div id="user_list" class="col-lg-8">
              <div class="media user_listing">
                <label class="checkbox"><input type="checkbox" >Click to add Contributor</label>
             </div>
            </div>
            <div class="alert alert-success" id="success_new" style="display:none"></div>
				<div class="alert alert-danger" id="error_new" style="display:none"></div>
          <div id="user_details" style="display:none" class="col-lg-8">
            Contributor : <input type="text" id="username" name="username" value="" />
               <button type="add_contributor"  id="add_contributor" value="username" class="btn btn-info btn-sm">Add
               </button>
               <input type="hidden" name="cnt" id="cnt" value="<?php echo $count ?>" />
            <?php echo ((form_error('username')!=NULL)) ? '<br /><span class="help-inline">'.form_error('username').'</span>' : '' ?>
         </div>
        <div class="col-lg-4 text-right">
             <button type="submit" class="btn btn-danger btn-sm">Done</button>
        </div>
  			</div>
 		</form>
        </div>
	</div>
</div>
<script type="text/javascript">
function checkerrors()
{
	var count = $('#cnt').val();
	var error = ''; var selected = ''; var percentage_values=0; var totpercentage = 0;
	for(i=1;i<=count;i++)
	{
		percentage = document.getElementById('percent'+i).value;
		if(percentage=='') percentage = 0; else percentage = parseInt(percentage);
		if(document.getElementById('user'+i).checked)
		{
			if(percentage<=0 || percentage>=90)
			{
				alert('Enter valid percentage for selected Contributor');
				return false
			}
			else
				totpercentage = totpercentage + percentage;
			selected = 1;
		}
		else
		{
			if(percentage>0) percentage_values = 1;
		}
	}
	if(selected=='')
	{
		alert('SET atleast one Contributor');
		return false	
	}
	if(percentage_values==1)
	{
		alert('Percentage given SET box must be checked');
		return false	
	}
	if(totpercentage>90)
	{
		alert('Total of allocated percentage should be less than 90');
		return false	
	}
	return true
}
</script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('#add_contributor').click(function(){
		var username = trim($('#username').val());
		/* 	$('input[name^="same_user[]"]').each(function() {
			var myArray = 'user'+$(this).val();
			
		if(username == myArray)
			{
				$("#error_new").html("Please select username234.");
				$('#success_new').hide();
				$('#error_new').show();
				return false;
			}*/
		if(username=='')
			{
				$("#error_new").html("Please select username.");
				$('#success_new').hide();
				$('#error_new').show();
				return false;
			}
			else
			{
	
				var cnt = $('#cnt').val();
				cnt = parseInt(cnt)+1;
				$('#cnt').val(cnt);
				$.ajax({
					type: "POST",
					url: "<?php echo BASE_URL;?>collaborate/raw_media_pull/get_result",
					data: "username="+username+"&content_id=<?php echo $content_details->content_id;?>&count="+cnt,
					success: function(msg)
					{
						if(msg=='')
						{
							$('#success_new').hide();
							$("#error_new").html("The username you selected is incorrect");
							$('#error_new').show();
							$("#username_tbl").html(msg);
						}
						else{
						
							if(msg!='Contributor does not exists')
							{	
								$('#username').val('');
								$('#success_new').show();
								$('#error_new').hide();
								$('#cnt').val(cnt);
								$("#success_new").html("username added successfully ");
								//getresults();
								$("#username_tbl").append(msg);
							}
							else
							{
								$('#success_new').hide();
								$('#error_new').show();
								$("#error_new").html(msg);
							}
							
							/*$('#error_new').hide();
							$('#success_new').show();
							$('#username').val('');
							$('#cnt').val(cnt);
							$("#success_new").html("username added successfully ");
							//getresults();
							$("#username_tbl").append(msg);*/
						}
					}
				});
				return false;				
				}
			//});
	});
});


function getresults()
{
	var username = trim($('#username').val());
	$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL;?>collaborate/raw_media_pull/get_result",
		data: "username="+username,		
		success: function(msg)
		{
			$("#username_tbl").html(msg);
		}
	});	
	//data: "content_id=<?php //echo $content_details->content_id?>&contributor_id=<?php //echo $row->mem_id?>",
}
function trim(str) 
{
	return str.replace(/^\s+|\s+$/g,"");
}
//getresults();
//setInterval( "getresults()", 10000);
</script>
 
        <script type="text/javascript">
		var values1 =0;
                $(document).ready(function(){
		//var values1 = $("input[id='same_user']").map(function(){return $(this).val();}).get();
                    $("#username").autocomplete({
                     source:'<?php echo BASE_URL;?>collaborate/raw_media_pull/allotment_search/<?php echo $content_details->content_id?>',
                     minLength:2
                    });
                });
</script>

<script>
$('.user_listing').click(function(event){
 	$('#user_list').css('display','none');
	$('#user_details').css('display','none');
	$('#user_details').css('display','block');
})
</script>
