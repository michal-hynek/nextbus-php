<?php

class Mockups extends CI_controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('translinkapiadapter', $this->getConfig());
	}
	
	public function index() {
		echo $this->translinkapiadapter->getNextBuses(50325);
	}

	public function main() {
		$this->load->view('mockups_main');
	}

	public function add_stop() {
		$this->load->view('mockups_add_stop');
	}

	public function get_arrivals() {
		$arrivals = $this->translinkapiadapter->getArrivals(50325);
		$this->load->helper('sort');
		$arrivals = sortArrivals($arrivals);

		foreach ($arrivals as $arrival) {
			echo $arrival->getBusNumber() . " " . $arrival->getDestination() . " " . $arrival->getMinutesTillArrival() . "<br/>";	
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