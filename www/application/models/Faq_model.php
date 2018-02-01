<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Faq_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		$query  = $this->db->query("select $str_fields from faq $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from faq WHERE $str_cond");
		return $query->result();
	}
	

	function get_single_record($cond)
	{
		$query_row  = $this->db->query("select * from faq where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return 0;
	}
	
		
	function add($data)
	{
		$this->db->insert('faq',$data);
		$user_id = $this->db->insert_id();
		return $user_id;
	}

	function edit($data,$id)
	{ 
		$this->db->update('faq',$data,"faq_id = ".$id);
		return;
	}
	
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('faq');/* delete user master table */
		return 1;
	}
	
	function custom_query($query){
        $query = $this->db->query($query);
		return $query->result();
	}
	
	function execute_query($query){
        $this->db->query($query);
	}
	
}  
?>