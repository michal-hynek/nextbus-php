<?php

require_once APPPATH . 'exceptions/LocationNotFoundException.php';

class Location_model extends CI_model {


	public function findStopsNearLocation($searchInput, $radius) {
		$stops = array();
		$locations = $this->getByName($searchInput);

		foreach ($locations as $location) {
			$longitude = $location->longitude;
			$latitude = $location->latitude;

			$sql = "SELECT *, SQRT(" .
    				"POW(69.1 * (latitude - ?), 2) + " .
    				"POW(69.1 * (? - longitude) * COS(latitude / 57.3), 2)) AS distance " .
					"FROM " . $this->db->dbprefix("stops") . " HAVING distance < ? ORDER BY distance";
			$query = $this->db->query($sql, array($latitude, $longitude, $radius));
			
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