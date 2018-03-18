<?php

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function sudahLogin()
	{
		if($this->session->userdata('logged_in') == true) {
			redirect('dashboard');
		}
	}

	public function belumLogin()
	{	
		if($this->session->userdata('logged_in') != true) {
			redirect('login');
		}
	}

}
