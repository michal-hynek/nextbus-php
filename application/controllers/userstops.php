<?php

require_once('restricted.php');

class UserStops extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('userstops_model');

	}


	public function index() {



		$data = array();
		$data['stops'] = array(50325); // stops will be coming into the tool as an array of up to 4 numbers only the first four entries will be accepted	$data = array();

		// add the data for each stop
		for ( $i = 0; $i < count($data['stops']); $i++ ) {
			$stopNumber = $data['stops'][$i];  // assigns the stop number as the$stopNumber/element
			$data['stop_data'][$stopNumber] = $this->userstops_model->get_arrivals($stopNumber);
			$data['stop_data'][$stopNumber]['number_of_buses'] = sizeof($data['stop_data'][$stopNumber]);
		}

		$this->load->view('userstops', $data);
	}
		
}