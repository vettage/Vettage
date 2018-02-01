<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submit_final_piece extends \MY_Frontcontroller 
{

	function __construct()
	{
		parent::__construct();
		
		//$this->user_id 	= $this->session->userdata('user_id');	
		//$this->index($this->uri->segment(2));
	}

	function index($alias='')
	{	
		$data['title'] 		 = '';
		$data['description'] = '';
 		$this->main_view('pages/submit_final_piece_view',$data);
	}
	
}

?>