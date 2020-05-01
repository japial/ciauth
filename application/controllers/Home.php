<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if(authentic()){
			$data['user'] = authentic();
			$this->load->view('home', $data);
		}else{
			redirect('auth/login');
		}
	}
}
