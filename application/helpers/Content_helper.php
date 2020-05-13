<?php

if ( ! function_exists('fileUpload'))
{
	function fileUpload($path, $field, $encryptName = TRUE, $fileTypes = 0, $maxSize = 0)
	{
		if(!$fileTypes){
			$fileTypes = "gif|jpg|png|jpeg|pdf|psd|doc|pptx|docx|xls|mp4|3gp|zip|rar|mp3|xls|txt|xlsx|";
		}
		if(!$maxSize){
			$maxSize = 20000;
		}
		$CI =& get_instance();
		$config = array(
			'upload_path' => "./".$path,
			'allowed_types' => $fileTypes,
			'max_size' => $maxSize,
			'encrypt_name' => $encryptName
		);
		$CI->load->library('upload', $config);
		if ($CI->upload->do_upload($field)) {
			$data = $CI->upload->data();
			return array(
				'status' => 'success',
				'data' => $data['file_name']
			);
		} else {
			return array(
				'status' => 'error',
				'data' => $CI->upload->display_errors()
			);
		}
	}
}

if ( ! function_exists('renderView'))
{
	function renderView($path, $data = array()){
		$CI =& get_instance();
		$CI->load->view('layouts/header');
		$CI->load->view($path, $data);
		$CI->load->view('layouts/footer');
	}
}

if ( ! function_exists('generateRandomString')) {
	function generateRandomString($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
