<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UsersModel');
	}

	public function index()
	{
		$authUser = authentic();
		$data['user'] = $this->UsersModel->find($authUser->id);
		$this->load->view('profile/user', $data);
	}

	public function update()
	{
		$authUser = authentic();
		$this->setUpdateValidationRules();
		if ($this->form_validation->run() == TRUE) {
			$userData = array(
				'name' => strip_tags($this->input->post('name')),
				'email' => strip_tags($this->input->post('email'))
			);
			if($this->emailAvailable($authUser->email, $userData['email'])){
				$this->UsersModel->updateUserInfo($authUser->id, $userData);
				$this->session->set_userdata('userSessionData',  $this->UsersModel->find($authUser->id));
				$this->session->set_flashdata('success', 'Your Information Updated');
			}else{
				$this->session->set_flashdata('emailError', 'This Email Already Used');
			}
			redirect('profile');
		} else {
			$data['user'] = $this->UsersModel->find($authUser->id);
			$this->load->view('profile/user', $data);
		}
	}

	private function emailAvailable($userEmail, $updatedEmail){
		if($userEmail == $updatedEmail){
			return TRUE;
		}else{
			$available = $this->UsersModel->isUserEmailAvailable($updatedEmail);
			if($available){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	private function setUpdateValidationRules()
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
				'rules' => 'trim|required|valid_email'
			)
		);
		$this->form_validation->set_rules($config);
	}
}
