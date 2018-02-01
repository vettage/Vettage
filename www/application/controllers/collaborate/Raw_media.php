<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Raw_media extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('raw_media_model');
		$this->load->model('country_model');
		$this->load->model('state_model');
		$this->load->model('city_model');
 		$this->load->model('connect_model');
		$this->load->model('content_model');
		$this->load->model('blog_model');
		$this->load->model('user_model');
 		$this->load->library('form_validation');
		$this->load->model('site_setting_model');
		$this->user_id = $this->user->getUserID();	
	}
	
	
	function index()
	{
		$data['title'] 		 = 'RAW MEDIA';
		$data['description'] = ''; 
		$data['raw_details'] = $this->raw_media_model->combox("*","contributor_id='".$this->user_id."' ORDER BY raw_id DESC");
		if($_GET)
		{ 
			$where = "contributor_id='".$this->user_id."' ";
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
			if(!empty($_GET['copyright']) && $_GET['copyright']!='')
			{
				$where.= " AND copyright = '".$_GET['copyright']."'";
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
			if(!empty($_GET['time_event']) && $_GET['time_event']!='')
			{
				$time_event = str_replace(".","",$_GET['time_event']);
				if(strlen($time_event)==4 && is_numeric($time_event) )
				{
					$where.= " AND date = '".$time_event."' ";
				}
			}
			if(!empty($_GET['date']) && $_GET['date']!='')
			{
				$date = str_replace(".","",$_GET['date']);
				if(strlen($date)==8 && is_numeric($date) )
				{
					//$date = substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
					//$where.= " AND date = '".$date."' ";
					$date = substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
					$where.= " AND date LIKE '".$date."%' ";
				}
			}
			if(!empty($_GET['links']) && $_GET['links']!='')
			{
				$where.= " AND links LIKE '%".$_GET['links']."%' ";
			}
			if(!empty($_GET['formattypes']) && $_GET['formattypes']!='')
			{
				$_GET['format'] = ",".implode(",",$_GET['formattypes']).",";
			}
			$where.=" ORDER BY raw_id DESC";
			$data['raw_details']  = $this->raw_media_model->combox("*",$where);
		}
		
		$data['countries'] 	= $this->country_model->combox();
		$this->main_view('pages/contributor/raw_media_view',$data);
	}
	
	function updaterecords()
	{
		exit;
		$raw_details  = $this->raw_media_model->combox("*");
		foreach($raw_details as $row) :
			$update_data['raw_key']	= md5($row->raw_id.$row->time_event);
			$this->raw_media_model->edit($update_data,array("raw_id"=>$row->raw_id));
		endforeach;
	}
	function submit()
	{ 
		$raw_details = $raw_key = NULL;	
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			//if(!empty($_GET['action']) && $_GET['action']=="New") $this->session->unset_userdata('raw_key');
			if(!empty($_GET['raw_key']) && $_GET['raw_key']!="")
			{
				$raw_details = $this->raw_media_model->get_single_record("raw_key='".$_GET['raw_key']."' AND contributor_id='".$this->user_id."'");
				if($raw_details=="0")
				{
					$this->session->unset_userdata('raw_key');
					redirect('contributor/raw_media');			
					exit;
				}
				else
					$raw_key = $raw_details->raw_key;
			}
		}
		//if($raw_key==NULL) $raw_key 	= $this->session->userdata('raw_key');
		//if($raw_key!=NULL) $raw_details = $this->raw_media_model->get_single_record("raw_key='".$raw_key."'");
		$data['title'] = 'SUBMIT RAW MEDIA';
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
			$this->form_validation->set_rules('tags', 'Tags', 'required');
			$this->form_validation->set_rules('links', 'Links', 'required|callback_valid_url_format');
		//	$this->form_validation->set_rules('time_event','Time of event', 'required|callback_time_check');
  			$this->form_validation->set_rules('country','Country', 'required');   
			$this->form_validation->set_rules('city','City', 'required');
  			$this->form_validation->set_rules('state','State','required');
 		//	$this->form_validation->set_rules('zipcode','Zipcode','required');
		//	if($_POST['date']!='') $this->form_validation->set_rules('date','Date','required|callback_date_check');
			if($this->form_validation->run() == TRUE)
			{
	
				
				$insert_data = $_POST;
				if($_POST['date']!='') $insert_data['date'] = substr($_POST['date'],0,4)."-".substr($_POST['date'],4,2)."-".substr($_POST['date'],6,2);
				if($raw_key==NULL)
				{
					$insert_data['contributor_id'] = $this->user_id;
					$raw_id = $this->raw_media_model->add($insert_data);
					$update_data['raw_key']	= $raw_key = md5($raw_id.$insert_data['time_event']);
					$this->raw_media_model->edit($update_data,array("raw_id"=>$raw_id));
					//Session data
					$this->session->set_userdata(array('raw_id' => $raw_id,'raw_key' => $raw_key));
					$this->session->set_flashdata(array('success_msg' => 'Raw media details submitted successfully.'));
				}
				else
				{
					$update_data = $insert_data;
					$this->raw_media_model->edit($update_data,array("raw_key"=>$raw_key));
					$this->session->set_flashdata(array('success_msg' => 'Raw media details updated successfully.'));
				}
				redirect('account/raw');			
				exit;
  			} 
		}
		
		$data['raw_key'] 	 	 = $raw_key; 
		$data['raw_details'] 	 = $raw_details; 
		$data['countries'] 		 = $this->country_model->combox();
		$data['content_details'] = $this->content_model->combox(); 
		$this->main_view('pages/contributor/submit_media_view',$data);
	}
	
	function connect()
	{ 
		$data['raw_key'] = '';$raw_details=NULL;
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['raw_key']) && $_GET['raw_key']!="")
			{
				$raw_details = $this->raw_media_model->get_single_record("raw_key='".$_GET['raw_key']."' AND contributor_id='".$this->user_id."'");
				if($raw_details=="0")
				{
					$this->session->unset_userdata('raw_key');
					redirect('contributor/raw_media');			
					exit;
				}
				else
					$raw_key = $data['raw_key'] = $raw_details->raw_key;
			}
		}
		
		$data['title'] 		 = 'CONNECT';
		$data['description'] = '';
		$data['connect_title']      =''; 
		//$data['member_requests'] = $this->member_model->combox("*","mem_id!='".$this->mem_id."' AND type=2");
		if($_GET)
		{ 
			$where = "type=2";
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
			/*if(!empty($_GET['keywords']) && $_GET['keywords']!='')
			{
				$where.= " AND keywords LIKE '%".$_GET['keywords']."%' ";
			}*/
			/*if(!empty($_GET['expertise']) && $_GET['expertise']!='')
			{
				$where.= " AND expertise LIKE '%".$_GET['expertise']."%' ";
			}*/
			if(!empty($_GET['keywords']) && $_GET['keywords']!='')
			{
				$explode_array = explode(",",$_GET['keywords']);
				$where.= " AND ( ";
	            for($i=0;$i<sizeof($explode_array);$i++) 	
				{
					$where.=  "  keywords LIKE '%".trim($explode_array[$i])."%' "; 
					if($i!=(sizeof($explode_array)-1)) $where.=  " OR ";
				}
				$where.= " ) ";
			}
			if(!empty($_GET['expertise']) && $_GET['expertise']!='')
			{
				$explode_array = explode(",",$_GET['expertise']);
				$where.= " AND ( ";
	            for($i=0;$i<sizeof($explode_array);$i++) 	
				{
					$where.=  "  expertise LIKE '%".trim($explode_array[$i])."%' "; 
					if($i!=(sizeof($explode_array)-1)) $where.=  " OR ";
				}
				$where.= " ) ";
			}
			
			if(!empty($_GET['interests']) && $_GET['interests']!='')
			{
				$explode_array = explode(",",$_GET['interests']);
				$where.= " AND ( ";
	            for($i=0;$i<sizeof($explode_array);$i++) 	
				{
					$where.=  "  interests LIKE '%".trim($explode_array[$i])."%' "; 
					if($i!=(sizeof($explode_array)-1)) $where.=  " OR ";
				}
				$where.= " ) ";
			}
			$data['member_requests'] = $this->user_model->combox("*",$where);
		} 
		else
		{  
		    $data['connect_title']='Requests From Editors';
			$mem_ids='';
			$connect_data 	= $this->connect_model->combox("*","(to_id='".$this->user_id."') AND status=0");
			foreach($connect_data as $row)
			{
				if($row->to_id==$this->mem_id)
					$mem_ids.=$row->from_id.',';
				else
					$mem_ids.=$row->to_id.',';
			}
			$memids = trim($mem_ids,",");
			if($memids=='') $memids = "''";
			$data['member_requests'] = $this->connect_model->custom_query("select * from users where id IN($memids)");
			$data['new_member_requests'] = $this->connect_model->custom_query("select conn_id from connect WHERE (to_id='".$this->user_id."') AND status=0");
		}
		
		$data['raw_details'] = $raw_details;
 		$data['countries'] 	 = $this->country_model->combox();
		$this->main_view('pages/contributor/connect_view',$data);
 	}
	
	 function valid_url_format()
	 {
	 	$_POST = $this->security->xss_clean($_POST);
        $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $_POST['links'])){
            $this->form_validation->set_message('valid_url_format', 'The link you entered is not correctly formatted.');
            return FALSE;
        }
        return TRUE;
    }
	
	function date_check()
	{
		$_POST = $this->security->xss_clean($_POST);
		
		$date = $_POST['date'];//str_replace(".","",$_POST['date']);
		if(strlen($date)!=8 || !is_numeric($date) )
		{
			$this->form_validation->set_message('date_check', 'Please enter valid date.');
			return FALSE;
		}
	}
	
	function time_check()
	{
		$_POST = $this->security->xss_clean($_POST);
		$time_event = $_POST['time_event'];//str_replace(".","",$_POST['time_event']);
		$hours=substr($time_event,0,2); $minutes = substr($time_event,2,2);
		if(strlen($time_event)!=4 || !is_numeric($time_event) || ($hours<0 || $hours>23) || ($minutes<0 || $minutes>59) )
		{
			$this->form_validation->set_message('time_check', 'Please enter valid time.');
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
			$data['raw_details']      = $this->raw_media_model->combox("*",$where);
		}
		
		$data['countries'] 	= $this->country_model->combox();
		$this->main_view('pages/contributor/raw_media_pull_view',$data);
	}
	
	function listing()
	{   
		$data='';
		$post_data 	= $this->input->post(NULL, TRUE);
		$data['connect_data'] = $this->connect_model->combox("*","to_id='".$this->user_id."'");
		$this->main_view('pages/request_view',$data); 
	}
	
	function delete()
	{
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['raw_key']) && $_GET['raw_key']!="")
			{
				$raw_details = $this->raw_media_model->get_single_record("raw_key='".$_GET['raw_key']."' AND contributor_id='".$this->user_id."'");
				if($raw_details!="0")
				{
					$content_details = $this->content_model->get_single_record("raw_id='".$raw_details->raw_id."'");
					if($content_details!=NULL)
					{
						$this->session->set_flashdata(array('delete_error' => 'This raw media used for story, unable to delete.'));
						redirect('account');			
						exit;
					}
					//delete
					$this->raw_media_model->delete_media($raw_details->raw_id);
					$this->session->set_flashdata(array('success_msg' => 'Raw media deleted successfully.'));
					redirect('account');			
					exit;
				}
			}
		}
		$this->session->set_flashdata(array('delete_error' => 'Invalid request, unable to delete raw media.'));
		redirect('account');			
		exit;
	}
 	
	function add_connect()
	{
		$user_id = (int) $_POST['mem_id'];
		if($user_id>0)
		{
			$user_details = $this->user_model->get_single_record("id='".$user_id."'");

			if($user_details!=NULL)
			{
				$conenct_details = $this->connect_model->get_single_record("(from_id='".$this->user_id."' AND to_id='".$user_id."') OR (to_id='".$this->user_id."' AND from_id='".$user_id."')");
				
				if($conenct_details==NULL)
				{
					//Insert
					$insert ['from_id'] 	= $this->user_id;
					$insert ['to_id'] 		= $user_id;
					$insert ['date'] 		= date("Y-m-d H:i:s");
					$insert['request_type']	= 1; 		
					$insert = $this->security->xss_clean($insert);				

						
					$this->connect_model->add($insert);	
						
					//connect request mail
/*
					$admin_row  = $this->site_setting_model->get_single_record(1);
						$username 	= $user_details->username;
						$email 		= $user_details->email;
						$this->email->subject('New connection request.');
						$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
						$this->email->to($email);
						
						$link 		= BASE_URL.'account';
						$account_link = '<a href="'.$link.'">'.$link.'</a>';
						$message = "Hello $username,<br/><br/>$account_link<br/><br/>Best regards,
						<br/>Vettage Support Team.";
						$this->email->message($message);
						$this->email->send();		
						*/		
						echo 'Connect request sent successfully';
				}
				else
				{ //print_r($conenct_details);exit;
					if($conenct_details->status==1)
						echo 'Already connected';
					else if($conenct_details->status==2)
					{
						$update['status']	= 0; 		
						$this->connect_model->edit_connect($update,$conenct_details->conn_id);
						echo 'Connect request sent successfully';
					}
					else
						echo 'Already request sent';
				}
				exit;
			}
		}		
	}
	function getstates()
	{
		$html='<option value="" selected="selected">Select State</option>';
		if($_POST)
		{
			$country = $_POST['country'];
			$state = $_POST['state'];
			if($country!='')
		{ 
			$country_details = $this->country_model->get_single_data("countries","(name='".$country."' OR code='".$country."')");
				if($country_details!="0")
				{
					$country_id = $country_details->country_id;
					$states = $this->state_model->combox("state","*","country_id='".$country_id."'");
					foreach($states as $row)
					{
						$selected=''; if($state==$row->name) $selected='selected="selected"';
						$html.='<option value="'.$row->name.'" '.$selected.'>'.$row->name.'</option>';
					}
				}
			}
		}
		echo $html;
	}
	
	function getcities()
	{
		$html='<option value="" selected="selected">Select City</option>';
		if($_POST)
		{
			$state = $_POST['state'];
			$city = $_POST['city'];
			if($state!='')
			{
				$state_details = $this->state_model->get_single_data("state","name='".$state."'");
				if($state_details!="0")
				{
					$state_id = $state_details->state_id;
					$cities = $this->city_model->combox("city","*","state_id='".$state_id."'");
					foreach($cities as $row)
					{
						$selected=''; if($city==$row->name) $selected='selected="selected"';
						$html.='<option value="'.$row->name.'" '.$selected.'>'.$row->name.'</option>';
					}
				}
			}
		}
		echo $html;
	}
	
}
?>