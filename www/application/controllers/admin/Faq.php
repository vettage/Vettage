<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Faq extends admin_template{  
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('faq_model');
		$this->load->model('email_template_model');
		$this->load->model('site_setting_model');
	}
	
	function index()
	{
		$data['title']   	= 'FAQ';
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$data['page'] = $page;
		$arr_cond = array(); $cond = 1; $count = 1;
		
		$config['base_url'] = BASE_URL.'/admin/faq/index';
		$config['per_page'] = $this->items_per_page;
		if($_POST!=NULL)
		{
			if($_POST['srch_question']!='')
			{
				$keyword = str_replace("'","\'",trim($_POST['srch_question']));
				$arr_cond[] = " (question LIKE '%".$keyword."%' || answer LIKE '%".$keyword."%') " ;
			}
			if(count($arr_cond)>0)
			{
				$cond  = implode(' AND ',$arr_cond);		
				$count = implode(' AND ',$arr_cond);	
			}	
		}
		
		$cond .= ' ORDER BY added_date DESC limit '.$page.','.$config['per_page'];
		$data['details'] 		= $this->faq_model->combox('*', $cond);
		$config['total_rows'] 	= $this->faq_model->count_records();
		
		$config['uri_segment'] 		= 5; 
		$config['full_tag_open'] 	= '<ul>';
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
		
		$this->main_view('configuration','faq_view','configuration',$data);
	}
	
	function add()
	{
		$this->load->library('form_validation');
		$data['title']   	= 'Add FAQ';
		if($_POST!=NULL)
		{
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('question', 'Question', 'required');
			$this->form_validation->set_rules('answer', 'Answer', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				$insert_data = $_POST;
				$insert_data['status'] = '1';
				$insert_data['added_date'] 	  = date('Y-m-d H:i:s');
				$insert_data['added_ip_address'] = $_SERVER['REMOTE_ADDR'];
				$this->faq_model->add($insert_data);
				$this->session->set_flashdata(array('success_msg' => 'FAQ added successfully.'));
				redirect('/admin/faq/');
			}
		}
		$this->main_view('configuration','add_faq_view','configuration',$data);
	}
	
	function edit()
	{
		$this->load->library('form_validation');
		$data['title']   	= 'Edit FAQ';
		$faq_id = (int) $this->uri->segment(4);
		$faq_data = $this->faq_model->get_single_record('faq_id='.$faq_id);
		if($faq_data=="0")
		{
			$this->session->set_flashdata(array('delete_error' => 'Unable to find FAQ'));
			redirect('/admin/faq/');
		}
		if($_POST!=NULL)
		{
			$_POST = $this->security->xss_clean($_POST);
			$this->form_validation->set_rules('question', 'Question', 'required');
			$this->form_validation->set_rules('answer', 'Answer', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				$insert_data = $_POST;
				$this->faq_model->edit($insert_data,$faq_id);
				$this->session->set_flashdata(array('success_msg' => 'FAQ updated successfully.'));
				redirect('/admin/faq/');
			}
		}
		$data['faq_data'] = $faq_data;
		$this->main_view('configuration','edit_faq_view','configuration',$data);
	}
	
	function status_change()
	{
		$faq_id = (int)$this->uri->segment(4);
		$faq_data = $this->faq_model->get_single_record('faq_id='.$faq_id);
		if(!empty($faq_data))
		{
			$faq_status = $faq_data->status;
			if($faq_status=='1')
				$update_status['status']='0';
			else
				$update_status['status']='1';
			$this->faq_model->edit($update_status,$faq_id);
		}
		$this->session->set_flashdata(array('success_msg' => 'Status changed successfully.'));
		redirect('/admin/faq/');
	}
	
	function delete()
	{
		$faq_id = (int) $this->uri->segment(4);
		if($faq_id)
		{
			$delete = $this->faq_model->delete('faq_id',$faq_id);
			if($delete)
			{
				$this->session->set_flashdata(array('success_msg' => 'FAQ deleted successfully.'));
				redirect('/admin/faq/');
			}
			else
			{
				$this->session->set_flashdata(array('delete_error' => 'Unable to delete FAQ'));
				redirect('/admin/faq/');
			}
		}	
	}
	
}?>