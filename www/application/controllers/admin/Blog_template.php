<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_template extends admin_template{  

 function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('blog_model');
		$this->load->model('category_model');
	}
	function index()
    {
		$data['title']   	= 'Blog Listing';
		$cond='';
		$data['blog_data'] = $this-> blog_model->combox("blogs");
		$this->main_view('configuration','blog_view','configuration',$data);
    }	
	 
	
  	function add_blog()
	{    
		$data['title']   		 = 'Add Blog';
		$data['duplicate_error'] = '';
		$data['category'] 	= $this->category_model->combox('category');
		if($this->input->post('sbmt_add_blog'))
		{   
			$_POST = $this->security->xss_clean($_POST);
			
			$this->load->library('form_validation');
			if($_POST['alias']!='')
			{
				$_POST['alias'] = str_replace(",","",$_POST['alias']);
				$_POST['alias'] = str_replace(" ","_",$_POST['alias']);
			}
			$this->form_validation->set_rules('alias', 'Menu Title', 'required|is_unique[blogs.alias]');
			$this->form_validation->set_rules('blog_title', 'Title','required|is_unique[blogs.blog_title]');
			$this->form_validation->set_rules('short_desc', 'Short description ', 'required|max_length[315]');
		    $this->form_validation->set_rules('blog_desc', 'blog_desc', 'required');
			$this->form_validation->set_rules('tags','Tags', 'required');
			$this->form_validation->set_rules('category_id','Category', 'required');
 
 		if ($this->form_validation->run() == TRUE){
				$insert_data = $_POST;
				
				if($_FILES['userfile']['name']!=NULL)
				{
					$image_name = $this->blog_model->do_upload($_FILES);
					if(!empty($image_name['error'])){
					if($image_name['error']=='upload_invalid_dimensions')
					{
						$this->session->set_flashdata(array('delete_error' => 'Image dimension must be  minimum 360 x 166 '));
						redirect('/admin/blog_template/add_blog');
						}
					}
					
					$insert_data['image'] = $image_name['upload_data']['file_name'];
				}
				unset($insert_data['sbmt_add_blog']);
				unset($insert_data['userfile']);
				//print_r($insert_data);exit;
				$insert_data['date_added'] = date("Y-m-d  H:i:s");
				$insert_data['status'] = 1;	
				$blog_id = $this->blog_model->add_blog($insert_data);
				
				if($blog_id){
					$this->session->set_flashdata(array('success_msg' => 'Blog added successfully.'));
					redirect('/admin/blog_template');
					exit;
				}
			}
		}
		$this->main_view('configuration','add_blog_view','configuration',$data);
	}
	
	function edit_blog($blog_id)
	{    
		$data['title']  		= 'Edit Blog';
		$data['blog_temp_data'] = $this->blog_model->get_single_record("blog_id=$blog_id");
		$data['category'] 		= $this->category_model->combox('category');
		if($data['blog_temp_data']==NULL) redirect('/admin/blog_template');
		if($_POST)
		{  
			$_POST = $this->security->xss_clean($_POST);
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('blog_title', 'Title', 'required');
			$this->form_validation->set_rules('short_desc', 'Short description ', 'required|max_length[315]');
			$this->form_validation->set_rules('blog_desc', 'Description ', 'required');
			$this->form_validation->set_rules('category_id','Category', 'required');

 			$chk = $this->blog_model->get_single_record(" blog_title ='".str_replace("'","\'",$_POST['blog_title'])."' and blog_id !=".$blog_id);
			if($chk!=NULL) $this->form_validation->set_rules('blog_title', 'Title', 'is_unique[blogs.blog_title]');
			if ($this->form_validation->run() == TRUE)
			{
				unset($_POST['sbmt_edit_blog']);
				
				$update_data = $_POST;
				if($_FILES['userfile']['name']!=NULL)
				{
					$image_name = $this->blog_model->do_upload($_FILES);
					if($image_name!=NULL){
						$this->blog_model->unlink_img($data['blog_temp_data']->image);
						$update_data['image'] = $image_name['upload_data']['file_name'];
					}
				}
				$this->blog_model->edit_blog($update_data,$blog_id);
				$this->session->set_flashdata(array('success_msg' =>'Blog details updated successfully.'));
				redirect('/admin/blog_template');
			}
		}
		$this->main_view('configuration','edit_blog_view','configuration',$data);
	}

	function delete($blog_id)
	{
		if($blog_id)
		{
			$delete = $this->blog_model->delete("blog_id",$blog_id);
			if($delete)
			{
				$this->session->set_flashdata(array('success_msg' => 'Blog deleted successfully.'));
				redirect('/admin/blog_template');
			}
			else
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete Blog.'));
				redirect('/admin/blog_template');
			}
		}	
	}

	function change_status($blog_id)
	{
		if($blog_id)
		{
			$change = $this->blog_model->chaneg_status($blog_id);
			$this->session->set_flashdata(array('success_msg' => 'Blog status changed successfully.'));
			redirect('/admin/blog_template');
		}	
	}//change_status
	
}?>