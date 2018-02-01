<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('member_model');
		$this->load->model('site_setting_model');
		$this->load->model('email_template_model');
		$this->load->library('email');
	}
	
	
	function ajax()
	{
		

		// TODO: tighten this later
		if($_POST!=NULL)
		{
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[7]');
			//$this->form_validation->set_rules('type', 'Type','required');	
		//	if($_POST['type']==1) $this->form_validation->set_rules('contribute_bit_address', 'Bitcoin wallet address','required|callback_bitcoinaddress_check');	
		//	if($_POST['type']==2) $this->form_validation->set_rules('editor_bit_address', 'Bitcoin wallet address','required|callback_bitcoinaddress_check');	
			//if($_POST['type']==3) $this->form_validation->set_rules('level', 'Level', 'required');
			
			$chk_mail = $this->member_model->get_single_data("email ='".str_replace("'","\'",$_POST['email'])."' AND status!=2");
			if($chk_mail!=NULL) $this->form_validation->set_rules('email', 'Email', 'is_unique[members.email]');
			$chk_username = $this->member_model->get_single_data("username ='".str_replace("'","\'",$_POST['username'])."' AND status!=2");
			if($chk_username!=NULL) $this->form_validation->set_rules('username', 'Username', 'is_unique[members.username]');
			
			
			// new validation
		//	$params = array('username'=>$_POST['username'],'type'=>$_POST['type']);
			$params = array('username'=>$_POST['username']);
		//	$user = $this->user->register($_POST['username'],$_POST['password'],$_POST['email'],$params);
			
			
			if($this->form_validation->run() == TRUE)
			{
				
				
				$url = BASE_URL.'register/beta';
				//print_r($insert_data);exit;
				echo "success#$url";
				exit();
				
				/*
				$insert_data =  $_POST;
				$token = md5($insert_data['password']).md5($insert_data['email']);
				$insert_data['password'] 	= md5($insert_data['password']);
				$insert_data['token'] 		= $token;
				$insert_data['created']		= date("Y-m-d H:i:s");
				$insert_data['ip']			= $_SERVER['REMOTE_ADDR'];
				
				//if($insert_data['type']==3) $insert_data['level'] = 1;
				
				$mem_id = $this->member_model->add($insert_data);
				if($mem_id)
				{
					$update_data['token'] = $token;
					$this->member_model->edit($update_data,array("mem_id"=>$mem_id));
					
					//Email
					if($insert_data['type']!=3) 
					{
						$admin_row  = $this->site_setting_model->get_single_record(1);
						$email_row  = $this->email_template_model->get_single_record(' title = "sign up" ');
						$name 		= $_POST['username'];
						$email 		= $_POST['email'];
						$this->email->subject($email_row->subject);
						$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
						$this->email->to($email);
						
						$link 			 = BASE_URL.'register/activation?id='.$mem_id.'&token='.$token;
						$activation_link = '<a href="'.$link.'">'.$link.'</a>';
						$sub_message 	 = $email_row->msg;
						$sub_pattern 	 = array('/{USERNAME}/','/{EMAIL}/','/{SUPPORT_EMAIL}/','/{ACTIVATION_LINK}/');
						$sub_replacement = array($name,$email,$admin_row->adm_support_email,$activation_link);
						$message 		 = preg_replace($sub_pattern,$sub_replacement,$sub_message);
						$this->email->message($message);
						$this->email->send();	
					}
					
					if($insert_data['type']==3) 
						$url = BASE_URL.'subscribers/subscription/index/'.$insert_data['username'];
					else
						$url = BASE_URL.'register/success';
						//print_r($insert_data);exit;
					echo "success#$url";
					exit;
				}
				*/
				
				
			}
			else
			{
				$error = '';
				foreach($_POST as $key=>$val){
					if(form_error("$key")) $error .= form_error("$key").'<br/>';
				}
				echo "error#$error";
			}
			exit;
		}
	}
	
	
	function bitcoinaddress_check()
	{
		if($_SERVER['HTTP_HOST']=="localhost" ||  $_SERVER['HTTP_HOST']=="192.168.1.6") return TRUE;
		
		$_POST 		= $this->security->xss_clean($_POST);
		$address 	= '';
		if($_POST['type']==1)  $address = $_POST['contribute_bit_address'];
		if($_POST['type']==2)  $address = $_POST['editor_bit_address'];
		if($address!='') 
		{
			$isvalid = $this->member_model->checkAddress($address);
			if(!$isvalid) 
			{
				$this->form_validation->set_message('bitcoinaddress_check', 'Bitcoin address not valid, try another.');
				return FALSE;
			}
		}
	}
	
	function index($request_id=NULL)
	{
		$data['title']  = 'User Registration';
		$data['email']  = ''; if(!empty($_GET['em'])) $data['email'] = $_GET['em'];
		if($_POST!=NULL)
		{
			$captcha = $_COOKIE['captcha']; unset($_COOKIE['captcha']);
			$_POST['captchaCode'] =  $captcha;
			if(empty($_POST['terms']))  $_POST['terms']='';
			
			$_POST = $this->security->xss_clean($_POST);
			
			$this->form_validation->set_rules('first_name', 'Name', 'required');
			$this->form_validation->set_rules('last_name', 'Surname', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('level', 'Level', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[7]');
			$this->form_validation->set_rules('conf_password', 'Confirm password', 'required|matches[password]');
			$this->form_validation->set_rules('mem_phrase', 'Memorable phrase', 'required|alpha_numeric|min_length[3]');
			$this->form_validation->set_rules('terms', 'Terms and service','required');
			$this->form_validation->set_rules('def_currency', 'Currency','required');		
			
			//Reg Lock 
			$turing_reg_val = $this->security_settings_model->get_val('turing_reg'); 
			if($turing_reg_val!=1)	
			{
				$this->form_validation->set_rules('captcha','Turing code','required');
				 if($_POST['captcha']!=NULL)
				  {
					if($_POST['captcha']!=$_POST['captchaCode'])
					{				
						 $this->form_validation->set_rules('captcha','Captcha','callback_Captchacode_check');
					}
				  }
			}
			//Email Lock 
			$turing_email_lock_val = $this->security_settings_model->get_val('email_lock');
			if($turing_email_lock_val!=1)
			{	
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[bit_users.email]');
			}
			//Blacklist  Domain
			$turing_blacklist_val = $this->security_settings_model->get_val('blacklist');
			if($turing_blacklist_val!=1)
			{	
				$email_blacklist = $_POST['email'];
				 if($email_blacklist!=NULL)
				{	
					$email_blacklist_chk = explode('@',$email_blacklist);
					if(!empty($email_blacklist_chk[1]))
					{
						$domain_name = $email_blacklist_chk[1];
						$turing_domain_name_val = $this->blacklist_model->get_single_record(' domain_name="'.$domain_name.'"');
							 if($turing_domain_name_val!=NULL)
							{	
								$this->form_validation->set_rules('email', 'email', 'callback_blackdomain_check');
							}
					}	
				}		
			}
			//Ipaddress Lock 
			$ip_lock_val = $this->security_settings_model->get_val('ip_lock');
			if($ip_lock_val!=1)
			{	
				$ip_address	  = $_SERVER['REMOTE_ADDR'];
				$ipaddress_val  = $this->member_model->get_single_record('ipaddress="'.$ip_address.'"');
				 if($ipaddress_val!=NULL)
				{	
					$this->form_validation->set_rules('ip_lock','ip_lock','callback_ip_lock');
				}
			}
			//Ipaddress Lock 
			if($this->form_validation->run() == TRUE)
			{
				unset($_POST['conf_password']);unset($_POST['terms']);unset($_POST['captchaCode']);unset($_POST['captcha']);
				$this->session->unset_userdata('captchaCode');
				
				$insert_data =  $_POST;
				$token = md5($insert_data['first_name']).md5($insert_data['email']);
				$insert_data['password'] 	= md5($insert_data['password']);
				$insert_data['token'] = $token;
				$insert_data['group_ids']	= ',4,';
				$insert_data['date_created']= date("Y-m-d H:i:s");
				$insert_data['ipaddress']	= $_SERVER['REMOTE_ADDR'];
				if($request_id!=NULL)
				{
					$affiliate_data = $this->affiliate_requests_model->get_single_record("md5(request_id) ='".$request_id."' AND status = 1");
					if(!empty($affiliate_data)){
						$insert_data['is_affiliate'] = $affiliate_data->request_id;
					}
				}
				
				$mem_id = $this->member_model->add($insert_data);
				
				if($mem_id)
				{
					$update_data['token'] = $token;
					$this->member_model->edit($update_data,array("mem_id"=>$mem_id));
					
					//Email
					$admin_row  = $this->site_setting_model->get_single_record(1);
					$email_row  = $this->email_template_model->get_single_record(' title = "sign up" ');
					$name 		= $this->input->post('first_name')." ".$this->input->post('last_name');
					$email 		= $this->input->post('email');
					$password 	= $this->input->post('password');
					$this->email->subject($email_row->subject);
					$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
					$this->email->to($email);
					
					$link 			 = BASE_URL.'register/activation?id='.$mem_id.'&token='.$token;
					$activation_link = '<a href="'.$link.'">'.$link.'</a>';
					$sub_message 	 = $email_row->msg;
					$sub_pattern 	 = array('/{USERNAME}/','/{EMAIL}/','/{SUPPORT_EMAIL}/','/{ACTIVATION_LINK}/');
					$sub_replacement = array($name,$email,$admin_row->adm_support_email,$activation_link);
					$message 		 = preg_replace($sub_pattern,$sub_replacement,$sub_message);
					echo $message;exit;
					$this->email->message($message);
					$this->email->send();	
					//$this->session->set_flashdata(array('success_msg' => 'Your registration has been done successfully.'));
					//$this->session->set_flashdata(array('success_msg' => 'Your registration has been done successfully, check your email address to activate account.'));
					redirect('register/success');			
					exit;
				}
			}
		}
		
		$data['countries'] 	= $this->country_model->combox();
		$data['questions'] 	= $this->question_model->combox();	
		$this->main_view('account/register_view', $data);
	}
	
	 function rates() 
	{	
		$data['title'] 		 = '';
		$data['description'] = '';
 		$this->main_view('account/sub_rates_view',$data);
	}
	
	
	function username_check()
	{
		$_POST 		= $this->security->xss_clean($_POST);
		$username  	= $_POST['username'];
		$details   	= $this->member_model->get_single_record(" username='".$username."'  ");
		if($details!=NULL)
		{
			$this->form_validation->set_message('username_check', 'Username already exists, try another.');
			return FALSE;
		}
	}
	
	function generate_accnumber($first_name,$last_name,$mem_id)
	{
		$first_name = str_replace(".","",$first_name);
		$last_name  = str_replace(".","",$last_name);
		
		$string = '';
		$name_first_letter 	  = ucwords(substr($first_name,0,1));
		$surname_first_letter = ucwords(substr($last_name,0,1));
		$string = "BF-";
		if(strlen($mem_id)<=4) 
		{
			$string .= "000-";
			if(strlen($mem_id)==1) $string .= "000".$mem_id;
			if(strlen($mem_id)==2) $string .= "00".$mem_id;
			if(strlen($mem_id)==3) $string .= "0".$mem_id;
			if(strlen($mem_id)==4) $string .= $mem_id;
		}
		else
		{
			$last_digits  = substr($mem_id,strlen($mem_id)-4,4);
			$explode = explode($last_digits,$mem_id);
			$first_digits = $explode[0];
			if(strlen($first_digits)==1) $string .= "00".$first_digits;
			if(strlen($first_digits)==2) $string .= "0".$first_digits;
			if(strlen($first_digits)==3) $string .= $first_digits;
			$string .= "-".$last_digits;
		}
		$string .= "-".$name_first_letter.$surname_first_letter;
		return $string;
	}
		
	function already_exist_username()
	{
		$this->form_validation->set_message('already_exist_username', 'This username is taken please choose another one.');
		return FALSE;
	}
	
	function blackdomain_check()
	{
		$this->form_validation->set_message('blackdomain_check', 'Unfortunately this is blacklisted domain on wintacoins.com ,You cannot register using this Domain name.');
		//'Unfortunately{Domain name} is blacklisted domain on wintacoins.com ,You cannot register using {Domain name}.'
		return FALSE;
	}
	
	function ip_lock()
	{
		$this->form_validation->set_message('ip_lock', 'This IP is already registered to wintacoins.com , you cannot register from the same IP again');
		return FALSE;
	}
	
	function Captchacode_check()
	{
		$this->form_validation->set_message('Captchacode_check', 'The answer you entered for the Security code was not correct');
		return FALSE;
	}
	
	function captcha(){
		ob_start();
		require "vendors/captcha.php";
		captcha::showImage();
	}
	
	function success()
	{
		$data['title']  = 'Registration success';
		$this->main_view('register_success_view', $data);
	}

	function beta()
	{
		$data['title']  = 'Vettage is in Beta';
		$this->main_view('beta_view',array());
	}
	
	
	function activation()
	{
		$token 		= $_GET['token'];
		$mem_id 	= $_GET['id'];
		$details  = $this->member_model->get_single_record(' mem_id="'.$mem_id.'" AND token="'.$token.'" ');
		if($details!=NULL)
		{
			//update user table
			$update_data['token'] 	= '';
			$update_data['status']	= 1;
			$this->member_model->edit($update_data,array("mem_id"=>$mem_id));
			$this->session->set_flashdata(array('success_msg' => 'Your account has been activated successfully.'));
			redirect('');			
			exit;
		}
		else
		{
			$this->session->set_flashdata(array('error_msg' => 'Invalid token or account activated already.'));
			redirect('');			
			exit;
		}
	}
	
	function send_email()
	{
		$admin_row  = $this->site_setting_model->get_single_record(1);
		$email_row  = $this->email_template_model->get_single_record(' title = "sign up" ');
		$this->email->subject($email_row->subject);
		$this->email->from("apple.dev2@gmail.com",$admin_row->adm_name);
		$this->email->to("apple.dev34@gmail.com");
		$this->email->message($email_row->msg);
		$this->email->send();	
		echo "Email send success..";
		exit;
	}

	
}

?>