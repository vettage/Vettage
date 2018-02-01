<?php
if($this->session->userdata('fv_logged_in') == TRUE)
{
	$header_acc_details = $this->member_model->get_single_record("mem_id='".$this->session->userdata('mem_id')."' AND status=1");
	if($header_acc_details==NULL)
	{
		$this->session->set_flashdata(array('error_msg' => 'Account does not exist or not activated yet or closed.'));
		redirect('logout');		
		exit;
	}
	else
	{
		$header_upgrade_level = 0; $header_upgrade_date = '';
		$header_upgrade_details = $this->member_upgrade_model->get_single_record("mem_id='".$this->session->userdata('mem_id')."' ORDER BY upgrade_id DESC LIMIT 0,1");
		if($header_upgrade_details!=NULL)
		{
			$header_upgrade_level 	= $header_upgrade_details->level;
			$header_upgrade_date 	= $header_upgrade_details->date;
		}
		$this->session->set_userdata( 
			array(
				'fv_logged_in'		=> TRUE,
				'mem_id'			=> $header_acc_details->mem_id,
				'username'			=> $header_acc_details->username,
				'email'				=> $header_acc_details->email,
				'firstname' 		=> $header_acc_details->firstname,
				'lastname' 			=> $header_acc_details->lastname,
				'type' 				=> $header_acc_details->type,
				'level' 			=> $header_upgrade_level,
				'level_date' 		=> $header_upgrade_date,
				'activetime' 		=> date("Y-m-d H:i:s")
			)
		);
	}
}
else
	$this->session->set_userdata(array('activetime' => date("Y-m-d H:i:s")));
?>