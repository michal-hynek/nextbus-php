<?php

require_once('restricted.php');

class UserStops extends Restricted {

	public function __construct() {
		parent::__construct();
		$this->load->model('userstops_model');

	}


	public function index() {
		$data = array();
		$data['arrivals'] = $this->userstops_model->getArrivals();

		$this->load->view('userstops');
	}
		
}