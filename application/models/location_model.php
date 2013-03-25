<?php

require_once APPPATH . 'exceptions/LocationNotFoundException.php';

class Location_model extends CI_model {


	public function findStopsNearLocation($searchInput, $radius) {
		$stops = array();
		$locations = $this->getByName($searchInput);

		foreach ($locations as $location) {
			$longitude = $location->longitude;
			$latitude = $location->latitude;
			$minLongitude = $longitude - ($radius / 111);
			$maxLongitude = $longitude + ($radius / 111);

			$minLatitude = $latitude - ($radius / 111);
			$maxLatitude = $latitude + ($radius / 111);

			$sql =	"select * from " . $this->db->dbprefix('stops') . " " .
					"where longitude >= ? and longitude <= ? and " .
					"latitude >= ? and latitude <= ?";
			$query = $this->db->query($sql, array($minLongitude, $maxLongitude, $minLatitude, $maxLatitude));

			$stops = array_merge($stops, $query->result());
		}

		return $stops;
	}

	public function getByName($name) {
		$query = $this->db->from($this->db->dbprefix('locations'))->like('name', $name)->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return array();
		}
	}

}