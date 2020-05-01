<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		if(authentic() && isAdmin()){
			$data['user'] = authentic();
			$this->load->view('admin', $data);
		}else{
			redirect('auth/login');
		}
	}
}
