<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subscription extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('content_model');
		$this->load->model('user_model');
		$this->load->model('member_upgrade_model');
		$this->load->model('connect_model');
		$this->load->model('raw_media_model');
		$this->load->model('country_model');
		$this->load->model('allotment_model');
		$this->load->model('site_setting_model');
		$this->load->model('email_template_model');
		$this->mem_id 	= $this->user_id 	= $this->user->getUserID();	
	}
	
	function index()
	{	
		
		$return = 'subscribers/search';

		if (isset($_REQUEST['return'])) $return = $_REQUEST['return'];
		
		if (isset($_POST['level'])) {
			
			$level = (int) $_POST['level'];
	
			switch ($level) {
				
				case 3:
					if ($this->user->addRatings(1)) {
						
					
					$this->session->set_flashdata(array('success_msg' => 'You have pruchased one Rating.'));
					redirect($return);
					exit;} else $this->session->set_flashdata(array('error_msg' => "We're sorry - something went wrong"));
					exit;
				case 4:
					if ($this->user->addRatings(10)) {
					$this->session->set_flashdata(array('success_msg' => 'You have pruchased 10 Ratings.'));
					redirect($return);
					exit;
					} else $this->session->set_flashdata(array('error_msg' => "We're sorry - something went wrong"));
					exit;
				case 5:
					if ($this->user->addRatings(100)) {
					$this->session->set_flashdata(array('success_msg' => 'You have pruchased 100 Ratings.'));
					redirect($return);
					} else $this->session->set_flashdata(array('error_msg' => "We're sorry - something went wrong"));
					exit;
				
				default:
					$this->session->set_flashdata(array('error_msg' => 'That option is not currently available.'));
						
				// do nothing
				
			}
			
		}
		
		
		$data['title'] 		 = 'Subscription';
		$data['description'] = 'Subscription';
		// TODO: clean
		//if (isset($_GET['return'])) $return = $_GET['return'];
		$data['return'] = $return;
 		$this->main_view('pages/subscribers/subscription_view',$data);
	}
	//Paypal
	function paypal()
	{    
		$amount = 0;$pp_item_name = '';
		$this->session->unset_userdata('paypal_username');	
		
		
		$level = $this->session->userdata('paypal_level');	//print_r($level);exit;
		//$level = $member_details->level;
		//check
		//if($level==2) { $amount = 0.99; $pp_item_name = '99 Cents Per View'; }
		
		if($level==3) { $amount = 0.99; $pp_item_name = '99 Cents Per View'; }
		if($level==4) { $amount = 9.99; $pp_item_name = '$9.99 Per Month'; }
		if($level==5) { $amount = 1250; $pp_item_name = '$1250 Institutional'; }
		
		$paypal_buss_email 	= 'apple.dev2-facilitator@gmail.com';
		$paypal_type 		= 'sandbox.';
		$currency_code      = 'USD';
		
		$this->session->set_userdata(array('paypal_username'=>$username));	
		
		echo'<form name="frmpaypal" action="https://www.'.$paypal_type.'paypal.com/cgi-bin/webscr" method="post" id="frmpaypal">
		<input id="pp-cmd" type="hidden" value="_xclick" name="cmd">
		<input id="pp-business" type="hidden" value="'.$paypal_buss_email.'" name="business">
		<input id="pp-currency-code" type="hidden" value="'.$currency_code.'" name="currency_code">
		<input id="pp-country" type="hidden" value="US" name="country">
		<input id="pp-return" type="hidden" value="'.BASE_URL.'subscribers/subscription/paypal_success" name="return">
		<input id="pp-cancel-return" type="hidden" value="'.BASE_URL.'subscribers/subscription/paypal_notification" name="cancel_return">
		<input id="pp-notify-url" type="hidden" value="'.BASE_URL.'subscribers/subscription/paypal_success" name="notify_url">
		<input id="pp-rm" type="hidden" value="2" name="rm">
		<input id="pp-no-note" type="hidden" value="0" name="no_note">
		<input id="pp-custom" type="hidden" value="'.md5(time()).'" name="custom">
		<input id="pp-tax" type="hidden" value="0" name="tax">
		<input id="pp-shipping" type="hidden" value="0" name="shipping">
		<input id="pp-cbt" type="hidden" value="Return to our site to validate your payment!" name="cbt">
		<input id="pp-amount" type="hidden" value="'.$amount.'" name="amount">
		<input id="pp-item-name" type="hidden" value="'.$pp_item_name.'" name="item_name">
		<input id="pp-item-number" type="hidden" value="1" name="item_number">
		<input id="pp-quantity" type="hidden" value="1" name="quantity">
		</form>
		<script>document.forms["frmpaypal"].submit();</script>';		
		exit;
		
		//print_r($_POST);
	}
	
	
	function paypal_success()
	{	
		$paypal_username = $this->session->userdata('paypal_username');
		$level 			 = $this->session->userdata('paypal_level');	
		$where = "";if($this->mem_id>0) $where = " AND status=1";
		$member_details = $this->member_model->get_single_record("username='".$paypal_username."' $where ");
		
		if($member_details==NULL) 
		{
//			redirect('');			
//			exit;
		}
		
		if(!empty($_POST['mc_gross']) && $_POST['mc_gross']>0)
		{
			$this->session->set_userdata(array('level'=>$level));
			
			$update_data['payment_status'] = 1;
			$update_data['level'] = $level;
			$update_data['status'] = 1;
			$this->user_model->edit($update_data,array("id"=>$this->user_id));
			//Upgrade
			$insert_upgrade_data['mem_id'] 		= $this->user_id;
			$insert_upgrade_data['level'] 		= $level;
			$insert_upgrade_data['date'] 		= date("Y-m-d H:i:s");
			if($level>=4){
				if($level==4) $expire_date = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
				if($level==5) $expire_date = mktime(0,0,0,date("m"),date("d"),date("Y")+1);
				$insert_upgrade_data['expire_date'] = date("Y-m-d H:i:s",$expire_date);
			}
			$insert_upgrade_data['price'] = $_POST['mc_gross'];
			$this->member_upgrade_model->add($insert_upgrade_data);
			
			//Email
			$admin_row  = $this->site_setting_model->get_single_record(1);
			$name 		= $member_details->username;
			$email 		= $member_details->email;
			
			$this->email->subject($_POST['mc_gross']." USD Deposited");
			$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
			$this->email->to($email);
			$message = 'Hello '.$name.',<br/><br/><strong>Paypal Information</strong><br/><br/><table>';
			foreach($_POST as $key=>$val)
			{
				$item_name = '';
				$message .= '<tr><td>'.$key.'</td><td>:</td><td>'.$val.$item_name.'</td></tr>';
			}
			$message.= '</table><br/><br/>If you have any issues with your account please email '.$admin_row->adm_support_email.'.<br/><br/>Best regards,<br/>Vettage Support Team.';
			$this->email->message($message);
			$this->email->send();	
			
			//check
			//if($level==2) $subscription = '99 Cents Per View';
			if($level==3) $subscription = '99 Cents Per View';
			if($level==4) $subscription = '$9.99 Per Month';
			if($level==5) $subscription = '$1250 Institutional';
			$this->email->subject("Account created with subscription");
			$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
			$this->email->to($email);
			$message = 'Hello '.$name.',<br/><br/><strong>Account & Subscription Information</strong><br/><br/><table>';
			$message .= '<tr><td>Username</td><td>:</td><td>'.$name.'</td></tr>';
			$message .= '<tr><td>Email Address</td><td>:</td><td>'.$email.'</td></tr>';
			$message .= '<tr><td>Subscription</td><td>:</td><td>'.$subscription.'</td></tr>';
			$message.= '</table><br/><br/>If you have any issues with your account please email '.$admin_row->adm_support_email.'.<br/><br/>Best regards,<br/>Vettage Support Team.';
			$this->email->message($message);
			//$this->email->send();
			//Email
			
			$member_details = $this->member_model->get_single_record("username='".$paypal_username."' AND status=1 ");
			$this->session->set_flashdata(array('success_msg' => 'Paypal transaction completed and subscription updated successfully.'));
			$this->session->set_userdata( 
				array(
				'fv_logged_in'		=> TRUE,
				'mem_id'			=> $member_details->mem_id,
				'username'			=> $member_details->username,
				'email'				=> $member_details->email,
				'firstname' 		=> $member_details->firstname,
				'lastname' 			=> $member_details->lastname,
				'type' 				=> $member_details->type,
				'level' 			=> $member_details->level,
				'activetime' 		=> date("Y-m-d H:i:s")
				)
			);
			
			$this->session->unset_userdata('paypal_username');
			$this->session->unset_userdata('paypal_level');
			
			$this->mem_id 	= (int) $this->session->userdata('mem_id');	
			if($this->mem_id>0)
			redirect('subscribers/search/source');
			else
			redirect('');
			exit;
		}
		else
		{
			$this->session->set_flashdata(array('error_msg' => 'Transaction cancelled due to invalid inputs.'));
			$this->session->unset_userdata('paypal_username');	
			redirect("subscribers/subscription/index/$paypal_username");
			exit;
		}
	}
	
	//bitvcoin
	function bitcoin()
	{		
		$redirect = 0;
		$data['title'] 		 = 'Subscription';
		$data['description'] = 'Subscription';
		if($this->mem_id>0) 
			$username = $this->username;
		else
			$username = $this->uri->segment(4);
		
		$where = "";if($this->mem_id>0) $where = " AND status=1";
		$data['member_details'] = $member_details = $this->member_model->get_single_record("username='".$username."' $where");
		if($member_details==NULL) 
			$redirect = 1;
		else
		{
			/*if($this->mem_id>0){
				if($member_details->type==3 && $this->level==5) $redirect = 1;
			}*/
			if($member_details->type!=3) $redirect = 1;
			if($this->mem_id<=0 && $member_details->status==1) $redirect = 1;
		}
		
		if($redirect==1) 
		{
			redirect('');			
			exit;
		}
		
		$data['level'] = $member_details->level;
		//$data['member_details'] = $member_details = $this->member_model->get_single_record("username='".$username."' AND status=1 ");
 		$this->main_view('pages/subscribers/subscription_view_bitcoin',$data);
	}
	
	
	
	function paypal_notification()
	{	
		$paypal_username = $this->session->userdata('paypal_username');	
		$this->session->set_flashdata(array('error_msg' => 'Transaction cancelled due to invalid inputs.'));
		$this->session->unset_userdata('paypal_username');	
		$this->session->unset_userdata('paypal_level');
		redirect("subscribers/subscription/index/$paypal_username");
		exit;
	}
	//
}
?>
