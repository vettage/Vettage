<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends \MY_Frontcontroller 
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('page_model');
		$this->user_id 	= $this->session->userdata('user_id');	
		//$this->index($this->uri->segment(2));
	}

	function pages($alias='')
	{	
		

		if(trim($alias)=='')
		{
			$this->session->set_flashdata(array('error_msg' => 'Invalid page'));
			redirect('');			
			exit;
		}
		$data['page_data'] = $this->page_model->get_single_record("alias='".trim($alias)."'");
		if($data['page_data']=="0")
		{
			$this->session->set_flashdata(array('error_msg' => 'Invalid page'));
			redirect('');			
			exit;
		}
		$data['title'] 		 = $data['page_data']->menu_title;
		$data['description'] = $data['page_data']->description;
 		$this->main_view('pages/pages_view',$data);
	}
	
}

?>