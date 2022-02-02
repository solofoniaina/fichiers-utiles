<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Magasin extends CI_Controller {

	
	public function index()
	{
			$this->load->view('magasin/magasin');
		
	}
	public function details($id_package)
	{
		$pack = array();
		$pack['id_package'] = $id_package;
			$this->load->view('magasin/details_package',$pack);
		
	}
	public function search()
	{
		$search = array();
		$search['critere'] = $_GET['key'];			
		$this->load->view('magasin/magasin',$search);
		
	}
	public function panier()
	{
			$this->load->view('magasin/panier');
		
	}
	public function mes_packages()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/package');
		}
	}

	public function packages($id_package)
	{
		
		$prod = array();
		$prod['id_package'] = $id_package;
		$this->load->view('membre/produit',$prod);	
	}
}
?>