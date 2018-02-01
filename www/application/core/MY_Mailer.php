<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Mail Manager
 *
 * wrapper for PHPMailer
 *
 * @package		Vettage
 * @subpackage	Libraries
 * @category	Libraries
 * @author		plabs
 */
class My_Mailer {
	
	
	// singleton / uncouple
	public function __construct() {
		
		$this->CI =& get_instance();
		$this->CI->load->database();
		
		$this->config = new PHPAuth\Config($this->CI->db->conn_id);
		
		$mail = new PHPMailer;
		$mail->CharSet = $this->config->mail_charset;
		
		if ($this->config->smtp) {
			$mail->isSMTP();
			$mail->Host = $this->config->smtp_host;
			$mail->SMTPAuth = true;
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
//			if (!is_null($this->config->smtp_auth)) {
				$mail->Username = $this->config->smtp_username;
				$mail->Password = $this->config->smtp_password;
//			}
			$mail->Port = 587;
		
			if (!is_null($this->config->smtp_security)) {
				$mail->SMTPSecure = $this->config->smtp_security;
			}
		}
		
		$mail->From = $this->config->site_email;
		$mail->FromName = $this->config->site_name;
		$mail->isHTML(true);
		$this->mailer = $mail;
		
	}
		
	public function sendMail($email,$subject,$body) {
		
		$return = array('success'=>true);
		
		$this->mailer->addAddress($email);
		$this->mailer->Subject = $subject;  // sprintf into lang
		$this->mailer->Body = $body;
//		$mail->AltBody = $mail->Body;
		
		if (!$this->mailer->send()) {
			$return['success']= false;
			$return['message'] = $this->mailer->ErrorInfo;
		}
	
		return $return;
	
	}
	

	public function subject($subject) {
	
		$this->mailer->Subject = $subject;
	
	}

	public function from($email,$name) {
	
		$this->mailer->From = $email;
		$this->mailer->FromName = $name;
		
	}
	
	public function to($to) {
		$this->mailer->addAddress($to);
	}
	
	
	
	public function message($message) {
		$this->mailer->Body = $message;
	}


	public function send() {
		
		$return = array('success'=>true);
		
		if (!$this->mailer->send()) {
			$return['success']= false;
			$return['message'] = $this->mailer->ErrorInfo;
		}
		
		return $return;
		
	}
	
	
	
	
	
	
}
	
