<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller{  

	function __construct()
	{
		parent::__construct();
		//$this->admin_login();
		$this->load->library('email');
		$this->load->model('member_model','',TRUE);
		$this->load->model('site_setting_model','',TRUE);
		$this->load->model('member_upgrade_model','',TRUE);
		$this->load->database();
		$this->load->library('session');
		$this->items_per_page = 5; 
	}

	function admin_login()
    {

    	
    	$adm_login 		= $this->input->post('username', TRUE);	
		$adm_password 	= $this->input->post('pwd', TRUE);	

		if((!empty($adm_password)) && (!empty($adm_login)))
		{
			
			// TODO: SQL INjection!
			$query = $this->db->query("select * from  system_settings where adm_login='".$adm_login."' and adm_password='".$adm_password."'");
			$user_info 	= $query->row();
			
			if($query->num_rows()>0)
			{
				$this->session->set_userdata(
					array('admin_logged_in'=>"Superadmin",'admin_name'=>$user_info->adm_name,'user_id'=>$user_info->adm_id,'email'=>$user_info->adm_email,'looged_id'=>$user_info->adm_id,'permissions'=>',76,')
				);
				
				$this->session->set_flashdata(array('success_msg' => 'Login Successfully...'));
				echo "1";
			}
		}
    }
		
}?>