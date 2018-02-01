<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LanguageLoader
{
	function initialize() {
      		  $ci =& get_instance();  
	       // $ci->load->helper('language');
	        $site_lang = $ci->session->userdata('site_lang');
		    if ($site_lang) { 
	            $ci->lang->load('',$ci->session->userdata('site_lang'));
	        } else {
	            $ci->lang->load('','english');
	        }
	    }
}