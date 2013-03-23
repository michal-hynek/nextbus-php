<?php

require_once('restricted.php');

class Application extends Restricted {
	
	public function logout() {
		$data = array();
		$data['email'] = $this->session->userdata('email');

		$this->session->set_userdata('is_logged_in', 'false');	
		$this->load->view('logout', $data);
	}

}