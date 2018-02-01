<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->mem_id 		= $this->session->userdata('mem_id');	
		$this->activetime 	= $this->session->userdata('activetime');
	}
	
	function index()
	{	
		//$this->member_model->checkAddress("1PSpXtPWdBZKkHJXRJeDLBs8APpCXcUrEV");
		$data['title'] 		 = '';
		$data['description'] = '';
		$data['keywords'] 	 = '';
 		$this->main_view('pages/blog_view',$data);
	}
	
	function details()
	{	
		//$this->member_model->checkAddress("1PSpXtPWdBZKkHJXRJeDLBs8APpCXcUrEV");
		$data['title'] 		 = '';
		$data['description'] = '';
		$data['keywords'] 	 = '';
 		$this->main_view('pages/blog_details_view',$data);
	}
	
}
?>