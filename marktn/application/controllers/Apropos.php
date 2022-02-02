<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Apropos extends CI_Controller {

	
	public function index()
	{
		$this->load->view('apropos');
	}
}
?>