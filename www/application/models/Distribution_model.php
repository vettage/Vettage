<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Distribution_model extends CI_Model {  
  
	protected $payment_percent = 0.10;
	protected $vettage_percent = 0.10;
	protected $rating_cost = 0.99;
	
	
	public function distribute($content_id,$rating_id) {
		
		$this->load->model('content_model');
		$this->load->model('allotment_model');
		$this->load->model('content_ratings_model');
		
		// need to handle payment type here
		
		$content = $this->content_model->get_single_record("content_id='".$content_id."'");
		$rating = $this->content_ratings_model->get_single_record("rating_id='".$rating_id."'");
		
		$allotments = $this->allotment_model->combox('*','content_id='.$content_id);
		
		
		$to_payment = round($this->rating_cost * $this->payment_percent,4);
		
		$data = array('contributor_id'=>99999,'content_id'=>$content_id,'allot_id'=>99999,'rating_id'=>$rating_id,'amount'=>$to_payment);
		$this->add($data);
		
		$to_vettage = round($this->rating_cost * $this->vettage_percent,4);
		
		$data = array('contributor_id'=>99998,'content_id'=>$content_id,'allot_id'=>99998,'rating_id'=>$rating_id,'amount'=>$to_vettage);
		$this->add($data);

		$dist_percent = $rating->rating;
		if (empty($dist_percent)) $dist_percet = 0.8888;
		
		$remainder = 0.792;
		
		foreach ($allotments as $allot) {
			
			if ($allot->percent==0) continue;
				
			$amount = ($allot->percent/100) * $remainder;			
			$data = array('contributor_id'=>$allot->contributor_id,'content_id'=>$content_id,'allot_id'=>$allot->allot_id,'rating_id'=>$rating_id,'amount'=>$amount);
			$this->add($data);
			
			$remainder -= $amount;
				
		}
		
		$data = array('contributor_id'=>99997,'content_id'=>$content_id,'allot_id'=>99997,'rating_id'=>$rating_id,'amount'=>$remainder);
		$this->add($data);
		
		
		
	}
	
	protected function calculatePercent($rating) {
		
		return $percent;
		
	}
	
	public function getTotalEarnings($user_id) {
		
		$query = $this->db->query("select sum(amount) as amount from distribution where contributor_id=".$user_id);
		return $query->row()->amount;
		
	}
	
	
	
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		//echo "select $str_fields from distribution $str_cond ";exit;
		$query  = $this->db->query("select $str_fields from distribution $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from distribution WHERE $str_cond");
		return $query->result();
	}
	
	function get_single_record($cond)
	{	
		$query_row  = $this->db->query("select * from  distribution where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return NULL;
	}
	function edit_media($data,$dist_id)
	{
		$this->db->update('distribution',$data,"dist_id = ".$dist_id);
		return;
	}
	
	function delete_media($dist_id)
	{	
		if($raw_id)
		{
			$query = $this->db->where('dist_id', $dist_id);
      		$query = $this->db->limit(1,0);
      		$query = $this->db->delete('distribution');/* delete re_users master table */
			return 1;
		}
	}
	
	function get_single_data($cond)
	{
		$query_row  = $this->db->query("select * from  distribution where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	function add($data)
	{	
		$this->db->insert('distribution',$data);
		$dist_id = $this->db->insert_id();
		return $dist_id;
	}

	function edit($data,$cond)
	{ 
		//unset non_editable_fields
		$this->db->update('distribution',$data,$cond);
		return;
	}
	
	function edit_distribution($data,$dist_id)
	{
		$this->db->update('distribution',$data,"dist_id = ".$dist_id);
		return;
	}
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('distribution');/* delete user master table */
		return 1;
	}
	
	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from  distribution where dist_id=$id");
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