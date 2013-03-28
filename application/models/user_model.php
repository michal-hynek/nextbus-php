<?php

require_once(BASEPATH . '../application/exceptions/UserDoesNotExistException.php');
require_once(BASEPATH . '../application/exceptions/PasswordNotCorrectException.php');

class User_model extends CI_model {

	private static $dateFormat;

	public function __construct() {
		date_default_timezone_set('America/Vancouver');
		parent::__construct();
		self::$dateFormat = "Y-m-d H:m:s";
	}	

	public function create($email, $password, $firstName, $lastName, $isActivated) {
		$this->db->insert($this->db->dbprefix('users'), array(
							'email' => $email,
							'password' => $this->hashPassword($password),
							'is_activated' => $isActivated,
							'date_created' => date(self::$dateFormat)
						 )
		);

		return $this->db->insert_id();
	}

	public function getByEmailAndPassword($email, $password) {
		$user = $this->getByEmail($email);

		if ($this->checkPassword($password, $user->password)) {
			return $user;
		}
		else {
			throw new PasswordNotCorrectException("The password is not correct.", $user->id, $user->is_locked);
		}
	}

	public function getByEmail($email) {
		$query = $this->db->from($this->db->dbprefix('users'))->where('email', $email)->get();

		if ($query->num_rows() == 0) {
			throw new UserDoesNotExistException("User with email $email does not exist.");
		}

		$user = $query->result();

		return $user[0];
	}

	public function get($userId) {
		$query = $this->db->from($this->db->dbprefix('users'))->where('id', $userId)->get();

		if ($query->num_rows() == 0) {
			throw new UserDoesNotExistException("User with id $userId does not exist.");
		}

		$user = $query->result();

		return $user[0];
	}

	public function userExists($email) {
		try {
			$this->getByEmail($email);
			return true;
		}	
		catch (UserDoesNotExistException $e) {
			return false;
		}
	}

	public function increaseNumberOfFailedLogins($userId) {
		$sql = "UPDATE " . $this->db->dbprefix('users') . " SET num_of_failed_logins = num_of_failed_logins + 1 where id = ? limit 1";
		$this->db->query($sql, array($userId));

		// return the number of failed logins
		$numOfFailedLoginsQuery = $this->db->from($this->db->dbprefix('users'))
										   ->select('num_of_failed_logins')
										   ->where('id', $userId)->get();
		$numOfFailedLoginsResult = $numOfFailedLoginsQuery->result();
		$numOfFailedLogins = $numOfFailedLoginsResult[0]->num_of_failed_logins;

		return $numOfFailedLogins;
	}

	public function resetNumberOfFailedLogins($userId) {
		$this->db->update($this->db->dbprefix('users'), array('num_of_failed_logins' => 0), "id = $userId");
	}

	public function lockAccount($userId) {
		$this->db->update($this->db->dbprefix('users'), array('is_locked' => true), "id = $userId");
	}

	public function unlockAccount($userId) {
		$this->db->update($this->db->dbprefix('users'), array('is_locked' => false), "id = $userId");
		$this->db->update($this->db->dbprefix('users'), array('num_of_failed_logins' => 0), "id = $userId");
	}

	public function activate($userId) {
		$this->db->update($this->db->dbprefix('users'), array('is_activated' => true), "id = $userId");
	}

	public function resetPassword($userId, $newPassword = '') {
		if ($newPassword == '') {
			$newPassword = substr(md5(rand()), 0, 15);
		}

		$this->db->update($this->db->dbprefix('users'), array('password' => $this->hashPassword($newPassword)), "id = $userId");

		return $newPassword;
	}

	private function checkPassword($password, $passwordHash) {
		return $this->hashPassword($password) == $passwordHash;
	}

	private function hashPassword($password) {
		$salt = '09ji;wj23[09rur[09uj23rewm,./mb_strwidth([weprtkr-0werfwiojaa;lkj121`"{()_U&$@"])';
		return sha1($password.$salt);
	}

}