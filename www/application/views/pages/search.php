<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends \MY_Frontcontroller 
{
 
	function __construct()
	{
		parent::__construct();
		
  		$this->type = $this->session->userdata('type');	
		if($this->type!=3){
			redirect('');			
			exit;
		}		
		$this->load->model('content_model');
		$this->load->model('member_model');
		$this->load->model('connect_model');
		$this->load->model('raw_media_model');
		$this->load->model('country_model');
		$this->load->model('allotment_model');
		
 		$this->user_id 	= $this->session->userdata('user_id');	
		$this->mem_id = $this->session->userdata('mem_id');	
		$this->level = $this->session->userdata('level');	
		//$this->index($this->uri->segment(2));
	}
	
	function index()
	{
		$data['title'] 		 = 'STORY SEARCH';
		$data['description'] = ''; 
		$data['source_data'] = NULL; 
		$data['member_requests'] = $this->member_model->combox("*","mem_id!='".$this->mem_id."'");
  		if($_GET)
		{ 
			$where = "AND status=1 ";			
			$_GET = $this->security->xss_clean($_GET);
			
			$searchtypes = '';
			if(!empty($_GET['searchtypes']) && $_GET['searchtypes']!='')
				$searchtypes = ",".implode(",",$_GET['searchtypes']).",";
			
			if(!empty($_GET['username']) && $_GET['username']!='')
			{	
				$story_ids=',';
				//if(strpos($searchtypes,",Editor,")!==false)
				//{
					echo "SELECT content_id FROM contents LEFT JOIN members ON contents.editor=members.mem_id WHERE story_date 
					Like '".date("Y-m")."%' AND username='%".$_GET['username']."%' ORDER BY content_id DESC";exit;
					$stories = $this->content_model->custom_query("SELECT content_id FROM contents LEFT JOIN members ON contents.editor=members.mem_id WHERE story_date 
					Like '".date("Y-m")."%' AND username='%".$_GET['username']."%' ORDER BY content_id DESC");
					foreach($stories as $row) $story_ids.=$row->content_id.',';
				//}
				if(strpos($searchtypes,",Contributor,")!==false)
				{
					$stories = $this->content_model->custom_query("SELECT allotment.content_id FROM allotment LEFT JOIN members ON allotment.contributor_id=members.mem_id 
					LEFT JOIN contents ON allotment.content_id=contents.content_id WHERE story_date 
					Like '".date("Y-m")."%' AND username='%".$_GET['username']."%' ORDER BY content_id DESC");
					foreach($stories as $row) 
					{
						if(strpos($story_ids,",".$row->content_id.",")===false) $story_ids.=$row->content_id.',';
					}
				}
				//$where.= ' AND username like "%'.$_GET['username'].'%" ';
				$story_ids = trim($story_ids,",");
				if($story_ids!='')
					$where.= " AND contents.content_id IN($story_ids)";
				else
					$where.= " AND contents.content_id IN('')";
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
				$where.= " AND postal_code LIKE '%".$_GET['zipcode']."%' ";
			}
			if(!empty($_GET['tags']) && $_GET['tags']!='')
			{
				$explode_array = explode(",",$_GET['tags']);
				$where.= " AND ( ";
	            for($i=0;$i<sizeof($explode_array);$i++) 	
				{
					$where.=  " tags LIKE '".$explode_array[$i]."%' "; 
					if($i!=(sizeof($explode_array)-1)) {
						$where.=  " OR ";
					}
				}
				$where.= " ) ";
			}
			if(!empty($_GET['date']) && $_GET['date']!='')
			{
				$explode = explode("/",$_GET['date']);
				if(sizeof($explode)==3)
				{
					$date = $explode[0]."-".$explode[1]."-".$explode[2];
					$where.= " AND story_date LIKE '".$date."%' ";
				}
			}
			if(!empty($_GET['tags']) && $_GET['tags']!='')
			{
				$explode_array = explode(",",$_GET['tags']);
				$where.= " AND ( ";
	            for($i=0;$i<sizeof($explode_array);$i++) 	
				{
					$where.=  " tags LIKE '".$explode_array[$i]."%' "; 
					if($i!=(sizeof($explode_array)-1)) {
						$where.=  " OR ";
					}
				}//echo $where;exit;
				$where.= " ) ";
			}
			if(!empty($_GET['searchtypes']) && $_GET['searchtypes']!='')
			{
				$type_array = $_GET['searchtypes'];
				//$where.= " AND ( ";
				$searchtypestring = '';
				for($i=0;$i<sizeof($type_array);$i++)
				{
					if($type_array[$i] != 'Contributor' && $type_array[$i] != 'Editor')
					{
						$searchtypestring.=  " types LIKE '".$type_array[$i]."%' ";
						if($i!=(sizeof($type_array)-1)) {
							$searchtypestring.=  " OR ";
						}
					}
				}
				
				if($searchtypestring!='') $where.= " AND ($searchtypestring) ";
				//$where.= " ) ";
			}
			
			/*echo "SELECT  contents.*,AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) 
			as percent  FROM contents LEFT JOIN content_ratings ON contents.content_id=content_ratings.content_id WHERE story_date 
			Like '".date("Y-m")."%' $where GROUP BY contents.content_id ORDER BY AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) DESC";exit;
			*/
			$data['story_data'] = $this->content_model->custom_query("SELECT  contents.*,AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) 
			as percent  FROM contents LEFT JOIN content_ratings ON contents.content_id=content_ratings.content_id WHERE story_date 
			Like '".date("Y-m")."%' $where GROUP BY contents.content_id ORDER BY AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) DESC");	
			$this->main_view('pages/subscribers/all_stories_view',$data);
		} 
		else
		{
  			$data['countries'] 	= $this->country_model->combox();		
  			$this->main_view('pages/subscribers/search_source_view',$data);
		}
		//$this->index($this->uri->segment(2));
	}
	
	
	function source()
	{	
	    $data['title']		 = '';
 		$data['description'] = '';
 		$post_data = $this->input->post(NULL, TRUE);
		
		$data['story_data']  = $this->content_model->combox('*',"featured=1 ORDER BY content_id DESC LIMIT 0,1");
		$this->main_view('pages/subscribers/story_view',$data);	
		//$this->index($this->uri->segment(2));
	}
	
	function assign_story($mem_id=NULL)
	{	
		/*if($this->level!=5) 
		{
			redirect('subscribers/search');			
			exit;
		}*/
		$data['title'] 		 = 'CONNECT';
		$data['description'] = ''; 
		$data['member_requests'] = $this->member_model->combox("*","mem_id ='".$mem_id."'");
		if($_GET)
		{ 
			$where = "mem_id!=''";
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
				}+
				$where.= " ) ";
			}
			
			if(!empty($_GET['interests']) && $_GET['interests']!='')
			{
				$where.= " AND interests LIKE '%".$_GET['interests']."%' ";
			}
				if(!empty($_GET['experience']) && !empty($_GET['country']) && !empty($_GET['city']) && 
				!empty($_GET['state']) && !empty($_GET['zipcode']) && !empty($_GET['keywords']) && !empty($_GET['interests'])
				&& !empty($_GET['expertise'])){
				$data['member_requests']=$this->member_model->combox("*",$where);
			 }else{
			$data['member_requests'] = array();
			 }
		 } 
		
 		$data['countries'] 	= $this->country_model->combox();
		$this->main_view('pages/subscribers/assign_story_view',$data);
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
					//Insert
					$insert ['from_id'] 	= $this->mem_id;
					$insert ['to_id'] 		= $mem_id;
					$insert ['date'] 		= date("Y-m-d H:i:s");
					$insert['request_type']	= 3; 
					$insert = $this->security->xss_clean($insert);				
					$this->connect_model->add($insert);				
					echo 'Connect request sent successfully';
				}
				else
				{
					if($conenct_details->status==1)
						echo 'Already connected';
					else
						echo 'Already request sent';
				}
				exit;
			}
		}		
	}
	
	 function stories()
	{	
		$data['title'] 		 = 'Results';
		$data['description'] = '';
		
		$data['story_data'] = $this->content_model->custom_query("SELECT contents.*, AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) as percent
		FROM contents LEFT JOIN content_ratings ON contents.content_id=content_ratings.content_id WHERE story_date Like '".date("Y-m")."%' AND status=1 
		GROUP BY contents.content_id ORDER BY AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) DESC");
		//$data['story_data'] = $this->content_model->combox("*"," story_date Like '".date("Y-m")."%' AND status=1 ORDER BY content_id DESC");
		$this->main_view('pages/subscribers/all_stories_view',$data);
	}
	
	function main_story()
	{	
		$data['title'] 		 = 'Stories';
		$data['description'] = 'Stories';
		$data['story_data'] = $this->content_model->combox();
 		$this->main_view('pages/subscribers/main_story_view',$data);
	}
	
	function payment()
	{	
		$data['title'] 		 = 'Stories';
		$data['description'] = 'Stories';
		$data['story_data'] = $this->content_model->combox();
 		$this->main_view('pages/subscribers/sub_rates_view',$data);
	}

	function keyword($content_id=NULL)
	{	
		$data['title'] 		 = '';
		$data['description'] = '';
		
		$where = '';
		$data['content'] = $this->content_model->combox("*","content_id ='".$content_id."'");
		if($_GET)  
		{    
			$where = "a.content_id!='' AND b.status=1 ";
			if(!empty($_GET['tags']) && $_GET['tags']!='')
			{
				$explode_array = explode(",",$_GET['tags']);
				$where.= " AND ( ";
	            for($i=0;$i<sizeof($explode_array);$i++) 	
				{
					$where.=  " a.tags LIKE '%".$explode_array[$i]."%' "; 
					if($i!=(sizeof($explode_array)-1)) $where.=  " OR ";
				}
				$where.= " ) ";
			}
			
			$select = "distinct(mem_id) as mem_id,username,picture,type";//title
			$data['source_data'] = $this->content_model->custom_query('select '.$select.' from contents a , members b , allotment c where '.            $where.' 
			AND (a.editor = b.mem_id OR ( a.content_id = c.content_id AND c.contributor_id = b.mem_id  ) ) ');		
			
			$this->main_view('pages/subscribers/result_source_view',$data);
		}
 		else
		{   /*from contents ORDER BY tags  ASC*/
			$data['type_data'] = $this->content_model->combox(" distinct(tags) as tags ");		
			$this->main_view('pages/subscribers/keyword_view',$data);
		}
	}
	
	
	
	 function region()
	{	
		$data['title'] 		 = '';
		$data['description'] = '';
		
		$data['story_data'] = $this->content_model->custom_query("SELECT contents.*, AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) as percent
		FROM contents LEFT JOIN content_ratings ON contents.content_id=content_ratings.content_id WHERE story_date Like '".date("Y-m")."%' AND status=1 
		GROUP BY contents.content_id ORDER BY AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) DESC");
 		$this->main_view('pages/subscribers/region_view',$data);
	}
	
}
	
?>
