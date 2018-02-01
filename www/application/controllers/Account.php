<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$this->load->model('connect_model');
		$this->load->model('content_model');
		$this->load->model('content_ratings_model');
		$this->load->model('country_model');
		$this->load->model('allotment_model');
		$this->load->model('location_model');
		$this->load->model('expertise_model');
		$this->load->model('distribution_model');
		$this->load->model('message_model');
		$this->load->model('state_model');
		$this->load->model('city_model');
		$this->load->model('raw_media_model');
		$this->user_id = $this->user->getUserID();	
	}
	
	function profile($user_id)
	{
		$data['member_details'] = $this->user_model->get_single_record("id='".$user_id."'");
		if($data['member_details']=="0" || empty($user_id))
		{
			$this->session->set_flashdata(array('error_msg' => 'Invalid profile request'));
			redirect('home');
			exit;
		}
		$data['total_earnings'] = $this->distribution_model->getTotalEarnings($user_id);
		$rating_result = $this->content_ratings_model->custom_query("select count(R.rating_id) as count from content_ratings as R, contents as C where C.content_id=R.content_id and C.editor=".$user_id);
		$data['total_ratings'] = $rating_result[0]->count;
		
		$this->main_view('account/profile_view',$data);
	}
	
	
	function stories() {
		$data['content_details'] 	= $this->content_model->combox("*","editor='".$this->user_id."' ORDER BY content_id DESC");
		$this->main_view('account/stories_view',$data);
			
	}

	function ratings() {
	
		$this->db->select('*');
		$this->db->from('content_ratings');
		$this->db->join('contents', 'content_ratings.content_id = contents.content_id', 'left');
		$this->db->where('content_ratings.rating_by', $this->user_id);

		$query = $this->db->get();
		$data['ratings_details'] = $query->result();
		
		$this->main_view('account/ratings_view',$data);
			
	}
	
	
	function earnings() {
	
		$this->db->select('*');
		$this->db->from('distribution');
		$this->db->join('contents', 'distribution.content_id = contents.content_id', 'left');
		$this->db->join('content_ratings', 'distribution.rating_id = content_ratings.rating_id', 'left');
		$this->db->where('distribution.contributor_id', $this->user_id);
		$query = $this->db->get();
		$data['earnings_details'] = $query->result();
		
		$this->main_view('account/earnings_view',$data);
		
	}

	function locations() {
		
		if (isset($_GET['action']) && $_GET['action']=='delete') {
			
			if (isset($_GET['id']))	$id = (int) $_GET['id'];
			
			// make sure this belongs to user before deleting
			$location = $this->location_model->get_single_record("location_id='".$id."'");
			
			if ($location->user_id == $this->user->getUserID()) {
				$deleted = $this->location_model->delete('location_id',$id);
				if (empty($deleted)) {
					$this->session->set_flashdata(array('delete_error'=>'Error deleting Location.'));
				} else {
					$this->session->set_flashdata(array('success_msg'=>'Location deleted successfully.'));
				}
			} else {
				$this->session->set_flashdata(array('delete_error'=>'Sorry, you are not allowed to do that.'));
			}
			
		}
		
		
		if($_POST!=NULL)
		{
		
			$_POST = $this->security->xss_clean($_POST);
			
			$insert = array('user_id'=>$this->user->getUserID());
			if (!empty($_POST['city'])) $insert['city'] = $_POST['city'];
			if (!empty($_POST['state'])) $insert['state'] = $_POST['state'];
			if (!empty($_POST['country'])) $insert['country'] = $_POST['country'];
				
			
			$results = $this->location_model->add($insert);
			if (empty($results)) {
				$this->session->set_flashdata(array('delete_error'=>'Saving location failed.'));
			} else {
				$this->session->set_flashdata(array('success_msg'=>'Location added successfully.'));
			}
		
			
		}
	
		$data['location_details'] = $this->location_model->combox("*","user_id='".$this->user_id."' ORDER BY location_id DESC");
		
		$this->main_view('account/location_view',$data);
		
	}
	
	
	function connections() {
	
 		$data['connect_data'] = $this->connect_model->combox("*","(from_id='".$this->user_id."' || to_id='".$this->user_id."')");
	
//		$data['connect_data'] = $this->user->getConnections();
		$data['user_id']= $this->user_id;
		$this->main_view('account/connections_view',$data);
			
	}
	
	function messages() {

		
		$data['message_data'] = $this->message_model->combox("*","(from_id='".$this->user_id."' || to_id='".$this->user_id."')");
		
		$data['user_id']= $this->user_id;
		$this->main_view('account/messages_view',$data);
			
	}
	
	
	function raw() {
	
		$data['raw_list'] = $this->raw_media_model->combox("*","contributor_id='".$this->user_id."' ORDER BY raw_id DESC");
		
		$this->main_view('account/raw_view',$data);
			
	}
	
	
	
	function index()
	{
		
		$data['title']  = 'Account information';
		$data['email']  = ''; if(!empty($_GET['em'])) $data['email'] = $_GET['em'];

		
		//$data['member_details'] = $this->member_model->get_single_record("mem_id='".$this->mem_id."'");
		$user_data = $this->user->getUserData();
		$data['member_details']= (object) $user_data;
		
		$data['location_details'] = $this->location_model->combox("*","user_id='".$this->user_id."' ORDER BY location_id DESC");
		
		$data['countries'] 	= $this->country_model->combox();

		
		
		
		if($_POST!=NULL)
		{

			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('type[]', 'type', 'required');
			
			$this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
//			if($data['member_details']->type==2) $this->form_validation->set_rules('folio_link','Folio link', 'required|callback_valid_url_format');
/*
			if($data['member_details']->type!=3)
			{
				$this->form_validation->set_rules('experience','experience', 'required');
				$this->form_validation->set_rules('expertise','expertise', 'required');
			}
 */
		//	if($data['member_details']->type==1) $this->form_validation->set_rules('contribute_bit_address', 'Raw media contributor bitcoin wallet address','required|callback_bitcoinaddress_check');	
		//	if($data['member_details']->type==2) $this->form_validation->set_rules('editor_bit_address', 'Editor bitcoin wallet address','required|callback_bitcoinaddress_check');	
			if(trim($_POST['password'])!='') $this->form_validation->set_rules('password', 'Password', 'min_length[7]');
			if($this->form_validation->run() == TRUE)
			{ 
				if(trim($_POST['password'])!='')  $_POST['password'] = md5($_POST['password']); else unset($_POST['password']);
			/*
				if($_FILES['picture']['name']!=NULL)
				{
					$_FILES['userfile'] = $_FILES['picture']; unset($_FILES['picture']);
					$image_details = $this->member_model->do_upload($_FILES);
					if($image_details!=NULL){
						$this->member_model->unlink_img($data['member_details']->picture);
						$_POST['picture'] = $image_details['upload_data']['file_name'];
					}
				}
				
				*/
				
				$fs= explode('/',$_POST['picture']);
				$filename = array_pop($fs);
				$insert_data['picture'] = $filename;
				
				
				
				/*if($_FILES)
				{
					if($_FILES['picture']['name']!='')
					{	
						$ext = end(explode(".",$_FILES['picture']['name']));
						$name = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).time().time().rand(0,9).rand(0,9).rand(0,9).rand(0,9).".".$ext;
						$target_path = getcwd().'/media/uploads/members/'.$name;
						if(move_uploaded_file($_FILES['picture']['tmp_name'],$target_path))
						{
							
							if($data['member_details']->picture!='' && file_exists(getcwd().'/media/uploads/members/'.$data['member_details']->picture))
								unlink(getcwd().'/media/uploads/members/'.$data['member_details']->picture);
							$_POST['picture'] = $name;
						}
					}
				}*/
				
				$update_data = $_POST;
				/*
				$this->member_model->edit($update_data,array("mem_id"=>$this->mem_id));
				
				if (isset($update_data['contribute_bit_address'])) {
					
					$update_data['bit_address'] = $update_data['contribute_bit_address'];
					unset($update_data['contribute_bit_address']);
					
				}
				*/

				
				$expertise = explode(',',$_POST['expertise']);
				
				foreach ($expertise as $e) {
					$e = $this->security->xss_clean($e);
					
					$this->expertise_model->add($e);
				
				}
				
				
				
				$type = $_POST['type'];
								
				unset($update_data['type']);
				$s = $e = $r = 0;
				
				foreach ($type as $t) {	
					if ($t=='subscriber') $s = 1;
					if ($t=='raw') $r = 1;
					if ($t=='editor') $e = 1;
				}

				$update_data['type'] = $e.$r.$s;
				
				// new uswer object
				$results = $this->user->updateUserData($update_data);
				if ($results['error']) {
					$this->session->set_flashdata(array('delete_error'=>'Saving account information failed.'));		
				} else {
					$this->session->set_flashdata(array('success_msg'=>'Account information has updated successfully.'));
				}
				redirect('account');			
				exit;
			}
		}
		
	    $where = "AND story_date Like '".date("Y-m")."%'";
		$data['content_details'] 	= $this->content_model->combox("*","editor='".$this->user_id."' $where  ORDER BY content_id DESC"); 
		$data['connect_data'] = $this->connect_model->combox("*","(from_id='".$this->user_id."' || to_id='".$this->user_id."')");
			$data['raw_details'] = $this->raw_media_model->combox("*","contributor_id='".$this->user_id."' AND date Like '".date("Y-m")."%' ORDER BY raw_id DESC");
			$data['connect_data'] = $this->connect_model->combox("*","(from_id='".$this->user_id."' || to_id='".$this->user_id."')");
		
		$this->main_view('account/index_view',$data);
	}
	
	function valid_url_format()
	 {
	 	$_POST = $this->security->xss_clean($_POST);
        $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $_POST['folio_link'])){
            $this->form_validation->set_message('valid_url_format', 'The folio link you entered is not correctly formatted.');
            return FALSE;
        }
        return TRUE;
    }
	
	function username_check()
	{
		$_POST 		= $this->security->xss_clean($_POST);
		$username  	= $_POST['username'];
		$details   	= $this->user_model->get_single_record(" id!='".$this->user_id."' AND username='".$username."' AND status!=2  ");
		if($details!=NULL)
		{
			$this->form_validation->set_message('username_check', 'Username already exists, try another.');
			return FALSE;
		}
		return TRUE;
	}
	
	function email_check()
	{
		$_POST 		= $this->security->xss_clean($_POST);
		$email  	= $_POST['email'];
		$details   	= $this->user_model->get_single_record(" id!='".$this->user_id."' AND email='".$email."' AND status!=2  ");
		if($details!=NULL)
		{
			$this->form_validation->set_message('email_check', 'Email already exists, try another.');
			return FALSE;
		}
		return TRUE;
	}
	
	
	function bitcoinaddress_check()
	{
		if($_SERVER['HTTP_HOST']=="localhost" ||  $_SERVER['HTTP_HOST']=="192.168.1.6") return TRUE;
		$_POST 		= $this->security->xss_clean($_POST);
		$address 	= '';
		if($_POST['type']==1)  $address = $_POST['contribute_bit_address'];
		if($_POST['type']==2)  $address = $_POST['editor_bit_address'];
		if($address!='') 
		{
			$isvalid = $this->member_model->checkAddress($address);
			if(!$isvalid) 
			{
				$this->form_validation->set_message('bitcoinaddress_check', 'Bitcoin address not valid, try another.');
				return FALSE;
			}
		}
		return TRUE;
	}
	function add_connect()
	{
		$data['title']  = 'Connect information';
		$mem_id 	= (int) $_POST['mem_id'];
		$request_type = (int) $_POST['request_type'];
		if($mem_id>0)
		{
			$member_details = $this->member_model->get_single_record("mem_id='".$mem_id."'");
			if($member_details!=NULL)
			{
				//Insert
				$insert ['from_id'] 	= $this->mem_id;
				$insert ['to_id'] 	= $mem_id;
 				$insert ['date'] = date("Y-m-d H:i:s");
				$array = array("1"=>"Contributor-Editor","2"=>"Editor-Contributor");	
				$insert['request_type']= $request_type; 		
				$insert = $this->security->xss_clean($insert);				
 				$this->connect_model->add($insert);				
 				$this->session->set_flashdata(array('success_msg' => 'Connect request send  successfully.'));
				exit;
			}
		}		
	}
	
	/*
	function connections()
	{   
		$data='';
		$post_data 	= $this->input->post(NULL, TRUE);
		$data['connect_data'] = $this->connect_model->combox("*","(to_id='".$this->user_id."' OR from_id='".$this->user_id."')");
		$this->main_view('pages/request_view',$data); 
	}
	*/
	
	function request_status($conn_id,$status)
	{   
		$connect_details = $this->connect_model->get_single_record("conn_id='".$conn_id."' AND to_id='".$this->user_id."'");
		if($connect_details!=NULL)
		{
			$update_data['status'] = $status;
			$this->connect_model->edit($update_data,array("conn_id"=>$conn_id));
			if($status==1)
				$this->session->set_flashdata(array('success_msg' => 'Request accepted successfully.'));
			else
				$this->session->set_flashdata(array('delete_error' => 'Request rejected.'));
		}
		else
			$this->session->set_flashdata(array('delete_error' => 'Invalid request.'));
		
		redirect('account');
	}
	
	function request_delete($conn_id='')
	{   
		$connect_details = $this->connect_model->get_single_record("conn_id='".$conn_id."' AND (to_id='".$this->user_id."' OR from_id='".$this->user_id."')");
		if($connect_details!=NULL)
		{
			$this->connect_model->delete("conn_id",$conn_id);
			$this->session->set_flashdata(array('success_msg' => 'Connection removed successfully.'));
		}
		else
			$this->session->set_flashdata(array('delete_error' => 'Invalid request.'));
		redirect('account');
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
				$country_details = $this->country_model->get_single_data("countries","name='".$country."' OR code='".$country."'");
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