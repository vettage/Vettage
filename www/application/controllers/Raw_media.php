<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Raw_media extends \MY_Frontcontroller 
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
		$this->load->model('blog_model');
		$this->load->model('member_model');
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
			if($_POST['date']!='') $this->form_validation->set_rules('date','Date','required|callback_date_check');
				
			if($this->form_validation->run() == TRUE)
			{ 
				//print_r($_POST);exit;
				//$post_data = $this->input->post(NULL, TRUE);
				$insert_data=$_POST;
				if($_POST['date']!='') $insert_data['date']= substr($_POST['date'],0,4)."-".substr($_POST['date'],4,2)."-".substr($_POST['date'],6,2);
				$insert_data['contributor_id'] = $this->mem_id;
				//$data['countries'] 	= $this->country_model->combox();
				$raw_id = $this->raw_media_model->add($insert_data);
				//echo "<br>".$this->db->last_query();die;
  				$this->session->set_flashdata(array('success_msg' => 'Raw media details submitted successfully.'));
				redirect('raw_media/connect/'.$raw_id);			
				exit;
  			} 
		}
		$this->main_view('pages/submit_media_view',$data);
 		 
	}
	
	function date_check()
	{
		$_POST = $this->security->xss_clean($_POST);
		$date  	= $_POST['date'];
		if(strlen($date)!=8 || !is_numeric($date) )
		{
			$this->form_validation->set_message('date_check', 'Please enter valid date.');
			return FALSE;
		}
	}
	
	function search()
	{
		$data['title'] 		 = 'RAW MEDIA PULL';
		$data['description'] = ''; 
		$data['raw_details'] = NULL; 
		
		if($_GET)
		{ 
			$where = "raw_id>0 ";
			
			$_GET = $this->security->xss_clean($_GET);
			
			if(!empty($_GET['formattypes']) && $_GET['formattypes']!='')
			{
				$format_array = $_GET['formattypes'];
				$where.= " AND ( ";
				for($i=0;$i<sizeof($format_array);$i++)
				{
					if($i!=sizeof($format_array)-1)
						$where.= " format LIKE '%".$format_array[$i]."%' OR ";
					else
						$where.= " format LIKE '%".$format_array[$i]."%' ";
				}
				$where.= " ) ";
			}
			if(!empty($_GET['tags']) && $_GET['tags']!='')
			{
				$where.= " AND tags LIKE '%".$_GET['tags']."%' ";
			}
			if(!empty($_GET['country']) && $_GET['country']!='')
			{
				$where.= " AND country LIKE '%".$_GET['country']."%' ";
			}
			if(!empty($_GET['city']) && $_GET['city']!='')
			{
				$where.= " AND city LIKE '%".$_GET['city']."%' ";
			}
			if(!empty($_GET['state']) && $_GET['state']!='')
			{
				$where.= " AND state LIKE '%".$_GET['state']."%' ";
			}
			if(!empty($_GET['zipcode']) && $_GET['zipcode']!='')
			{
				$where.= " AND zipcode LIKE '%".$_GET['zipcode']."%' ";
			}
			if(!empty($_GET['links']) && $_GET['links']!='')
			{
				$where.= " AND links LIKE '%".$_GET['links']."%' ";
			}
			if(!empty($_GET['date']) && $_GET['date']!='')
			{
				$explode = explode("/",$_GET['date']);
				if(sizeof($explode)==3)
				{
					$date = $explode[0]."-".$explode[1]."-".$explode[2];
					$where.= " AND date LIKE '".$date."%' ";
				}
			}
			if(!empty($_GET['formattypes']) && $_GET['formattypes']!='')
			{
				$_GET['format'] = ",".implode(",",$_GET['formattypes']).",";
			}
			$data['raw_details'] = $this->raw_media_model->combox("*",$where); 
		}
		
		$data['countries'] 	= $this->country_model->combox();
		$this->main_view('pages/raw_media_pull_view',$data);
	}
	
	
	function connect($raw_id=NULL)
	{
		$data['title'] 		 = 'CONNECT';
		$data['description'] = ''; 
		$data['raw_details'] = $this->raw_media_model->get_single_record("raw_id='".$raw_id."'"); ; 
		$data['member_requests'] = $this->member_model->combox("*","mem_id!='".$this->mem_id."' AND type=2");
		if($_GET)
		{ 
			$where = "mem_id!='".$this->mem_id."' AND type=2";
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['formattypes']) && $_GET['formattypes']!='')
			{
				$format_array = $_GET['formattypes'];
				$where.= " AND ( ";
				for($i=0;$i<sizeof($format_array);$i++)
				{
					if($i!=sizeof($format_array)-1)
						$where.= " format LIKE '%".$format_array[$i]."%' OR ";
					else
						$where.= " format LIKE '%".$format_array[$i]."%' ";
				}
				$where.= " ) ";
			}
			if(!empty($_GET['country']) && $_GET['country']!='')
			{
				$where.= " AND country LIKE '%".$_GET['country']."%' ";
			}
			if(!empty($_GET['city']) && $_GET['city']!='')
			{
				$where.= " AND city LIKE '%".$_GET['city']."%' ";
			}
			if(!empty($_GET['state']) && $_GET['state']!='')
			{
				$where.= " AND state LIKE '%".$_GET['state']."%' ";
			}
			if(!empty($_GET['zipcode']) && $_GET['zipcode']!='')
			{
				$where.= " AND zipcode LIKE '%".$_GET['zipcode']."%' ";
			}
			if(!empty($_GET['experience']) && $_GET['experience']!='')
			{
				$where.= " AND experience LIKE '%".$_GET['experience']."%' ";
			}
			if(!empty($_GET['keywords']) && $_GET['keywords']!='')
			{
				$where.= " AND keywords LIKE '%".$_GET['keywords']."%' ";
			}
			if(!empty($_GET['expertise']) && $_GET['expertise']!='')
			{
				$where.= " AND expertise LIKE '%".$_GET['expertise']."%' ";
			}
			if(!empty($_GET['interests']) && $_GET['interests']!='')
			{
				$where.= " AND interests LIKE '%".$_GET['interests']."%' ";
			}
			/*		if($_GET)
			{
			if($_GET['action']=="Search")
			{ 			
			$_GET['field'] = $_GET['keyword'] = '';
			if(!empty($_GET['type'])) $arr_cond.= "AND type = '".trim($_GET['type'])."' " ; 
			}
			}
			
			*/		
			//$this->main_view('pages/raw_media_pull_view',$data);
			$data['member_requests'] = $this->member_model->combox("*",$where);
		} 
		
 		$data['countries'] 	= $this->country_model->combox();
		$this->main_view('pages/connect_view',$data);
		//$this->main_view('pages/connect_requst_view',$data);
 	}
 	 	
}
?>