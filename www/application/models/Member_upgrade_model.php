<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member_upgrade_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		$query  = $this->db->query("select $str_fields from member_upgrades $str_cond");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from member_upgrades where $str_cond");
		return $query->result();
	}
	
	function get_single_record($cond)
	{	
		$query_row  = $this->db->query("select * from member_upgrades where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return NULL;
	}
	
	function get_single_data($cond)
	{
		$query_row  = $this->db->query("select * from member_upgrades where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	function add($data)
	{	
		$this->db->insert('member_upgrades',$data);
		$upgrade_id = $this->db->insert_id();
		return $upgrade_id;
	}

	function edit($data,$cond)
	{ 
		$this->db->update('member_upgrades',$data,$cond);
		return;
	}
	
	function edit_member($data,$upgrade_id)
	{
		$this->db->update('member_upgrades',$data,"upgrade_id = ".$upgrade_id);
		return;
	}
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('member_upgrades');/* delete user master table */
		return 1;
	}
	
	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from member_upgrades where upgrade_id=$id");
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