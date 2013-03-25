<?php 

require_once(APPPATH . 'exceptions/UserStopAlreadyExistsException.php');
require_once(APPPATH . 'exceptions/StopNotFoundException.php');

class Userstops_model extends CI_model {

	public function __construct() {
		parent::__construct();
		$this->load->library('translinkapiadapter', $this->getConfig());
	}


	/**
	* Gets all of the arriving buses from a specific stop number
	* param: int $stopNumber
	* return: array[array[string]] arrivals
	*/
	public function get_arrivals($stopNumber) {
		$arrivals = $this->translinkapiadapter->getArrivals($stopNumber);
		$this->load->helper('sort');
		$arrivals = sortArrivals($arrivals);

		$i = 0;
		$arrivalData = array();

		foreach ($arrivals as $arrival) {
			$arrivalData[$i] = array(	'bus_number' 	=> $arrival->getBusNumber(), 
										'destination' 	=> $arrival->getDestination(), 
										'time' 			=> $arrival->getMinutesTillArrival());
			$i++;
			
		}

		return $arrivalData;
	}

	public function add($userId, $stopCode) {
		$stopQuery = $this->db->from($this->db->dbprefix('stops'))->where('code', $stopCode)->get();

		if ($stopQuery->num_rows() > 0) {
			$stopId = $stopQuery->row()->code;

			// check the stop is not already added
			$uniqueQuery = $this->db
								->from($this->db->dbprefix('user_stops'))
								->where(array('stop_id' => $stopId, 'user_id' => $userId))->get();
			if ($uniqueQuery->num_rows == 0) {
				$this->db->insert($this->db->dbprefix('user_stops'), array('user_id' => $userId, 'stop_id' => $stopId));	
			}
			else {
				throw new UserStopAlreadyExistsException("User already has the stop with code '$stopCode'");
			}
		}
		else {
			throw new StopNotFoundException("Stop with code '$stopCode' doesn't exist");
		}
	}


	/*
	* Returns an array of stop numbers belonging to a specific user ID
	* param: int $userId
	* return: array[int] $stops
	* throws: UserHasNoStopsException 
	*/
	public function getUserStops($userId)  {
		
		$stops = array();
		$userStopsQuery = $this->db->from($this->db->dbprefix('user_stops'))->where('user_id', $userId)->get();

		if ($userStopsQuery->num_rows() > 0)  {
			$results = $userStopsQuery->result_array();

			foreach( $results as $row ) {
				$stops[] = $row['stop_id'];
			}

			return $stops;
		}
		else {
			throw new UserHasNoStopsException("No stops have been added.");
		}


	}

	/*
	* Retrieves the name of the stop from the database
	* param: array[int] $stopCodes 
	* return: array[string] $stopNames
	*/
	public function getStopNames($stopCodes) {

	//	$sql = "select * from " . $this->db->dbprefix("stops") . " where code in (?)";
	//	$stopNamesQuery = $this->db->query($sql, implode(",", $stopCodes));
	//	$codes = implode(",", $stopCodes);
		
		$stopNamesQuery = $this->db->from($this->db->dbprefix('stops'))->where_in('code', $stopCodes)->get();

		if ($stopNamesQuery->num_rows() > 0)  {
			$results = $stopNamesQuery->result_array();
			foreach( $results as $row ) {
				$stopNames[$row['code']] = $row['description'];
			}

			return $stopNames;
		}
		else {
			throw new StopNotFoundException("Stop(s) not found.");
		}
	}

	private function getConfig() {
		$this->load->library('restapiclient');
		$this->load->library('translinkapiparser');

		$config = array();
		$config['restClient'] = $this->restapiclient;
		$config['APIKey'] = '2YKG0XDLT8lPgbrkUGY8';
		$config['parser'] =	$this->translinkapiparser;

		return $config;
	}
}