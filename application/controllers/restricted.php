<?php

class Restricted extends CI_Controller {

	private $userId;

	public function __construct() {
		parent::__construct();

		// make sure the user is logged before letting him/her to access r
		// a page that requires him/her to be logged in
		if ($this->session->userdata('ip_address') == $_SERVER['REMOTE_ADDR'] &&
			$this->session->userdata('is_logged_in') == 'true') {
			$this->setUserId($this->session->userdata('user_id'));
			return;
		}
		else {
			redirect('/login/index');
		}
	}

	protected function getUserId() {
		return $this->userId;
	}

	private function setUserId($userId) {
		$this->userId = $userId;
	}

}

?>