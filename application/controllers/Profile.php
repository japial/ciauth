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
}
