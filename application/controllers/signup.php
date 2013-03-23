<?php

class Signup extends CI_controller {

	public function index() {
		$formValidationConfig = array(
               						array(
                     					'field'   => 'email', 
                     					'label'   => 'Email', 
                     					'rules'   => 'trim|required|valid_email|callback__isEmailUnique'
                  					),
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
                                 array(
                                    'field'   => 'captcha_input', 
                                    'label'   => 'CAPTCHA', 
                                    'rules'   => 'callback__captchaCheck'
                                 )
            					);

		if (!empty($_POST)) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules($formValidationConfig);
			$this->form_validation->set_error_delimiters('<p class="text-error">', '</p>');

			if ($this->form_validation->run() == true) {
				$this->load->model('user_model');
				$userId = $this->user_model->create($this->input->post('email'),
										                  $this->input->post('password'),
										                  $this->input->post('first_name'),
										                  $this->input->post('last_name'),
										                  false);

            $this->session->set_userdata('email', $this->input->post('email'));
				redirect("signup/complete/$userId");
			}
		}

      $this->load->view('signup', $this->_getNewCaptcha());
	}

   public function new_code() {
      $this->load->view('signup', $this->_getNewCaptcha());
   }

   public function complete($userId) {
      $this->load->model('activationcode_model');
      $this->load->library('mailsender');
      $this->load->model('user_model');

      $user = $this->user_model->get($userId);
      $activationCode = $this->activationcode_model->create($userId);
      $activationLink = base_url() . "index.php/signup/activate/$userId/$activationCode";
      $this->mailsender->sendActivationMail($user->email, $activationLink);

      $this->load->view('signup_complete', array('activationLink' => $activationLink));
   }

   public function activate($userId, $activationCode = "") {
      $this->load->model('activationcode_model');
      $this->load->model('user_model');

      try {
         $codeId = $this->activationcode_model->get($userId, $activationCode);
         $this->activationcode_model->delete($codeId);
         $this->user_model->activate($userId);
         $this->load->view('account_activated');
      }
      catch (ActivationCodeDoesNotExistException $e) {
         show_404(); 
      }
   }

   public function _captchaCheck() {
      $this->load->model('captcha_model');

      if ($this->captcha_model->check($this->input->post('captcha_id'),
                                      $this->input->post('captcha_input'))) {
         return true; 
      }
      else {
         $this->form_validation->set_message('_captchaCheck', 'The code is not correct.');
         return false;
      }
   }

   public function _isEmailUnique() {
      $this->load->model('user_model');

      if ($this->user_model->userExists($this->input->post('email')) == false) {
         return true;
      }
      else {
         $this->form_validation->set_message('_isEmailUnique', 'The email already exists.');
         return false;
      }
   }

   private function _getNewCaptcha() {
      $this->load->model('captcha_model');
      $captcha = $this->captcha_model->create();
      $data = array();
      $data['captcha'] = $captcha['image'];
      $data['captcha_id'] = $captcha['id'];

      return $data;
   }

}