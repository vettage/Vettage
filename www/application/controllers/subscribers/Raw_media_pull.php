<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Raw_media_pull extends \MY_Frontcontroller 
{

	function __construct()
	{
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
		$this->load->model('site_setting_model');
		$this->load->model('connect_model');
		$this->load->model('country_model');
		$this->load->model('content_model');
		$this->load->model('allotment_model');
		$this->load->model('blog_model');
		$this->load->model('member_model');
 		$this->load->library('form_validation');
 		$this->mem_id = $this->session->userdata('mem_id');	
		$this->username = $this->session->userdata('username');
		$this->user_id 	= $this->session->userdata('user_id');	
		$this->user_email = $this->session->userdata('email');	
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
			
			/*if(!empty($_GET['tags']) && $_GET['tags']!='')
			{
				$where.= " AND tags LIKE '%".$_GET['tags']."%' ";
			}*/
			if(!empty($_GET['tags']) && $_GET['tags']!='')//print_r($_GET['tags']);exit;
			{
				$explode_array = explode(",",$_GET['tags']);
				$where.= " AND ( ";
	            for($i=0;$i<sizeof($explode_array);$i++) 	
				{
					$where.=  "  tags LIKE '%".trim($explode_array[$i])."%' "; 
					if($i!=(sizeof($explode_array)-1)) $where.=  " OR ";
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
 			if(!empty($_GET['date']) && $_GET['date']!='')
			{
				$date = str_replace(".","",$_GET['date']);
				if(strlen($date)==8 && is_numeric($date) )
				{
					$where.= " AND date = '".$date."' ";
				}
			}
			
			if(!empty($_GET['date']) && $_GET['date']!='')
			{
				$date = str_replace(".","",$_GET['date']);
				if(strlen($date)==8 && is_numeric($date) )
				{
					$date = substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
					//$date = $explode[0]."-".$explode[1]."-".$explode[2];
					$where.= " AND date LIKE '".$date."%' ";
				}
			}
			if(!empty($_GET['formattypes']) && $_GET['formattypes']!='')
			{
				$_GET['format'] = ",".implode(",",$_GET['formattypes']).",";
			}
			$where.=" order by raw_id DESC";
			$data['raw_details'] = $this->raw_media_model->combox("*",$where); 
		}
		$this->main_view('pages/editor/raw_media_pull_view',$data);
	}
	
	function connect()
	{
		/*$redirect = 1;
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['raw_key']) && $_GET['raw_key']!="")
			{
				$raw_details = $this->raw_media_model->get_single_record("raw_key='".$_GET['raw_key']."'");
				if($raw_details!=NULL)
				{
					$redirect = 0;
					$raw_key = $raw_details->raw_key;
				}
			}
		}
		if($redirect==1)
		{
			$this->session->set_flashdata(array('error_msg' => 'Please select atleast one download link to submit final piece'));
			redirect('editor/raw_media_pull');			
			exit;
		}*/
		
		$data['title'] 		 		= 'CONNECT';
		$data['description'] 		= ''; 
		$data['connect_title']      ='';
		//$data['raw_details'] 		= $this->raw_media_model->get_single_record("raw_key='".$raw_key."'");  
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
						$where.= " expertise LIKE '%".$format_array[$i]."%' OR ";
					else
						$where.= " expertise LIKE '%".$format_array[$i]."%' ";
				}
				$where.= " ) ";
				$_GET['format'] = ",".implode(",",$_GET['formattypes']).",";
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
			
			  
			           $data['member_requests'] = $this->member_model->combox("*",$where);
			    
		} 
		else
		{
			$data['connect_title']='Requests From Raw Content Contributors';
			$mem_ids='';
			$connect_data 	= $this->connect_model->combox("*","(to_id='".$this->mem_id."') AND status=0");
			
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
			$data['new_member_requests'] = $this->connect_model->custom_query("select conn_id from connect WHERE (to_id='".$this->mem_id."') AND status=0");
		
		}
		
		//$data['raw_key'] 	 	= $raw_key; 
 		$data['countries'] 		= $this->country_model->combox();
		//$data['connect_data'] 	= $this->connect_model->combox("*","to_id='".$this->mem_id."' OR from_id='".$this->mem_id."'");
		$this->main_view('pages/editor/connect_requst_view',$data);
 	}
	
	function submit_final_piece()
 	{	
	   
		$this->load->library('email');
		$redirect = 1;
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['raw_key']) && $_GET['raw_key']!="")
			{
				$raw_details = $this->raw_media_model->get_single_record("raw_key='".$_GET['raw_key']."'");
				if($raw_details!=NULL)
				{
					$redirect = 0;
					$raw_key = $raw_details->raw_key;
				}
			}
		}
		if($redirect==1)
		{
			$this->session->set_flashdata(array('error_msg' => 'Please select atleast one raw media download link to submit final piece'));
			redirect('editor/raw_media_pull');			
			exit;
		}
		
		$mem_ids=$raw_details->contributor_id.',';
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
		$member_requests = $this->connect_model->custom_query("select * from members where mem_id IN($memids) AND type=1");
		if($member_requests==NULL)
		{
			$this->session->set_flashdata(array('error_msg' => 'Please must have atleast one contributor connection to submit final piece'));
			redirect('editor/raw_media_pull/connect?raw_key='.$raw_key);			
			exit;
		}
		
		$data['title']  = 'SUBMIT FINAL PIECE';
        //$data['raw_details'] = $this->raw_media_model->combox();
 		$data['countries'] = $this->country_model->combox();
		if($_POST)
		{   //print_r($_POST);exit;
			if(!empty($_POST['formattypes']) && $_POST['formattypes']!='')
			{
				$_POST['types'] = ",".implode(",",$_POST['formattypes']).",";
			}
			unset($_POST['formattypes']);
			if(empty($_POST['copyright'])) $_POST['copyright'] = '';
			
			$_POST = $this->security->xss_clean($_POST);
			//$_POST['content_desc'] = htmlspecialchars($_POST['content_desc']);
			
			$this->form_validation->set_rules('types', 'Media type', 'required');
			$this->form_validation->set_rules('copyright', 'Copyright', 'required');
			$this->form_validation->set_rules('tags', 'tags', 'required');
			if($_POST['content_desc']=='')
			   { $this->form_validation->set_rules('embed_code_link', 'Embed code/link', 'required'); }
  			$this->form_validation->set_rules('country','Country', 'required');   
			$this->form_validation->set_rules('city','City', 'required');
  			$this->form_validation->set_rules('state','State','required');
			$this->form_validation->set_rules('date','Date','required|callback_date_check');
		    $this->form_validation->set_rules('title','Title','required|is_unique[contents.title]');
			
  			if($this->form_validation->run() == TRUE)
			{ 
				$insert_data=$_POST; 
				//$insert_data['content_desc'] = str_replace("'","\'",$insert_data['content_desc']);
				if($_POST['date']!='') $insert_data['story_date']= substr($_POST['date'],0,4)."-".substr($_POST['date'],4,2)."-".substr($_POST                ['date'],6,2);
				$insert_data['created_date'] = date("Y-m-d H:i:s");
				$insert_data['ipaddress'] = $_SERVER['REMOTE_ADDR'];
				if($_FILES)
				{
					$image_name = $this->content_model->do_upload($_FILES);
					if($_FILES['userfile']['name']!=NULL)
					{
						$insert_data['image'] = $image_name['upload_data']['file_name'];
					}
				}
				unset($insert_data['copyright']);unset($insert_data['date']);
				unset($insert_data['userfile']);
				
				$insert_data['editor'] 		= $this->mem_id;
				$insert_data['raw_id'] 		= $raw_details->raw_id;
				$insert_data['contributor'] = $raw_details->contributor_id;
				$insert_data['status'] 		= 1;
				
				$content_id = $this->content_model->add($insert_data);
				
				$update_data['content_key']	= $content_key = md5($content_id.$insert_data['title']);
				$this->content_model->edit($update_data,array("content_id"=>$content_id));
				
				//default allotment
				$insert_allotment['content_id'] 	= $content_id;
				$insert_allotment['percent'] 		= 0;
				$insert_allotment['contributor_id'] = $raw_details->contributor_id;
				$insert_allotment['editor_id'] 		= $this->mem_id;
				$this->allotment_model->add($insert_allotment);
				
				//Subscribers
				$admin_row  	= $this->site_setting_model->get_single_record(1);
				$subscribers  	= $this->member_model->combox('*', "type=3 AND status=1");
				foreach($subscribers as $row)
				{
					$username 	= $row->username;
					$email 		= $row->email;
					$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
					$this->email->to($email);
					$this->email->subject('New Final Piece Submitted');
					
					
					$link 		= BASE_URL.'story/details?key='.$content_key;
					$story_link = '<a href="'.$link.'">'.$link.'</a>';
					$message 	= "Hello $username,<br/><br/>Title:".$_POST['title']."<br/>$story_link<br/><br/>Best regards,<br/>Vettage Support Team.";
					$this->email->message($message);
					$this->email->send();	
				}
				
				$this->session->set_flashdata(array('success_msg' => 'Final piece submitted successfully.'));
				redirect('editor/raw_media_pull/allotment?content_key='.$content_key);			
				exit;
  			} 
		}
		//$data['content_key'] 	 	 = $content_key; 
		//$data['content_details'] 	 = $content_details; 
		$data['raw_key'] 	 	= $raw_key; 
		$data['countries'] 		= $this->country_model->combox();
		$data['raw_details'] 	= $this->raw_media_model->combox(); 
		$this->main_view('pages/editor/submit_final_piece_view',$data);
	}

	
	
	function allotment()
	{	
		$this->load->library('email');
		if($_GET=='')
		{
			redirect('editor/raw_media_pull');			
			exit;
		}
		else
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
		
		$raw_details = $this->raw_media_model->get_single_record("raw_id='".$content_details->raw_id."'");
		if($raw_details==NULL)
		{
			$this->session->set_flashdata(array('error_msg' => 'Please select atleast one raw media download link to submit final piece'));
			redirect('editor/raw_media_pull');			
			exit;
		}
		
		//Connections
		$mem_ids = $raw_details->contributor_id.',';
		/*$connect_data 	= $this->connect_model->combox("*","(to_id='".$this->mem_id."' OR from_id='".$this->mem_id."') AND status=1");
		foreach($connect_data as $row)
		{
			if($row->to_id==$this->mem_id)
				$mem_ids.=$row->from_id.',';
			else
				$mem_ids.=$row->to_id.',';
		}*/
		
		//new code
		$allocation_data =$this->allotment_model->combox("*","content_id='".$content_details->content_id."' AND editor_id='".$this->mem_id."'");
		foreach($allocation_data as $row_alloc) $mem_ids.=$row_alloc->contributor_id.',';
		
		$memids = trim($mem_ids,",");
		if($memids=='') $memids = "''";
		$data['member_requests'] = $member_requests = $this->connect_model->custom_query("select * from members where mem_id IN($memids) AND type=1");
		//Connections
	
		if($_POST)
		{
			$table = $emails = '';
			$_POST = $this->security->xss_clean($_POST);
			$post_data = $_POST;
			$max_count = $_POST['cnt'];   
			for($i = 1 ;$i<=$max_count;$i++)  
			{ 
				if(!empty($_POST['user'.$i]) && !empty($_POST['percent'.$i]))
			   	{
					$contributor_details = $this->member_model->get_single_record("mem_id ='".$_POST['user'.$i]."'");
					if($contributor_details != NULL)
					{
						$contributor_name = $contributor_details->username;
						$email = $contributor_details->email;
						$allotment_details = $this->allotment_model->get_single_record("content_id='".$content_details->content_id."' AND contributor_id='".$_POST['user'.$i]."' AND editor_id='".$this->mem_id."'");
						if($allotment_details==NULL)
						{
							$insert_allotment['content_id'] 	= $content_details->content_id;
							$insert_allotment['percent'] 		= $_POST['percent'.$i];
							$insert_allotment['contributor_id'] = $_POST['user'.$i];
							$insert_allotment['editor_id'] 		= $this->mem_id;
							$this->allotment_model->add($insert_allotment);
							$table .= '<tr><td>'.$contributor_name.'</td><td>'.$insert_allotment['percent'].'</td></tr>';
							$emails.= $email.",";
						}
						else
						{
							$insert_allotment['percent'] = $_POST['percent'.$i];
							$this->allotment_model->edit_allotment($insert_allotment,$allotment_details->allot_id);
							if($allotment_details->percent!=$insert_allotment['percent']) 
							{
								$table .= '<tr><td>'.$contributor_name.'</td><td>'.$insert_allotment['percent'].'</td></tr>';
								$emails.= $email.",";
							}
						}
					}
					
				}
			}
					
			//Contributors
			if($emails!='')
			{
				$emails 	= trim($emails,",");
				$admin_row  = $this->site_setting_model->get_single_record(1);
				$this->email->subject('New Final Piece Submitted');
				$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
				$this->email->to($emails);
				
				$allotments = 'Allotments:<br/><table width="20%"><thead><tr><th width="70%" style="text-align:left">Contributor</th><th style="text-align:left">%</th></tr></thead><tbody>'.$table.'</tbody></table>';
				
				$link 		= BASE_URL.'story/details?key='.$content_key;
				$story_link = '<a href="'.$link.'">'.$link.'</a>';
				$message 	= "Hello,<br/><br/>Title:".$content_details->title."<br/>$story_link<br/><br/>$allotments<br/><br/>Best regards,<br/>Vettage Support Team.";
				//echo $message;exit;
				$this->email->message($message);
				$this->email->send();	
			}
			
			$this->session->set_flashdata(array('success_msg' => 'Final piece allotment updated successfully.'));
			redirect('editor/raw_media_pull');			
			exit;
		}
		
		}//GET
		$data['content_key'] 	 	= $content_key; 
		$data['content_details'] 	= $content_details; 
		$data['countries'] 		 	= $this->country_model->combox();
		$this->main_view('pages/editor/allotmnt_view',$data);
	}
	
	
	function allotment_search($content_id)
	{
		//search allotment
		/*$connected_mem_ids = ',';
		$connect_data 	= $this->connect_model->combox("*","(to_id='".$this->mem_id."' OR from_id='".$this->mem_id."') AND status=1");
		foreach($connect_data as $row)
		{
			if($row->to_id==$this->mem_id)
				$connected_mem_ids.=$row->from_id.',';
			else
				$connected_mem_ids.=$row->to_id.',';
		}
		$connected_mem_ids = trim($connected_mem_ids,",");
		if($connected_mem_ids=='') $connected_mem_ids = "''";*/
		
		$content_details = $this->content_model->get_single_record("content_id = '".$content_id."'");
		$mem_ids = ",".$content_details->contributor.',';
		$connect_data 	= $this->allotment_model->combox("*","content_id='".$content_id."'");
		foreach($connect_data as $row)
		{
			$mem_ids.=$row->contributor_id.',';
		}
		$memids = trim($mem_ids,",");
		if($memids=='') $memids = "''";
		
		$json=array();
		$member_details = $this->member_model->combox("*","mem_id NOT IN($memids) AND type=1 AND username like '%".$_GET['term']."%'");
		
		foreach($member_details as $row) :
			$json[]=array(
				'value'=> $row->username,
				'label'=>$row->username
			);
		endforeach;
		echo json_encode($json); 
	}	
	
	function get_result()
	{
		$post_data = $this->input->post(NULL, TRUE);$count=0;$html='';
		
		$percentage = $checked = '';$checked = 'checked="checked"';
		$count = $post_data['count'];
		
		$contributor_details = $this->member_model->get_single_record("type=1 AND username ='".$_POST['username']."'");
		if($contributor_details == NULL) 
		{
			echo "Contributor does not exists";
			exit;
		}
		$allotment_details = $this->allotment_model->get_single_record("content_id='".$_POST['content_id']."' AND contributor_id='".$contributor_details->mem_id."' AND editor_id='".$this->mem_id."'");
		if($allotment_details==NULL)
		{
			$insert_allotment['content_id'] 	= $_POST['content_id'];
			$insert_allotment['contributor_id'] = $contributor_details->mem_id;
			$insert_allotment['editor_id'] 		= $this->mem_id;
			$this->allotment_model->add($insert_allotment);
			$html.='<tr>
				<td>
					<strong>'.$_POST['username'].'</strong>
				</td>
				<td><input type="text" id="percent'.$count.'" name="percent'.$count.'" value="0" class="form-control input-sm" style="width:200px;" /> </td>
				<td><input type="checkbox" id="user'.$count.'" name="user'.$count.'" value="'.$contributor_details->mem_id.'" ></td>
			</tr>';				
			echo $html;
		}
		exit;
	}
	
	/*<input type="hidden" name="same_user[]" value="'.$contributor_details->mem_id.'">*/
	
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
	
	
 	function date_check()
	{
		$_POST = $this->security->xss_clean($_POST);
		$date  = $_POST['date'];
		if(strlen($date)!=8 || !is_numeric($date) )
		{
			$this->form_validation->set_message('date_check', 'Please enter valid date.');
			return FALSE;
		}
		else
		{
			
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
					$this->content_model->remove_images($content_details->content_id);
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
		$mem_id 	= (int) $_POST['mem_id'];
		$raw_key 	= !empty($_POST['raw_key']) ? $_POST['raw_key'] : '';
		if($mem_id>0)
		{
			$member_details = $this->member_model->get_single_record("mem_id='".$mem_id."'");
			if($member_details!=NULL)
			{
				$conenct_details = $this->connect_model->get_single_record("(from_id='".$this->mem_id."' AND to_id='".$mem_id."') OR (to_id='".$this->mem_id."' AND from_id='".$mem_id."')");
				if($conenct_details==NULL)
				{
					$raw_id = 0;
					$raw_details = $this->raw_media_model->get_single_record("raw_key='".$raw_key."'");
					if($raw_details!=NULL) $raw_id = $raw_details->raw_id;
					//Insert
					$insert ['raw_id'] 		= $raw_id;
					$insert ['from_id'] 	= $this->mem_id;
					$insert ['to_id'] 		= $mem_id;
					$insert ['date'] 		= date("Y-m-d H:i:s");
					$insert['request_type']	= 2; 
					//print_r($insert);exit;		
					$insert = $this->security->xss_clean($insert);				
					$this->connect_model->add($insert);	
					//connect request mail
					$admin_row  = $this->site_setting_model->get_single_record(1);
					$username 	= $member_details->username;
					$email 		= $member_details->email;
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
				{
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
	
	function submitted_final_pieces()
 	{	
		$data['title']  = 'SUBMITTED FINAL PIECES';
		if($_GET)
		{ 
			$where = "content_id>0 ";			
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['country']) && $_GET['country']!='')
			{
				$where.= " AND a.country LIKE '%".$_GET['country']."%' ";
			}
			if(!empty($_GET['city']) && $_GET['city']!='')
			{
				$where.= " AND a.city LIKE '%".$_GET['city']."%' ";
			}
			if(!empty($_GET['state']) && $_GET['state']!='')
			{
				$where.= " AND a.state LIKE '%".$_GET['state']."%' ";
			}
			if(!empty($_GET['zipcode']) && $_GET['zipcode']!='')
			{
				$where.= " AND a.zipcode LIKE '%".$_GET['zipcode']."%' ";
			}
			if(!empty($_GET['tags']) && $_GET['tags']!='')
			{
				$where.= " AND a.tags LIKE '%".$_GET['tags']."%' ";
			}
			
			if(!empty($_GET['date']) && $_GET['date']!='')
			{
				$explode = explode("/",$_GET['date']);
				if(sizeof($explode)==3)
				{
					$date = $explode[0]."-".$explode[1]."-".$explode[2];
					$where.= " AND a.date LIKE '".$date."%' ";
				}
			}
			
			if(!empty($_GET['searchtypes']) && $_GET['searchtypes']!='')
			{
				$type_array = $_GET['searchtypes'];
				//$type_array =  ",".implode(",",$_GET['searachtype']).",";
				$where.= " AND ( ";
				for($i=0;$i<sizeof($type_array);$i++)
				{
					if($type_array[$i] == 'Contributor') $type = 1;
					else $type = 2;
					if($i!=sizeof($type_array)-1)
						$where.= " b.type = ".$type." OR ";
					else
						$where.= " b.type = ".$type;
				}
				$where.= " ) ";
			}
		}
		//$data['countries'] 			= $this->country_model->combox();
		$data['content_details'] 	= $this->content_model->combox("*","editor='".$this->mem_id."' ORDER BY content_id DESC"); 
		$this->main_view('account/final_piece_listing_view',$data);
	}
	
	
	function edit_submitted_final_piece()
 	{	
		$redirect = 1;
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['content_key']) && $_GET['content_key']!="")
			{
				$content_details = $this->content_model->get_single_record("content_key='".$_GET['content_key']."' AND editor='".$this->mem_id."'");
				if($content_details!=NULL)
				{
					$redirect = 0;
					$content_key = $content_details->content_key;
				}
			}
		}
		if($redirect==1)
		{
			$this->session->set_flashdata(array('error_msg' => 'Invalid request'));
			redirect('editor/raw_media_pull/submitted_final_pieces');		
			exit;
		}
		
		//$raw_details = $this->raw_media_model->get_single_record("raw_id='".$content_details->raw_id."'");
		//$raw_key = $raw_details->raw_key;
		
		$data['title'] = 'SUBMITTED FINAL PIECE';
		//print_r($_POST);exit;
		if($_POST)
		{  
			if(!empty($_POST['formattypes']) && $_POST['formattypes']!='')
			{
				$_POST['types'] = ",".implode(",",$_POST['formattypes']).",";
			}
			unset($_POST['formattypes']);
			if(empty($_POST['copyright'])) $_POST['copyright'] = '';
			
			//print_r($_POST);exit;
			//$_POST = $this->security->xss_clean($_POST);
			//print_r($_POST);exit;
			$this->form_validation->set_rules('types', 'Media type', 'required');
			$this->form_validation->set_rules('copyright', 'Copyright', 'required');
			$this->form_validation->set_rules('tags', 'tags', 'required');
			if($_POST['content_desc']=='')
			   { $this->form_validation->set_rules('embed_code_link', 'Embed code/link', 'required'); }
  			$this->form_validation->set_rules('country','Country', 'required');   
			$this->form_validation->set_rules('city','City', 'required');
  			$this->form_validation->set_rules('state','State','required');
			$this->form_validation->set_rules('date','Date','required|callback_date_check');
		    $this->form_validation->set_rules('title','Title','required');
			$chk_title = $this->content_model->get_single_data(" title ='".str_replace("'","\'",$_POST['title'])."' AND content_key!='".$content_key."'");
			if($chk_title!=NULL) $this->form_validation->set_rules('title', 'Title', 'is_unique[contents.title]');
			
  			if($this->form_validation->run() == TRUE)
			{ 
				$insert_data=$_POST;//print_r($insert_data);exit;
				if($_POST['date']!='') $insert_data['story_date']= substr($_POST['date'],0,4)."-".substr($_POST['date'],4,2)."-".substr($_POST[                'date'],6,2);
				
				if($_FILES)
				{
					$image_name = $this->content_model->do_upload($_FILES);
					if($_FILES['userfile']['name']!=NULL)
					{
						$this->content_model->remove_images($content_details->content_id);
						$insert_data['image'] = $image_name['upload_data']['file_name'];
					}
				}
				unset($insert_data['copyright']);unset($insert_data['date']);
				unset($insert_data['userfile']);
			
				$update_data = $insert_data;	
				$this->content_model->edit($update_data,array("content_key"=>$content_key));
				$this->session->set_flashdata(array('success_msg' => 'Final piece updated successfully.'));
				
				redirect('editor/raw_media_pull/edit_allotment?content_key='.$content_key);			
				exit;
  			} 
		}
		//$data['content_key'] 	 	 = $content_key; 
		//$data['content_details'] 	 = $content_details; 
		$data['content_key'] 	 = $content_key; 
		$data['countries'] 		 = $this->country_model->combox();
		$data['content_details'] = $content_details; 
		$this->main_view('account/edit_final_piece_view',$data);
	}
	
	function clearimageinput()
	{
		if($_POST)
		{
			$content_id = $_POST['content_id'];
			$content_details = $this->content_model->get_single_record("content_id='".$content_id."' AND editor='".$this->mem_id."'");
			if($content_details!=NULL)
			{
				$this->content_model->remove_images($content_id);
				$update_data['image'] 	 = '';	
				$update_data['featured'] = 0;	
				$this->content_model->edit($update_data,array("content_id"=>$content_id));
			}
		}
		echo "";
		exit;
	}
	
	function edit_allotment()
	{
		$this->load->library('email');
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['content_key']) && $_GET['content_key']!="")
			{
				$content_details = $this->content_model->get_single_record("content_key='".$_GET['content_key']."' AND editor='".$this->mem_id."'");
				if($content_details==NULL)
				{
					$this->session->set_flashdata(array('error_msg' => 'Invalid request'));
					redirect('account');			
					exit;
				}
				else
					$content_key = $content_details->content_key;
			}
		}
		else
		{
			$this->session->set_flashdata(array('error_msg' => 'Invalid request'));
			redirect('account');			
			exit;
		}
	
		$raw_details = $this->raw_media_model->get_single_record("raw_id='".$content_details->raw_id."'");
		if($raw_details==NULL)
		{
			$this->session->set_flashdata(array('error_msg' => 'Please select atleast one raw media download link to submit final piece'));
			redirect('account');				
			exit;
		}
		
		//Connections
		
		$mem_ids = $raw_details->contributor_id.',';
		$connect_data 	= $this->allotment_model->combox("*","content_id='".$content_details->content_id."'");
		foreach($connect_data as $row)
		{
			$mem_ids.=$row->contributor_id.',';
		}
		
		/*$connect_data 	= $this->connect_model->combox("*","(to_id='".$this->mem_id."' OR from_id='".$this->mem_id."') AND status=1");
		foreach($connect_data as $row)
		{
			if($row->to_id==$this->mem_id)
				$mem_ids.=$row->from_id.',';
			else
				$mem_ids.=$row->to_id.',';
		}*/
		$memids = trim($mem_ids,",");
		if($memids=='') $memids = "''";
		$data['member_requests'] = $member_requests = $this->connect_model->custom_query("select * from members where mem_id IN($memids) AND type=1");
		//Connections
		if($_POST)
		{
			$table = $emails = '';
			$_POST = $this->security->xss_clean($_POST);
			$post_data = $_POST;
			$max_count = $_POST['cnt'];
			for($i = 1 ;$i<=$max_count;$i++) 
			{ 
				if(!empty($_POST['user'.$i]) && !empty($_POST['percent'.$i]))
				{
					$contributor_details = $this->member_model->get_single_record("mem_id ='".$_POST['user'.$i]."'");
					if($contributor_details != NULL)
					{
						 $contributor_name = $contributor_details->username;
						 $email = $contributor_details->email;
						 $allotment_details = $this->allotment_model->get_single_record("content_id='".$content_details->content_id."' AND  contributor_id='".$_POST['user'.$i]."' AND editor_id='".$this->mem_id."'");
						if($allotment_details==NULL)
						{
							$insert_allotment['content_id'] 	= $content_details->content_id;
							$insert_allotment['percent'] 		= $_POST['percent'.$i];
							$insert_allotment['contributor_id'] = $_POST['user'.$i];
							$insert_allotment['editor_id'] 		= $this->mem_id;
							$this->allotment_model->add($insert_allotment);
							$table.= '<tr><td width="70%">'.$contributor_name.'</td><td>'.$insert_allotment['percent'].'</td></tr>';
							$emails.= $email.",";
						}
						else
						{    
							$insert_allotment['contributor_id'] = $_POST['user'.$i];
							$insert_allotment['percent'] = $_POST['percent'.$i];
							$this->allotment_model->edit_allotment($insert_allotment,$allotment_details->allot_id);
							if($allotment_details->percent!=$insert_allotment['percent']) 
							{
								$table .= '<tr><td>'.$contributor_name.'</td><td>'.$insert_allotment['percent'].'</td></tr>';
								$emails.= $email.",";
							}
						}
					}
					
				} 
			}
			
			//Contributors
			if($emails!='')
			{
				$emails 	= trim($emails,",");
				$admin_row  = $this->site_setting_model->get_single_record(1);
				$this->email->subject('New Final Piece Submitted');
				$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
				$this->email->to($emails);
				
				$allotments = 'Allotments:<br/><table width="20%"><thead><tr><th width="70%" style="text-align:left">Contributor</th><th style="text-align:left">%</th></tr></thead><tbody>'.$table.'</tbody></table>';
				
				$link 		= BASE_URL.'story/details?key='.$content_key;
				$story_link = '<a href="'.$link.'">'.$link.'</a>';
				$message 	= "Hello,<br/><br/>Title:".$content_details->title."<br/>$story_link<br/><br/>$allotments<br/><br/>Best regards,<br/>Vettage Support Team.";
				$this->email->message($message);
				$this->email->send();	
			}
			
			$this->session->set_flashdata(array('success_msg' => 'Final piece allotment updated successfully.'));
			redirect('account');					
			exit;
		}
		
		$data['content_key'] 	 	= $content_key; 
		$data['content_details'] 	= $content_details; 
		$data['countries'] 		 	= $this->country_model->combox();
		$this->main_view('account/edit_allotment_view',$data);
	}
	
	 
}

?>