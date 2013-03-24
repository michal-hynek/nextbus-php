<?php

require_once('restricted.php');
require_once(APPPATH . 'exceptions/UserStopAlreadyExistsException.php');
require_once(APPPATH . 'exceptions/StopNotFoundException.php');

define('MAXIMUM_ROWS_TO_DISPLAY', 5);

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

			$stopId = $data['stops'][$i];  // assigns the stop number as the$stopId/element
			$data['stop_data'][$stopId] = $this->userstops_model->get_arrivals($stopId);
			$data['stop_data'][$stopId]['number_of_buses'] = sizeof($data['stop_data'][$stopId]);

		}
	//	$data['stop_table'] = $this->load->view('stop_table', $data);
		$this->load->view('userstops', $data);
	}

	public function add($userId, $stopCode) {
		$data = array();

		try {
			$this->userstops_model->add($userId, $stopCode);
			$data['infoMessage'] = "The stop with code '$stopCode' was added.";
		}
		catch (UserStopAlreadyExistsException $e) {
			$data['errorMessage'] = "You already have bus stop with code '$stopCode'.";
		}
		catch (StopNotFoundException $e) {
			$data['errorMessage'] = "The stop with code '$stopCode' doesn't exist.";
		}

		$this->load->view('add_stop', $data);
	}


	/**
	* Function redirects to the single stop view when a user clicks on a saved station in their menu
	* param: int $stopId
	*/
	public function show_stop($stopId) {

		$data = array();
		$data['stops'][0] = $stopId;  // assigns the stop number as the$stopId/element.  There is only one in this case
		$data['stop_data'][$stopId] = $this->userstops_model->get_arrivals($stopId);
		$data['stop_data'][$stopId]['number_of_buses'] = sizeof($data['stop_data'][$stopId]);
	//	$data['stop_table'] = $this->load->view('stop_table', $data);

		$this->load->view('single_stop', $data);

	}
		
}