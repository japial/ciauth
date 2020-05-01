<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! function_exists('authentic'))
{
	function authentic()
	{
		$CI =& get_instance();
		$authUser = $CI->session->userdata('userSessionData');
		if($authUser){
			return (object) $authUser;
		}else{
			return FALSE;
		}
	}

	function isAdmin()
	{
		$CI =& get_instance();
		$CI->load->model('UsersModel');
		$authUser = $CI->session->userdata('userSessionData');
		$userRoles = $CI->UsersModel->userRoles($authUser->id);
		if(in_array('admin', $userRoles)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
