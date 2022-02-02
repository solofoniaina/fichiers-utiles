<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Share extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function up($par)
	{
		$par = str_replace("MB","" , $par);
		$par = str_replace("MC","" , $par);
		$par = str_replace("MD","" , $par);
		$par = str_replace("ME","" , $par);
		$par = str_replace("MF","" , $par);
		$par = str_replace("MG","" , $par);
		$_SESSION['id_parrain'] = intval($par);
		$this->load->view('index_accueil');
	}
	public function prod($id_package,$par)
	{
		$par = str_replace("MC","" , $par);
		$par = str_replace("MD","" , $par);
		$par = str_replace("ME","" , $par);
		$par = str_replace("MF","" , $par);
		$par = str_replace("MG","" , $par);
		$_SESSION['id_parrain'] = intval($par);

		$pack = array();
		$pack['id_package'] = $id_package;
		$this->load->view('magasin/index_details_package',$pack);
	}
}
?>