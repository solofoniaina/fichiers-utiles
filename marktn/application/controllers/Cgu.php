<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Cgu extends CI_Controller {

	
	public function index()
	{
		$this->load->view('cgu');
	}
}
?>