<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Authentication
{
	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function check()
	{
		$authUser =  $this->CI->session->userdata('userSessionData');
		if ($authUser) {
			if ($this->CI->router->fetch_class() == 'auth') {
				if ($this->CI->router->fetch_method() != 'logout') {
					redirect("home");
				}
			}
		} else {
			if ($this->CI->router->fetch_class() == 'welcome') {
				//do nothing
			} else if ($this->CI->router->fetch_class() != 'auth') {
				$this->CI->session->set_userdata("redirect_url", $this->CI->uri->uri_string());
				redirect("auth/login");
			}
		}
	}
}
