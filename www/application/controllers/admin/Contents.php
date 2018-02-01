<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contents extends admin_template{  
		
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('country_model');
		$this->load->model('content_model');
		$this->load->model('raw_media_model');
		$this->load->model('allotment_model');
		$this->load->model('distribution_model');
		$this->load->model('connect_model');
		$this->load->model('content_ratings_model');
		$this->load->model('email_template_model');
		$this->load->model('site_setting_model');
	}
	
	function index()
    {
		$data['title']  = 'Contents';
		$config['base_url'] = BASE_URL.'/admin/contents/index';
		$config['per_page'] = 10;
		$page 				= ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$data['page'] 		= $page;
		$arr_cond = "content_id!=''"; $cond = "status=1"; $count = 1;
		if($_GET)
		{
			if($_GET['action']=="Search")
			{
				if(!empty($_GET['field']) && !empty($_GET['keyword']))
				{
					$keyword = str_replace("'","\'",trim($_GET['keyword']));
					if($_GET['field']=="user") 
					{
						$mem_id=0;
						$details = $this->user_model->get_single_record("username='".$keyword."'");
						if($details!=NULL) 
						{
							if($details->type==1)
							{
								$contents_ids = '';
								$allotments = $this->allotment_model->combox("distinct(content_id) as content_id","contributor_id='".$details->mem_id."'");
								foreach($allotments as $row_allotments) $contents_ids.=$row_allotments->content_id.",";		
								if($contents_ids!='') $contents_ids = trim($contents_ids,","); else $contents_ids = "''";
								$stories = $this->content_model->combox("*"," content_id IN ($contents_ids)"); 
								$arr_cond.= " AND content_id IN ($contents_ids)" ;
							}
							else
								$arr_cond.= " AND editor = '".$details->id."'" ;
						}
						else
							$arr_cond.= " AND editor = '".$mem_id."'" ;
					}
					else if($_GET['field']=="country") 
					{
						$countrydetails = $this->country_model->get_single_record("(LOWER(name)='".strtolower($keyword)."' OR LOWER(code)='".strtolower($keyword)."')");
						if($countrydetails!="0") $keyword = $countrydetails->code;
						$arr_cond.= "AND ".$_GET['field']." LIKE '%".$keyword."%' " ;
					}
					else
						$arr_cond.= "AND ".$_GET['field']." LIKE '%".$keyword."%' " ;
				}
					if(!empty($_GET['field']) && !empty($keyword))
				{
					$explode_array = explode(",",$keyword);	
					
					$arr_cond.= " OR ( ";
					for($i=0;$i<sizeof($explode_array);$i++) 	
					{
						$arr_cond.= " tags LIKE '%".trim($explode_array[$i])."%' " ;
						if($i!=(sizeof($explode_array)-1)) $arr_cond.=  " OR ";
					}
				$arr_cond.= " ) ";
				
			}
				else
					$_GET['field'] = $_GET['keyword'] = '';
			}
		}
		//echo $arr_cond;exit;
		$config['total_rows'] = $this->content_model->count_records("WHERE $arr_cond"); 
		$arr_cond.= ' ORDER BY content_id DESC,image DESC limit '.$page.','.$config['per_page'];//echo "WHERE $arr_cond";exit;
		$data['content_details']  = $this->content_model->combox('*',$arr_cond);
		
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
		$this->main_view('contents','content_listing_view','contents',$data);
	}
	
	
	function feature_status($content_id)
	{
		if($content_id)
		{
			$change = $this->content_model->feature_status($content_id);
			$this->session->set_flashdata(array('success_msg' => 'Featured status changed successfully.'));
			redirect('/admin/contents');
		}	
	}//change_status
	
	function allotment()
	{ 
		
		if(!$_GET)
		{
			redirect('/admin/contents');	
		}
		$content_id=!empty($_GET['content_id']) ? $_GET['content_id'] : ''; 
			
		$data['content_details'] = $this->content_model->get_single_record("content_id='".$content_id."'");
		if($data['content_details']==NULL)
		{
			redirect('/admin/contents');	
		}
		
		// add $$$ (for vettage and payments)
		$dist = $this->distribution_model->custom_query("select distinct(contributor_id) as id,sum(amount) as amount from distribution where content_id=".$content_id."  group by contributor_id");
		$data['distributions'] = array();
		foreach ($dist as $d) {
			$data['distributions'][$d->id] = $d->amount;
		}
		
		
		$data['allotments'] = $this->allotment_model->combox("*","content_id='".$content_id."'");
		$data['content_id'] 	 	= $content_id; 
		$this->main_view('contents','allotmnt_list_view','contents',$data);
	}
	
	function edit_content($content_id)
 	{	
	    $this->load->library('form_validation');
		$content_details = $this->content_model->get_single_record("content_id='".$content_id."'"); 
		if($content_details==NULL)
		{  
			redirect('admin/contents');	
			exit;
		}
		
 		$data['title'] = '';
		if($_POST)
		{		 
			$_POST = $this->security->xss_clean($_POST);
			
			if(!empty($_POST['formattypes']) && $_POST['formattypes']!='')
			{
				$_POST['types'] = ",".implode(",",$_POST['formattypes']).",";
			}
			unset($_POST['formattypes']);
			if(empty($_POST['copyright'])) $_POST['copyright'] = '';
			
			$this->form_validation->set_rules('types', 'Media type', 'required');
			$this->form_validation->set_rules('copyright', 'Copyright', 'required');
			$this->form_validation->set_rules('tags', 'tags', 'required');
			$this->form_validation->set_rules('embed_code_link', 'Embed code/link', 'required');
  			$this->form_validation->set_rules('country','Country', 'required');   
			$this->form_validation->set_rules('city','City', 'required');
  			$this->form_validation->set_rules('state','State','required');
			$this->form_validation->set_rules('postal_code','Or Postal Code','required');
			$this->form_validation->set_rules('date','Date','required|callback_date_check');
  			if($_POST['title']!='')
			{
				$content_check_details = $this->content_model->get_single_record("title='".$_POST['title']."' && content_id!='".$content_id."'");
				if($content_check_details!=NULL) $this->form_validation->set_rules('title', 'Title', 'is_unique[contents.title]');
			}
  			if($this->form_validation->run() == TRUE)
			{  
				$insert_data=$_POST; 
				if($_POST['date']!='') $insert_data['story_date']= substr($_POST['date'],0,4)."-".substr($_POST['date'],4,2)."-".substr($_POST[                'date'],6,2);
				if($_FILES)
				{    
					if(!empty($_FILES['userfile']['name'])) 
					{
						$image_name = $this->content_model->do_upload($_FILES);
						$this->content_model->remove_images($content_details->content_id);
						if($_FILES['userfile']['name']!=NULL) $insert_data['image'] = $image_name['upload_data']['file_name'];
					}
					if(!empty($_FILES['home_image']['name']))
					{
						 $image_name = $this->content_model->do_home_upload($_FILES);
						 $this->content_model->remove_home_images($content_details->content_id);
						 if($image_name['upload_data']['file_name']!=NULL) $insert_data['home_image'] = $image_name['upload_data']['file_name']; 
					}
				}
				unset($insert_data['copyright']);unset($insert_data['date']);
				unset($insert_data['userfile']);unset($insert_data['action']);
				 				
				$update_data = $insert_data;
				$this->content_model->edit($update_data,array("content_id"=>$content_id));
				$this->session->set_flashdata(array('success_msg' => 'Contents updated successfully.'));
				redirect('admin/contents');			
				exit;
  			} 
		}
		
		$data['content_id'] 	 	 = $content_id;
		$data['countries'] 	= $this->country_model->combox();
 		$data['content_details'] 	 = $content_details; 
		$this->main_view('contents','edit_content_view','contents',$data);
  	}
	
	 function stories()
	{	
		$data['title'] 		 = 'Results';
		$data['description'] = '';
		
		$data['story_data'] = $this->content_model->custom_query("SELECT contents.*, AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) as percent
		FROM contents LEFT JOIN content_ratings ON contents.content_id=content_ratings.content_id WHERE story_date Like '".date("Y-m")."%' AND status=1 
		GROUP BY contents.content_id ORDER BY AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) DESC");
		//$data['story_data'] = $this->content_model->combox("*"," story_date Like '".date("Y-m")."%' AND status=1 ORDER BY content_id DESC");
		$this->main_view('contents','story_listing_view',$data);
	}
 
	 
	function delete($content_id)
	{
		if($content_id)
		{
			$delete = $this->content_model->delete('content_id',$content_id);
			if($delete)
				$this->session->set_flashdata(array('success_msg' => 'Content deleted successfully.'));
			else
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete content.'));
			redirect('/admin/contents');
		}	
	}
	
}
?>