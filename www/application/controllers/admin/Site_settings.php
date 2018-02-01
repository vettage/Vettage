<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_settings extends admin_template{  
	
	function index()
    {
		$adm_id = 1;
		$this->load->library('form_validation');
		$data['title']   	= 'Edit Account';
		$data['duplicate_error'] ='';
		$data['account_data'] 	= $this->site_setting_model->get_single_record("adm_id=$adm_id");
		if($this->input->post('sbmt_edit'))
		{
			$_POST = $this->security->xss_clean($_POST);
			
		    $this->form_validation->set_rules('adm_login', 'Username', 'required');
			$this->form_validation->set_rules('adm_name', 'Name', 'required');
			$this->form_validation->set_rules('adm_email', 'Email', 'required');
			$this->form_validation->set_rules('adm_support_email', 'Support Email ', 'required');
			$this->form_validation->set_rules('adm_info_email', 'Info Email ', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				if($_POST['adm_password']!=NULL) $update_data['adm_password'] = $_POST['adm_password'];
				$update_data['adm_name']      		= $_POST['adm_name'];
				$update_data['adm_login ']        	= $_POST['adm_login'];
				$update_data['adm_email']         	= $_POST['adm_email'];
				$update_data['adm_support_email'] 	= $_POST['adm_support_email'];
				$update_data['adm_info_email']    	= $_POST['adm_info_email'];
				$update_data['twitter_link']    	= $_POST['twitter_link'];
				$update_data['facebook_link']    	= $_POST['facebook_link'];
				$update_data['linked_in_link']    	= $_POST['linked_in_link'];
				$update_data['pinterest_link']    	= $_POST['pinterest_link'];
				$update_data['dribble_link']    	= $_POST['dribble_link'];
				$this->site_setting_model->edit($update_data,$adm_id);
				$this->session->set_userdata(array('admin_name' => $_POST['adm_login']));
				$this->session->set_flashdata(array('success_msg' => 'Site-setting details updated successfully.'));
				redirect('/admin/site_settings');
			}
		}
		$this->main_view('','site_setting_view','site_setting',$data);
	}
	
	function web_cash()
	{
		$adm_id = 1;
		$this->load->library('form_validation');
		$data['title']   	= 'Web-Cash Award';
		$data['account_data'] 	= $this->site_setting_model->get_single_record("adm_id=$adm_id");
		if($_POST!=NULL)
		{
			$this->form_validation->set_rules('awarded_web_cash', 'Web Cash', 'required|numeric|callback_max_pst');
			if ($this->form_validation->run() == TRUE)
			{
				$update_data['awarded_web_cash']  = $_POST['awarded_web_cash'];
				$this->site_setting_model->edit($update_data,$adm_id);
				$this->session->set_flashdata(array('success_msg' => 'Web-cash details updated successfully.'));
				redirect('/admin/site_settings/web_cash');
			}
		}
		$this->main_view('','web_cash_view','site_setting',$data);
	}
	
	function max_pst($value) 
	{
		$var = explode(".", $value);
		if (strpbrk($value, '-') && strlen($value) > 1)
		{
			$this->form_validation->set_message('max_pst', '%s accepts only positive values');
			return false;
		}
	}	
	
	function login_history()
	{
		$data['title']   	= 'Login History';
		$this->load->model('user_login_history_model');
		
		$config['base_url'] = BASE_URL.'/admin/site_settings/login_history';
		$config['per_page'] = $this->items_per_page;
		
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		
		$data['page'] = $page;
		
		$arr_cond = array(); $cond = 1; $count = 1;
		
		if($_POST!=NULL)
		{
			if($_POST['srch_email']!='')
				$arr_cond[] = " email = '".trim($_POST['srch_email'])."'" ;
			if($_POST['sort_by_status']!='')	
				$arr_cond[] = " login_status = ".$_POST['sort_by_status'];
				
			if(count($arr_cond)>0)
			{
				$cond  = implode(' AND ',$arr_cond);		
				$count = implode(' AND ',$arr_cond);	
			}	
		}
		
		$cond .= ' ORDER BY logged_date DESC limit '.$page.','.$config['per_page'];
		
		$data['login_history_data'] 	= $this->user_login_history_model->combox('bit_user_login_historys','*', $cond);
		
		$config['total_rows'] = $this->user_login_history_model->count_records($count);
		
		$config['uri_segment'] = 4; 
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';		
		$this->pagination->initialize($config);
		
		$this->main_view('','user_loggin_history_view','site_setting',$data);
	}
	
	function action_log()
	{
		$data['title']   	= 'Action History';
		$this->load->model('action_log_model');
		$this->load->model('user_model');
		
		$config['base_url'] = BASE_URL.'/admin/site_settings/action_log';
		$config['per_page'] = $this->items_per_page;
		
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		
		$data['page'] = $page;
		
		$cond = '1 ORDER BY action_date DESC limit '.$page.','.$config['per_page'];
		
		$data['action_history_data'] 	= $this->action_log_model->combox('bit_action_logs','*', $cond);
		
		$config['total_rows'] = $this->action_log_model->count_records();
		
		$config['uri_segment'] = 4; 
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';		
		$this->pagination->initialize($config);
		
		$this->main_view('','action_history_view','site_setting',$data);
	}
	
	function delete_login_history()
	{
		$hist_id = (int) $this->uri->segment(4);
		$this->load->model('user_login_history_model');
		if($hist_id)
		{
			$delete = $this->user_login_history_model->delete($hist_id);
			
			if($delete)
			{
				$this->session->set_flashdata(array('success_msg' => 'History deleted successfully.'));
				redirect('/admin/site_settings/login_history');
			}
			else
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete history.'));
				redirect('/admin/site_settings/login_history');
			}
		}	
	}
	
	function delete_action_history($action_log_id)
	{
		$this->load->model('action_log_model');
		if($action_log_id)
		{
			$delete = $this->action_log_model->delete('action_log_id',$action_log_id);
			
			if($delete)
			{
				$this->session->set_flashdata(array('success_msg' => 'Action deleted successfully.'));
				redirect('/admin/site_settings/action_log');
			}
			else
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete action.'));
				redirect('/admin/site_settings/action_log');
			}
		}	
	}
	
	function security_setting()
	{
		$adm_id = 1;
		$setting_id = 1;
		
		$this->load->library('form_validation');
		$data['title']   	= 'Security Settings';
		
		$this->load->model('security_settings_model');
		
		$data['admin_account_data'] = $this->site_setting_model->get_single_record("adm_id=$adm_id");
		$data['security_data'] 		= $this->security_settings_model->get_single_record("id=$setting_id");
		
		if($_POST!=NULL)
		{
			$this->form_validation->set_rules('reg_number', 'Registration Number', 'required');
			$this->form_validation->set_rules('secondary_password', 'Secondory Password', 'required');
			
			if ($this->form_validation->run() == TRUE)
			{
			
				$update_admin_data['reg_number'] 		 = $_POST['reg_number'];
				$update_admin_data['secondary_password'] = $_POST['secondary_password'];
				
				$update_security_data['ip_location'] 				= $_POST['ip_location'];
				$update_security_data['watchman'] 					= $_POST['watchman'];
				$update_security_data['turing_reg'] 				= $_POST['turing_reg'];
				$update_security_data['turing_log'] 				= $_POST['turing_log'];
				$update_security_data['secure_admin_login'] 		= $_POST['secure_admin_login'];
				$update_security_data['account_lockdown'] 			= $_POST['account_lockdown'];
				$update_security_data['log_failed_logins'] 			= $_POST['log_failed_logins'];
				$update_security_data['session_inactivity_timeout'] = $_POST['session_inactivity_timeout'];
				$update_security_data['ip_lock'] 					= $_POST['ip_lock'];
				$update_security_data['email_lock'] 				= $_POST['email_lock'];
				$update_security_data['blacklist'] 					= $_POST['blacklist'];
			
				$this->site_setting_model->edit($update_admin_data,$adm_id);
				$this->security_settings_model->edit($update_security_data,$setting_id);
				
				$this->session->set_flashdata(array('success_msg' => 'Security setting details updated successfully.'));
				redirect('/admin/site_settings/security_setting');
			}
		}
		$this->main_view('','security_setting_view','site_setting',$data);
	}
	
	function document_setting()
	{
		$this->load->library('form_validation');
		$data['title']   	= 'Document Settings';
		
		$this->load->model('document_setting_model');
		$data['document_setting_data'] = $this->document_setting_model->get_single_record("id=1");
		
		if($_POST!=NULL)
		{
			$update_data['format_file'] = implode(',',$_POST['format_file']);
			$update_data['size'] = $_POST['size'];
			$this->document_setting_model->edit($update_data,1);
			$this->session->set_flashdata(array('success_msg' => 'Document setting details updated successfully.'));
			redirect('/admin/site_settings/document_setting');
		}
		
		$this->main_view('','document_setting_view','site_setting',$data);
		
	}
	

}?>