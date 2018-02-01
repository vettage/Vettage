<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends \MY_Frontcontroller 
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('page_model');
		
		$this->user_id 	= $this->session->userdata('user_id');	
		//$this->index($this->uri->segment(2));
	}

	function index($alias='')
	{	
		if(trim($alias)=='')
		{
			$this->session->set_flashdata(array('error_msg' => 'Invalid page'));
			redirect('trade');			
			exit;
		}
		$data['page_data'] = $this->page_model->get_single_record("alias='".trim($alias)."'");
		if($data['page_data']=="0")
		{
			$this->session->set_flashdata(array('error_msg' => 'Invalid page'));
			redirect('trade');			
			exit;
		}
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
 		$this->main_view('page_view',$data);
	}
	
	function about_us()
	{
		$data['page_data'] = $this->page_model->get_single_record("alias='about_us'");
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
 		$this->main_view('pages/pages_view',$data);
	}
	
	function risk_warning()
	{
		$data['page_data'] = $this->page_model->get_single_record("alias='risk_warning'");
		
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
		
 		$this->main_view('page_view',$data);
	}
	
	function customer_agreement()
	{
		$data['page_data'] = $this->page_model->get_single_record("alias='customer_agreement'");
		
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
		
 		$this->main_view('page_view',$data);
	}
	
	function privacy_policy()
	{
		$data['page_data'] = $this->page_model->get_single_record("alias='privacy_policy'");
		
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
		
 		$this->main_view('page_view',$data);
	}
	
	function conflict_policy()
	{
		$data['page_data'] = $this->page_model->get_single_record("alias='conflict_policy'");
		
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
		
 		$this->main_view('page_view',$data);
	}
	
	function order_execution_policy()
	{
		$data['page_data'] = $this->page_model->get_single_record("alias='order_execution_policy'");
		
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
		
 		$this->main_view('page_view',$data);
	}
	
	function site_map()
	{
		$data['page_data'] = $this->page_model->get_single_record("alias='site_map'");
		
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
		
 		$this->main_view('page_view',$data);
	}
	
	function terms_condition()
	{
		$data['page_data'] = $this->page_model->get_single_record("alias='terms_condition'");
		
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
		
 		$this->main_view('page_view',$data);
	}
}

?>