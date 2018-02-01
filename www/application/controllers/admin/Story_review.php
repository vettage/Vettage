<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Story_review extends admin_template{  
		
	function __construct()
	{
		parent::__construct();
 		$this->load->model('content_model');
		$this->load->model('content_ratings_model');
  	}
	
	function index()
    {
		$data['title']  = 'Stories Reviews';
		$data['description'] = '';
		
		$data['story_data'] = $this->content_model->custom_query("SELECT contents.*, AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) as percent
		FROM contents LEFT JOIN content_ratings ON contents.content_id=content_ratings.content_id WHERE story_date Like '".date("Y-m")."%' AND status=1 
		GROUP BY contents.content_id ORDER BY AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) DESC");
		//$data['story_data'] = $this->content_model->combox("*"," story_date Like '".date("Y-m")."%' AND status=1 ORDER BY content_id DESC");
		 
		$this->main_view('contents','story_listing_view','contents',$data);
	}
 	 
}
?>