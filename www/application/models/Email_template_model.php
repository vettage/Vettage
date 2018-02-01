<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
class Email_template_model extends CI_Model {  
  
  function count_records($str_cond,$str_fields='*')
	{
		$query  = $this->db->query("select $str_fields from email_templates $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}

	function get_single_record($cond)
	{
		$query_row  = $this->db->query("select * from email_templates where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}


    function get_email_template($limit, $start,$str_cond)
    {
        $query = $this->db->query("select * from  email_templates $str_cond order by temp_id DESC limit $start, $limit ");
		return $query->result();
    }
	
	function add_email($data)
	{
		unset($data['sbmt_add']);
		$this->db->insert('email_templates',$data);
		$user_id = $this->db->insert_id();
		return $user_id;
	}
	
	function edit_email($data,$doc_id)
	{
		unset($data['sbmt_edit']);
		$this->db->update('email_templates',$data,"temp_id = ".$doc_id);
		return;
	}
	
	function delete($doc_id)
	{
		if($doc_id)
		{
			$query = $this->db->where('temp_id', $doc_id);
      		$query = $this->db->limit(1,0);
      		$query = $this->db->delete('email_templates');/* delete user master table */
			return 1;
		}
	}
	

}  
?>