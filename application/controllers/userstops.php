<?php

require_once('restricted.php');

class UserStops extends Restricted {

	public function index() {
		$this->load->view('userstops');
	}
		
}