<?php

class PasswordNotCorrectException extends Exception {

	private $userId;
	private $isAccountLocked;

	public function __construct($message, $userId, $isAccountLocked) {
		parent::__construct($message);
		$this->userId = $userId;
		$this->isAccountLocked = $isAccountLocked;
	}

	public function getUserId() {
		return $this->userId;	
	}

	public function isAccountLocked() {
		return $this->isAccountLocked;
	}

}