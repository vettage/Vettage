<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
class Site_setting_model extends CI_Model {  
  
	function count_records($str_cond,$str_fields='*')
	{
		$query  = $this->db->query("select $str_fields from system_settings $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}

	function get_single_record($cond)
	{

		$query_row  = $this->db->query("select * from system_settings where $cond ");

		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}

	function edit($data,$adm_id)
	{
		$this->db->update('system_settings',$data,"adm_id = ".$adm_id);
		return;
	}

	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from system_settings where adm_id=$id");
		$query_data = $query_row->row();
		
		if($query_row->num_rows()>0)
			return $query_data->$field;
		else
			return '';
	}
	
	function get_name_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from system_settings where adm_id=$id");
		$query_data = $query_row->row();
		
		if($query_row->num_rows()>0)
			return $query_data->adm_name;
		else
			return '';
	}
	
	function custom_query($query){
        $query = $this->db->query($query);
		return $query->result();
	}
	
	function get_records($table,$cond="1")
	{
		$query_row  = $this->db->query("select * from $table where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	
	function add_records($table,$data)
	{
		$this->db->insert($table,$data);
		$user_id = $this->db->insert_id();
		return $user_id;
	}
	
	function edit_records($table,$data,$cond)
	{
		$this->db->update($table,$data,$cond);
		return;
	}
	

}  
?>