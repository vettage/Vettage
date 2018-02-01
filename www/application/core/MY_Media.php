<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Media Manager
 *
 * Basic parser / renderer for Media content, v1.
 *
 * @package		Vettage
 * @subpackage	Libraries
 * @category	Libraries
 * @author		plabs
 */
class My_Media {
	
	
	
	protected $valid_sources = array(
		'youtube'=>array('callback'=>'_is_youtube'),	
		'vimeo'=>array('callback'=>'_is_vimeo'),
		'quicktime'=>array('callback'=>'_is_quicktime'),
		'html'=>array('callback'=>'_is_html'),
		'image'=>array('callback'=>'_is_image'),
		'plain'=>array('callback'=>'_is_text'),
		'pdf'=>array('callback'=>'_is_pdf'),
	);
	protected $media_type = 'invalid';
	public $story_details = array();
	private $headers = array();
	
	public function getType(){
	
		return $this->media_type;
	
	}
	
	public function validateUrl($url) {
		
		$url = htmlspecialchars_decode($url);
		// now we only accept <iframe or https:// http://
		// this is currently a vulnerability :)
		if (substr($url, 0, 7)=='<iframe') {	
			$this->media_type='iframe';
			return 'iframe';
		} elseif (substr($url, 0, 7)=='http://' || substr($url, 0, 8)=='https://') { // regex:)
		
			// let's try to grab the headers and find out what this is
			$this->headers = get_headers($url, 1);
	
			if (strstr($this->headers[0],'200 OK') || stristr($this->headers[0],'302 Found')) {
				
				$this->setContentType($url);
				return $this->getType();
			}
		
		}
		return 'invalid';
	}

	public function setCacheFile($url,$contentkey = NULL) {
	
		$xframe = false;
		// TODO: these can be arrays!
		if (isset($this->headers['X-Frame-Options'])) $xframe = $this->headers['X-Frame-Options'];
	
		// cache C-Frame-Options
		if ($contentkey !== NULL && $xframe) {
			$file_name = getcwd()."/media/uploads/contents/$contentkey.html";
	
			if (!file_exists($file_name)) {
					
				$myfile = fopen($url, "r") or die("Unable to open file!");
				while(!feof($myfile)) {
	
					$some = fgets($myfile);
					file_put_contents($file_name,$some,FILE_APPEND);
				}
				fclose($myfile);
			}
	
		}
	
	}
	
	
	public function setContentType($url) {
		
		
		if (is_array($this->headers['Content-Type'])) $type = explode(';',$this->headers['Content-Type'][0]);
			else $type = explode(';',$this->headers['Content-Type']);
		$this->media_type = trim($type[0]);

		foreach($this->valid_sources as $key=>$source) {
			if ($this->{$source['callback']}($url)) { $this->media_type = $key; break; }
		}
		
		return $this->getType();
		
		
	}
	

	public function generateAlias($text) {
			
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		
		// trim
		$text = trim($text, '-');
		
		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);
		
		// lowercase
		$text = strtolower($text);
		
		if (empty($text)) {
			return 'n-a-'.time();
		}
	
		return $text;
	}
	
	

	public function loadStory($details) {
	
		$this->story_details = $details;
		
	}
	
	public function getValidEmbed() {
		
		if ($this->story_details->type=='youtube') {
			
			$id = $this->_youtube_video_id($this->story_details->embed_code_link);
			if (!empty($id)) return 'https://www.youtube.com/embed/'.$id.'?enablejsapi=1&wmode=opaque&amp;rel=0&amp;autohide=1&amp;showinfo=0&amp;wmode=transparent&amp;modestbranding=1';
		
			return false;
			
		} elseif ($this->story_details->type=='vimeo') {
	
			https://player.vimeo.com/video/106381957
			$id = $this->_vimeo_video_id($this->story_details->embed_code_link);
			if (!empty($id)) return 'https://player.vimeo.com/video/'.$id.'';
			
			return false;
			
			
		} elseif ($this->story_details->type=='text/html' || $this->story_details->type=='text/plain') {

			return $this->story_details->embed_code_link;

		} elseif (strstr($this->story_details->type,'image')) {
			
			return $this->story_details->embed_code_link;
					
		} else return $this->story_details->embed_code_link;
		
		
	//	return false;
		
	}
	
	

	protected function _is_image($url)
	{
		if (stristr($this->media_type,'image')) return true;
		return false;
	}
	
	protected function _is_html($url)
	{
		if (stristr($this->media_type,'html')) return true;
		return false;
	}
	
	protected function _is_text($url)
	{
		if (stristr($this->media_type,'plain')) return true;
		return false;
	}
	
	protected function _is_quicktime($url)
	{
		if (stristr($this->media_type,'quicktime')) return true;
			return false;
	}

	protected function _is_pdf($url)
	{
		if (stristr($this->media_type,'pdf')) return true;
		return false;
	}
	
	protected function _is_youtube($url)
	{
		
		return (preg_match('/youtu\.be/i', $url) || preg_match('/youtube\.com\/watch/i', $url));
	}
	
	protected function _is_vimeo($url)
	{
		return (preg_match('/vimeo\.com/i', $url));
	}
	
	protected function _youtube_video_id($url)
	{
		if($this->_is_youtube($url))
		{
			$pattern = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
			preg_match($pattern, $url, $matches);
			if (count($matches) && strlen($matches[7]) == 11)
			{
				return $matches[7];
			}
		}
		
		return '';
	}
	
	protected function _vimeo_video_id($url)
	{
		if($this->_is_vimeo($url))
		{
			$pattern = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
			preg_match($pattern, $url, $matches);
			if (count($matches))
			{
				return $matches[2];
			}
		}
		 
		return '';
	}


}


?>