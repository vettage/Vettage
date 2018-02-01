<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expertise_model extends CI_Model {  
	
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		//echo "select $str_fields from expertise $str_cond ";exit;
		$query  = $this->db->query("select $str_fields from expertise $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from expertise WHERE $str_cond");
		return $query->result();
	}
	
	function get_single_record($cond)
	{	
		$query_row  = $this->db->query("select * from expertise where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return NULL;
	}
	function edit_media($data,$dist_id)
	{
		$this->db->update('expertise',$data,"dist_id = ".$dist_id);
		return;
	}
	
	function delete_media($dist_id)
	{	
		if($raw_id)
		{
			$query = $this->db->where('dist_id', $dist_id);
      		$query = $this->db->limit(1,0);
      		$query = $this->db->delete('expertise');/* delete re_users master table */
			return 1;
		}
	}

	function fetch_likes($term)
	{
		$query  = $this->db->query("select expertise from  expertise where expertise LIKE '$term%' ");
		if($query->num_rows()>0){
			// need to do this better
			$result = $query->result();
			$return = array();
			foreach ($result as $res) {
								
				$return[] = $res->expertise;
				
			}
			return $return;
			
		} else return array();
	}
	
	
	function get_single_data($cond)
	{
		$query_row  = $this->db->query("select * from  expertise where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	function add($data)
	{	
		
		$db_debug = $this->db->db_debug;
		
		$this->db->db_debug = FALSE;
		
		$sql ="insert into expertise (expertise) values ('$data') ";
		$result = $this->db->query($sql); 

		$this->db->db_debug = $db_debug;
		
		
		return true;
	}

	function edit($data,$cond)
	{ 
		//unset non_editable_fields
		$this->db->update('expertise',$data,$cond);
		return;
	}
	
	function edit_expertise($data,$dist_id)
	{
		$this->db->update('expertise',$data,"dist_id = ".$dist_id);
		return;
	}
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('expertise');/* delete user master table */
		return 1;
	}
	
	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from  expertise where dist_id=$id");
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