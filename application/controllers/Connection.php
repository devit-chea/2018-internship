<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connection extends CI_Controller {
	/**
	 * Default constructor
	 * @author Benjamin BALET <benjamin.balet@gmail.com>
	 */
	public function __construct() {
			parent::__construct();
			log_message('debug', 'URI=' . $this->uri->uri_string());
	}

	/**
	 * Login form of the application
	 * @author Benjamin BALET <benjamin.balet@gmail.com>
	 */
	public function login()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('login', 'User Name', 'required|strip_tags');
			$this->form_validation->set_rules('password', 'Password', 'required|strip_tags');
			if ($this->form_validation->run() === FALSE) {
				log_message('debug', 'Let\'s display the login form');
				$data['title'] = 'Login';
				$data['flashPartialView'] = $this->load->view('templates/flash', $data, TRUE);
				// $this->load->view('templates/header', $data);
				$this->load->view('login/login', $data);
				// $this->load->view('templates/footer');
			} else {
				$this->load->model('users_model');
				$login = $this->input->post('login');
				$password = $this->input->post('password');
				// get role of users
				// $this->users_model->checkCredentials($login, $password)
				$role = $this->users_model->checkCredentials($login, $password);
				if ($this->users_model->checkCredentials($login, $password) != 0) {
				
					if ($role == 1) {
						log_message('debug', 'Not last_page set. Redirect to the home page');
						redirect('Welcome_IF/home');
					}
					if ($role == 2) {
						log_message('debug', 'Not last_page set. Redirect to the home page');
						redirect('tutorDas');
					}
					if ($role == 3) {
						log_message('debug', 'Not last_page set. Redirect to the home page');
						redirect('supervisor');
					}
					if ($role == 4) {
						log_message('debug', 'Not last_page set. Redirect to the home page');
						redirect('cStudent');
					}
				}else{
					log_message('debug', 'Not last_page set. Redirect to the home page');
						redirect('Connection/login');
				}
			}
		}

	/**
	 * logout endpoint. Destroy the PHP session
	 * @author Benjamin BALET <benjamin.balet@gmail.com>
	 */
	public function logout()
	{

		log_message('debug', 'Logout current user and redirect to the home page');
		$this->session->sess_destroy();
		redirect('Connection/login','refresh');
	}
}
