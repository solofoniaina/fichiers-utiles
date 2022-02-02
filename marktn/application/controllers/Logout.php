<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		unset($_SESSION['session_membre']);
		unset($_SESSION['session_acheteur']);
		unset($_SESSION['session_admin']);
		unset($_SESSION['session_superadmin']);
		unset($_SESSION['session_simpleadmin']);
		unset($_SESSION['session_moderateur']);
		unset($_SESSION['panier']);
		$this->load->view('connexion');
	}
}
?>