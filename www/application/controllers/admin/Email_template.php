<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email_template extends admin_template{  
	
	function index()
    {
		$data['title']   	= 'Email Template Listing';
		$config['base_url'] = BASE_URL.'/admin/email_template/index';
		$config['per_page'] = $this->items_per_page;
		
		$this->load->model('email_template_model');
		
		
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$cond='where 1';
		/*if($this->input->post('sbt_srch')){
			if($this->input->post('srch_name')!='')
				$cond = "where title like '%".trim($this->input->post('srch_name'))."%'" ;
		}*/
		$data['filter'] = 0;
		if(!empty($_GET['filter']))
		{
			$cond = "where type=".$_GET['filter'] ;
			$data['filter'] = $_GET['filter'];
		}
		
		
		$config['total_rows'] = $this->email_template_model->count_records($cond,'temp_id');
		
		$data['email_temp_data'] = $this->email_template_model->get_email_template($config['per_page'],$page,$cond);
		$config['uri_segment'] = 4; 
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';		
		$this->pagination->initialize($config);
		
		$data['email_types'] = array('0'=>"All",'1'=>"Administrator",'2'=>"General",'5'=>"user");
		
		$this->main_view('configuration','email_template_view','configuration',$data);
	}
	
	function new_email()
	{
		$this->load->library('form_validation');
		$data['title']   	= 'Add Email';
		
		$this->load->model('email_template_model');
		
		if($_POST!=NULL)
		{
			$this->form_validation->set_rules('title', 'Email Title', 'required');
			$this->form_validation->set_rules('subject', 'Email Subject', 'required');
			$this->form_validation->set_rules('msg', 'Message ', 'required');
			
			$chk = $this->email_template_model->count_records(" where title ='".str_replace("'","\'",$_POST['title'])."'");
			if($chk!=NULL)
			$this->form_validation->set_rules('title', 'Title', 'is_unique[email_templates.title]');
			
			if ($this->form_validation->run() == TRUE){
				$email_data = array();
				$email_data = $_POST;
				$temp_id = $this->email_template_model->add_email($email_data);
				if($temp_id){
					$this->session->set_flashdata(array('success_msg' => 'Email added successfully.'));
					redirect('/admin/email_template');
				}
			}
		}
		$this->main_view('configuration','add_email_template_view','configuration',$data);
	}

	function edit_email()
	{
		$this->load->library('form_validation');
		$data['title']   	= 'Edit Email';
		$data['duplicate_error'] ='';
		
		$temp_id =$this->uri->segment(4);
		
		$this->load->model('email_template_model');
		
		$data['email_temp_data'] 	= $this->email_template_model->get_single_record("temp_id=$temp_id");
		
		if($data['email_temp_data']==NULL)
			redirect('/admin/email_template');
		if($_POST!=NULL)
		{
		    $this->form_validation->set_rules('title', 'Email Title', 'required');
			$this->form_validation->set_rules('subject', 'Email Subject', 'required');
			$this->form_validation->set_rules('msg', 'Message ', 'required');
			
			$chk = $this->email_template_model->count_records(" where  title ='".str_replace("'","\'",$_POST['title'])."' and temp_id !=".$temp_id);
			if($chk!=NULL)
			$this->form_validation->set_rules('title', 'Title', 'is_unique[email_templates.title]');
			
			if ($this->form_validation->run() == TRUE){
					$this->email_template_model->edit_email($_POST,$temp_id);
					$this->session->set_flashdata(array('success_msg' => 'Email details updated successfully.'));
					redirect('/admin/email_template');
			}
		}
		$this->main_view('configuration','edit_email_template_view','configuration',$data);
	}

	function delete()
	{
		$this->load->model('email_template_model');
		$temp_id =$this->uri->segment(4);
		
		if($temp_id)
		{
			$delete = $this->email_template_model->delete($temp_id);
			if($delete)
			{
				$this->session->set_flashdata(array('success_msg' => 'Email delete successfully.'));
				redirect('/admin/email_template');
			}
			else
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete Email.'));
				redirect('/admin/email_template');
			}
		}	
	}
	

}?>