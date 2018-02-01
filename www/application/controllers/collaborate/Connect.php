<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connect extends \MY_Frontcontroller 
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
		
		// need to make sure all users I'm connected to are in here too
		$connected_ids = $this->connect_model->combox("to_id","from_id=".$this->user_id." and status=1");
		
		$conn_ids= array();
		foreach($connected_ids as $conn){
			$conn_ids[]=$conn->to_id;
		}
		
		if($_GET)
		{ 
			//$where = "type=2";
			$where = "1=1";
				
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
				$where.= " AND L.country LIKE '%".$_GET['country']."%' ";
			}
			if(!empty($_GET['city']) && $_GET['city']!='')
			{
				$where.= " AND L.city LIKE '%".$_GET['city']."%' ";
			}
			if(!empty($_GET['state']) && $_GET['state']!='')
			{
				$where.= " AND L.state LIKE '%".$_GET['state']."%' ";
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
			$conns = implode(',',$conn_ids);
			if (!empty($conns)) $where .= ' or U.id in ('.$conns.')'; 
			$data['member_requests'] = $this->user_model->location_combox("*",$where);
		} 
		else

		{  
			$conns = implode(',',$conn_ids);
			if (!empty($conns)) $where = ' or id in ('.$conns.')';
				else $where = '';
			$data['member_requests'] = $this->user_model->combox("*","1=1 $where limit 5");
			/*
		    $data['connect_title']='Requests From Editors';
			$mem_ids='';
			$connect_data 	= $this->connect_model->combox("*","(to_id='".$this->user_id."') AND status=0");
			foreach($connect_data as $row)
			{
				if($row->to_id==$this->user_id)
					$mem_ids.=$row->from_id.',';
				else
					$mem_ids.=$row->to_id.',';
			}
			$memids = trim($mem_ids,",");
			if($memids=='') $memids = "''";
			$data['member_requests'] = $this->connect_model->custom_query("select * from users where id IN($memids)");
			$data['new_member_requests'] = $this->connect_model->custom_query("select conn_id from connect WHERE (to_id='".$this->user_id."') AND status=0");
			*/
		
		}
		
		$data['connections'] = $this->user->getConnections();
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
}
?>