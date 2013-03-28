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

	/**
	* index Function loads the data for the main userstops.php view
	*/
	public function index() {

		$data = array();
		$data['user_id'] = $this->session->userdata('user_id'); 

		try {

			$data['stops'] = $this->userstops_model->getUserStops($data['user_id']); 
			$data['stop_names'] = $this->userstops_model->getStopNames($data['stops']);

		}
		catch (UserHasNoStopsException $e) {
			$data['errorMessage'] = "You currently have no saved stops.";
			$data['stops'] = NULL;
		}
		catch (StopNotFoundException $e) {
			$data['errorMessage'] = "Stop(s) not found.";
			return;
		}

		// add the data for each stop
		for ( $i = 0; $i < count($data['stops']); $i++ ) {

			$stopCode = $data['stops'][$i];  // assigns the stop number as the$stopCode/element
			$data['stop_data'][$stopCode] = $this->userstops_model->get_arrivals($stopCode);
			$data['stop_data'][$stopCode]['number_of_buses'] = sizeof($data['stop_data'][$stopCode]);
		}

		$data['show_all'] = FALSE;
		$this->load->view('userstops', $data);

	}

	/**
	* Function attempts to add the requested stop the user_stops table in DB
	* param: int $userId, int $stopCode
	*/
	public function add($userId, $stopCode) {
		
		$data = array();
		$data['user_id'] = $this->session->userdata('user_id');  
		$success = true;

		try {
			$this->userstops_model->add($userId, $stopCode);
			$data['infoMessage'] = "The stop with code '$stopCode' was added.";
		}
		catch (UserStopAlreadyExistsException $e) {
			$success = false;
			$data['errorMessage'] = "You already have bus stop with code '$stopCode'.";
		}
		catch (StopNotFoundException $e) {
			$success = false;
			$data['errorMessage'] = "The stop with code '$stopCode' doesn't exist.";
		}

		// Now add general stops data for the views
		try {

			$data['stops'] = $this->userstops_model->getUserStops($data['user_id']); 
			$data['stop_names'] = $this->userstops_model->getStopNames($data['stops']);

		}
		catch (UserHasNoStopsException $e) {
			$success = false;
			$data['errorMessage'] = "You currently have no saved stops.";
		}
		catch (StopNotFoundException $e) {
			$success = false;
			$data['errorMessage'] = "Stop(s) not found.";
		}

		$data['show_all'] = FALSE;

		// add random data to prevent AJAX caching
		$data['random']	= rand(1, 9999999999999999);

		echo json_encode($data);
	}


	/**
	* Function redirects to the single stop view when a user clicks on a saved station in their menu
	* param: int $stopCode
	*/
	public function show_stop($stopCode) {

		$data = array();
		$data['user_id'] = $this->session->userdata('user_id');

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

		$data['show_all'] = TRUE;

		$this->load->view('single_stop', $data);

	}

	/**
	* Function deletes the selected stop from 
	* param: int $userId, int $stopCode
	*/
	public function delete_stop($stopCode) {

		$data = array();
		$data['user_id'] = $this->session->userdata('user_id');

		$this->userstops_model->delete($data['user_id'], $stopCode);
		$this->index();
	}

}