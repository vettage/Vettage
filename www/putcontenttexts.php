<?php
if($_POST)
{
	if($_SERVER['HTTP_HOST']=="192.168.1.6" || $_SERVER['HTTP_HOST']=="localhost")
	{
		$db = mysql_connect("localhost","root","");
		mysql_select_db("vettage",$db);
	}
	else
	{
		$db = mysql_connect("localhost","webapp_sachin","sznz=6{B#Sn}");
		mysql_select_db("webapp_vettage",$db);
	}
	
	ini_set('memory_limit', '2048M');
	$content_id 	 = $_POST['content_id'];
	$content_desc 	 = $_POST['content_desc'];
	
	$query = mysql_query("SELECT content_key FROM contents WHERE content_id='".$content_id."'");
	$content_details = mysql_fetch_assoc($query);
	$content_key 	 = $content_details['content_key'];
	$file_name = getcwd()."/media/uploads/contents/$content_key.html";
	$fp = fopen($file_name,"w+");fclose($fp);
	$content_desc = html_entity_decode($content_desc);
	file_put_contents($file_name,$content_desc);
	echo "";exit;
	
	$content_details = $this->content_model->get_single_record("content_id='".$content_id."' AND editor='".$this->mem_id."'");
	if($content_details!=NULL)
	{
		//print_r($_POST);exit;
		ini_set('memory_limit', '2048M');
		$content_key = $content_details->content_key;
		$file_name = getcwd()."/media/uploads/contents/$content_key.html";
		$fp = fopen($file_name,"w+");fclose($fp);
		$_POST['content_desc'] = html_entity_decode($_POST['content_desc']);
		file_put_contents($file_name,$_POST['content_desc']);
	}
}

?>