<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends \MY_Frontcontroller {  

	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('site_setting_model');
		$this->load->model('message_model');
		$this->load->model('content_model');
		$this->load->model('expertise_model');
		$this->load->model('user_model');
		$this->email =  new \MY_Mailer();
		$this->user_id = $this->user->getUserID();;
		$this->items_per_page =5; 
	}

	function expertise() {
		
		$term = $this->security->xss_clean($_GET['term']);
		
		
		$results = $this->expertise_model->fetch_likes($term);
		
		echo json_encode($results);
		
	}


	function search() {
	
		$terms = $this->security->xss_clean($_GET);
	
		$results = $this->content_model->search($terms);
		
		$tosend = array();
		foreach($results as $result) {
			$tosend[] = (array) $result;
		}
			
		
		echo json_encode($tosend);
	
	}
	
	
	function add_check()
    {
		//$update_data['not_to_see_ad'] = $_POST['check_val'];
		//$user_id = $this->session->userdata('user_id');
		//$this->user_model->edit($update_data,$user_id);
		$message = 'success';
		$this->session->set_userdata(array('ad_ahow' => '0'));
		echo $message;
    }	
	
	function newsletter_contact()
	{
		$_POST 		= $this->security->xss_clean($_POST);
		$email = $_POST['email'];
		$status = $this->validate_email($email);
		if($status=='valid')
		{	
			$newsletter_data = $this->newsletter_contact_model->get_single_record("email='".$email."'");
			$user_data = $this->user_model->get_single_record("email='".$email."'");
			
			if(empty($newsletter_data) && empty($user_data))
			{
				$insert_data['email'] = $email;
				$insert_data['request_date'] = date('Y-m-d H:i:s');
				$insert_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
				$this->newsletter_contact_model->add($insert_data);
				$answer = "Thank you! Newsletter request added successfully ";
			}
			else
				$answer = "Already subscribed";
		}
		else
			$answer = "Invalid email";
		echo $answer;
	}
	
	function validate_email($email)
	{
		$user_email = $email;		

		$chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{1,6}\$/i";

		$description ='valid';
		
		if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false) {
		$cnt = substr_count($user_email, ' ');
		if(($cnt == 0) && (preg_match($chars, $user_email)))
		{
			
			return $description;
			}  else {
				$description = "invalid"; 
				return $description;
			}

		} else {
			$description = "invalid"; 
			return $description;
		}
	}
	
	function get_currency_value()
	{
		$price 		= 0;
		$_POST 		= $this->security->xss_clean($_POST);
		$table 		= $_POST['table_name'];
		$coin_value = $_POST['coin_value'];
		$details	= $this->orders_model->custom_query("SELECT price FROM $table order by order_id desc limit 0,1");
		if(!empty($details[0]->price))
			$price = $details[0]->price;
		else
		{
			$str   = strtoupper(str_replace(array("bit_orders_","_backup"),array("",""),$table));
			$name  = substr($str,0,3)."/".substr($str,3,3);
			$details = $this->orders_model->custom_query("SELECT trading_id FROM bit_tradings WHERE name='".$name."'");
			if(!empty($details[0]->trading_id))
			{
				$data = $this->orders_model->custom_query("SELECT buy_price FROM bit_trading_values WHERE trading_id='".$details[0]->trading_id                ."'");
				if(!empty($data[0]->buy_price)) $price  = $data[0]->buy_price;
			}
			else
				$price = 0;
		}
		$price = $price * $coin_value;
		echo $price;
	}
			
	function send_msg()
	{
		
		
		$errmessage = '';
		$id 	= (int) $_POST['mem_id'];
		$message 	= $_POST['message'];
		if($id>0)
		{
			$member_details = $this->user_model->get_single_record("id='".$id."'");
			if($member_details!=NULL)
			{
				//Insert
				$insert_message['from_id'] 	= $this->user_id;
				$insert_message['to_id'] 	= $id;
				$insert_message['message'] 	= $message;
				$insert_message['date'] 		= date("Y-m-d H:i:s");
				$insert_message['ipaddress'] = $_SERVER['REMOTE_ADDR'];
				$insert_message = $this->security->xss_clean($insert_message);
				$this->message_model->add($insert_message);
				
				//email
				
				$email = $member_details->email;
				$username = $this->user->getUserData('username');	
				$type = $this->session->userdata('type');	
				$admin_row  = $this->site_setting_model->get_single_record(1);
				$this->email->subject("Message from ".$username." ".$type);
				$this->email->from($admin_row->adm_info_email,SITE_TITLE);
				$this->email->to($email);
				$this->email->message(nl2br($message));
				$this->email->send();	
				
				echo "Message sent successfully";
				exit;
			}
		}
		echo "Error while message send";
		exit;
	}

}
?>