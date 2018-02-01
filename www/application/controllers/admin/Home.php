<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Home extends admin_template{  

	function __construct()
	{
		parent::__construct();

		$this->load->model('member_model');
		$this->load->model('site_setting_model');
		$this->load->database();
	}

	
	
	function index()
    {	
       // $this->load->model('admin_page_model');
		$data['title']  = 'Admin Control ';
		$adm_login 		= $this->input->post('txt_username', TRUE);
		$adm_password 	= $this->input->post('txt_password', TRUE);

		if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'])
		{
			$user_id = $_SESSION['looged_id'];
			
			$data['users'] 			= $this->db->count_all('members');
			$data['user_count'] 	= $this->member_model->count_records(NULL,'mem_id');
			$data['user_reg_week'] 	= $this->member_model->count_records("where DATE_FORMAT(created,'%Y-%m-%d')>='".date('Y-m-d',strtotime("monday this week"))."'",'mem_id');
			$data['today_user'] 	= $this->member_model->count_records(" where DATE_FORMAT(created,'%Y-%m-%d') = '".date('Y-m-d')."'",'mem_id');
			$data['contributors'] 	= $this->member_model->count_records(" where type = 1",'mem_id');
			$data['editors'] 		= $this->member_model->count_records(" where type = 2",'mem_id');
			$data['subscribers'] 	= $this->member_model->count_records(" where type = 3",'mem_id');
			$this->load->view('admin/home_view', $data);
		} else if((!empty($adm_password)) && (!empty($adm_login)))
			{
			
				// TODO: SQL INjection!
				$query = $this->db->query("select * from  system_settings where adm_login='".$adm_login."' and adm_password='".$adm_password."'");
				$user_info 	= $query->row();

				if($query->num_rows()>0)
				{
					$_SESSION['admin_logged_in']='Superadmin';
					$_SESSION['admin_name']=$user_info->adm_name;
					$_SESSION['user_id']=$user_info->adm_id;
					$_SESSION['email']=$user_info->adm_email;
					$_SESSION['looged_id']=$user_info->adm_id;
					$_SESSION['permissions'] = ',76,';
		/*
							array('admin_logged_in'=>"Superadmin",'admin_name'=>$user_info->adm_name,'user_id'=>$user_info->adm_id,'email'=>$user_info->adm_email,
							'looged_id'=>$user_info->adm_id,'permissions'=>',76,')
							);
			*/
					$this->session->set_flashdata(array('success_msg' => 'Login Successfully...'));

					$user_id = $_SESSION['looged_id'];
					
					$data['users'] 			= $this->db->count_all('members');
					$data['user_count'] 	= $this->member_model->count_records(NULL,'mem_id');
					$data['user_reg_week'] 	= $this->member_model->count_records("where DATE_FORMAT(created,'%Y-%m-%d')>='".date('Y-m-d',strtotime("monday this week"))."'",'mem_id');
					$data['today_user'] 	= $this->member_model->count_records(" where DATE_FORMAT(created,'%Y-%m-%d') = '".date('Y-m-d')."'",'mem_id');
					$data['contributors'] 	= $this->member_model->count_records(" where type = 1",'mem_id');
					$data['editors'] 		= $this->member_model->count_records(" where type = 2",'mem_id');
					$data['subscribers'] 	= $this->member_model->count_records(" where type = 3",'mem_id');
					$this->load->view('admin/home_view', $data);
						
					
				} else {
					
					$this->session->set_flashdata(array('error_msg' => 'Invalid details'));
					$this->login();
					
				}
			
		} else {
			$this->login();
			
		}
		
    }	
	
	function login()
	{
		$data['title']  = 'Admin Login';
		$this->load->helper(array('form', 'url'));
		//$this->load->library('form_validation');
		//if($this->session->userdata('admin_logged_in'))
		
		//$this->session->set_flashdata(array('success_msg' => 'Welcome to Vettage.com...'));
		//redirect('/admin/home/login');
		
		$this->load->library(array('session','form_validation'));
		$this->load->view('admin/login_view', $data);
	}

	function logout()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$data['title'] 	 = 'Login';
		$data['agency']  = '';
		$data['agents']  = '';
		$data['rent'] 	 = '';
		$data['buy'] 	 = '';
		$data['contact'] = '';
		$data['news'] 	 = '';
		if(isset($_POST['sbt_login']))
		{
			$this->login();
		}
		else
		{

			
					unset($_SESSION['admin_logged_in']);
					unset($_SESSION['admin_name']);
					unset($_SESSION['user_id']);
					unset($_SESSION['email']);
					unset($_SESSION['looged_id']);
					unset($_SESSION['permissions']);
					session_destroy();
					$this->session->set_flashdata(array('success_msg' => 'Logout Successful.'));
			redirect('admin');
			exit;
		}
	}
	
	function daily_messages()
	{
		$user_id = $this->session->userdata('looged_id');
		$messages = '';
		//where read_by NOT LIKE '%,".$user_id.",%' 
		$message_data = $this->daily_messages_model->custom_query("select * from bit_daily_messages where status=1 order by added_on DESC Limit 0,20");
		foreach($message_data as $message_row):
			$id = $message_row->daily_message_id;
			$style='';if(strpos($message_row->read_by,",".$user_id.",")===false) $style='style="font-weight:bold"';
			$messages .= '<li>'.date("H:i, d-m-Y",strtotime($message_row->added_on)).' : <a title="View Email Message" href="javascript:show_message('.$message_row->daily_message_id.');" id="daily_message_link_'.$id.'" class="icon_link" '.$style.' >'.$message_row->subject.'</a> <div style="display:none" id="message_'.$id.'">'.$message_row->message.'</div></li>';
		endforeach;
		if($messages=='') $messages = '<li>Messages not available</li>';
		echo $messages;
	}
	
	function getemailmessage()
	{
		$body='';
		if($_POST)
		{
			$user_id = $this->session->userdata('looged_id');
			$daily_message_id  = $_POST['daily_message_id'];
			$details		= $this->daily_messages_model->get_single_data('bit_daily_messages',"daily_message_id=$daily_message_id");
			if($details!="0")
			{
				/*$userdetails = $this->user_model->get_single_data('bit_users',"user_id='".$details->added_by."'");
				$by_name = '';if($userdetails!="0") $by_name = $userdetails->first_name." ".$userdetails->last_name;
				$body.='<strong>By:</strong> '.$by_name.'<br /><br />';
				$body.='<strong>On:</strong> '.date("d-m-Y H:iA",strtotime($details->added_on)).'<br /><br />';
				$body.='<strong>Subject:</strong> '.$details->subject.'<br /><br />';
				$body.=$details->message.'<br />';*/
				
				//Update read flag
				$read_by = $details->read_by;
				if($read_by=='')
					$update['read_by'] = ",".$user_id.",";
				else
					$update['read_by'] = $read_by.$user_id.",";
				$this->daily_messages_model->edit($update,$daily_message_id);
				//Update read flag
			}
		}
		echo $body;
		exit;
	}
			
	
}?>