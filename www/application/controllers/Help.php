<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends \MY_Frontcontroller 
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('faq_model','',TRUE);
		$this->user_id 	= $this->session->userdata('user_id');	
		//$this->index($this->uri->segment(2));
	}

	function index()
	{	
		$data['title'] 		 = "Help";
		$data['description'] = "Help";
		$data['help_data'] 	 = $this->faq_model->combox("*","status=1");
 		$this->main_view('pages/help_view',$data);
	}
	
}

?>