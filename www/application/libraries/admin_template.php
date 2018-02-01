<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_template extends CI_Controller{  

	function __construct()
	{ 
		parent::__construct();
		
		//$this->load->model('group_permission_model');
		//Permissions
		//$this->group_permission_model->check_permissions();
	
	$this->load->database();
	$this->load->library('session');
	
	$this->load->library('pagination');
		$this->load->library('email');
		$this->load->model('member_model');
		$this->load->model('site_setting_model');
       $this->load->helper('form');
        $this->load->helper('url');

//		$this->admin_login();
		$this->items_per_page =10; 
		$this->per_pages =array("10","20","30","50","100"); 

		if(!empty($_POST['items_per_page']))
			$this->session->set_userdata(array('items_per_page' => $_POST['items_per_page']));
		else
		{
			if($this->session->userdata('items_per_page')=='')
				$this->session->set_userdata(array('items_per_page' => $this->items_per_page));
		}
	}
	
	function index()
    {
		
    }	
		
	function main_view($folder,$view,$left_view,$view_data)
	{
		$data['description']= !empty($view_data['description']) ? $view_data['description'] : '';
		$data['keywords']	= !empty($view_data['keywords']) ? $view_data['keywords'] : ''; 
		$data['title']      = !empty($view_data['title']) ? $view_data['title'] : 'Admin Template';
		$data['folder']    	=  $folder;
		$data['view']	   	= $view;
		$data['left_view'] 	= $left_view.'_left_view';
		$data['view_data'] 	= $view_data;
		if(!file_exists($folder))
		{
			$this->load->view('admin/admin_template_view', $data);
		}
		else{
			$this->load->view('admin/admin_template_view', $data);
		}
	}
	
	function admin_login()
	{
		$this->load->helper(array('form', 'url'));
		if($this->session->userdata('admin_logged_in')==NULL)
		{
			redirect('/admin/home/login');
			//redirect('/admin/home');
			return;
		}
		
	}
	
	function getControllerArray()
	{
		$controller_array = array('Documents'=>'documents','Information'=>'information');
		return $controller_array;
	}
	
	
	
}

	
?>