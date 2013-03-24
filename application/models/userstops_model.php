<?php 

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