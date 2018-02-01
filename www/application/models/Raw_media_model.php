<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Raw_media_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		//echo "select $str_fields from raw_media $str_cond ";exit;
		$query  = $this->db->query("select $str_fields from  raw_media $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($fields="*",$str_cond="1"){
		//echo "select $fields from raw_media WHERE $str_cond"; exit;
        $query = $this->db->query("select $fields from raw_media WHERE $str_cond");
		return $query->result();
	}
	
	function get_single_record($cond)
	{	
		$query_row  = $this->db->query("select * from  raw_media where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return NULL;
	}
	
	function get_single_data($cond)
	{
		$query_row  = $this->db->query("select * from  raw_media where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	function add($data)
	{	
		$this->db->insert('raw_media',$data);
		$raw_id = $this->db->insert_id();
		return $raw_id;
	}

	function edit($data,$cond)
	{ 
		//unset non_editable_fields
		$this->db->update('raw_media',$data,$cond);
		return;
	}
	
	function edit_media($data,$raw_id)
	{
		$this->db->update('raw_media',$data,"raw_id = ".$raw_id);
		return;
	}
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('raw_media');/* delete user master table */
		return 1;
	}
	
	function delete_media($raw_id)
	{	
		if($raw_id)
		{
			$query = $this->db->where('raw_id', $raw_id);
      		$query = $this->db->limit(1,0);
      		$query = $this->db->delete('raw_media');/* delete re_users master table */
			return 1;
		}
	}
	
	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from  raw_media where raw_id=$id");
		$query_data = $query_row->row();
		
		if($query_row->num_rows()>0)
			return $query_data->$field;
		else
			return '';
	}
	
	function geolocation($ip)
	{
		//$ip='94.219.40.96';
		//Array ( [domain] => dslb-094-219-040-096.pools.arcor-ip.net [country] => DE - Germany [state] => Hessen [town] => Erzhausen )
		//check, if the provided ip is valid
		if(!filter_var($ip, FILTER_VALIDATE_IP))
		{
			throw new InvalidArgumentException("IP is not valid");
		}
		
		//contact ip-server
		$response=@file_get_contents('http://www.netip.de/search?query='.$ip);
		if (empty($response))
		{
			throw new InvalidArgumentException("Error contacting Geo-IP-Server");
		}
		
		//Array containing all regex-patterns necessary to extract ip-geoinfo from page
		$patterns=array();
		$patterns["domain"] = '#Domain: (.*?)&nbsp;#i';
		$patterns["country"] = '#Country: (.*?)&nbsp;#i';
		$patterns["state"] = '#State/Region: (.*?)<br#i';
		$patterns["town"] = '#City: (.*?)<br#i';
		
		//Array where results will be stored
		$ipInfo=array();
		//check response from ipserver for above patterns
		foreach ($patterns as $key => $pattern)
		{
			//store the result in array
			$ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
		}
		return $ipInfo;
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