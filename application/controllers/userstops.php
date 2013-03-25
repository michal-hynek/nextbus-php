<?php

require_once('restricted.php');
require_once(APPPATH . 'exceptions/UserStopAlreadyExistsException.php');
require_once(APPPATH . 'exceptions/StopNotFoundException.php');
require_once(APPPATH . 'exceptions/UserHasNoStopsException.php');

define('MAXIMUM_ROWS_TO_DISPLAY', 5);

class UserStops extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('userstops_model');

	}


	public function index() {

		$data = array();
		$data['user_id'] = 1;  // generic user ID.  Will grab from session information later
		
		try {

			$data['stops'] = $this->userstops_model->getUserStops($data['user_id']); 
			$data['stop_names'] = $this->userstops_model->getStopNames($data['stops']);

		}
		catch (UserHasNoStopsException $e) {
			$data['errorMessage'] = "You currently have no saved stops.";
		}
		catch (StopNotFoundException $e) {
			$data['errorMessage'] = "Stop(s) not found.";
		}

		// add the data for each stop
		for ( $i = 0; $i < count($data['stops']); $i++ ) {

			$stopCode = $data['stops'][$i];  // assigns the stop number as the$stopCode/element
			$data['stop_data'][$stopCode] = $this->userstops_model->get_arrivals($stopCode);
			$data['stop_data'][$stopCode]['number_of_buses'] = sizeof($data['stop_data'][$stopCode]);

		}

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
	* param: int $stopCode
	*/
	public function show_stop($stopCode) {

		$data = array();

		$data['user_id'] = 1;  // generic user ID.  Will grab from session information later

		try {

			$data['stops'] = $this->userstops_model->getUserStops($data['user_id']);
			$data['stop_names'] = $this->userstops_model->getStopNames($data['stops']); 
		}
		catch (UserHasNoStopsException $e) {
			$data['errorMessage'] = "You currently have no saved stops.";
		}
		catch (StopNotFoundException $e) {
			$data['errorMessage'] = "Stop(s) not found.";
		}

		$data['single_stop'] = $stopCode; 
		$data['stop_data'][$stopCode] = $this->userstops_model->get_arrivals($stopCode);
		$data['stop_data'][$stopCode]['number_of_buses'] = sizeof($data['stop_data'][$stopCode]);

		$this->load->view('single_stop', $data);

	}
		
}