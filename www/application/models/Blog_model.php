<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Blog_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		$query  = $this->db->query("select $str_fields from  blogs $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($table,$fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from $table  where $str_cond");
		return $query->result();
	}

	function get_single_record($cond)
	{
		$query_row  = $this->db->query("select * from   blogs where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return 0;
	}
	function get_record($cond)
	{
		$query_row  = $this->db->query("select * from blog_comments where $cond order by comment_id desc");
		return $query_row -> result();
	}
	
	function chaneg_status($blog_id)
	{
		$record = $this->get_single_record("blog_id=$blog_id");
		if($record->status==1) $status = 0; else $status = 1;
		$blog_data['status'] = $status;
		$this->db->update('blogs',$blog_data,"blog_id = ".$blog_id);
		return $status;
	}  
	
	function do_upload($image)
	{
	   $_FILES = $image;
		$config['upload_path'] = getcwd()."/media/uploads/blogs/";
		$config['allowed_types'] ='gif|jpg|png|jpeg';
		$config['encrypt_name'] = $image;
		
		$this->load->library('upload',$config);
		 
		if ( ! $this->upload->do_upload())
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
			
			//resize_35
			$config['source_image'] = getcwd()."/media/uploads/blogs/".$raw_name.$file_ext;
			$config['new_image'] =  getcwd()."/media/uploads/blogs/".$raw_name.'_35'.$file_ext;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 35;
			$config['height'] =35;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			
			//resize_50
			$config['source_image'] = getcwd()."/media/uploads/blogs/".$raw_name.$file_ext;
			$config['new_image'] =  getcwd()."/media/uploads/blogs/".$raw_name.'_50'.$file_ext;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 50;
			$config['height'] =50;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			
			//resize_120
			$config['source_image'] = getcwd()."/assets/uploads/blogs/".$raw_name.$file_ext;
			$config['new_image'] =  getcwd()."/assets/uploads/blogs/".$raw_name.'_120'.$file_ext;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 120;
			$config['height'] = 120;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			
			//resize_220
			$config['source_image'] = getcwd()."/media/uploads/blogs/".$raw_name.$file_ext;
			$config['new_image'] =  getcwd()."/media/uploads/blogs/".$raw_name.'_220'.$file_ext;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 220;
			$config['height'] = 220;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			
			
			return $data;
		}
		return;
	}	
		
	function unlink_img($image=NULL)
	{
		if($image != NULL)
		{
			$path = getcwd()."/media/uploads/blogs/";
			
			$img_path = $path.$image;
			if(file_exists($img_path)) unlink($img_path);
			
			$arg = explode('.',$image);
			$img_path = $path.$arg[0].'_35.'.$arg[1];
			if(file_exists($img_path)) unlink($img_path);
			
			$arg = explode('.',$image);
			$img_path = $path.$arg[0].'_50.'.$arg[1];
			if(file_exists($img_path)) unlink($img_path);
			
			$arg = explode('.',$image);
			$img_path = $path.$arg[0].'_120.'.$arg[1];
			if(file_exists($img_path)) unlink($img_path);
			
			$arg = explode('.',$image);
			$img_path = $path.$arg[0].'_220.'.$arg[1];
			if(file_exists($img_path)) unlink($img_path);
			
		}
		return;
	}
	function add_comment($data)
	{ 
	  $this->db->insert('blog_comments',$data);
	  $user_id=$this->db->insert_id();
	  return $user_id;
	}
		
	function add_blog($data)
	{
		$this->db->insert('blogs',$data);
		$user_id = $this->db->insert_id();
		return $user_id;
	}

	function edit_blog($data,$id)
	{ 
		$this->db->update('blogs',$data,"blog_id = ".$id);
		return;
	}
	
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('blogs');/* delete user master table */
		return 1;
	}
	
}  
?>