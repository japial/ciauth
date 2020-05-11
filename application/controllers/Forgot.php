<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UsersModel');
	}

	public function index()
	{
		$this->load->view('auth/forgot');
	}

	public function send_email(){
		$this->form_validation->set_rules(array(
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email'
			)
		));
		if ($this->form_validation->run() == TRUE) {
			$userData = $this->UsersModel->userByEmail($this->input->post('email'));
			if($userData){
				$this->makePasswordReset($userData->email);
				redirect('forgot');
			}else{
				$data['failed'] = TRUE;
				$this->load->view('auth/forgot', $data);
			}
		} else {
			$this->load->view('auth/forgot');
		}
	}

	public function change_password(){
		$this->setPasswordValidationRules();
		if ($this->form_validation->run() == TRUE) {
			$resetToken = $this->UsersModel->passwordResetToken($this->input->post('token'));
			if($resetToken){
				$user = $this->UsersModel->userByEmail($resetToken->email);
				$userData['password'] = md5(strip_tags($this->input->post('password')));
				$this->UsersModel->updateUserPassword($user->id, $userData);
				$this->session->set_flashdata('success', 'Your Password Changed Successfully');
				redirect('auth/login');
			}else{
				$this->session->set_flashdata('error', 'Invalid Request');
				$this->load->view('auth/reset');
			}
		} else {
			$data['token'] = $this->input->post('token');
			$this->load->view('auth/reset', $data);
		}
	}

	public function reset_password($token = NULL){
		if($token){
			$resetToken = $this->UsersModel->passwordResetToken($token);
			if($resetToken){
				$difference = time() - strtotime($resetToken->created_at);
				if($difference < 900) {
					$data['token'] = $token;
					$this->load->view('auth/reset', $data);
				}else{
					$this->session->set_flashdata('timeError', 'Time Expired');
					redirect('forgot');
				}
			}else{
				$this->session->set_flashdata('timeError', 'Invalid URL');
				redirect('forgot');
			}
		}else{
			$this->session->set_flashdata('timeError', 'Invalid URL');
			redirect('forgot');
		}
	}

	private function makePasswordReset($email){
		$data['email'] = $email;
		$data['token'] = $this->generateRandomString(32);
		$lastTime = $this->UsersModel->lastPasswordResetTime($email);
		if($lastTime){
			$difference = time() - strtotime($lastTime->created_at);
			if($difference > 900) {
				$this->UsersModel->createPasswordReset($data);
				$this->sendVerificationEmail($email, $data['token']);
				$this->session->set_flashdata('success', 'Verification Email Sent');
			}else{
				$this->session->set_flashdata('timeError', 'Please Try After Sometime');
			}
		}else{
			$this->UsersModel->createPasswordReset($data);
			$this->sendVerificationEmail($email, $data['token']);
			$this->session->set_flashdata('success', 'Verification Email Sent');
		}
	}

	private function sendVerificationEmail($email, $token){
		$link = base_url('forgot/reset_password/'.$token);
		$message = 'Reset your password using this link: '.$link;
		$this->load->library('email');
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.mailtrap.io',
			'smtp_port' => 2525,
			'smtp_user' => 'username',
			'smtp_pass' => 'password',
			'crlf' => "\r\n",
			'newline' => "\r\n"
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
		$this->email->to($email);
		$this->email->from('demo@example.com', 'CI Auth');
		$this->email->subject('Password Reset');
		$this->email->message($message);
		$this->email->send();
		return TRUE;
	}

	private function generateRandomString($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	private function setPasswordValidationRules()
	{
		$config = array(
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
}
