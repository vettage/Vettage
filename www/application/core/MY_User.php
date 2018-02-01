<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Object
 *
 * Handles Auth, et al using PHPAuth (composer)
 *
 * @package		Vettage
 * @subpackage	Core
 * @category	Libraries
 * @author		plabs
 */



// TODO: make singleton
class My_User {
	
	protected $config = NULL;
	protected $auth = NULL;
	
	protected $dbh = NULL;
	protected $uid = 0;
	protected $user_data = array();
	private $CI;
	
	public function __construct() {
			
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->helper('cookie');
		$this->CI->load->library('session');
		$this->CI->load->model('user_model','users');
		
		$this->dbh = $this->CI->db->conn_id;
		$this->config = new PHPAuth\Config($this->CI->db->conn_id);
		$this->auth   = new PHPAuth\Auth($this->CI->db->conn_id, $this->config);
		
		if ($this->isLogged()) {
			// then lets populate this object
			$hash = get_cookie($this->config->cookie_name);
			$this->uid = $this->auth->getSessionUID($hash);			
			$this->user_data = $this->auth->getUser($this->uid);
		} 
		
	}
	
	public function getUserID() {
		return $this->uid;
	}

	public function getUserData($field = NULL) {
		if ($field!=NULL && isset($this->user_data[$field])) {
			return $this->user_data[$field];
		}
		return $this->user_data;
	}

	public function isSubscriber() {
		$type = $this->getUserData('type');
		if (is_array($type)) return false;
		if (substr($type,-1)=='1') return true;;
		return false;
	}
	
	public function isEditor() {
		$type = $this->getUserData('type');
		if (is_array($type)) return false;
		if (substr($type,0,1)=='1') return true;
		return false;
	}
	
	public function isRaw() {
		$type = $this->getUserData('type');
		if (is_array($type)) return false;
		if (substr($type,1,1)=='1') return true;;
		return false;
	}
	

	public function updateUserData($params) {

		if (is_array($params)&& count($params) > 0) {
			$customParamsQueryArray = Array();
		
			foreach($params as $paramKey => $paramValue) {
				$customParamsQueryArray[] = array('value' => $paramKey . ' = ?');
			}
		
			$setParams = implode(', ', array_map(function ($entry) {
				return $entry['value'];
			}, $customParamsQueryArray));
		} else { $setParams = ''; }
		
		
		$query = $this->dbh->prepare("UPDATE {$this->config->table_users} SET {$setParams} WHERE id = ?");
		
		$bindParams = array_values(array_merge($params, array($this->getUserID())));
		
		if (!$query->execute($bindParams)) {

			$return['error'] = true;
			$return['message'] = $this->auth->lang["system_error"] . " #04";
			return $return;
		}
		
		$return['error'] = false;
		return $return;
		
		
		
	}
	
	

	public function isLogged() {
		
		if (!$this->auth->isLogged()) {
			return false;
		}
		
		return true;
		
	}
	
	public function register($username,$password,$email,$params= array()) {
		
		// TODO: need to add username to base user object
		$result = $this->auth->register($email,$password,$password,$params);
		return $result;
		
		
	}
	
	public function login($email,$password,$remember) {
	
		$result = $this->auth->login($email,$password,$remember);
		@setcookie($this->config->cookie_name,$result['hash'],strtotime($result['expire']),$this->config->cookie_path);

		return $result;
	
	}

	public function addRatings($number = 0) {
	
		$number = (int) $number;
		$sql = 'UPDATE users SET available_ratings = available_ratings + '.$number.' WHERE (id = :id )';
		$prepStatement = $this->dbh->prepare( $sql );
		if (!$prepStatement->execute(array(':id' => $this->getUserID()))) {
			// TODO: log errors!
			return false;
		}

		return true;
	
	}
	
	public function useRating() {
	
		$sql = 'UPDATE users SET available_ratings = available_ratings - 1  WHERE (id = :id )';
		$prepStatement = $this->dbh->prepare( $sql );
		if (!$prepStatement->execute(array(':id' => $this->getUserID()))) {
			// TODO: log errors!
			return false;
		}
	
		return true;
	
	}
	
	public function getConnections() {
	
		$sql = 'select * from connect,users where connect.to_id=users.id and connect.from_id=:id and connect.status=1';
		$prepStatement = $this->dbh->prepare( $sql );
		if (!$prepStatement->execute(array(':id' => $this->getUserID()))) {
			// TODO: log errors!
			return false;
		}
		$result = $prepStatement->fetchAll();
		return $result;
	
	}

	public function getRatingsCount() {
	
		$sql = 'select available_ratings from users  WHERE (id = :id )';
		$prepStatement = $this->dbh->prepare( $sql );
		if (!$prepStatement->execute(array(':id' => $this->getUserID()))) {
			// TODO: log errors!
			return 0;
		}
		$result = $prepStatement->fetch();
		if (isset($result['available_ratings'])) return $result['available_ratings'];
		else return 0;
	
	}
	
	
	
	
	public function logout() {

		$this->CI->session->set_flashdata(array('success_msg' => 'You have succesfully logged out.'));
		$hash = get_cookie($this->config->cookie_name);
		$this->auth->logout($hash);		
		
		
	}

	
	
	
}