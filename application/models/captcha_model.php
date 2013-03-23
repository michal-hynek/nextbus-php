<?php

class Captcha_model extends CI_model {

	private static $captchaExpireTimeout;
	private static $captchaDir;

	public function __construct() {
		self::$captchaExpireTimeout = 1200;				// 20 minute timeout
		self::$captchaDir = BASEPATH . '../captcha';
	}

	public function create() {
		$this->load->helper('captcha');

		$config = array(
    		'img_path'	 	=> BASEPATH . '../captcha/',
    		'img_url'	 	=> base_url() . 'captcha/',
    		'font_path'		=> BASEPATH . '../assets/fonts/Ubuntu-B.ttf'
    	);

		$captcha = create_captcha($config);

		$data = array(
    		'captcha_time'	=> $captcha['time'],
    		'ip_address'	=> $this->input->ip_address(),
    		'word'	 => $captcha['word']
    	);

		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
		$captcha['id'] = $this->db->insert_id();

		return $captcha;
	}

	public function check($captchaId, $captchaCode) {
		// First, delete old captchas
		$expiration = time() - self::$captchaExpireTimeout;
		$this->deleteExpiredCaptchas($expiration);

		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM " . $this->db->dbprefix('captcha') . 
			   " WHERE captcha_id = ? AND word = ? AND captcha_time > ?";
		$query = $this->db->query($sql, array($captchaId, $captchaCode, $expiration));
		$row = $query->row();

		return $row->count == 1;
	}

	private function deleteExpiredCaptchas($expiration) {
		// delete CAPTCHAs from the database
		$this->db->query("DELETE FROM " . $this->db->dbprefix('captcha') . " WHERE captcha_time < " . $expiration);	

		// delete CAPTCHA images from the drive
		if ($handle = opendir(self::$captchaDir)) {
    		while (false !== ($file = readdir($handle))) {
        		$filepath = self::$captchaDir . '/' . $file;
        		if (is_dir($filepath) == false && filectime($filepath) <= $expiration) {
           			unlink($filepath);
        		}
    		}

    		closedir($handle);
		}
	}

}