<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation extends CI_Controller {

	public function membre()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('validation/membres');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function produit()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('validation/produits');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function search_user_produit()
	{
		$array = array();
		$array['user'] = $_POST['user_srch']; 
		$array['produit'] = $_POST['produit_srch'];
		$this->load->view('validation/ajax/ajax_resultat_produit', $array);
	}
	public function search_paiement_produit()
	{
		$array = array();
		$array['user'] = $_POST['user_srch']; 
		$array['produit'] = $_POST['produit_srch'];
		$this->load->view('validation/ajax/ajax_paiement_produit', $array);
	}
	public function search_livraison_produit()
	{
		$array = array();
		$array['user'] = $_POST['user_srch']; 
		$array['produit'] = $_POST['produit_srch'];
		$this->load->view('validation/ajax/ajax_livraison_produit', $array);
	}
		public function search_rejet_produit()
	{
		$array = array();
		$array['user'] = $_POST['user_srch']; 
		$array['produit'] = $_POST['produit_srch'];
		$this->load->view('validation/ajax/ajax_rejet_produit', $array);
	}
	public function search_reception_produit()
	{
		$array = array();
		$array['user'] = $_POST['user_srch']; 
		$array['produit'] = $_POST['produit_srch'];
		$this->load->view('validation/ajax/ajax_reception_produit', $array);
	}
	public function search_recu_produit()
	{
		$array = array();
		$array['user'] = $_POST['user_srch']; 
		$array['produit'] = $_POST['produit_srch'];
		$this->load->view('validation/ajax/ajax_recu_produit', $array);
	}
	public function activation()
	{
		echo $this->Validation_model->valider_invalider($_POST['id_package'],$_POST['active']);
	}

	//apercu ID membre
	public function id_apercu($id_membre)
	{
		$array = array();
		$array['id_membre'] = $id_membre;
		$this->load->view('membre/identite_apercu', $array);
	}
	//Valider CIN
	public function valider_cin()
	{
		echo $this->Validation_model->valider_cin($_POST['id_membre']);
	}
}
?>