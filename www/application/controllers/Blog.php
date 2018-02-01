<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('blog_model');
		$this->load->model('category_model');
		
		$this->mem_id 		= $this->session->userdata('mem_id');	
		$this->activetime 	= $this->session->userdata('activetime');
	}
	
	function index()
	{	
		redirect("blogs");			
		exit;
		
		//$this->member_model->checkAddress("1PSpXtPWdBZKkHJXRJeDLBs8APpCXcUrEV");
		$data['title'] 		 = 'Blogs';
		$data['description'] = '';
		$data['keywords'] 	 = '';
		$where = "blog_id > 0" ;
		if(!empty($_GET['category']) &&  trim($_GET['category'])!='') 
		{
			$details = $this->category_model->get_single_record("category_title='".trim($_GET['category'])."'");
			if($details!="0") $where .= " AND category_id='".$details->category_id."'"; 
		}
		if(!empty($_GET['tags']) && trim($_GET['tags'])!='') $where .= " AND tags LIKE '%".trim($_GET['tags'])."%'";
		$data['blog_data'] 	 = $this-> blog_model->combox("blogs","*",$where);
 		$this->main_view('pages/blog_view',$data);
	}
	
	function details($alias)
	{	
		$explode = explode("_",$alias);
		$blog_id = $explode[0];
		$alias   = $explode[1];
		$data['blog_details'] = $this->blog_model->get_single_record("blog_id='".$blog_id."'");
		
		if($data['blog_details']=="0") 
		{
			redirect('blogs');			
			exit;
		}
		$data['title'] 		 = 'Blog Details';
		$data['description'] = '';
		$data['keywords'] 	 = '';
        //$data['blog_cmt'] = $this->blog_model->get_record("blog_id='".$blog_id."'");
 		$this->main_view('pages/blog_details_view',$data);
	}
	
	function comment()
	{	
		$this->load->library('form_validation');
	    $post_data = $this->input->post(NULL, TRUE);
		$insert_data['blog_id'] 	= $post_data['blog_id'];
		$insert_data['mem_id']  	= $this->mem_id;
		$insert_data['comment'] 	= $post_data['comment'];
		$insert_data['date_added'] 	= date("Y-m-d  H:i:s");
		$comment = $this->blog_model->add_comment($insert_data);
		echo "success";
	}
	
	function getcomments()
	{	
	    $post_data = $this->input->post(NULL, TRUE);
		$blog_cmt = $this->blog_model->get_record("blog_id='".$post_data['blog_id']."'");
		$html='';
		if($blog_cmt!=NULL)
		{
			$member_path 		= BASE_URL.'media/uploads/members/';
			$member_file_path 	= getcwd().'/media/uploads/members/';
			
			foreach($blog_cmt as $row) :
			$member='User'; $img_src = $member_path.'randombig.gif';
			if($row->mem_id>0)
			{
				$details = $this->member_model->get_single_record("mem_id='".$row->mem_id."'");
				if($details!="0") 
				{
					$member	 = $details->username;
					$picture = $details->picture;
					if($picture!='' && file_exists($member_file_path.$picture))
						$img_src = $member_path.$picture;
				}
			}
			$delete_link = '';
			if($this->mem_id==$row->mem_id) $delete_link = '<a title="Delete" href="javascript:deletecomment('.$row->comment_id.');" class="btn btn-info pull-right"> <i class="fa fa-trash-o"></i></a>';
			$html.='<tr style=" padding:10px; ">
				<td valign="bottom" align="center" width="12%">
					<div style="background-color:#f1f1f1; padding:10px; border:1px solid #d9d9d9"><img src="'.$img_src.'" width="50" title="'.date("d M y, H:i A",strtotime($row->date_added)).'" /></div><strong style="color:#006600">'.$member.'</strong>
				</td>
				<td valign="top" >
					<div class="clearfix" style="background-color:#f1f1f1; padding:10px; border:1px solid #d9d9d9">'.$row->comment.' '.$delete_link.' </div>
				</td>
			</tr>';
			endforeach;
		}
		else
			$html='No one commented yet';
		echo $html;
	}
	
	
	function deletecomment()
	{	
		if($_POST)
		{
			$post_data = $_POST;
			$blog_cmt = $this->blog_model->get_record("blog_id='".$post_data['blog_id']."' AND comment_id='".$post_data['comment_id']."' AND mem_id='".$this->mem_id."'");
			if($blog_cmt!=NULL)
			{
				//print_r($blog_cmt);exit;
				$this->blog_model->deletecomment('comment_id',$post_data['comment_id']);
				echo "comment removed";
			}
			else
				echo "invalid request";
		}
		else
			echo "invalid data";
	}
	
}
?>