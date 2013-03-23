<?php

class Password extends CI_controller {

	public function forgot_password() {
		$this->load->view('forgot_password');
	}

	public function reset_password() {
		$this->load->model('user_model');

		try {
			$this->session->set_userdata('email', $this->input->post('email'));
			$user = $this->user_model->getByEmail($this->input->post('email'));
			$newPassword = $this->user_model->resetPassword($user->id);
			$this->user_model->unlockAccount($user->id);

			$this->load->library('mailsender');
			$this->mailsender->sendPasswordResetMail($this->input->post('email'), $newPassword);
			$this->load->view('reset_password');
		}
		catch (UserDoesNotExistException $e) {
			$data = array();
			$data['resetError']	= "Account " . $this->input->post('email') . " doesn't exist";

			$this->load->view('forgot_password', $data);
		}

	}

	public function new_password($userId, $code) {
    	$this->load->model('user_model');

    	if (!empty($_POST)) {
    		$formValidationConfig = array(
               							array(
                     						'field'   => 'password', 
                     						'label'   => 'Password', 
                     						'rules'   => 'trim|required|matches[confirm_password]'
                  						),
               							array(
                     						'field'   => 'confirm_password', 
                     						'label'   => 'Password Confirmation', 
                     						'rules'   => 'trim|required'
                  						), 
            						);

			$this->load->library('form_validation');
			$this->form_validation->set_rules($formValidationConfig);
			$this->form_validation->set_error_delimiters('<p class="text-error">', '</p>');

    		if ($this->form_validation->run() == true) {
    			$this->user_model->unlockAccount($userId);
    			$this->user_model->resetPassword($userId, $this->input->post('password'));
    			$this->load->view('new_password_set');
    		}
    		else {
    			$this->load->view('new_password');
    		}
    	}
    	else {
	    	try {
				$this->load->model('activationcode_model');
	    		$codeId = $this->activationcode_model->get($userId, $code);
	    		$this->activationcode_model->delete($codeId);
	    		$this->load->view('new_password');
	    	}
	    	catch (ActivationCodeDoesNotExistException $e) {
	    		show_404(); 
	    	}
    	}
	}

}