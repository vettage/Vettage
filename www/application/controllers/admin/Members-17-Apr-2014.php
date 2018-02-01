<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Members extends admin_template{  
		
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('member_model');
		$this->load->model('country_model');
		$this->load->model('state_model');
		$this->load->model('city_model');
		$this->load->model('member_upgrade_model');
		$this->load->model('content_model');
		$this->load->model('raw_media_model');
		$this->load->model('allotment_model');
		$this->load->model('email_template_model');
		$this->load->model('site_setting_model');
	}
	
	function index()
    {
		$data['title']  = 'Members';
		$config['base_url'] = BASE_URL.'/admin/members/index';
		$config['per_page'] = $this->session->userdata('items_per_page');
		$page 				= ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$data['page'] 		= $page;
		$arr_cond = "status!=2 "; $cond = "status=1 "; $count = 1;
		if($_GET)
		{
			if($_GET['action']=="Search")
			{
				if(!empty($_GET['field']) && !empty($_GET['keyword']))
				{
					$keyword = str_replace("'","\'",trim($_GET['keyword']));
					if($_GET['field']=="country") 
					{
						$countrydetails = $this->country_model->get_single_record("(LOWER(name)='".strtolower($keyword)."' OR LOWER(code)='".strtolower($keyword)."')");
						if($countrydetails!="0") $keyword = $countrydetails->code;
					}
					else
						$arr_cond.= "AND ".$_GET['field']." LIKE '%".$keyword."%' " ; 
				}
				else
					$_GET['field'] = $_GET['keyword'] = '';
				
				if(!empty($_GET['level'])) $arr_cond.= "AND level = '".trim($_GET['level'])."' " ;
				if(!empty($_GET['type'])) $arr_cond.= "AND type = '".trim($_GET['type'])."' " ;
				
			}
		}
		$config['total_rows'] = $this->member_model->count_records("WHERE $arr_cond");//echo "WHERE $arr_cond";exit;
		$arr_cond.= ' ORDER BY created ASC limit '.$page.','.$config['per_page'];
		$data['member_data']  = $this->member_model->combox('*', $arr_cond);
		
		$config['uri_segment'] 		= 4; 
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
		
		$this->main_view('members','member_listing_view','members',$data);
	}
	
	function payment()
	{
		$data['title']  = 'Payment';
	
		$data['member_data']  = $this->member_upgrade_model->combox('*',"1 ORDER BY upgrade_id DESC");
		$this->main_view('members','payment_listing_view','members',$data);
	}
	
	function new_payment()
	{
		$this->load->library('form_validation');
		$data['title']   	= 'New Payment';
		if($_POST!=NULL)
		{
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('level', 'Level', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
			$this->form_validation->set_rules('price', 'Price', 'required|numeric');
			if($this->form_validation->run() == TRUE)
			{	
				$insert_data = $_POST;
				$insert_data['date']	 	= date("Y-m-d H:i:s");
				$insert_data['payment_type']= 2;
				if($insert_data['level']>=4)
				{
					if($insert_data['level']==4) $expire_date = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
					if($insert_data['level']==5) $expire_date = mktime(0,0,0,date("m"),date("d"),date("Y")+1);
					$insert_data['expire_date'] = date("Y-m-d H:i:s",$expire_date);
				}
				unset($insert_data['email']);
				$this->member_upgrade_model->add($insert_data);
				
				$update_data['level'] 			= $insert_data['level'];
				$update_data['payment_status'] 	= 1;
				$this->member_model->edit($update_data,array("mem_id"=>$insert_data['mem_id']));
				
				$this->session->set_flashdata(array('success_msg' => 'User bitcoin payment subscription added successfully.'));
				redirect('/admin/members/payment');
			}
		}
		
		$this->main_view('members','new_payment_view','members',$data);
	}
	
	
	function email_check()
	{
		$_POST 		= $this->security->xss_clean($_POST);
		$email  	= $_POST['email'];
		$details   	= $this->member_model->get_single_record("email='".$email."' AND type=3 AND status=1  ");
		if($details==NULL)
		{
			$this->form_validation->set_message('email_check', 'Email does not exists, try another.');
			return FALSE;
		}
		else
			$_POST['mem_id'] = $details->mem_id;
	}
	
	function add()
	{
		$this->load->library('form_validation');
		$data['title']   	= 'Add Member';
		if($_POST!=NULL)
		{
			$_POST = $this->security->xss_clean($_POST);
			
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[5]');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[7]');
			$this->form_validation->set_rules('address','Address', 'required');
			$this->form_validation->set_rules('country','Country', 'required');
			$this->form_validation->set_rules('zipcode','Zipcode', 'required');
			if($_POST['level']==3) 
				$this->form_validation->set_rules('level','Membership', 'required');
			else
				$_POST['level'] = '';
			$chk_mail = $this->member_model->get_single_data(" email ='".str_replace("'","\'",$_POST['email'])."' AND status!=2");
			if($chk_mail!=NULL) $this->form_validation->set_rules('email', 'Email', 'is_unique[members.email]');
			$chk_username = $this->member_model->get_single_data(" username ='".str_replace("'","\'",$_POST['username'])."' AND status!=2");
			if($chk_username!=NULL) $this->form_validation->set_rules('username', 'Username', 'is_unique[members.username]');
				
			if($this->form_validation->run() == TRUE)
			{	
				unset($_POST['action']);
				$insert_data = $_POST;
				$insert_data['password'] = md5($insert_data['password']);
				$insert_data['created']	 = date("Y-m-d H:i:s");
				$insert_data['ip']		 = $_SERVER['REMOTE_ADDR'];
				$insert_data['status']	 = 1;
				$mem_id = $this->member_model->add($insert_data);
				
				$array 		= array("1"=>"Raw Media Contributor","2"=>"Editor","3"=>"Subscriber");	
				$type 		= $array[$insert_data['type']];
				//Email
				$link 		= BASE_URL;
				$login_link = '<a href="'.$link.'">here</a>';
				$admin_row  = $this->site_setting_model->get_single_record(1);
				$email_row  = $this->email_template_model->get_single_record(' title = "sign up administrator" ');
				$name 		= $insert_data['firstname']." ".$insert_data['lastname'];
				$username 	= $insert_data['username'];
				$level    	= $insert_data['level'];
				$email 		= $this->input->post('email');
				$password 	= $this->input->post('password');
				$this->email->subject($email_row->subject);
				$this->email->from($admin_row->adm_support_email,$admin_row->adm_name);
				$this->email->to($email);
				$sub_message 	 = $email_row->msg;
				$sub_pattern 	 = array('/{NAME}/','/{EMAIL}/','/{USERNAME}/','/{PASSWORD}/','/{TYPE}/','/{LINK}/','/{SUPPORT_EMAIL}/');
				$sub_replacement = array($name,$email,$username,$password,$type,$login_link,$admin_row->adm_support_email);
				$message 		 = preg_replace($sub_pattern,$sub_replacement,$sub_message);
				$this->email->message($message);
				$this->email->send();	
				
				$this->session->set_flashdata(array('success_msg' => 'User details added successfully.'));
				redirect('/admin/members');
			}
		}
		
		$data['countries'] 	= $this->country_model->combox();
		$this->main_view('members','add_members_view','members',$data);
	}
	
	function edit_member($mem_id)
	{ 
		$this->load->library('form_validation');
		$data['user'] 		= $this->member_model->get_single_data("mem_id=$mem_id");
		if($data['user']=="0")
		{
			$this->session->set_flashdata(array('delete_error' => 'Unable to find user.'));
			redirect('/admin/members');
			exit;
		}
		$data['title']  	= "User : ".$data['user']->firstname." ".$data['user']->lastname;
		
		if($_POST!=NULL)
		{	
			$_POST = $this->security->xss_clean($_POST);
			
			unset($_POST['action']);
			
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[5]');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			if($_POST['password']!= NULL) $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]');
			$this->form_validation->set_rules('address','Address', 'required');
			$this->form_validation->set_rules('country','Country', 'required');
			$this->form_validation->set_rules('zipcode','Zipcode', 'required');
			if($_POST['level']==3) 
				$this->form_validation->set_rules('level','Membership', 'required');
			else
				$_POST['level'] = '';
			
			$chk_mail = $this->member_model->get_single_data(" email ='".str_replace("'","\'",$_POST['email'])."' AND status!=2 AND mem_id!=".$mem_id);
			if($chk_mail!=NULL) $this->form_validation->set_rules('email', 'Email', 'is_unique[members.email]');
			$chk_username = $this->member_model->get_single_data(" username ='".str_replace("'","\'",$_POST['username'])."' AND status!=2 AND mem_id!=".$mem_id);
			if($chk_username!=NULL) $this->form_validation->set_rules('username', 'Username', 'is_unique[members.username]');
				
			if($this->form_validation->run() == TRUE)
			{	
				$update_data = $_POST;		
				if(trim($_POST['password']) != '')
					$update_data['password'] 	=  md5($_POST['password']);
				else
					unset($update_data['password']);
				$this->member_model->edit_member($update_data,$mem_id);
				
				$this->session->set_flashdata(array('success_msg' => 'Member details updated successfully.'));
				redirect('/admin/members/edit_member/'.$mem_id);
			}
		}
		
		$data['countries'] 	= $this->country_model->combox();
		$this->main_view('members','edit_members_view','members',$data);
	}
	
	function delete($mem_id)
	{
		if($mem_id)
		{
			$delete = $this->member_model->close_account_status_closed($mem_id);
			if($delete)
			{
				$this->session->set_flashdata(array('success_msg' => 'Member closed successfully.'));
				redirect('/admin/members');
			}
			else
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete member.'));
				redirect('/admin/members');
			}
		}	
	}
	function change_pay_status($mem_id)
	{
		if($mem_id>0)
		{
			$userdetails = $this->member_model->get_single_data("mem_id=$mem_id");
			if($userdetails=="0")
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to find user.'));
				redirect('admin/members');
				exit;
			}
			
			$this->member_model->change_status($mem_id);
			$this->session->set_flashdata(array('success_msg' => 'Member status changed successfully.'));
			redirect('admin/members');
		}	
		
		$this->session->set_flashdata(array('delete_error' => 'Unable to find user.'));
		redirect('admin/members');
	}
	
	function change_status($mem_id)
	{
		if($mem_id>0)
		{
			$userdetails = $this->member_model->get_single_data("mem_id=$mem_id");
			if($userdetails=="0")
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to find user.'));
				redirect('admin/members');
				exit;
			}
			
			$this->member_model->change_status($mem_id);
			$this->session->set_flashdata(array('success_msg' => 'Member status changed successfully.'));
			redirect('admin/members');
		}	
		
		$this->session->set_flashdata(array('delete_error' => 'Unable to find user.'));
		redirect('admin/members');
	}
	
	function cancel_membership($mem_id)
	{
		if($mem_id>0)
		{
			$userdetails = $this->member_model->get_single_data("mem_id=$mem_id");
			if($userdetails=="0")
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to find user.'));
				redirect('admin/members');
				exit;
			}
			
			$this->member_model->cancel_membership($mem_id);
			$this->session->set_flashdata(array('success_msg' => 'Member level cancelled successfully.'));
			redirect('admin/members');
		}	
		
		$this->session->set_flashdata(array('delete_error' => 'Unable to find user.'));
		redirect('admin/members');
	}
	
	function contents()
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
		$data['countries'] 			= $this->country_model->combox();
		$data['content_details'] = $this->content_model->combox(); 
		$this->main_view('contents','contents/admin_piece_listing_view','contents',$data);
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
				$country_details = $this->country_model->get_single_data("countries","name='".$country."'");
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