<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(authentic()){
			if(!isAdmin()){
				redirect('home');
			}
		}else{
			redirect('auth/login');
		}
	}

	public function index()
	{

		$data['user'] = authentic();
		$this->load->view('admin', $data);

	}
}
