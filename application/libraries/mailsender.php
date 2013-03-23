<?php

class MailSender {

	const FROM_EMAIL = 'michal.hyn3k@gmail.com';
	const FROM_NAME = 'NextBus';

	private $CI;

	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->library('email');
	}	

	public function sendActivationMail($email, $activationLink) {
		$this->_sendMail($email, 'Welcome to NextBus', 
								 "Thank you for creating the account.\n\nPlease click the link below to activate it.\n\n$activationLink");
	}	

	public function sendPasswordResetMail($email, $newPassword) {
		$this->_sendMail($email, 'NextBus: Password Reset',
								 "Your password has been reset.\n\nThe new password is $newPassword");
	}

	public function sendAccountLockedEmail($email, $newPasswordLink) {
		$this->_sendMail($email, 'NextBus: Account was locked',
								 "Your account was blocked due to too many failed login attempts\n\n".
								 "Click the link below to set the new password and activate the account\n\n".
								 $newPasswordLink);
	}

	private function _sendMail($to, $subject, $message) {
		$this->_initialize();

        $this->CI->email->from(self::FROM_EMAIL, self::FROM_NAME);
        $this->CI->email->to($to); 
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);  

        $this->CI->email->send();
	}

	private function _initialize() {
        $this->CI->email->initialize($this->_getConfig());
	}

	private function _getConfig() {
		$config['protocol']		= 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = self::FROM_EMAIL;
        $config['smtp_pass']    = 'Pa55w0rd1!4c0mp2920';
        $config['charset']		= 'utf-8';
        $config['newline']		= "\r\n";
        $config['mailtype']		= 'text'; // or html
        $config['validation']	= TRUE; // bool whether to validate email or not      

        return $config;
	}


}