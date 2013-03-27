<?php

require_once APPPATH . 'exceptions/StopNotFoundException.php';

class Stop_model extends CI_model {

	public function find($searchInput) {
		$stops = array();

		if (is_numeric($searchInput)) {
			try {
				$stops[0] = $this->getByCode($searchInput);
			}
			catch (StopNotFoundException $e) {
				return array();	
			}
		}
		else if (!empty($searchInput)) {
			// search by bus stop description
			try {
				$stops = $this->getByDescription($searchInput);
			}
			catch (StopNotFoundException $e) {
				return array();
			}
		}
		else {
			return array();
		}

		return $stops;
	}

	public function getByCode($code) {
		$query = $this->db->from($this->db->dbprefix('stops'))->where('code', $code)->get();

		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else {
			throw new StopNotFoundException("Stop with code '$code' doesn't exist");	
		}
	}

	public function getByDescription($description) {
		$searchFilter = "%" . $description . "%";
		// replace empty spaces with % for more userfriendly search results
		$searchFilter = preg_replace('/\s+/', '%', $searchFilter);
		$query = $this->db->query("select * from " . $this->db->dbprefix('stops') . " where description like ?", $searchFilter);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			throw new StopNotFoundException("Stop with name '$description' doesn't exist");	
		}
	}
}