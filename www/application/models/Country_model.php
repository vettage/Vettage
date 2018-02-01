<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Country_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		$query  = $this->db->query("select $str_fields from  countries $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($table="countries",$fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from $table  where $str_cond");
		return $query->result();
	}
	
	function get_single_record($cond)
	{
		$query_row  = $this->db->query("select * from  countries where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return 0;
	}
	
	function get_single_data($str_tbl_name,$cond)
	{
		$query_row  = $this->db->query("select * from $str_tbl_name where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	function add($data)
	{
		$this->db->insert(' countries',$data);
		$user_id = $this->db->insert_id();
		return $user_id;
	}

	function edit($data,$cond)
	{ 
		$this->db->update('countries',$data,$cond);
		return;
	}
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete(' countries');/* delete user master table */
		return 1;
	}
	
	function activate_user($cond)
	{
		$user_data = array();
		$user_data['verification_code'] ='';
		$user_data['status '] =1;
		$this->db->update(' countries',$user_data,"verification_code ='$cond' ");
	}
	
	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from  countries where user_id=$id");
		$query_data = $query_row->row();
		
		if($query_row->num_rows()>0)
			return $query_data->$field;
		else
			return '';
	}
	
}  
?>