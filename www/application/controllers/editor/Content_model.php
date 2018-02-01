<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

die('not used?');
class content_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		//echo "select $str_fields from contents $str_cond ";exit;
		$query  = $this->db->query("select $str_fields from contents $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from contents as a WHERE $str_cond");
		return $query->result();
	}
	
	function get_single_record($cond)
	{	
		$query_row  = $this->db->query("select * from  contents where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return NULL;
	}
	function edit_media($data,$content_id)
	{
		$this->db->update('contents',$data,"content_id = ".$content_id);
		return;
	}
	
	function delete_media($content_id)
	{	
		if($raw_id)
		{
			$query = $this->db->where('content_id', $content_id);
      		$query = $this->db->limit(1,0);
      		$query = $this->db->delete('contents');/* delete re_users master table */
			return 1;
		}
	}
	function get_single_data($cond)
	{
		$query_row  = $this->db->query("select * from  contents where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	function add($data)
	{	//print_r($data);exit;
		$this->db->insert('contents',$data);
		$content_id = $this->db->insert_id();
		return $content_id;
	}

	function edit($data,$cond)
	{ //print_r($data);exit;
		//unset non_editable_fields
		$this->db->update('contents',$data,$cond);
		return;
	}
	
	function edit_member($data,$mem_id)
	{
		$this->db->update('contents',$data,"content_id = ".$content_id);
		return;
	}
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('contents');/* delete user master table */
		return 1;
	}
	
	function delete_user($mem_id)
	{	
		if($mem_id)
		{
			$query = $this->db->where('content_id', $content_id);
      		$query = $this->db->limit(1,0);
      		$query = $this->db->delete('contents');/* delete re_users master table */
			return 1;
		}
	}
	
	function feature_status($content_id)
	{
		$record = $this->get_single_record("content_id=$content_id");
		if($record->featured==1) $status = 0; else $status = 1;
		$content_data['featured'] = $status;
		$this->db->update('contents',$content_data,"content_id = ".$content_id);
		return $status;
	}  

	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from  contents where content_id=$id");
		$query_data = $query_row->row();
		
		if($query_row->num_rows()>0)
			return $query_data->$field;
		else
			return '';
	}
	
	function custom_query($query){
        $query = $this->db->query($query);
		return $query->result();
	}
	
	function execute_query($query){
        $this->db->query($query);
	}
	
	function do_upload($image)
	{
	    $_FILES =$image;
		$config['upload_path'] = getcwd()."/media/uploads/stories/";
		$config['allowed_types'] ='gif|jpg|png|jpeg';
		$config['encrypt_name'] = $image;
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			//print_r($error);exit;		
		}
		else
		{
			//resize image
			$data = array('upload_data' => $this->upload->data());
			$raw_name = $data['upload_data']['raw_name'];
			$file_ext = $data['upload_data']['file_ext'];
			$this->load->library('image_lib',$config);
			
			//resize_32
			$config['source_image'] = getcwd()."/media/uploads/stories/".$raw_name.$file_ext;
			$config['new_image'] =  getcwd()."/media/uploads/stories/".$raw_name.'_1679'.$file_ext;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 1679;
			$config['height'] =502;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			return $data;
		}
		return;
	}	
	
	function remove_images($content_id=NULL)
	{
		$image = NULL;
		if($content_id!=NULL)
		{
			$getdetails = $this->get_single_data("content_id='".$content_id."' limit 0,1");
			if($getdetails!=NULL) $image = $getdetails->image;
		}
		if($image!=NULL)
		{
			$path = getcwd()."/media/uploads/stories/";
			
			$img_path = $path.$image;
			if(file_exists($img_path))unlink($img_path);
			
			$arg = explode('.',$image);
			$img_path = $path.$arg[0].'_1679.'.$arg[1];
			if(file_exists($img_path))unlink($img_path);
		}
		return;
	}
	
	
	function do_home_upload($image)
	{
		unset($image['userfile']);
	   	$_FILES = $image;
		$_FILES['userfile'] = $_FILES['home_image'];
		unset($_FILES['home_image']);
		$config['upload_path'] = getcwd()."/media/uploads/stories/";
		$config['allowed_types'] ='gif|jpg|png|jpeg';
		$config['encrypt_name'] = $image;
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			//print_r($error);exit;		
		}
		else
		{
			//resize image
			$data = array('upload_data' =>$this->upload->data());
			$raw_name = $data['upload_data']['raw_name'];
			$file_ext = $data['upload_data']['file_ext'];
			$this->load->library('image_lib',$config);
			
			//resize_32
			$config['source_image'] = getcwd()."/media/uploads/stories/".$raw_name.$file_ext;
			$config['new_image'] =  getcwd()."/media/uploads/stories/".$raw_name.'_689'.$file_ext;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 689;
			$config['height'] =459;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			return $data;
		}
		return;
	}	
	
	function remove_home_images($content_id=NULL)
	{
		$image = NULL;
		if($content_id!=NULL)
		{
			$getdetails = $this->get_single_data("content_id='".$content_id."' limit 0,1");
			if($getdetails!=NULL) $image = $getdetails->home_image;
		}
		if($image!=NULL)
		{
			$path = getcwd()."/media/uploads/stories/";
			
			$img_path = $path.$image;
			if(file_exists($img_path)) unlink($img_path);
			
			$arg = explode('.',$image);
		    $img_path = $path.$arg[0].'_689.'.$arg[1];
			if(file_exists($img_path)) unlink($img_path);
		}
		return;
	}
	
	
	function get_keyword($fields="*",$str_cond)
	{
		$query = $this->db->query("select tags from contents where ".$str_cond);
		return $query->result();
	}
	
	function daysremaining($date)
	{
		$monthyear 	  = strtotime(date('F Y'));
		$date 		  = date("Y-m-").date('t', $monthyear);
        $content_date = strtotime($date);
		$current_date = strtotime(date("Y-m-d"));
		$timeDiff 	  = abs($content_date - $current_date);
		$numberDays   = $timeDiff/86400;  // 86400 seconds in one day
		$numberDays   = intval($numberDays);
		return $numberDays;
	}
	
	function get_allot_details()
	{
		$query = $this->db->query("SELECT a.*,AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) as percent
		FROM contents a, content_ratings b  WHERE a.story_date Like '".date("Y-m")."%' AND (a.content_id=b.content_id) GROUP BY a.content_id        ORDER BY AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) DESC ");
		/*echo "SELECT a.*,AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) as percent
		FROM contents a, content_ratings b  WHERE a.story_date Like '".date("Y-m")."%' AND (a.content_id=b.content_id) GROUP BY a.content_id        ORDER BY AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) DESC ";exit;*/
		return $query->result();
	}
  
}  
?>