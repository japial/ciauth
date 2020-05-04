<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if(authentic()){
			if(isAdmin()){
				redirect('admin');
			}
		}else{
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['user'] = authentic();
		$this->load->view('home', $data);
	}
}
