<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Country extends admin_template{  
		
	function __construct()
	{
		parent::__construct();
 		$this->load->model('country_model');
		$this->load->model('state_model');
		$this->load->model('city_model');
		$this->load->model('site_setting_model');
 		//$this->load->model('site_setting_model');
	}
	
	function index()
    {
		$data['title']  = 'Countries';
		$this->load->library('form_validation');
		
		
		$config['base_url'] = BASE_URL.'/admin/country/index';
		$config['per_page'] = $this->session->userdata('items_per_page');
		$page 				= ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$data['page'] 		= $page;
		$arr_cond 			= "country_id!='' ";
		
		if(!empty($_GET['keyword']) && trim($_GET['keyword'])!='' )
		{  
			$keyword = str_replace("'","\'",trim($_GET['keyword']));
			$arr_cond.= "AND (name = '".$keyword."' OR code = '".$keyword."') " ;
		}
		
		//echo $arr_cond;exit;
		$config['total_rows'] = $this->country_model->count_records("WHERE $arr_cond","country_id");//echo "WHERE $arr_cond";exit;
		$arr_cond.= ' ORDER BY name ASC limit '.$page.','.$config['per_page'];
		$data['countries']  = $this->country_model->combox("countries",'*', $arr_cond);
		
		$config['uri_segment'] 		= 3; 
		$config['full_tag_open']	= '<ul>';
		$config['full_tag_close'] 	= '</ul>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="active"><a>';$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_link'] 		= '&raquo;';
		$config['prev_link'] 		= '&laquo;';		
		$this->pagination->initialize($config);
		
		
 		//$data['countries'] 	= $this->country_model->combox("countries","*","1");
 		$this->main_view('country','country_view','countries',$data);//$folder,$view,$left_view,$view_data
	}
     
 	function edit_country($country_id)
    {
		$data['title']  = 'Countries';
		$this->load->library('form_validation');
		if($_POST)
		{			
			$_POST = $this->security->xss_clean($_POST);
		    $update_data=$_POST;
 			$this->country_model->edit($update_data,array("country_id"=>$country_id));
			$this->session->set_flashdata(array('success_msg' => 'Country updated successfully.'));
			redirect('/admin/country/');			
			exit;
		}
		$data['country_details'] 	= $this->country_model->get_single_data("countries","country_id=$country_id");
 		$this->main_view('country','edit_country_view','countries',$data);//$folder,$view,$left_view,$view_data
	}
	
	 function states($country_id)
    {  
		$data['title']  = 'States';
		$this->load->library('form_validation');
		$data['country_id'] = $country_id;
		$data['states'] 	= $this->state_model->combox("state","*","country_id='".$country_id."'");
		$this->main_view('country','state_view','state',$data);//$folder,$view,$left_view,$view_data
	}
	
	function edit_states($state_id)
    { 
		$data['title']  = 'State';
		$this->load->library('form_validation');
		$data['state_details'] 	= $this->state_model->get_single_data("state","state_id=$state_id");
		if($_POST)
		{			
			$_POST = $this->security->xss_clean($_POST);
		    $update_data=$_POST;
 			$this->state_model->edit($update_data,array("state_id"=>$state_id));
 			
			$this->session->set_flashdata(array('success_msg' => 'State updated successfully.'));
			redirect('/admin/country/states/'.$data['state_details']->country_id);			
			exit;
		}
 		$this->main_view('country','edit_state_view','state',$data);//$folder,$view,$left_view,$view_data
	}
    
	function add_states($country_id)
    {
		$data['title']  = 'State';
		$this->load->library('form_validation');
		if($_POST!=NULL)
		{
			$_POST = $this->security->xss_clean($_POST);
 			$this->form_validation->set_rules('name', 'State Name', 'required');
			
			if($this->form_validation->run() == TRUE)
			{
				$insert_data = $_POST;
			    $insert_data['country_id']= $country_id;
		        $id = $this->state_model->add($insert_data);
 			
  			   $this->session->set_flashdata(array('success_msg' => 'State added successfully.'));
			   redirect('/admin/country/states/'.$country_id);			
			   exit;
		   
		 }
		}
		//$data['state_details'] 	= $this->state_model->get_single_data("state","state_id=$state_id");
 		$this->main_view('country','add_state_view','state',$data);//$folder,$view,$left_view,$view_data
	}
	
	 function cities($state_id)
    {  
		$data['title']  = 'City';
		$this->load->library('form_validation');
		$data['state_id'] = $state_id;
		$data['city_details'] 	= $this->city_model->combox("city","*","state_id='".$state_id."'");
		$data['state_details'] = $this->state_model->get_single_data("state","state_id=$state_id");
		$this->main_view('country','city_view','cities',$data);//$folder,$view,$left_view,$view_data
	}
	
	function add_city($state_id)
    {
		$data['title']  = 'City';
		$this->load->library('form_validation');
		if($_POST!=NULL)
		{
			$_POST = $this->security->xss_clean($_POST);
 			$this->form_validation->set_rules('name', 'City Name', 'required');
			
			if($this->form_validation->run() == TRUE)
			{
				$insert_data = $_POST;
			    $insert_data['state_id']= $state_id;
		        $id = $this->city_model->add($insert_data);
 			
  			   $this->session->set_flashdata(array('success_msg' => 'City added successfully.'));
			   redirect('/admin/country/cities/'.$state_id);			
			   exit;
		   
		 }
		}
		//$data['state_details'] 	= $this->state_model->get_single_data("state","state_id=$state_id");
 		$this->main_view('country','add_city_view','cities',$data);//$folder,$view,$left_view,$view_data
	}
    function delete($country_id)
	{
		if($country_id)
		{
			$delete = $this->country_model->delete('country_id',$country_id);
			if($delete)
				$this->session->set_flashdata(array('success_msg' => 'Country deleted successfully.'));
			else
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete country.'));
			redirect('/admin/country');
			 
		}	
	}
	
	function delete_state($state_id)
	{
		if($state_id)
		{
			$state_details = $this->state_model->get_single_data("state","state_id=$state_id");
			
			$delete = $this->state_model->delete('state_id',$state_id);
			if($delete)
				$this->session->set_flashdata(array('success_msg' => 'State deleted successfully.'));
			else
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete State.'));
			redirect('/admin/country/states/'.$state_details->country_id);
			 
		}	
	}
	
	function delete_city($city_id)
	{
		if($city_id)
		{
			$city_details = $this->city_model->get_single_data("state","city_id=$city_id");
			$delete = $this->city_model->delete('city_id',$city_id);
			if($delete)
				$this->session->set_flashdata(array('success_msg' => 'City deleted successfully.'));
			else
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete City.'));
			redirect('/admin/country/cities/'.$city_details->state_id);
			 
		}	
	}
}
?>