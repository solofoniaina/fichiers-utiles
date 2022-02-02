<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Testpayer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
	
	} 

	//ACHAT
	public function payment_mobile() {
			$id_membre = (!empty($_SESSION['session_membre']) && $this->Membre_model->est_active($_SESSION['session_membre'])) ? $_SESSION['session_membre'] : '';
		if (!empty($id_membre)) {
			$m = $this->Membre_model->cemembre($id_membre);
			$id_parrain_v = $m[0]['id_parrain'];
		}
		elseif (!empty($_SESSION['id_parrain'])) {
			$id_parrain_v = $_SESSION['id_parrain'];
		}
		$montant = 0;
		if (!empty($_SESSION['panier'])) {
			foreach ($_SESSION['panier'] as $key => $id_package) {
				$mont= $this->Package_model->prixpackage($id_package);
				$this->Vente_model->insert($id_package,$id_membre, $id_parrain_v,$this->Membre_model->est_active($id_parrain_v), $mont, date('Y-m-d'));
				$montant += $mont;
			}
		}
		//Transférer le panier
		$_SESSION['panier_ok'] 	= $_SESSION['panier'];
		//vider le panier_ok
		$_SESSION['panier'] = array();
			$idpanier = date("mYdHis");
			$ref_arn = date("siH");
			$code_arn = date("Hi");
			$idpaiement = date("YmdHis");
			$nomPayeur = "Test nom payeur";
			$parametres = $this->Admin_model->get_parametres();
			$p = $parametres[0];
			$montant = $p['droit_inscription'];
			// LOGs DES PAIEMENTS EFFECTUES
			$this->Vente_model->log($idpaiement, $idpanier,$ref_arn,$code_arn,$nomPayeur, $montant, 1);
		$this->load->view('membre/index_achat');

	}
	//ABONNEMENT
	public function payment_vanilla() {
			if ($this->Membre_model->activer($_SESSION['session_membre'])) {
				$idpanier = date("mYdHis");
				$ref_arn = date("siH");
				$code_arn = date("Hi");
				$idpaiement = date("YmdHis");
				$nomPayeur = "Test nom payeur";
				$parametres = $this->Admin_model->get_parametres();
	    		$p = $parametres[0];
				$montant = $p['droit_inscription'];
				// LOGs DES PAIEMENTS EFFECTUES
				$this->Vente_model->log($idpaiement, $idpanier,$ref_arn,$code_arn,$_SESSION['session_membre'], $montant, 0);
			$this->load->view('membre/compte');
		}
			
	}
}