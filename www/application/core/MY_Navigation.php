<?php

// TODO: move this to helper
function checkActiveMain(&$value,$key)
{
	$it = false;
	
	if (!is_array($value)) {
		if (isset($_SERVER['REQUEST_URI']) && strstr($_SERVER['REQUEST_URI'],$value)) $it = true;	
		$value = array('uri'=>$value,'active'=>$it);
	}
}

// TODO: move this to helper
function checkActive(&$value,$key)
{
	$it = false;

	if (!is_array($value)) {
		if (isset($_SERVER['REQUEST_URI']) && strstr($_SERVER['REQUEST_URI'],$value)) $it = true;
		if (strtolower($value)=='search' && strstr($_SERVER['REQUEST_URI'],'search/')) $it= false;
		if (strtolower($value)=='account' && strstr($_SERVER['REQUEST_URI'],'account/')) $it= false;
		$value = array('uri'=>$value,'active'=>$it);
	}
}



defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Navigation Manager
 *
 * Basic parser / renderer for Media content, v1.
 *
 * @package		Vettage
 * @subpackage	Libraries
 * @category	Libraries
 * @author		plabs
 */
class My_Navigation {
	
	public $links = array(
			
		'public' => array (
				'About'=>'site/pages/about',
				'FAQ' => 'help',
				'Blog' => 'blogs',
				'Terms' => 'site/pages/terms',
				'Privacy' => 'site/pages/privacy',
				'Advertise' => 'site/pages/adverytise',
				'Copyrights' => 'site/pages/copyrights',
				'Developers' => 'site/pages/developers',
				
				
		),

			
		'user' => array (
				'Home'=>'home',
				'Search'=>'search',
				'Collaborate'=>'collaborate/raw_media/submit',
				'Account'=>'account',
				'Logout'=>'logout',
				
		),
			
	);
	
	public $sublinks = array (
			
		'search' => array (
				'Region'=>'search/region',
				'Advanced'=>'search',
				'Keyword'=>'search/keyword',
		),
			
		'collaborate' => array (
				'Submit Raw Media'=>'collaborate/raw_media/submit',
				'Find Raw Media'=>'collaborate/raw_media_pull',
				'Connect'=>'collaborate/connect',
				'Submit Final Piece'=>'collaborate/raw_media_pull/submit_final_piece',
		),
				
		'account' => array (
				'Profile'=>'account',
				'Messages'=>'account/messages',
				'Connections'=>'account/connections',
				'Ratings'=>'account/ratings',
				'Stories'=>'account/stories',
				'Raw Pieces' => 'account/raw',
				'Earnings'=>'account/earnings',
		),
				
				
			
			
			
	);
	
	protected $user = NULL;
	
	
	public function __construct(\MY_User $user) {

		$this->user = $user;
		
	}
	
	
	
	public function getMenuArray($menu = 'main',$part = NULL) {
		
		if ($menu =='sub') {
			
			switch ($part) {
				
				case 'search':
					array_walk($this->sublinks['search'],'checkActive');
					return $this->sublinks['search'];
					break;
				
				case 'collaborate':
					array_walk($this->sublinks['collaborate'],'checkActive');
					return $this->sublinks['collaborate'];
					break;
						
				case 'account':
					array_walk($this->sublinks['account'],'checkActive');
					if (!$this->user->isEditor() && !$this->user->isRaw()) {
						unset($this->sublinks['account']['Ratings']);
						unset($this->sublinks['account']['Stories']);
						unset($this->sublinks['account']['Raw Pieces']);
						unset($this->sublinks['account']['Earnings']);
					}
					if (!$this->user->isRaw()) {
						unset($this->sublinks['account']['Raw Pieces']);
						unset($this->sublinks['account']['Earnings']);
					}
					if (!$this->user->isEditor()) {
						unset($this->sublinks['account']['Ratings']);
						unset($this->sublinks['account']['Stories']);
						unset($this->sublinks['account']['Earnings']);
					}
						
					
					return $this->sublinks['account'];
					break;
						
					
				default:
					return array();
				
			}
				
		} else {
			if ($this->user->isLogged()) {
				array_walk($this->links['user'],'checkActiveMain');
				
				if (!$this->user->isEditor() && !$this->user->isRaw()) unset($this->links['user']['Collaborate']);			
				
				return $this->links['user'];
			} else {
				array_walk($this->links['public'],'checkActive');
				return $this->links['public'];
			}
		}
		
	}
	

}
	
	
