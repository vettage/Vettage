<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content_ratings_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		//echo "select $str_fields from content_ratings $str_cond ";exit;
		$query  = $this->db->query("select $str_fields from content_ratings $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from content_ratings WHERE $str_cond");
		return $query->result();
	}
	
	function get_single_record($cond)
	{	
		$query_row  = $this->db->query("select * from  content_ratings where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return NULL;
	}
	
	function get_single_data($cond)
	{
		$query_row  = $this->db->query("select * from  content_ratings where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	function add($data)
	{	
		
		$data = $this->calcRating($data);
		$this->db->insert('content_ratings',$data);
		$rating_id = $this->db->insert_id();
		return $rating_id;
	}
	
	private function calcRating($data) {
		$data['rating']= round(($data['importance']+$data['credibility']+$data['timeline']+$data['appearance'])/40,4);
		return $data;
	}

	function edit($data,$cond)
	{ 
		//unset non_editable_fields
		throw new Exception('not currently allowed');
		$this->db->update('content_ratings',$data,$cond);
		return;
	}
	
	function edit_ratings($data,$rating_id)
	{
		throw new Exception('not currently allowed');
		$this->db->update('content_ratings',$data,"rating_id = ".$rating_id);
		return;
	}
	
	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from  content_ratings where rating_id=$id");
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