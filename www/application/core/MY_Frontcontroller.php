<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Frontcontroller extends CI_Controller{  

	function __construct()
	{ 

		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
//		$this->load->library('email');
		$this->load->model('member_model','',TRUE);
		$this->load->model('site_setting_model','',TRUE);
		$this->load->model('member_upgrade_model','',TRUE);
		$this->load->library('session');
		$this->user = new \MY_User();
		$this->email = new \MY_Mailer();
		$this->navigation = new \MY_Navigation($this->user);
		
		
	}
	
	function index()
    {
		
    }	
		
	function main_view($view,$view_data)
	{
		$data['description'] = !empty($view_data['description']) ? $view_data['description'] : '';
		$data['keywords']	 = !empty($view_data['keywords']) ? $view_data['keywords'] : ''; 
		$data['title']       = !empty($view_data['title']) ? $view_data['title'] : '| v e t t a g e |';
		$data['view']        = $view;
		$data['view_data']   = $view_data;
		
		$this->load->view('front_template_view', $data);
	}
	
	function user_before_login()
	{
		if($this->session->userdata('fv_logged_in')==TRUE)
		{ 
			redirect('/home');
			return;
		}
	}
	
	function user_after_login()
	{
		if($this->session->userdata('fv_logged_in')!=TRUE)
		{
			redirect('/register');
			return;
		}
	}
	
}

	
?>
