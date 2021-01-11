<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Underconstruction extends MY_Controller
{
	public $data = [];
	public function index()
	{
		//cek_session_front();
		cek_session_offline();
		//$this->template->load(template().'/underconstruction',template().'/view_offline');
		//$this->template->load(template().'/views/template',template().'/views/view_home');

		$this->data['title'] = $this->lang->line('login_heading');

		// validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() === TRUE) {
				// check to see if the user is logging in
				// check for "remember me"
				$remember = (bool)$this->input->post('remember');

				if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
						//if the login is successful
						//redirect them back to the home page
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect('/', 'refresh');
					} else {
						// if the login was un-successful
						// redirect them back to the login page
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
					}
			} else {
				// the user is not logging in so display the login page
				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['identity'] = [
					'name' => 'identity',
					'id' => 'identity',
					'type' => 'text',
					'value' => $this->form_validation->set_value('identity'),
					'class' => 'form-control',
					'placeholder' => 'username/email',
				];

				$this->data['password'] = [
					'name' => 'password',
					'id' => 'password',
					'type' => 'password',
					'class' => 'form-control',
					'placeholder' => 'password',
				];

				$this->data['submit'] = [
					'name' => 'submit',
					'class' => 'btn float-right login_btn',
					'value' => 'Login',
				];

				//$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
				//$this->template->load('administrator/template','administrator/view_index');
				$this->template->load('administrator/template-login', 'auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
			}
	}
}
