<?php

class Arrival {

	private $busNumber;
	private $destination;
	private $minutesTillArrival;

	public function __construct($busNumber, $destination, $minutesTillArrival) {
		$this->setBusNumber($busNumber);
		$this->setDestination($destination);
		$this->setMinutesTillArrival($minutesTillArrival);
	}

	public final function getBusNumber() {
		return $this->busNumber;
	}

	public final function setBusNumber($busNumber) {
		$this->busNumber = $busNumber;
	}

	public final function getDestination() {
		return $this->destination;
	}

	public final function setDestination($destination) {
		$this->destination = $destination;
	}

	public final function getMinutesTillArrival() {
		return $this->minutesTillArrival;
	}

	public final function setMinutesTillArrival($minutesTillArrival) {
		if ($minutesTillArrival < 0) {
			$this->minutesTillArrival = 0;
		}
		else {
			$this->minutesTillArrival = $minutesTillArrival;
		}
	}

}