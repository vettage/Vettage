<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends admin_template{  

 function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
	}
	function index()
    {
		$data['title']   	= 'Category Listing';
		$cond='';
		$data['category_data'] = $this-> category_model->combox("category");
		$this->main_view('configuration','category_view','configuration',$data);
    }	
	 
	
  	function add_category()
	{    
		$data['title']   	= 'Add Blog Category';
		$this->load->library('form_validation');
		$data['duplicate_error'] = '';
		if($this->input->post('sbmt_add_category'))
		{   
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('category_title', 'Title','required|is_unique[category.category_title]');
			if ($this->form_validation->run() == TRUE){
				$insert_data = $_POST;
				unset($insert_data['sbmt_add_category']);
				$category_id = $this->category_model->add_category($insert_data);
				if($category_id){
					$this->session->set_flashdata(array('success_msg' => 'Category added successfully.'));
					redirect('/admin/category');
					exit;
				}
			}
		}
		$this->main_view('configuration','add_category_view','configuration',$data);
	}
	
	function edit_category($category_id)
	{    
		$data['title']  = 'Edit Blog Category';
		$this->load->library('form_validation');
 		$data['category_temp_data'] = $this->category_model->get_single_record("category_id=$category_id");
		if($data['category_temp_data']==NULL) redirect('/admin/category');
		
		if($this->input->post('sbmt_edit_category'))
		{  
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('category_title', 'Title', 'required');
  			$chk = $this->category_model->count_records(" where  category_title ='".str_replace("'","\'",$_POST['category_title'])."' and category_id !=".$category_id);
			if($chk!=NULL) $this->form_validation->set_rules('category_title', 'Title', 'is_unique[category.category_title]');
			if ($this->form_validation->run() == TRUE)
			{
				unset($_POST['sbmt_edit_category']);
 				$update_data['category_title'] = $_POST['category_title'];
 				$this->category_model->edit_category($update_data,$category_id);
				$this->session->set_flashdata(array('success_msg' =>'Category details updated successfully.'));
				redirect('/admin/category');
			}
		}
		$this->main_view('configuration','edit_category_view','configuration',$data);
	}

	function delete($category_id)
	{
		if($category_id)
		{
			$delete = $this->category_model->delete("category_id",$category_id);
			if($delete)
			{
				$this->session->set_flashdata(array('success_msg' => 'Category deleted successfully.'));
				redirect('/admin/category');
			}
			else
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete Category.'));
				redirect('/admin/category');
			}
		}	
	}

	function change_status($category_id)
	{
		if($category_id)
		{
			$change = $this->category_model->chaneg_status($category_id);
			$this->session->set_flashdata(array('success_msg' => 'Category status changed successfully.'));
			redirect('/admin/category');
		}	
	}//change_status
	
}?>