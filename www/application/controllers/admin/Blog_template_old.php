<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Blog_template extends admin_template{  
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
	}
	
	function index()
    {
		$data['title']   	= 'Blog Template Listing';
		$cond='';
		$data['blog_data'] = $this-> blog_model->combox("blogs");
		$this->main_view('configuration','blog_view','configuration',$data);
	}
	
	function add_blog()
	{
		$this->load->library('form_validation');
		$data['title']   		 = 'Add Blog Template';
		$data['duplicate_error'] = '';
		if($_POST!=NULL)
		{
			$this->form_validation->set_rules('alias', 'Menu Title', 'required|is_unique[pages.alias]');
		    $this->form_validation->set_rules('blog_title', 'Menu Title', 'required|is_unique[pages.blog_title]');
			$this->form_validation->set_rules('blog_desc', 'Description ', 'required');
			if ($this->form_validation->run() == TRUE){
				$_POST['date_added'] = date('Y-m-d H:i:s');
				$this->blog_model->add($_POST);
				$this->session->set_flashdata(array('success_msg' => 'Blog template details added successfully.'));
				redirect('/admin/ blog_template');
			}
		}
		$this->main_view('configuration','add_blog_view','configuration',$data);
	}
	
	
	function edit_blog()
	{
		$this->load->library('form_validation');
		$data['title']   	= 'Edit Blog Template';
		$data['duplicate_error'] ='';
		
		$page_id =$this->uri->segment(4);
		
		$this->load->model('blog_model');
		
		$data['blog_temp_data'] 	= $this->blog_model->get_single_record("blog_id =$blog_id");
		
		if($data['blog_temp_data']==NULL)
			redirect('/admin/blog_template');
			
		if($_POST!=NULL)
		{
		    $this->form_validation->set_rules('blog_title', 'Menu Title', 'required');
			$this->form_validation->set_rules('blog_desc', 'Description ', 'required');
			
			$chk = $this->blog_model->count_records(" where  blog_title ='".$this->input->post('blog_title')."' and blog_id !=".$blog_id);
			if($chk!=NULL)
			$this->form_validation->set_rules('blog_title', 'Menu Title', 'is_unique[blogs.blog_title]');
			
			if ($this->form_validation->run() == TRUE){
					$_POST['date_modified'] = date('Y-m-d H:i:s');
					$this->page_model->edit($_POST,$blog_id);
					$this->session->set_flashdata(array('success_msg' => 'Blog template details updated successfully.'));
					redirect('/admin/blog_template');
			}
		}
		$this->main_view('configuration','edit_blog_view','configuration',$data);
	}
}?>