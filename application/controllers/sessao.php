<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessao extends CI_Controller {

	public function index()
	{
		$data['title'] = "Login";
		$this->load->view('login', $data);
	}
	
	public function login()
	{
		$data['title'] = "Login";
		$this->load->view('login', $data);
	}
	
	public function logout()
	{
		
	}
}

