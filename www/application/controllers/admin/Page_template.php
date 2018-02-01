<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page_template extends admin_template{  
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
	}
	
	function index()
    {
		$data['title']   	= 'Page Template Listing';
		$cond='';
		$data['page_data'] = $this->page_model->combox("pages");
		$this->main_view('configuration','pages_view','configuration',$data);
	}
	
	function add_pages()
	{
		$this->load->library('form_validation');
		$data['title']   		 = 'Add Page Template';
		$data['duplicate_error'] = '';
		if($_POST!=NULL)
		{
			$_POST = $this->security->xss_clean($_POST);
			
			$this->form_validation->set_rules('alias', 'Menu Title', 'required|is_unique[pages.alias]');
		    $this->form_validation->set_rules('menu_title', 'Menu Title', 'required|is_unique[pages.menu_title]');
			$this->form_validation->set_rules('description', 'Description ', 'required');
			if ($this->form_validation->run() == TRUE){
				$_POST['date_modified'] = date('Y-m-d H:i:s');
				$this->page_model->add($_POST);
				$this->session->set_flashdata(array('success_msg' => 'Page template details added successfully.'));
				redirect('/admin/page_template');
			}
		}
		$this->main_view('configuration','add_pages_view','configuration',$data);
	}
	
	
	function edit_pages()
	{
		$this->load->library('form_validation');
		$data['title']   	= 'Edit Page Template';
		$data['duplicate_error'] ='';
		
		$page_id =$this->uri->segment(4);
		
		$this->load->model('page_model');
		
		$data['page_temp_data'] 	= $this->page_model->get_single_record("page_id =$page_id");
		
		if($data['page_temp_data']==NULL)
			redirect('/admin/page_template');
			
		if($_POST!=NULL)
		{
			$_POST = $this->security->xss_clean($_POST);
			
		    $this->form_validation->set_rules('menu_title', 'Menu Title', 'required');
			$this->form_validation->set_rules('description', 'Description ', 'required');
			
			$chk = $this->page_model->count_records(" where  menu_title ='".str_replace("'","\'",$_POST['menu_title'])."' and page_id !=".$page_id);
			if($chk!=NULL)
			$this->form_validation->set_rules('menu_title', 'Menu Title', 'is_unique[pages.menu_title]');
			
			if ($this->form_validation->run() == TRUE){
					$_POST['date_modified'] = date('Y-m-d H:i:s');
					$this->page_model->edit($_POST,$page_id);
					$this->session->set_flashdata(array('success_msg' => 'Page template details updated successfully.'));
					redirect('/admin/page_template');
			}
		}
		$this->main_view('configuration','edit_pages_view','configuration',$data);
	}
}?>