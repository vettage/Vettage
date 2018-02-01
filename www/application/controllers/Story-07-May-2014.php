<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Story extends \MY_Frontcontroller 
{

	function __construct()
	{
		parent::__construct();
		
		/*if($this->session->userdata('fv_logged_in') != FALSE)
		{
			$this->type = $this->session->userdata('type');	
			if($this->type!=3){
				redirect('');			
				exit;
			}		
		}*/
		$this->load->model('content_model');
		$this->load->model('content_ratings_model');
		$this->load->model('member_model');
		$this->load->model('raw_media_model');
		$this->load->model('country_model');
 		$this->user_id 	= $this->session->userdata('user_id');	
		$this->mem_id 	= $this->session->userdata('mem_id');	
		$this->type 	= $this->session->userdata('type');	
		//$this->index($this->uri->segment(2));
	}
	
	function index()
	{
		redirect('subscribers/search');		
	}
	
	function details()
	{
		if($this->session->userdata('fv_logged_in') == FALSE)
		{
			 $this->session->set_flashdata(array('error_msg' => 'Access denied'));
				redirect('');
				exit;	
		}
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['key']) && $_GET['key']!="")
			{
				$story_details = $this->content_model->get_single_record("content_key='".$_GET['key']."'");
				if($story_details==NULL)
				{
					redirect('subscribers/search');			
					exit;
				}
			}
		}
		else
		{
			redirect('subscribers/search');			
			exit;
		}
		$rating_details = $this->content_ratings_model->get_single_record("rating_by='".$this->mem_id."' AND content_id='".$story_details->content_id."' ");
		
		if($this->session->userdata('level')==1) {			
           $user_details = $this->member_model->get_single_record("mem_id='".$this->mem_id."'");
		   $explod=explode('#',$user_details->stroy_view_count);
		   if(empty($explod[0])) $explod[0]=0;if(empty($explod[1])) $explod[1]='';
		   if( $explod[0]==0){
			   $update_data['stroy_view_count'] = '1'.'#'.$story_details->content_id;
				$this->member_model->edit($update_data,array("mem_id"=>$this->mem_id));
		   }
		  else if( $explod[0]==1 && $explod[1]==$story_details->content_id){
			   //
		   }
		   else{			    
				if($this->session->userdata('level')==2)
				{
					$data['title'] 	 = 'Story: '.$story_details->title;
					$data['bitwall'] = 'bitwall';
					$this->main_view('pages/subscribers/all_stories_view',$data);exit;
				}
				else
				{
					$this->session->set_flashdata(array('error_msg' => 'You can view only one story per month.'));
					redirect('');
					exit;
				}
		   }
		}
		
		
		if($this->session->userdata('level')==2 || $this->session->userdata('level')==3) 
		{
			
				$upgrade_date = $this->session->userdata('level_date');
				$where_ratings = '';if($upgrade_date!='' && $upgrade_date!='0000-00-00 00:00:00') $where_ratings = "AND rating_date>='".$upgrade_date."'";
				$rating_check_details = $this->content_ratings_model->custom_query("SELECT rating_id,content_id from content_ratings WHERE rating_by='".$this->mem_id."' $where_ratings");
				if($rating_check_details!=NULL) 
				{
					$content_key = !empty($_GET['key']) ? $_GET['key'] : '';
					$id = $rating_check_details[0]->content_id;
					$cnt_data = $this->content_model->custom_query("SELECT content_key from contents WHERE content_id=".$id);					
					$compare_key = $cnt_data[0]->content_key;
					if($content_key != $compare_key)
					{						
						if($this->session->userdata('level')==2)
						{
							$data['title'] 	 = 'Story: '.$story_details->title;							
							$data['description'] 	= 'Story: '.$story_details->title;
							$data['story_details'] 	= $story_details;
							$data['rating_details'] = $rating_details;
							$data['editor_details'] = $this->member_model->get_single_record("mem_id='".$story_details->editor."'");
							$data['bitwall'] = 'bitwall';
							$this->main_view('pages/story_details_view',$data);
						}
						else
						{
							$this->session->set_flashdata(array('success_msg' => 'You not able to rate new story..'));
							redirect('subscribers/rating');
						}
					}
					else
					{
						$this->session->set_flashdata(array('success_msg' => 'You not able to rate new story..'));
						redirect('subscribers/rating');
					}
				}						
		}
		
		if($_POST)
		{   
			$insert_data = $this->security->xss_clean($_POST);
			if($rating_details==NULL)
			{	
				$total = 
				$insert_data['rating_by'] 	= $this->mem_id;
				
				$insert_data['rating_by'] 	= $this->mem_id;
				$insert_data['content_id'] 	= $story_details->content_id;
				$insert_data['rating_date'] = date("Y-m-d H:i:s");
				$insert_data['rating_ip'] 	= $_SERVER['REMOTE_ADDR'];
				$this->content_ratings_model->add($insert_data);
				$this->session->set_flashdata(array('success_msg' => 'Ratings submitted successfully.'));
			}
			else
				$this->session->set_flashdata(array('error_msg' => 'Ratings already submitted'));
			redirect('story/details?key='.$_GET['key']);		
		}
		
		$data['title'] 		 	= 'Story: '.$story_details->title;
		$data['description'] 	= 'Story: '.$story_details->title;
		$data['story_details'] 	= $story_details;
		$data['rating_details'] = $rating_details;
		$data['editor_details'] = $this->member_model->get_single_record("mem_id='".$story_details->editor."'");
 		$this->main_view('pages/story_details_view',$data);
	}
	
	function getembedcode($content_key)
	{	
		$story_details = $this->content_model->get_single_record("content_key='".$content_key."'");
		echo $story_details->embed_code_link;
	}	
}
	
?>