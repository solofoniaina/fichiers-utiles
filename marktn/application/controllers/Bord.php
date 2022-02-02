<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Bord extends CI_Controller {

	public function membre()
	{
		if (isset($_SESSION['session_simpleadmin']) || isset($_SESSION['session_superadmin'])) 
		{
			$this->load->view('bord/membres');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function commande()
	{
		if (isset($_SESSION['session_simpleadmin']) || isset($_SESSION['session_superadmin'])) 
		{
			$this->load->view('bord/commandes');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function loca_agence()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('bord/loca_agence');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function loca_destination()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('bord/loca_destination');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function commande_par_agence()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$array = array();
			$array['id_agence'] = $_GET['p'];
			$this->load->view('admin/commande_par_agence', $array);
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function commande_destination()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/commande_destination');
		}
		else
		{
			$this->load->view('connexion');
		}
	}

	public function commande_details()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$array = array();
			$array['id_vente'] = $_GET['p'];
			$this->load->view('admin/commande_details', $array);
		}
		else
		{
			$this->load->view('connexion');
		}
	}
}
?>