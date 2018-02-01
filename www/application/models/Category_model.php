<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Category_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		$query  = $this->db->query("select $str_fields from  category $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($table,$fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from $table  where $str_cond  order by category_title");
		return $query->result();
	}

	function get_single_record($cond)
	{
		$query_row  = $this->db->query("select * from  category where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return 0;
	}
  	
	function add_category($data)
	{
		$this->db->insert('category',$data);
		$user_id = $this->db->insert_id();
		return $user_id;
	}

	function edit_category($data,$id)
	{ 
		$this->db->update('category',$data,"category_id = ".$id);
		return;
	}
	
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('category');/* delete user master table */
		return 1;
	}
	
}  
?>