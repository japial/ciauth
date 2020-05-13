<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if(isAdmin()){
			redirect('admin');
		}
	}

	public function index()
	{
		$data['user'] = authentic();
		renderView('user/home', $data);
	}
}
