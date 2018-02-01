<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('fv_logged_in') != FALSE){
			redirect('account');			
			exit;
		}
		
		$this->load->helper('cookie');
		$this->load->model('member_model');
		$this->load->library('session');
		$this->load->model('member_upgrade_model');
		$this->load->model('site_setting_model');
		$this->load->model('email_template_model');
	}

	function ajax()
	{	 
		if($_POST)
		{ 
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('signin_email', 'Email', 'required');
			$this->form_validation->set_rules('signin_password', 'Password', 'required');
										
			if ($this->form_validation->run() == TRUE)
			{
				
				$user = $this->user->login($_POST['signin_email'],$_POST['signin_password'],1);

				if ($user['error']) {
					echo "error#".$user['message'];
					exit();
				}
				

				/*
				$member_details = $this->member_model->get_single_record("(email='".$_POST['signin_email']."' || username='".                $_POST['signin_email']."') AND password='".md5($_POST['signin_password'])."' AND status!=2");
				
  				if($member_details!=NULL)
				{
					if($member_details->status==1)
					{ 					
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
						
						//check expiry date of level
						$member_upgrade_details = $this->member_upgrade_model->get_single_record("mem_id='".$member_details->mem_id."' ORDER BY upgrade_id DESC");
						if($member_upgrade_details!=NULL)
						{
							if($member_upgrade_details->level>=4)
							{
								if(strtotime(date("Y-m-d")) > strtotime($member_upgrade_details->expire_date))
								{
									$update_expire_data['level'] = 1;
									$this->member_model->edit($update_expire_data,array("mem_id"=>$member_details->mem_id));
									//Upgrade
									$insert_expire_upgrade_data['mem_id'] 	= $member_details->mem_id;
									$insert_expire_upgrade_data['level'] 	= 1;
									$insert_expire_upgrade_data['date'] 	= date("Y-m-d H:i:s");
									$this->member_upgrade_model->add($insert_expire_upgrade_data);
								}
							}
						}
						
						$url = BASE_URL.'account';
						if($member_details->type==1) $url = BASE_URL.'contributor/raw_media/submit';
						if($member_details->type==2) $url = BASE_URL.'editor/raw_media_pull';
						if($member_details->type==3) $url = BASE_URL.'subscribers/search/source';
						
						if(!empty($_POST['remember']))
						{ 
							$cookie = array(
								'name' => 'rememberMe',
								'value' => $_POST['signin_email']."#".$_POST['signin_password'],
								'expire' => 31536000,
								'domain' => $_SERVER['HTTP_HOST']
							);
							set_cookie($cookie); 
							 
							$this->session->set_flashdata(array('success_msg' => 'Welcome to Vettage.com...'));
						}
						echo "success#$url"; 
						exit;
					}
					
				    elseif($member_details->status==0 && $member_details->type==3)
					{
						if($member_details->level==0 || ($member_details->level>1 && payment_status==0) )
						{
							$url = BASE_URL.'subscribers/subscription/index/'.$member_details->username;
							echo "success#$url";
						}
						else{
							echo "error#Account not activated yet.";
						}
					}
  					elseif($member_details->status==0 && ($member_details->type==1 || $member_details->type==2))
					{
						echo "error#Account not activated yet.";
					}
					else
					{
						echo "error#Invalid login details, try another.";
					}
					exit;
				}
				else
					echo "error#Invalid login details, try another.";
				
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
			if (!empty($_POST['redirect'])) $redirect = $_POST['redirect'];
				else $redirect = 'home';
			echo "success#$redirect";
			exit;
		}
	}
 	function reset_password()
	{	
		if($_POST)
		{
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('email', 'Email/Username', 'required');
			if($this->form_validation->run() == TRUE)
			{
				$email = $_POST['email'];
				$member_details	= $this->member_model->get_single_record("(email='".$email."' || username='".$email."') AND status=1");
				if($member_details!=NULL)
				{
					$mem_id 	= $member_details->mem_id;
					$name 		= $member_details->username;
					
					$token = md5($email).md5($mem_id);
					$insert_data['token'] = $token;
					$this->member_model->edit($insert_data,array("mem_id"=>$mem_id));
					
					$admin_row  	 = $this->site_setting_model->get_single_record(1);
					$email_row  	 = $this->email_template_model->get_single_record(' title = "Reset your password" ');
					$link 			 = BASE_URL.'login/change_password?id='.$mem_id.'&token='.$token;
					$activation_link = '<a href="'.$link.'">'.$link.'</a>';
					$sub_message 	 = $email_row->msg;
					$sub_pattern 	 = array('/{NAME}/','/{LINK}/','/{SUPPORT_EMAIL}/');
					$sub_replacement = array($name,$activation_link,$admin_row->adm_support_email);
					$message 		 = preg_replace($sub_pattern,$sub_replacement,$sub_message);
					
					$this->email->subject($email_row->subject);
					$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
					$this->email->to($member_details->email);
					$this->email->message($message);
					$this->email->send();
					
					echo "success#Reset password link sent to your email address";
					exit;
				}
				else
					echo "error#Invalid email address or username, try another.";
			}
			else
			{
				$error = '';
				foreach($_POST as $key=>$val){
					if(form_error("$key")) $error .= form_error("$key").'<br/>';
				}
				echo "error#$error";
			}
		}
	}
	
	function change_password()
	{	
		$token 		= $_GET['token'];
		$mem_id 	= $_GET['id'];
		$member_details  = $this->member_model->get_single_record(' mem_id="'.$mem_id.'" AND token="'.$token.'" ');
		if($member_details!=NULL)
		{
			$name 	= $member_details->username;
			$email 	= $member_details->email;
			
			//update user table
			$password = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
			$update_user_data['password'] 	= md5($password);
			$update_user_data['token'] 		= '';
			$this->member_model->edit($update_user_data,array("mem_id"=>$mem_id));
			
			$admin_row  	 = $this->site_setting_model->get_single_record(1);
			$email_row  	 = $this->email_template_model->get_single_record(' title = "Forgot Password" ');
			$sub_message 	 = $email_row->msg;
			$sub_pattern 	 = array('/{NAME}/','/{EMAIL}/','/{PASSWORD}/','/{SUPPORT_EMAIL}/');
			$sub_replacement = array($name,$email,$password,$admin_row->adm_support_email);
			$message 		 = preg_replace($sub_pattern,$sub_replacement,$sub_message);
			
			$this->email->subject($email_row->subject);
			$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
			$this->email->to($email);
			$this->email->message($message);
			$this->email->send();
			
 			$this->session->set_flashdata(array('success_msg' => 'New temporary password has been sent successfully, please check your email'));
			redirect('');			
			exit;
		}
		else
		{
			$this->session->set_flashdata(array('error_msg' => 'Invalid request or password changed already.'));
			redirect('');			
			exit;
		}
	}
	
	
}
?>