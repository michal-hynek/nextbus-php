<?php

require_once APPPATH . 'exceptions/StopNotFoundException.php';

class Stop_model extends CI_model {

	public function find($searchInput) {
		$stops = array();

		if (is_numeric($searchInput)) {
			try {
				$stops[0] = $this->stop_model->get($searchInput);
			}
			catch (StopNotFoundException $e) {
				return array();	
			}
		}

		return $stops;
	}

	public function get($code) {
		$query = $this->db->from($this->db->dbprefix('stops'))->where('code', $code)->get();

		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else {
			throw new StopNotFoundException("Stop with code '$code' doesn't exist");	
		}
	}

	
}