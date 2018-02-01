<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Withdrawals extends admin_template{  
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('orders_model');
		$this->load->model('trading_model');
		$this->load->model('funds_model');
		$this->load->model('fund_btc_transactions_model');
		$this->load->model('email_template_model');
		$this->load->model('user_settings_model');
		$this->load->model('crypto_currency_model');
		$this->load->model('wallet_btc_model');
		$this->load->model('wallet_ltc_model');
		$this->load->model('wallet_ftc_model');
		$this->load->model('user_actions_model');
		
		$this->load->library('email');
	}
	
	function index()
	{
		redirect('/admin/withdrawals/fiat_currency');
		exit;
	}
	
	function fiat_currency()
	{
		$data['title']   	  = 'Withdrawals - Fiat Currency';
		$data['curr_details'] = $this->crypto_currency_model->combox('bit_crypto_currency','*',' currency=1 AND status=1 ','ORDER BY crypto_curr_id');
		$fund_types=''; foreach($data['curr_details'] as $row) $fund_types.="'".$row->name."',";
		if($fund_types!='') $fund_types = trim($fund_types,","); else $fund_types="''";
		
		$config['base_url'] = BASE_URL.'/admin/withdrawals/fiat_currency';
		$config['per_page'] = $this->items_per_page;
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$data['page'] = $page;
		$arr_cond = array(); $cond = "trn_type=2 AND fund_type IN($fund_types) AND password_used=1"; $count = 1;
		if($_GET!=NULL)
		{
			$arr_cond[] = "trn_type=2 AND password_used=1";
			if($_GET['from_date']!='' && $_GET['to_date']!='') 
				$arr_cond[] = "(DATE_FORMAT(date_added,'%Y-%m-%d')>='".$_GET['from_date']."' AND DATE_FORMAT(date_added,'%Y-%m-%d')<='".$_GET['to_date']."')";
			else
				$_GET['from_date'] = $_GET['to_date'] = '';
			if($_GET['fund_type']!='') $arr_cond[] = "fund_type='".$_GET['fund_type']."'"; else $arr_cond[] = "fund_type IN($fund_types)";
			if($_GET['status']!='')    $arr_cond[] = "status='".$_GET['status']."'";
			if($_GET['accnumber']!='')
			{
				$accnumber = trim(str_replace("'","\'",$_GET['accnumber']));
				$details = $this->user_model->get_single_record("accnumber='".$accnumber."'");
				if($details!="0") $arr_cond[] = "user_id='".$details->user_id."'"; else $arr_cond[] = "user_id=''";
				$_GET['accnumber'] = trim(str_replace('"','',$_GET['accnumber']));
			}
			if(count($arr_cond)>0)
			{
				$cond  = implode(' AND ',$arr_cond);		
				$count = implode(' AND ',$arr_cond);	
			}	
		}
		
		
		//custom_query
		$config['total_rows'] 		= $this->fund_btc_transactions_model->count_records("where $cond","fund_btc_trn_id");
		$cond .= ' ORDER BY date_added DESC limit '.$page.','.$config['per_page'];
		$data['transaction_data'] 	= $this->fund_btc_transactions_model->combox('bit_fund_btc_transactions','*',$cond);
		
		
		$config['uri_segment'] 		= 4; 
		$config['full_tag_open'] 	= '<ul>';
		$config['full_tag_close'] 	= '</ul>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="active"><a>';$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_link'] 		= '&raquo;';
		$config['prev_link'] 		= '&laquo;';		
		$this->pagination->initialize($config);
		
		$this->main_view('withdrawals','fiat_currency_view','transactions',$data);
	}
	
	function approve_fiat_withdrawal($fund_btc_trn_id)
	{	
		$fund_btc_trn_id = (int) $fund_btc_trn_id;
		$process_complete_status = 0;
		if($fund_btc_trn_id>0)
		{
			$data['curr_details'] = $this->crypto_currency_model->combox('bit_crypto_currency','*',' currency=1 AND status=1 ','ORDER BY crypto_curr_id');
			$fund_types=''; foreach($data['curr_details'] as $row) $fund_types.="'".$row->name."',";
			if($fund_types!='') $fund_types = trim($fund_types,","); else $fund_types="''";
			$details = $this->fund_btc_transactions_model->get_single_record("fund_btc_trn_id='".$fund_btc_trn_id."' AND status=0 AND trn_type=2 AND fund_type IN($fund_types)");
			if($details!="0")
			{
				$fund_details = $this->funds_model->get_balance("fund",$details->fund_type,"1",$details->user_id);
				$fund  		 = $fund_details[0];
				$binary_fund = $fund_details[1];
				$total_fund  = $fund_details[2];
				if($details->amount<=$total_fund)
				{
					$insert_data['status'] = 3;
					$this->fund_btc_transactions_model->edit($insert_data,$fund_btc_trn_id);
					
					$funddetails = $this->funds_model->get_single_record("user_id='".$details->user_id."' AND fund_type='".$details->fund_type."'");
					$insertfund['user_id'] 	 = $details->user_id;
					$insertfund['fund_type'] = $details->fund_type;
					$insertfund['fund'] 	 = $fund - $details->amount;
					if($funddetails=="0")
						$this->funds_model->add($insertfund);
					else
						$this->funds_model->edit($insertfund,$funddetails->fund_id);
					
					
					$fund=0;
					$funddetails = $this->funds_model->get_single_record("user_id='1' AND fund_type='".$details->fund_type."'");
					if($funddetails!="0") $fund = $funddetails->fund;
					$insertfund['user_id'] 	 = 1;
					$insertfund['fund_type'] = $details->fund_type;
					$insertfund['fund'] 	 = $fund + $details->fee;
					if($funddetails=="0")
						$this->funds_model->add($insertfund);
					else
						$this->funds_model->edit($insertfund,$funddetails->fund_id);
					
					
					//User Actions
					$insert_user_actions['action_by'] 	= $this->session->userdata('user_id');
					$insert_user_actions['id'] 			= $fund_btc_trn_id;
					$insert_user_actions['type'] 		= 2;
					$insert_user_actions['date_time'] 	= date("Y-m-d H:i:s");
					$insert_user_actions['ipaddress'] 	= $_SERVER['REMOTE_ADDR'];
					$insert_user_actions['status'] 		= $insert_data['status'];
					$this->user_actions_model->add($insert_user_actions);
					//User Actions
					
					//Email
					$user_settings_info  = $this->user_settings_model->get_single_record("user_id='".$details->user_id."'");
					$email_notification  = (!empty($user_settings_info->receiving_funds)) ? $user_settings_info->receiving_funds : 0;
					if($email_notification==1)
					{
						$user_info  = $this->user_model->get_single_record("user_id='".$details->user_id."'");
						$admin_row  = $this->site_setting_model->get_single_record(1);
						$email_row  = $this->email_template_model->get_single_record(' title = "fund approved" ');
						$name 		= $user_info->first_name." ".$user_info->last_name;
						$email 		= $user_info->email;
						$this->email->subject($email_row->subject);
						$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
						$this->email->to($email);
						
						$sub_message 	 = $email_row->msg;
						$sub_pattern 	 = array('/{NAME}/','/{AMOUNT}/','/{FUND_TYPE}/','/{SUPPORT_EMAIL}/');
						$sub_replacement = array($name,$details->send_amount,$details->fund_type,$admin_row->adm_support_email);
						$message 		 = preg_replace($sub_pattern,$sub_replacement,$sub_message);
						
						$this->email->message($message);
						$this->email->send();	
					}
					$process_complete_status = 1;
				}
			}
		}
		if($process_complete_status==1)
			$this->session->set_flashdata(array('success_msg' => 'Fund withdrawal request approved successfully.'));
		else
			$this->session->set_flashdata(array('delete_error' => 'Invalid request'));
		redirect('/admin/withdrawals/fiat_currency');
	}
	
	function cancel_fiat_withdrawal($fund_btc_trn_id)
	{
		$fund_btc_trn_id = (int) $fund_btc_trn_id;
		$process_complete_status = 0;
		if($fund_btc_trn_id>0)
		{
			$data['curr_details'] = $this->crypto_currency_model->combox('bit_crypto_currency','*',' currency=1 AND status=1 ','ORDER BY crypto_curr_id');
			$fund_types=''; foreach($data['curr_details'] as $row) $fund_types.="'".$row->name."',";
			if($fund_types!='') $fund_types = trim($fund_types,","); else $fund_types="''";
			$details = $this->fund_btc_transactions_model->get_single_record("fund_btc_trn_id='".$fund_btc_trn_id."' AND status=0 AND trn_type=2 AND fund_type IN($fund_types)");
			if($details!="0")
			{
				$insert_data['status'] = 2;
				$this->fund_btc_transactions_model->edit($insert_data,$fund_btc_trn_id);
				
				//User Actions
				$insert_user_actions['action_by'] 	= $this->session->userdata('user_id');
				$insert_user_actions['id'] 			= $fund_btc_trn_id;
				$insert_user_actions['type'] 		= 2;
				$insert_user_actions['date_time'] 	= date("Y-m-d H:i:s");
				$insert_user_actions['ipaddress'] 	= $_SERVER['REMOTE_ADDR'];
				$insert_user_actions['status'] 		= $insert_data['status'];
				$this->user_actions_model->add($insert_user_actions);
				//User Actions
				
				//Email
				$user_settings_info  = $this->user_settings_model->get_single_record("user_id='".$details->user_id."'");
				$email_notification  = (!empty($user_settings_info->receiving_funds)) ? $user_settings_info->receiving_funds : 0;
				if($email_notification==1)
				{
					$user_info  = $this->user_model->get_single_record("user_id='".$details->user_id."'");
					$admin_row  = $this->site_setting_model->get_single_record(1);
					$email_row  = $this->email_template_model->get_single_record(' title = "fund declined" ');
					$name 		= $user_info->first_name." ".$user_info->last_name;
					$email 		= $user_info->email;
					$this->email->subject($email_row->subject);
					$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
					$this->email->to($email);
					
					$sub_message 	 = $email_row->msg;
					$sub_pattern 	 = array('/{NAME}/','/{AMOUNT}/','/{FUND_TYPE}/','/{SUPPORT_EMAIL}/');
					$sub_replacement = array($name,$details->send_amount,$details->fund_type,$admin_row->adm_support_email);
					$message 		 = preg_replace($sub_pattern,$sub_replacement,$sub_message);
					$this->email->message($message);
					$this->email->send();	
				}
				$process_complete_status = 1;
			}
		}
		if($process_complete_status==1)
			$this->session->set_flashdata(array('success_msg' => 'Fund withdrawal request declined.'));
		else
			$this->session->set_flashdata(array('delete_error' => 'Invalid request'));
		redirect('/admin/withdrawals/fiat_currency');
	}
	
	function complete_fiat_withdrawal($fund_btc_trn_id)
	{
		$fund_btc_trn_id = (int) $fund_btc_trn_id;
		$process_complete_status = 0;
		if($fund_btc_trn_id>0)
		{
			$data['curr_details'] = $this->crypto_currency_model->combox('bit_crypto_currency','*',' currency=1 AND status=1 ','ORDER BY crypto_curr_id');
			$fund_types=''; foreach($data['curr_details'] as $row) $fund_types.="'".$row->name."',";
			if($fund_types!='') $fund_types = trim($fund_types,","); else $fund_types="''";
			$details = $this->fund_btc_transactions_model->get_single_record("fund_btc_trn_id='".$fund_btc_trn_id."' AND status=3 AND trn_type=2 AND fund_type IN($fund_types)");
			if($details!="0")
			{
				$insert_data['status'] = 1;
				$this->fund_btc_transactions_model->edit($insert_data,$fund_btc_trn_id);
				
				//User Actions
				$insert_user_actions['action_by'] 	= $this->session->userdata('user_id');
				$insert_user_actions['id'] 			= $fund_btc_trn_id;
				$insert_user_actions['type'] 		= 2;
				$insert_user_actions['date_time'] 	= date("Y-m-d H:i:s");
				$insert_user_actions['ipaddress'] 	= $_SERVER['REMOTE_ADDR'];
				$insert_user_actions['status'] 		= $insert_data['status'];
				$this->user_actions_model->add($insert_user_actions);
				//User Actions
				
				$process_complete_status = 1;
			}
		}
		if($process_complete_status==1)
			$this->session->set_flashdata(array('success_msg' => 'Fund withdrawal request completed successfully.'));
		else
			$this->session->set_flashdata(array('delete_error' => 'Invalid request'));
		redirect('/admin/withdrawals/fiat_currency');
	}
	
	function delete_fiat_withdrawal($fund_btc_trn_id)
	{
		$fund_btc_trn_id = (int) $fund_btc_trn_id;
		$process_complete_status = 0;
		if($fund_btc_trn_id>0)
		{
			$data['curr_details'] = $this->crypto_currency_model->combox('bit_crypto_currency','*',' currency=1 AND status=1 ','ORDER BY crypto_curr_id');
			$fund_types=''; foreach($data['curr_details'] as $row) $fund_types.="'".$row->name."',";
			if($fund_types!='') $fund_types = trim($fund_types,","); else $fund_types="''";
			$details = $this->fund_btc_transactions_model->get_single_record("fund_btc_trn_id='".$fund_btc_trn_id."' AND status=2 AND trn_type=2 AND fund_type IN($fund_types)");
			if($details!="0")
			{
				$this->fund_btc_transactions_model->delete('fund_btc_trn_id',$fund_btc_trn_id);
				$process_complete_status = 1;
			}
		}
		if($process_complete_status==1)
			$this->session->set_flashdata(array('success_msg' => 'Withdrawal request removed successfully.'));
		else
			$this->session->set_flashdata(array('delete_error' => 'Invalid request'));
		redirect('/admin/withdrawals/fiat_currency');
	}
	
	//crypto
	function crypto_currency()
	{
		$data['title']   	  = 'Withdrawals - Crypto Currency';
		$data['curr_details'] = $this->crypto_currency_model->combox('bit_crypto_currency','*',' currency=0 AND status=1 ','ORDER BY crypto_curr_id');
		$fund_types=''; foreach($data['curr_details'] as $row) $fund_types.="'".$row->name."',";
		if($fund_types!='') $fund_types = trim($fund_types,","); else $fund_types="''";
		
		$config['base_url'] = BASE_URL.'/admin/withdrawals/crypto_currency';
		$config['per_page'] = $this->items_per_page;
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$data['page'] = $page;
		$arr_cond = array(); $cond = "trn_type=2 AND fund_type IN($fund_types) AND password_used=1"; $count = 1;
		if($_GET!=NULL)
		{
			$arr_cond[] = "trn_type=2 AND password_used=1";
			if($_GET['from_date']!='' && $_GET['to_date']!='') 
				$arr_cond[] = "(DATE_FORMAT(date_added,'%Y-%m-%d')>='".$_GET['from_date']."' AND DATE_FORMAT(date_added,'%Y-%m-%d')<='".$_GET['to_date']."')";
			else
				$_GET['from_date'] = $_GET['to_date'] = '';
			if($_GET['fund_type']!='') $arr_cond[] = "fund_type='".$_GET['fund_type']."'"; else $arr_cond[] = "fund_type IN($fund_types)";
			//if($_GET['status']!='')    $arr_cond[] = "status='".$_GET['status']."'";
			if($_GET['accnumber']!='')
			{
				$accnumber = trim(str_replace("'","\'",$_GET['accnumber']));
				$details = $this->user_model->get_single_record("accnumber='".$accnumber."'");
				if($details!="0") $arr_cond[] = "user_id='".$details->user_id."'"; else $arr_cond[] = "user_id=''";
				$_GET['accnumber'] = trim(str_replace('"','',$_GET['accnumber']));
			}
			if(count($arr_cond)>0)
			{
				$cond  = implode(' AND ',$arr_cond);		
				$count = implode(' AND ',$arr_cond);	
			}	
		}
		
		
		//custom_query
		$config['total_rows'] 		= $this->fund_btc_transactions_model->count_records("where $cond","fund_btc_trn_id");
		$cond .= ' ORDER BY date_added DESC limit '.$page.','.$config['per_page'];
		$data['transaction_data'] 	= $this->fund_btc_transactions_model->combox('bit_fund_btc_transactions','*',$cond);
		
		$config['uri_segment'] 		= 4; 
		$config['full_tag_open'] 	= '<ul>';
		$config['full_tag_close'] 	= '</ul>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="active"><a>';$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_link'] 		= '&raquo;';
		$config['prev_link'] 		= '&laquo;';		
		$this->pagination->initialize($config);
		
		$this->main_view('withdrawals','crypto_currency_view','transactions',$data);
	}
	
	
	
	

}?>