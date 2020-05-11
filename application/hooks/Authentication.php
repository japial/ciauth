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
		$fetchedClass = $this->CI->router->fetch_class();
		if ($authUser) {
			if ($fetchedClass == 'auth') {
				if ($this->CI->router->fetch_method() != 'logout') {
					redirect("home");
				}
			}
		} else {
			$guestClasses = array('welcome',  'forgot');
			if (in_array($fetchedClass, $guestClasses)) {
				return;
			} else if ($fetchedClass != 'auth') {
				$this->CI->session->set_userdata('redirectUrl', $this->CI->uri->uri_string());
				redirect("auth/login");
			}
		}
	}
}
