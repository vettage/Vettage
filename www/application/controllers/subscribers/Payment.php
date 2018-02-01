<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('content_model');
		$this->load->model('member_model');
		$this->load->model('connect_model');
		$this->load->model('raw_media_model');
		$this->load->model('country_model');
		$this->load->model('allotment_model');
 		$this->user_id 	= $this->session->userdata('user_id');	
		$this->mem_id = $this->session->userdata('mem_id');	
	}
	
	function index()
	{	
		$username = $this->uri->segment(4);
		$data['member_details'] = $member_details = $this->member_model->get_single_record("username='".$username."'");
		if($member_details==NULL) 
		{
			redirect('');			
			exit;
		}
		else
		{
			$data['level'] = $member_details->level;
		}
		
		if($_POST)
		{
			$update_data['level'] = $_POST['level'];
			$this->member_model->edit($update_data,array("mem_id"=>$member_details->mem_id));
			
			if($_POST['level']==""){}
		}
		
		$data['title'] 		 = 'Subscription';
		$data['description'] = 'Subscription';
 		$this->main_view('pages/subscribers/subscription_view',$data);
	}
	
}
?>
