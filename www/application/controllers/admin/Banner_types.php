<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banner_types extends admin_template{  
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('banner_type_model');
	}
	
	function index()
	{
		$data['title']   	= 'Banner Types';
		
		$config['base_url'] = BASE_URL.'/admin/banner_types';
		$config['per_page'] = $this->items_per_page;
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$data['page'] = $page;
		$arr_cond = array(); $cond = 1; $count = 1;
		if($_POST!=NULL)
		{
			if($_POST['srch_group']!='')
				$arr_cond[] = " name LIKE '".trim($_POST['srch_company'])."%'" ;

			if(count($arr_cond)>0)
			{
				$cond  = implode(' AND ',$arr_cond);		
				$count = implode(' AND ',$arr_cond);	
			}	
		}
		
		$config['total_rows'] 	= $this->banner_type_model->count_records("WHERE $cond");
		$cond .= ' ORDER BY banner_type_id ASC limit '.$page.','.$config['per_page'];
		$data['banner_data'] 	= $this->banner_type_model->combox('bit_banner_types','*', $cond);
		
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
		
		$this->main_view('banners','banner_type_view','banners',$data);
	}
	
	function add()
	{
		$this->load->library('form_validation');
		$data['title']   	 = 'Add Banner Type';
		if($_POST!=NULL)
		{
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required');
			if($_POST['type']=='image')
			{
				$this->form_validation->set_rules('width', 'Width', 'required');
				$this->form_validation->set_rules('height', 'height', 'required');
				$this->form_validation->set_rules('filesize', 'Filesize', 'required');
			}
			if ($this->form_validation->run() == TRUE)
			{
				$insert_data = $_POST;
				if($_POST['type']!='image') $insert_data['width'] = $insert_data['height'] = $insert_data['filesize'] = '';
				$this->banner_type_model->add($insert_data);
				$this->session->set_flashdata(array('success_msg' => 'Banner type information added successfully.'));
				redirect('/admin/banner_types/');
			}
		}
		$this->main_view('banners','add_banner_type_view','banners',$data);
	}
	
	function edit()
	{
		$this->load->library('form_validation');
		$data['title']   	 = 'Edit Banner Type';
		$banner_type_id 	 = $this->uri->segment(4);
		$data['banner_data']  = $this->banner_type_model->get_single_record('banner_type_id='.$banner_type_id);
		
		if($_POST!=NULL)
		{
			$_POST['type']  = $data['banner_data']->type;
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required');
			if($_POST['type']=='image')
			{
				$this->form_validation->set_rules('width', 'Width', 'required');
				$this->form_validation->set_rules('height', 'height', 'required');
				$this->form_validation->set_rules('filesize', 'Filesize', 'required');
			}
			if($this->form_validation->run() == TRUE)
			{
				$update_data = $_POST;
				if($_POST['type']!='image') $update_data['width'] = $update_data['height'] = $update_data['filesize'] = '';
				$this->banner_type_model->edit_banner($update_data,$banner_type_id);
				$this->session->set_flashdata(array('success_msg' => 'Banner type information updated successfully.'));
				redirect('/admin/banner_types/');
			}
		}
		$this->main_view('banners','edit_banner_type_view','banners',$data);
	}
	
	
	function delete()
	{
		$banner_type_id = (int) $this->uri->segment(4);
		if($banner_type_id)
		{
			$delete = $this->banner_type_model->delete('banner_type_id',$banner_type_id);
			if($delete)
				$this->session->set_flashdata(array('success_msg' => 'Banner type deleted successfully.'));
			else
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete banner type'));
		}	
		redirect('/admin/banner_types/');
	}
	
}?>