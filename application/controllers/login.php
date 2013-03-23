<?php

require_once(BASEPATH . '../application/exceptions/UserDoesNotExistException.php');
require_once(BASEPATH . '../application/exceptions/PasswordNotCorrectException.php');

class Login extends CI_controller {

	const FAILED_LOGINS_LOCKOUT_THRESHOLD = 3;

	public function index() {
		$data = array();

		// redirect to the application home page if the user is already logged in
		if ($this->session->userdata('is_logged_in') == 'true') {
			redirect('/userstops/index');
		}

		// check the username and password if the user clicked log in button
		if (!empty($_POST)) {
			$this->load->model('user_model');

			try {
				$this->session->set_userdata('email', $this->input->post('email'));
				$user = $this->user_model->getByEmailAndPassword($this->input->post('email'), $this->input->post('password'));

		        // check if the account has been locked out
		        if ($user->is_locked) {
		        	$data['loginError'] = 'The account has been locked.';
		        }
		        else if ($user->is_activated == false) {
		        	$data['loginError'] = 'The account hasn\'t been activated yet.<br/>Click the activation link you received via email.';
		        }
		        else {
		        	// reset number of failed logins
		        	$this->user_model->resetNumberOfFailedLogins($user->id);
		        	// set session data
					$this->session->set_userdata('user_id', $user->id);
					$this->session->set_userdata('is_logged_in', 'true');
					redirect('/userstops/index');
				}
			}
			catch (UserDoesNotExistException $e) {
				$data['loginError'] = 'Email or password is not correct.';
			}
			catch (PasswordNotCorrectException $e) {
				$numOfFailedLogins = $this->user_model->increaseNumberOfFailedLogins($e->getUserId());
				if ($numOfFailedLogins >= self::FAILED_LOGINS_LOCKOUT_THRESHOLD || $e->isAccountLocked()) {
					$this->user_model->lockAccount($e->getUserId());
					$data['loginError'] = 'The account has been locked.';

					// only send the email when the account is locked
					// subsequent login failures shouldn't send extra emails
					if ($e->isAccountLocked() == false) {
						$this->load->library('mailsender');
						$this->load->model('activationcode_model');
						$user = $this->user_model->get($e->getUserId());
						$activationCode = $this->activationcode_model->create($user->id);
      					$activationLink = base_url() . "index.php/password/new_password/$user->id/$activationCode";
						$this->mailsender->sendAccountLockedEmail($user->email, $activationLink);
					}
				}
				else {
					$data['loginError'] = 'Email or password is not correct.';
				}
			}
		}

		$this->load->view('login', $data);
	}
}

