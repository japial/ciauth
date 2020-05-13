<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!isSuperAdmin()){
			redirect('home');
		}
	}

	public function index()
	{
		$data['user'] = authentic();
		renderView('super/home', $data);
	}
}
