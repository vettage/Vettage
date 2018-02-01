<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends \MY_Frontcontroller 
{
	function __construct()
	{

		parent::__construct();		
		$this->load->model('member_model', '', TRUE);
		$this->load->model('content_model', '', TRUE);
		$this->load->model('page_model', '', TRUE);
		$this->load->library('session');

		/*
		if($this->session->userdata('fv_logged_in') != FALSE){
			$this->type = $this->session->userdata('type');	
			if($this->type==1)
			{
				redirect('contributor/raw_media/submit');			
				exit;
			}
			if($this->type==2)
			{
				redirect('editor/raw_media_pull');			
				exit;
			}
		}
		*/
		$this->load->helper('cookie');
		$this->mem_id 		= $this->session->userdata('mem_id');	
		$this->activetime 	= $this->session->userdata('activetime');
		
	}
/*	
	public function view($page = 'home')
	{
		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
	
		$data['title'] = ucfirst($page); // Capitalize the first letter
	

		$this->load->view('home_view', $data);
	}
*/	
	function index()
	{	
		//$this->member_model->checkAddress("1PSpXtPWdBZKkHJXRJeDLBs8APpCXcUrEV");
		
		if ($this->user->isLogged()) {
			$data['title'] 		 = '';
			$data['description'] = '';
			$data['keywords'] 	 = '';
			$data['stories']  = $this->content_model->combox('*', "image!= '' ORDER BY content_id DESC limit 5");
			$this->main_view('user_home',$data);
				
		} else {
			$data['title'] 		 = '';
			$data['description'] = '';
			$data['keywords'] 	 = '';
			$data['slider_images']  = $this->content_model->combox('*', "featured=1 AND image!= '' ORDER BY content_id DESC limit 5");
	 		$data['left_column'] = trim($this->page_model->get_single_record("alias='Home Left Column'")->description);
	 		$data['right_column'] = trim($this->page_model->get_single_record("alias='Home Right Column'")->description);
	 		
	 		$this->main_view('home_view',$data);
		}
	}
 	
	
	function tag($tag)
	{
		$tag = $this->security->xss_clean($tag);
	
			$data['title'] 		 = $tag;
			$data['description'] = '';
			$data['keywords'] 	 = '';
			$data['stories']  = $this->content_model->combox('*', "image!= '' and tags like '%".$tag."%' ORDER BY content_id DESC limit 5");
			$this->main_view('user_home',$data);
	
	}
	
	
	function getcontenttexts($content_id)
	{
		$content_details = $this->content_model->get_single_record("content_id='".$content_id."'");
		if($content_details!=NULL)
		{
			$content_key = $content_details->content_key;
			$file_name = getcwd()."/media/uploads/contents/$content_key.html";
			echo file_get_contents($file_name);
			exit;
		}
	}
	
}
?>