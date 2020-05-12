<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UsersModel');
	}

	public function index(){
		redirect('auth/login');
	}

	public function login()
	{
		if ($_POST) {
			$this->setLoginValidationRules();
			if ($this->form_validation->run() == TRUE) {
				$userData = $this->UsersModel->authentication($this->input->post('email'), $this->input->post('password'));
				if($userData){
					$this->session->set_userdata('userSessionData', $userData);
					$this->userRedirection();
				}else{
					$data['failed'] = TRUE;
					$this->load->view('auth/login', $data);
				}
			} else {
				$this->load->view('auth/login');
			}
		} else {
			$this->load->view('auth/login');
		}
	}

	public function register()
	{
		if ($_POST) {
			$this->setRegisterValidationRules();
			if ($this->form_validation->run() == TRUE) {
				$userData = array(
					'name' => strip_tags($this->input->post('name')),
					'email' => strip_tags($this->input->post('email')),
					'password' => md5($this->input->post('password'))
				);
				$userData['id'] = $this->UsersModel->createUser($userData);
				if ($userData['id']) {
					unset($userData['password']);
					$this->session->set_userdata('userSessionData', $userData);
					$this->userRedirection();
				}else{
					redirect('auth/register');
				}
			} else {
				$this->load->view('auth/register');
			}
		} else {
			$this->load->view('auth/register');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('userSessionData');
		redirect('auth/login');
	}

	private function userRedirection(){
		$redirectUrl = $this->session->userdata('redirectUrl');
		if($redirectUrl){
			$this->session->set_userdata('redirectUrl', '');
			redirect($redirectUrl);
		}else if(isSuperAdmin()){
			redirect('superadmin');
		}else if(isAdmin()){
			redirect('admin');
		}else{
			redirect('home');
		}
	}

	private function setRegisterValidationRules()
	{
		$config = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|is_unique[users.email]|valid_email'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[8]'
			),
			array(
				'field' => 'password_confirmation',
				'label' => 'Password Confirmation',
				'rules' => 'trim|required|matches[password]'
			)

		);
		$this->form_validation->set_rules($config);
	}

	private function setLoginValidationRules()
	{
		$config = array(
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required'
			)
		);
		$this->form_validation->set_rules($config);
	}
}
