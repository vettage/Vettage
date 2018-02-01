<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rating extends \MY_Frontcontroller 
{
 
	function __construct()
	{
		parent::__construct();
		
  		$this->type = $this->session->userdata('type');	
		if($this->type!=3){
			redirect('');			
			exit;
		}		
		
		$this->load->model('member_model');
		$this->load->model('country_model');
		$this->load->model('content_model');
		$this->load->model('raw_media_model');
		$this->load->model('allotment_model');
		$this->load->model('connect_model');
		$this->load->model('content_ratings_model');
	    $this->mem_id = $this->session->userdata('mem_id');	
	}
	
	function index()
    {
		$data['title']  = 'Rating';
		$data['content_details']  = $this->content_model->get_allot_details();
    	$this->main_view('pages/subscribers/rating_view',$data);
 	}
}
	
?>
