<?php

require_once('restricted.php');

class UserStops extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('userstops_model');

	}


	public function index() {
		$data = array();
		$data['stops'] = array(50325, 50326); // stops will be coming into the tool as an array of up to 4 numbers only the first four entries will be accepted	$data = array();

		for ( $i = 0; $i < count($data['stops']); $i++ ) {
			$data['stop_data'][$i] = $this->userstops_model->get_arrivals($data['stops'][$i]);
		}

		print_r($data['stops']);
		echo "<br>";
		echo "<br>";
		print_r($data['stop_data']);
	}
		
}