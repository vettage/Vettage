<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends \MY_Frontcontroller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('content_model');
		$this->load->model('country_model');
		$this->load->helper('cookie');
		$this->mem_id 		= $this->session->userdata('mem_id');	
		$this->activetime 	= $this->session->userdata('activetime');
	}
	
	function index()
	{	
		exit;
		//$contents = file_get_contents('http://www.modelmayhem.com/services/geo/state/CA');
		//print_r($contents);exit;
		
		$contents = '';
		$countries = $this->member_model->custom_query("SELECT * FROM countries1 ORDER BY country_id");
		foreach($countries as $row)
		{
			set_time_limit(0);
			$contents = file_get_contents('http://www.modelmayhem.com/services/geo/state/'.$row->code);
			/*$contents="<option value=''>Select</option>
			<option value='7532'>Alberta</option>
			<option value='7529'>British Columbia</option>
			<option value='7535'>Manitoba</option>
			<option value='7539'>New Brunswick</option>
			<option value='7537'>Newfoundland And Labrador</option>
			<option value='7533'>Northwest Territories</option>
			<option value='7536'>Nova Scotia</option>
			<option value='7540'>Nunavut</option>
			<option value='7530'>Ontario</option>
			<option value='7534'>Prince Edward Island</option>
			<option value='7531'>Quebec</option>
			<option value='7538'>Saskatchewan</option>
			<option value='7541'>Yukon</option>";*/
			
			//$contents= str_replace(array("''"),array('""'),$contents);
			$contents= str_replace(array("<option value=''>Select</option>",'<option value=','</option>'),array('','(',  '"),'),$contents);
			$contents= str_replace(array('>'),array(",'".$row->country_id."',\""),$contents);
			$contents = trim($contents,",");
			//$contents = utf8_decode($contents);
			$query = "INSERT INTO state1(`state_id`,`country_id`, `name`) VALUES$contents;";
			$this->member_model->execute_query($query);
		}
		echo "Imported successfully";
	}
	
	function cities()
	{
		exit;
		$states = $this->member_model->custom_query("SELECT state_id FROM state1 WHERE country_id IN(222,223)  ORDER BY country_id");
		foreach($states as $row)
		{
			set_time_limit(0);
			$contents = file_get_contents('http://www.modelmayhem.com/services/geo/city/'.$row->state_id);
			$contents = str_replace(array("<option value=''>Select</option>",'<option value=','</option>'),array('','(',  '"),'),$contents);
			$contents = str_replace(array('>'),array(",'".$row->state_id."',\""),$contents);
			//$contents = str_replace(array('Ä'),array('a'),$contents);
			$contents = trim($contents,",");
			//echo $contents = utf8_decode($contents);exit;
			$query = "INSERT INTO city1(`city_id`,`state_id`, `name`) VALUES$contents;";
			$this->member_model->execute_query($query);
		}
		echo "Imported successfully";
	}
 
}
?>