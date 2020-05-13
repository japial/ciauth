<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!isSuperAdmin() && !isAdmin()){
			redirect('home');
		}
	}

	public function index()
	{
		$data['user'] = authentic();
		renderView('admin/home', $data);
	}
}
