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
		$this->load->model('user_model','user_model');
		$this->load->model('raw_media_model');
		$this->load->model('country_model');
		$this->load->model('distribution_model');
		$this->MY_Media = new \MY_Media();
 		$this->user_id 	= $this->user->getUserID();;	
	}
	
	function index($story = null)
	{
		
		if ($story == null) {
			redirect('/subscribers/search');
			exit;
		} else {
			$story = $this->security->xss_clean($story);
			if(!empty($story))
			{
				$story_details = $this->content_model->get_single_record("alias='".$story."'");
				if($story_details==NULL)
				{
					$this->session->set_flashdata(array('error_msg' => 'Problem loading story, s101'));
					redirect('/subscribers/search');
					exit;
				}
			}
		}
		
		$this->details($story_details);
		
	}
	
	
	function details($details = NULL)
	{
		
		
		if($_GET)
		{
			$_GET = $this->security->xss_clean($_GET);
			if(!empty($_GET['key']) && $_GET['key']!="")
			{
				$story_details = $this->content_model->get_single_record("content_key='".$_GET['key']."'");
				if($story_details==NULL)
				{
					redirect('/subscribers/search');
					exit;
				}
			}
		}
		elseif ($details==NULL)
		{
			$this->session->set_flashdata(array('error_msg' => 'Problem loading story, s102'));
			redirect('/subscribers/search');
			exit;
		} else {
			$story_details = $details;	
		}

		$rating_details = $this->content_ratings_model->get_single_record("rating_by='".$this->user_id."' AND content_id='".$story_details->content_id."' ");
		
		$story_rating = $this->content_model->custom_query("SELECT AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance)
				as percent  FROM contents LEFT JOIN content_ratings ON contents.content_id=content_ratings.content_id WHERE contents.content_id=".$story_details->content_id);
		
		$story_rating = ($story_rating[0]->percent * 100) / 40;
		if (empty($story_rating)) $story_rating = 'Not yet rated.';
			else $story_rating = round($story_rating,2).'%';

			
		$contributors = $this->content_model->custom_query("select contributor_id from allotment where content_id=".$story_details->content_id);
		
		$conts= array();
		$ids= array();
		foreach ($contributors as $cont) {
			if (empty($cont->contributor_id) || $cont->contributor_id==0) continue;
			
			if (!in_array($cont->contributor_id,$ids)) {
				$ids[]= $cont->contributor_id;
				$contributor = $this->user_model->get_single_record("id=".$cont->contributor_id);
				
				$this_money = $this->distribution_model->custom_query("select sum(amount) as amount from distribution where contributor_id=".$cont->contributor_id." and content_id=".$story_details->content_id);
				$all_money = $this->distribution_model->custom_query("select sum(amount) as amount from distribution where contributor_id=".$cont->contributor_id);
					
				
				$tmp = (array) $contributor;
	
				$tmp['this_money'] = ($this_money[0]->amount)?$this_money[0]->amount:0;
				$tmp['all_money'] = ($all_money[0]->amount)?$this_money[0]->amount:0;
	
				$conts[] = $tmp;
			}
			
		}
		
		
		$editor = $this->user_model->get_single_record("id='".$story_details->editor."'");
		
	
		$this_money = $this->distribution_model->custom_query("select sum(amount) as amount from distribution where contributor_id=".$editor->id." and content_id=".$story_details->content_id);
		$all_money = $this->distribution_model->custom_query("select sum(amount) as amount from distribution where contributor_id=".$editor->id);

		$editor = (array) $editor;
	
		$editor['this_money'] = ($this_money[0]->amount)?$this_money[0]->amount:0;
		$editor['all_money'] = ($all_money[0]->amount)?$this_money[0]->amount:0;
		
		
			
		// TODO: handle actual views/ view counts
		// and access
  
		/*
		
				$upgrade_date = $this->session->userdata('level_date');
				$where_ratings = '';if($upgrade_date!='' && $upgrade_date!='0000-00-00 00:00:00') $where_ratings = "AND rating_date>='".$upgrade_date."'";
				$rating_check_details = $this->content_ratings_model->custom_query("SELECT rating_id,content_id from content_ratings WHERE rating_by='".$this->user_id."' $where_ratings");
					$content_key = !empty($_GET['key']) ? $_GET['key'] : '';
					if ($rating_check_details) {
					$id = $rating_check_details[0]->content_id;
					$cnt_data = $this->content_model->custom_query("SELECT content_key from contents WHERE content_id=".$id);
					}
					//$compare_key = $cnt_data[0]->content_key;
							$data['title'] 	 = 'Story: '.$story_details->title;
							$data['description'] 	= 'Story: '.$story_details->title;
							$data['story_details'] 	= $story_details;
							$data['rating_details'] = $rating_details;
							$data['editor_details'] = $this->user_model->get_single_record("id='".$story_details->editor."'");
								
							//$data['bitwall'] = 'bitwall';
							$this->main_view('pages/story_details_view',$data);

		*/
		if($_POST)
		{   
			$insert_data = $this->security->xss_clean($_POST);
			if($rating_details==NULL)
			{	
				
				$insert_data['rating_by'] 	= $this->user_id;
				
				$insert_data['rating_by'] 	= $this->user_id;
				$insert_data['content_id'] 	= $story_details->content_id;
				$insert_data['rating_date'] = date("Y-m-d H:i:s");
				$insert_data['rating_ip'] 	= $_SERVER['REMOTE_ADDR'];
				$rating_id = $this->content_ratings_model->add($insert_data);

				// assuming the above saves correctly (try catch, etc)
				
				// decrease the user ratings count
				if (!$this->user->useRating()) {
					
					throw new Exception('Log me!');
					
				}
				
				// calculate distribution and save
				$this->distribution_model->distribute($story_details->content_id,$rating_id);
				
				$this->session->set_flashdata(array('success_msg' => 'Ratings submitted successfully.'));
				redirect('story/'.$story_details->alias);
				exit();
			}
			else {
				$this->session->set_flashdata(array('error_msg' => 'Ratings already submitted'));
				redirect('story/'.$story_details->alias);
				exit();
			}
		}
		$data['title'] 		 	= 'Story: '.$story_details->title;
		$data['description'] 	= 'Story: '.$story_details->title;
		$data['story_details'] 	= $story_details;
		$data['story_rating'] = $story_rating;
		
		$data['can_rate']= $this->user->getUserData('available_ratings');
		
		
		// TODO
		$this->MY_Media->loadStory($story_details);
		
		// decide what it is and prep for render here?

		$data['embed_type'] = $story_details->type; 
		$data['editor_details'] = $editor;
		
		if (!$data['valid_embed']= $this->MY_Media->getValidEmbed()) {
			$this->session->set_flashdata(array('error_msg' => 'Problem loading video, e101'));
		}		
		
		$data['rating_details'] = $rating_details;
		$data['contributors'] = $conts;
		if (!empty($this->user_id)) $this->main_view('pages/story_details_view',$data);
			else $this->main_view('pages/story_details_view_anon',$data);
	}
	
	function getembedcode($content_key)
	{	
		$story_details = $this->content_model->get_single_record("content_key='".$content_key."'");
		echo $story_details->embed_code_link;
	}	
}
	
?>