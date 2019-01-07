<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

	public function homePage()
	{
		$this->load->view('home');
	}

	public function userList()
	{
		$this->load->view('user_view');
	}
}
