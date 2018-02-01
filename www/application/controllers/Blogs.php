<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs extends \MY_Frontcontroller 
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
		$data['title'] 		 = 'Blogs';
		$data['description'] = '';
		$data['keywords'] 	 = '';
		$where = "blog_id > 0" ;
		if(!empty($_GET['category']) &&  trim($_GET['category'])!='') 
		{
			$details = $this->category_model->get_single_record("category_title='".trim($_GET['category'])."'");
			if($details!="0") $where .= " AND category_id='".$details->category_id."'"; 
		}
		if(!empty($_GET['tags']) && trim($_GET['tags'])!='') $where .= " AND tags LIKE '%".trim($_GET['tags'])."%'";
		$data['blog_data'] 	 = $this-> blog_model->combox("blogs","*",$where);
 		$this->main_view('pages/blog_view',$data);
	}
	
	function details($alias)
	{	
		redirect("blog/details/$alias");			
		exit;
			
		$explode = explode("_",$alias);
		$blog_id = $explode[0];
		$alias   = $explode[1];
		$data['blog_details'] = $this->blog_model->get_single_record("blog_id='".$blog_id."'");
		
		if($data['blog_details']=="0") 
		{
			redirect('blogs');			
			exit;
		}
		$data['title'] 		 = '';
		$data['description'] = '';
		$data['keywords'] 	 = '';
        //$data['blog_cmt'] = $this->blog_model->get_record("blog_id='".$blog_id."'");
 		$this->main_view('pages/blog_details_view',$data);
	}
}
?>