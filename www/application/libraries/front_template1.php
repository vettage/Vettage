<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Front_template extends CI_Controller{  

	function __construct()
	{ 
		die('acl');
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->model('member_model');
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