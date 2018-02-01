<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Allotment_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		//echo "select $str_fields from allotment $str_cond ";exit;
		$query  = $this->db->query("select $str_fields from allotment $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from allotment WHERE $str_cond");
		return $query->result();
	}
	
	function get_single_record($cond)
	{	
		$query_row  = $this->db->query("select * from  allotment where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return NULL;
	}
	function edit_media($data,$allot_id)
	{
		$this->db->update('allotment',$data,"allot_id = ".$allot_id);
		return;
	}
	
	function delete_media($allot_id)
	{	
		if($raw_id)
		{
			$query = $this->db->where('allot_id', $allot_id);
      		$query = $this->db->limit(1,0);
      		$query = $this->db->delete('allotment');/* delete re_users master table */
			return 1;
		}
	}
	
	function get_single_data($cond)
	{
		$query_row  = $this->db->query("select * from  allotment where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	function add($data)
	{	
		$this->db->insert('allotment',$data);
		$allot_id = $this->db->insert_id();
		return $allot_id;
	}

	function edit($data,$cond)
	{ 
		//unset non_editable_fields
		$this->db->update('allotment',$data,$cond);
		return;
	}
	
	function edit_allotment($data,$allot_id)
	{
		$this->db->update('allotment',$data,"allot_id = ".$allot_id);
		return;
	}
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('allotment');/* delete user master table */
		return 1;
	}
	
	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from  allotment where allot_id=$id");
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
	
	
 		
  
  
}  
?>