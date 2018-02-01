<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends \MY_Frontcontroller {
	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('fv_logged_in') != TRUE){
			redirect();			
			exit;
		}
	}
	
	function index()
	{
		$this->session->unset_userdata('fv_logged_in');
		$this->session->unset_userdata('mem_id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('firstname');
		$this->session->unset_userdata('lastname');
		$this->session->unset_userdata('type');
		$this->session->unset_userdata('activetime');
		$this->session->unset_userdata('raw_id');
		$this->session->unset_userdata('raw_key');
		
		//$this->session->set_userdata(array('logout_success_msg' => 'Logout Successfully.'));
		$this->session->set_flashdata(array('success_msg' => 'Logout Successfully...'));
		redirect('');
	}	
}
 ?>