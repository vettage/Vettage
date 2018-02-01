<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Story_ideas extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('blog_model');
		$this->load->model('category_model');
		
		$this->mem_id 		= $this->session->userdata('mem_id');	
		$this->activetime 	= $this->session->userdata('activetime');
	}
	
	function index()
	{	
		//$this->member_model->checkAddress("1PSpXtPWdBZKkHJXRJeDLBs8APpCXcUrEV");
		$data['title'] 		 = 'Story Ideas';
		$data['description'] = '';
		$data['keywords'] 	 = '';
 		$this->main_view('pages/story_ideas_view',$data);
	}
}
?>