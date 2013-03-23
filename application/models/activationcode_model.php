<?php

require_once(APPPATH . 'exceptions/ActivationCodeDoesNotExistException.php');

class ActivationCode_model extends CI_model {
	
	public function create($userId) {
		$code = md5(rand());
		$this->db->insert($this->db->dbprefix('activation_codes'), array(
							'user_id' 	=> $userId,
							'code'		=> $code
						 )
		);

		return $code;
	}

	public function get($userId, $code) {
		$query = $this->db->from($this->db->dbprefix('activation_codes'))
						  ->where('user_id', $userId)->where('code', $code)->get();

		if ($query->num_rows() == 0) {
			throw new ActivationCodeDoesNotExistException("Activation code $code for user id $userId does not exist.");
		}

		$code = $query->result();

		return $code[0]->id;	
	}

	public function delete($id) {
		$this->db->query("DELETE FROM " . $this->db->dbprefix('activation_codes') . " WHERE id = ?", $id);
	}

}