<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Raw_media_pull extends \MY_Frontcontroller 
{

	function __construct()
	{
		
		die('dead class?');
		parent::__construct();
		
		if($this->session->userdata('fv_logged_in') == FALSE){
			redirect('');			
			exit;
		}
		$this->type = $this->session->userdata('type');	
		if($this->type!=2){
			redirect('');			
			exit;
		}
		$this->load->model('raw_media_model');
		$this->load->model('content_model');
		$this->load->model('connect_model');
		$this->load->model('country_model');
		$this->load->model('content_model');
		$this->load->model('allotment_model');
		$this->load->model('blog_model');
		$this->load->model('member_model');
 		$this->load->library('form_validation');
 		$this->mem_id = $this->session->userdata('mem_id');	
		//$this->user_id 	= $this->session->userdata('user_id');	
		//$this->index($this->uri->segment(2));
	}
	
	function updaterecords()
	{
		exit;
		$raw_details  = $this->content_model->combox("*");
		foreach($raw_details as $row) :
			$update_data['content_key']	= md5($row->content_id.$row->title);
			$this->content_model->edit($update_data,array("content_id"=>$row->content_id));
		endforeach;
	}

	function index()
	{	
		$data['title']  = 'RAW MEDIA PULL';
        //$data['raw_details'] = $this->raw_media_model->combox();
 		$data['countries'] 	= $this->country_model->combox();
		
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
		$this->main_view('pages/editor/raw_media_pull_view',$data);
	}
	
	function connect()
	{
		/*if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['raw_key']) && $_GET['raw_key']!="")
			{
				$raw_details = $this->raw_media_model->get_single_record("raw_key='".$_GET['raw_key']."'");
				if($raw_details=="0")
				{
					redirect('editor/raw_media_pull');			
					exit;
				}
				else
					$raw_key = $raw_details->raw_key;
			}
		}
		else
		{
			redirect('editor/raw_media_pull');			
			exit;
		}*/
		
		$data['title'] 		 		= 'CONNECT';
		$data['description'] 		= ''; 
		//$data['raw_details'] 		= $this->raw_media_model->get_single_record("raw_id='".$raw_id."'");  
		//$data['member_requests'] 	= $this->member_model->combox("*","type=1");
		if($_GET)
		{ 
			$where = "type=1";
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
			$data['member_requests'] = $this->member_model->combox("*",$where);
		} 
		else
		{
			$mem_ids='';
			$connect_data 	= $this->connect_model->combox("*","(to_id='".$this->mem_id."' OR from_id='".$this->mem_id."') AND status!=2");
			foreach($connect_data as $row)
			{
				if($row->to_id==$this->mem_id)
					$mem_ids.=$row->from_id.',';
				else
					$mem_ids.=$row->to_id.',';
			}
			$memids = trim($mem_ids,",");
			if($memids=='') $memids = "''";
			$data['member_requests'] = $this->connect_model->custom_query("select * from members where mem_id IN($memids) AND type=1");
		}
		
		//$data['raw_key'] 	 	= $raw_key; 
 		$data['countries'] 		= $this->country_model->combox();
		//$data['connect_data'] 	= $this->connect_model->combox("*","to_id='".$this->mem_id."' OR from_id='".$this->mem_id."'");
		$this->main_view('pages/editor/connect_requst_view',$data);
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
		$this->main_view('pages/editor/raw_media_pull_view',$data);
	}
	
	/*function updaterecords()
	{
		exit;
		$content_details  = $this->content_model->combox("*");
		foreach($content_details as $row) :
			$update_data['content_key']	= md5($row->raw_id.$row->title);
			$this->content_model->edit($update_data,array("content_id"=>$row->content_id));
		endforeach;
	}*/
	
	
	
	function submit_final_piece()
 		{	
		

		$content_details = $content_key = NULL;	
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			//if(!empty($_GET['action']) && $_GET['action']=="New") $this->session->unset_userdata('content_key');
			if(!empty($_GET['content_key']) && $_GET['content_key']!="")
			{
				$content_details = $this->content_model->get_single_record("content_key='".$_GET['content_key']."' AND contributor ='".$this                ->mem_id."'");
				if($content_details=="0")
				{
					$this->session->unset_userdata('content_key');
					redirect('editor/raw_media_pull');			
					exit;
				}
				else
					$content_key = $content_details->content_key;
			}
		}
		$data['title']  = 'SUBMIT FINAL PIECE';
        //$data['raw_details'] = $this->raw_media_model->combox();
 		$data['countries'] = $this->country_model->combox();
		if($_POST)
		{ 
			if(!empty($_POST['formattypes']) && $_POST['formattypes']!='')
			{
				$_POST['types'] = ",".implode(",",$_POST['formattypes']).",";
			}
			unset($_POST['formattypes']);
			if(empty($_POST['copyright'])) $_POST['copyright'] = '';
			
			//print_r($_POST);exit;
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('types', 'Media type', 'required');
			$this->form_validation->set_rules('copyright', 'Copyright', 'required');
			$this->form_validation->set_rules('tags', 'tags', 'required');
			$this->form_validation->set_rules('embed_code_link', 'Embed code/link', 'required');
  			$this->form_validation->set_rules('country','Country', 'required');   
			$this->form_validation->set_rules('city','City', 'required');
  			$this->form_validation->set_rules('state','State','required');
			$this->form_validation->set_rules('date','Date','required|callback_date_check');
		    $this->form_validation->set_rules('title','Title','required');
  			if($this->form_validation->run() == TRUE)
			{ 
				$insert_data=$_POST;
				if($_POST['date']!='') $insert_data['story_date']= substr($_POST['date'],0,4)."-".substr($_POST['date'],4,2)."-".substr($_POST[                'date'],6,2);
				$insert_data['created_date'] = date("Y-m-d H:i:s");
				if($content_key==NULL)
				{
					$insert_data['ipaddress'] = $_SERVER['REMOTE_ADDR'];
					$image_name = $this->content_model->do_upload($_FILES);
					if($_FILES['userfile']['name']!=NULL)
					{
						$insert_data['image'] = $image_name['upload_data']['file_name'];
					}
					unset($insert_data['copyright']);unset($insert_data['date']);
					unset($insert_data['userfile']);
					$insert_data['contributor'] = $this->mem_id;
					$content_id =$this->content_model->add($insert_data);
					
					$update_data['content_key']	= $content_key = md5($content_id.$insert_data['title']);
					$this->content_model->edit($update_data,array("content_id"=>$content_id));
					
					$this->session->set_userdata(array('content_id' => $content_id,'content_key' => $content_key));
					$this->session->set_flashdata(array('success_msg' => 'Submit final piece submitted successfully.'));
				}
				else
				{
					$update_data = $insert_data;
					$this->content_model->edit($update_data,array("content_key"=>$content_key));
					$this->session->set_flashdata(array('success_msg' => 'Submit final piece updated successfully.'));
				}
				redirect('editor/raw_media_pull/allotment?content_key='.$content_key);			
				exit;
  			} 
		}
		$data['content_key'] 	 	 = $content_key; 
		$data['content_details'] 	 = $content_details; 
		$data['countries'] 		 = $this->country_model->combox();
		$data['raw_details'] = $this->raw_media_model->combox(); 
		$this->main_view('pages/editor/submit_final_piece_view',$data);
	}
	
	function allotment()
	{
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['content_key']) && $_GET['content_key']!="")
			{
				$content_details = $this->content_model->get_single_record("content_key='".$_GET['content_key']."'");
				if($content_details==NULL)
				{
					redirect('editor/raw_media_pull');			
					exit;
				}
				else
					$content_key = $content_details->content_key;
			}
		}
		else
		{
			redirect('editor/raw_media_pull');			
			exit;
		}
		//Connections
		$mem_ids = '';
		$connect_data 	= $this->connect_model->combox("*","(to_id='".$this->mem_id."' OR from_id='".$this->mem_id."') AND status=1");
		foreach($connect_data as $row)
		{
			if($row->to_id==$this->mem_id)
				$mem_ids.=$row->from_id.',';
			else
				$mem_ids.=$row->to_id.',';
		}
		$memids = trim($mem_ids,",");
		if($memids=='') $memids = "''";
		$data['member_requests'] = $member_requests = $this->connect_model->custom_query("select * from members where mem_id IN($memids) AND type=1");
		//Connections
		
		if($_POST)
		{
			$_POST = $this->security->xss_clean($_POST);
			foreach($member_requests as $row) :
				$memid = $row->mem_id;
				if(!empty($_POST['user'.$memid]) && !empty($_POST['percent'.$memid]))
				{
					$allotment_details = $this->allotment_model->get_single_record("content_id='".$content_details->content_id."' AND contributor_id='".$_POST['user'.$memid]."' AND editor_id='".$this->mem_id."'");
					if($allotment_details==NULL)
					{
						$insert_allotment['content_id'] 	= $content_details->content_id;
						$insert_allotment['percent'] 		= $_POST['percent'.$memid];
						$insert_allotment['contributor_id'] = $_POST['user'.$memid];
						$insert_allotment['editor_id'] 		= $this->mem_id;
						$this->allotment_model->add($insert_allotment);
					}
					else
					{
						$insert_allotment['percent'] = $_POST['percent'.$memid];
						$this->allotment_model->edit_allotment($insert_allotment,$allotment_details->allot_id);
					}
				}
			endforeach;
			$this->session->set_flashdata(array('success_msg' => 'Allotment updated successfully.'));
			redirect('editor/raw_media_pull/allotment?content_key='.$content_key);			
			exit;
		}
		
		$data['content_key'] 	 	= $content_key; 
		$data['content_details'] 	= $content_details; 
		$data['countries'] 		 	= $this->country_model->combox();
		$this->main_view('pages/editor/allotmnt_view',$data);
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
	function listing()
	{   
		$data='';
		$post_data 	= $this->input->post(NULL, TRUE);
		$data['connect_data'] = $this->connect_model->combox("*","to_id='".$this->mem_id."'");
		$this->main_view('pages/editor/connect_requst_view',$data); 
	}
	function delete()
	{
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['content_key']) && $_GET['content_key']!="")
			{
				$raw_details = $this->raw_media_model->get_single_record("content_key='".$_GET['content_key']."' AND contributor_id='".$this->mem_id."'");
				if($content_details!="0")
				{
					//delete
					$this->content_model->delete_media($content_details->content_id);
					$this->session->set_flashdata(array('success_msg' => 'Submit final piece deleted successfully.'));
					redirect('editor/raw_media_pull');			
					exit;
				}
			}
		}
		$this->session->set_flashdata(array('delete_error' => 'Invalid request, unable to delete Submit final piece.'));
		redirect('editor/raw_media_pull');			
		exit;
	}
 	
	function add_connect()
	{
		$mem_id = (int) $_POST['mem_id'];
		if($mem_id>0)
		{
			$member_details = $this->member_model->get_single_record("mem_id='".$mem_id."'");
			if($member_details!=NULL)
			{
				//Insert
				$insert ['from_id'] 	= $this->mem_id;
				$insert ['to_id'] 		= $mem_id;
				$insert ['date'] 		= date("Y-m-d H:i:s");
				$insert['request_type']	= 2; 
				//print_r($insert);exit;		
				$insert = $this->security->xss_clean($insert);				
				$this->connect_model->add($insert);				
				echo 'Connect request sent successfully';
				exit;
			}
		}		
	}

	
}

?>