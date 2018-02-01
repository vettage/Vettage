<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Editor_payment_model extends CI_Model {  
  
  	function count_records($str_cond=NULL,$str_fields='*')
	{
		//echo "select $str_fields from editor_pricing $str_cond ";exit;
		$query  = $this->db->query("select $str_fields from editor_pricing $str_cond ");
		if($query->num_rows()>0)
			return $query->num_rows;
		else
			return 0;
	}
	
	function combox($fields="*",$str_cond="1"){
        $query = $this->db->query("select $fields from editor_pricing where $str_cond");
		return $query->result();
	}
	
	function get_single_record($cond)
	{	
		$query_row  = $this->db->query("select * from editor_pricing where $cond");
		if($query_row->num_rows()>0)
		{
			return($query_row->row());
		}
		else 
			return NULL;
	}
	
	function get_single_data($cond)
	{
		$query_row  = $this->db->query("select * from editor_pricing where $cond ");
		if($query_row->num_rows()>0)
			return($query_row->row());
		else
			return 0;
	}
	
	function add($data)
	{	
		$this->db->insert('editor_pricing',$data);
		$mem_id = $this->db->insert_id();
		return $mem_id;
	}

	function edit($data,$cond)
	{ 
		//unset non_editable_fields
		$this->db->update('editor_pricing',$data,$cond);
		return;
	}
	
	function edit_member($data,$mem_id)
	{
		$this->db->update('editor_pricing',$data,"mem_id = ".$mem_id);
		return;
	}
	
	function delete($field,$id)
	{
		$query = $this->db->where($field, $id);
		$query = $this->db->delete('editor_pricing');/* delete user master table */
		return 1;
	}
	
	function delete_user($mem_id)
	{	
		if($mem_id)
		{
			$query = $this->db->where('mem_id', $mem_id);
      		$query = $this->db->limit(1,0);
      		$query = $this->db->delete('editor_pricing');/* delete re_users master table */
			return 1;
		}
	}

	function activate_user($cond)
	{
		$user_data = array();
		$user_data['verification_code'] ='';
		$user_data['status '] =1;
		$this->db->update('editor_pricing',$user_data,"verification_code ='$cond' ");
	}
	
	function change_status($mem_id)
	{
		$record = $this->get_single_data("mem_id=$mem_id");
		if($record->status==1) $status = 0; else $status = 1;
		$user_data['status'] =  $status;
		$this->db->update('editor_pricing',$user_data,"mem_id = ".$mem_id);
		return 1;
	}
	
	function cancel_editor_pricinghip($mem_id)
	{
		$user_data['level'] =  1;
		$this->db->update('editor_pricing',$user_data,"mem_id = ".$mem_id);
		return 1;
	}
	
	function close_account_status_closed($mem_id)	// acoount closed status
	{
		$user_data['status'] =  2;
		$this->db->update('editor_pricing',$user_data,"mem_id = ".$mem_id);
		return 1;
	}
	
	function do_upload($image)
	{
		$_FILES = $image;
		$config['upload_path'] = getcwd()."/media/uploads/editor_pricing/";
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name'] = $image;
		
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$raw_name = $data['upload_data']['raw_name'];
			$file_ext = $data['upload_data']['file_ext'];
			$this->load->library('image_lib', $config);
			//resize_32
			$config['source_image'] = getcwd()."/media/uploads/editor_pricing/".$raw_name.$file_ext;
			$config['new_image'] =  getcwd()."/media/uploads/editor_pricing/".$raw_name.'_32'.$file_ext;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 32;
			$config['height'] =32;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			
			//resize_100
			$config['source_image'] = getcwd()."/media/uploads/editor_pricing/".$raw_name.$file_ext;
			$config['new_image'] =  getcwd()."/media/uploads/editor_pricing/".$raw_name.'_100'.$file_ext;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 100;
			$config['height'] = 100;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			
			//resize_210
			$config['source_image'] = getcwd()."/media/uploads/editor_pricing/".$raw_name.$file_ext;
			$config['new_image'] =  getcwd()."/media/uploads/editor_pricing/".$raw_name.'_210'.$file_ext;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 210;
			$config['height'] =140;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			
			return $data;
		}
		return;
	}
	
	function get_image($mem_id="*",$image="randombig.gif",$size=210)
	{
		if($mem_id!="*")
		{
			$getdetails = $this->get_single_data("picture","mem_id='".$mem_id."' limit 0,1");
			if($getdetails!=NULL) $image = $getdetails->picture;
		}
		if($image!=NULL && $image!="randombig.gif")
		{
			$path = getcwd()."/media/uploads/editor_pricing/";
			$img_path = $path.$image;
			if(file_exists($img_path))
			{
				$arg = explode('.',$image);
				$img_name = $arg[0]."_$size.".$arg[1];
				return '<img src="'.BASE_ASSETS.'uploads/editor_pricing/'.$img_name.'">';
			}
		}
		return '<img src="'.BASE_ASSETS.'uploads/editor_pricing/randombig.gif" width="'.$size.'">';
	}
	
	function unlink_img($mem_id="*",$image="randombig.gif")
	{
		if($mem_id!="*")
		{
			$getdetails = $this->get_single_data("picture","mem_id='".$mem_id."' limit 0,1");
			if($getdetails!=NULL) $image = $getdetails->picture;
		}
		if($image != NULL && $image!="randombig.gif")
		{
			$path = getcwd()."/media/uploads/editor_pricing/";
			
			$img_path = $path.$image;
			if(file_exists($img_path)) unlink($img_path);
			
			$arg = explode('.',$image);
			$img_path = $path.$arg[0].'_32.'.$arg[1];
			if(file_exists($img_path)) unlink($img_path);
			
			$arg = explode('.',$image);
			$img_path = $path.$arg[0].'_100.'.$arg[1];
			if(file_exists($img_path)) unlink($img_path);
			
			$arg = explode('.',$image);
			$img_path = $path.$arg[0].'_210.'.$arg[1];
			if(file_exists($img_path)) unlink($img_path);
		}
		return;
	}
	
	function get_val($id,$field)
	{
		$query_row  = $this->db->query("select $field from editor_pricing where mem_id=$id");
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
	
	function checkAddress($addr="") 
	{
		if($addr!='')
		{
			//http://blockchain.info/address/16cWpnoMMVyCAuwAbanoQEGve9QUnbcsyi
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, 'http://blockexplorer.com/address/'.$addr);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			$res = curl_exec($ch);
			if(strpos($res,"Invalid address")===false)
				return true;
		}
		return false;
  	}
}  
?>