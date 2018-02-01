<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submit_media extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('fv_logged_in') == FALSE){
			redirect('');			
			exit;
		}
		
		$this->load->model('raw_media_model');
		$this->load->model('country_model');
		$this->load->library('form_validation');
		$this->mem_id = $this->session->userdata('mem_id');	
	}
	
	function index()
	{ 
		$data['title']  = 'SUBMIT RAW MEDIA';
        //$data['raw_details'] = $this->raw_media_model->combox();
 		$data['countries'] 	= $this->country_model->combox();
		if($_POST)
		{ 
			if(!empty($_POST['formattypes']) && $_POST['formattypes']!='')
			{
				$_POST['format'] = ",".implode(",",$_POST['formattypes']).",";
			}
			unset($_POST['formattypes']);
			if(empty($_POST['copyright'])) $_POST['copyright'] = '';
			
			//print_r($_POST);exit;
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('format', 'Format', 'required');
			$this->form_validation->set_rules('copyright', 'Copyright', 'required');
			$this->form_validation->set_rules('tags', 'tags', 'required');
			$this->form_validation->set_rules('links', 'links', 'required');
			$this->form_validation->set_rules('time_event','time_event', 'required');
  			$this->form_validation->set_rules('country','Country', 'required');   
			$this->form_validation->set_rules('city','City', 'required');
  			$this->form_validation->set_rules('state','State','required');
 			$this->form_validation->set_rules('zipcode','Zipcode','required');	
			if($this->form_validation->run() == TRUE)
			{ 
				//print_r($_POST);exit;
				//$post_data = $this->input->post(NULL, TRUE);
				$insert_data=$_POST;
				$insert_data['date']= date("Y-m-d H:i:s");
				$insert_data['contributor_id'] = $this->mem_id;
				$raw_id = $this->raw_media_model->add($insert_data);
				//echo "<br>".$this->db->last_query();die;
  				$this->session->set_flashdata(array('success_msg' => 'Raw media details submitted successfully.'));
				redirect('Submit_media');			
				exit;
  			} 
		}
		$this->main_view('pages/submit_media_view',$data);
 		 
	}
 }
?>