<?php
session_start();
//ini_set("allow_url_fopen", true);
defined('BASEPATH') OR exit('No direct script access allowed');

class Achat extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
	}
	public function succes()
	{
		
		/*$retour = array(
			"status" => "success",
			"order_id" => "54885555I",
			"amount" => "500",
			"pay_token" => "ksuyusejfrsefksef"
		); */
		//POUR TEST order_id
		//$_SESSION['order_id'] = "54885HR6I";
		if (!empty($_SESSION['order_id'])) 
		{
			$retour = $this->Admin_model->paiement_by_order_id($_SESSION['order_id']);
			if ($retour['status'] == "success") {

		#################################################################
				if (strpos($_SESSION['order_id'], "I")) {
					//PAIEMENT INSCRIPTION
					if ($this->Membre_model->activer($_SESSION['session_membre'])) {
						unset($_SESSION['order_id']);
						$this->load->view('membre/compte');
					}
				}
				//PAIEMENT ACHAT
				else
				{
					$id_membre = (!empty($_SESSION['session_membre']) && $this->Membre_model->est_active($_SESSION['session_membre'])) ? $_SESSION['session_membre'] : '';

					if (!empty($id_membre)) {
						$m = $this->Membre_model->cemembre($id_membre);
						$id_parrain_v = $m[0]['id_parrain'];
					}
					//MAHAZO GAIN NY PARRAIN NA TSY ACTIF ILAY MEMBRE EN COURS
					elseif(!empty($_SESSION['session_membre']))
					{
						$m = $this->Membre_model->cemembre($_SESSION['session_membre']);
						$id_parrain_v = $m[0]['id_parrain'];
					}
					elseif (!empty($_SESSION['id_parrain'])) {
						$id_parrain_v = $_SESSION['id_parrain'];
					}
					$montant = 0;
					if (!empty($_SESSION['panier'])) {
						foreach ($_SESSION['panier'] as $key => $id_package) {
							$mont= $this->Package_model->prixpackage($id_package);
							$this->Vente_model->insert($id_package,$id_membre, $id_parrain_v,$this->Membre_model->est_active($id_parrain_v), $mont, '1', date('Y-m-d'));
							$montant += $mont;
						}
					}
					//Transférer le panier
					$_SESSION['panier_ok'] 	= $_SESSION['panier'];
					//vider le panier_ok
					$_SESSION['panier'] = array();
					unset($_SESSION['order_id']);

					$this->load->view('magasin/paiement_success');
				}
		#################################################################
			}
			else
			{
				$this->load->view('magasin/paiement_error');
			}
		}
		else
		{
			$this->load->view('magasin/paiement_success');
			
		}	
	}
	public function produit()
	{
		#################################################################
		if (!empty($_POST['id_acheteur'])) {
			$_SESSION['session_acheteur'] = $_POST['id_acheteur'];
		}
		
		if ((!empty($_SESSION['session_membre']))) {
			$id_membre = $_SESSION['session_membre'];
		}
		elseif (!empty($_SESSION['session_acheteur'])) {
			$id_membre = $_SESSION['session_acheteur'];
		}

		if (!empty($id_membre)) {
			//A utiliser pour le choix de la position geographique
			$id_vente = array();
			$m = $this->Membre_model->cemembre($id_membre);
			$id_parrain_v = $m[0]['id_parrain'];
	
			$montant = 0;
			if (!empty($_SESSION['panier'])) {
				foreach ($_SESSION['panier'] as $key => $package) {
					$mont= $this->Package_model->prixpackage($package['id_package']);
					$id_vente[] = $this->Vente_model->insert($package['id_package'],$id_membre, $id_parrain_v,$this->Membre_model->est_active($id_parrain_v), $mont, $package['nombre_achat'], date('Y-m-d'));
					#27 12 2021 : Compte à rebours auto de la quantité en stock
					$this->Package_model->reduire_stock($package['id_package'],$package['nombre_achat']);
					$montant += $mont;
				}
			}
			//Transférer le panier
			$_SESSION['panier_ok'] 	= $_SESSION['panier'];
			//vider le panier_ok
			$_SESSION['panier'] = array();
			unset($_SESSION['order_id']);

			$_SESSION['id_vente'] = $id_vente;

			$this->load->view('membre/loca_achat_produit');

		}
		else echo "Une erreur s'est produite";
		#################################################################	
	}
	public function liste_achats()
	{
		$this->load->view('magasin/paiement_success');
	}
	public function erreur()
	{
		$this->load->view('magasin/paiement_error');
	}
	public function notification()
	{

	
		//True = changer en "ARRAY" au lieu de "OBJET"
		$retour = json_decode(file_get_contents('php://input'), TRUE);
	
		#################################################################
			if (strpos($retour['order_id'], "I")) {
				//PAIEMENT INSCRIPTION
				
					// LOGs DES PAIEMENTS EFFECTUES / 0:abonnement, 1:Achat
				$this->Vente_model->log($retour['order_id'], $retour['amount'],$retour['pay_token'],$retour['status'], 0);
			}
			//PAIEMENT ACHAT
			else
			{
				// LOGs DES PAIEMENTS EFFECTUES / 0:abonnement, 1:Achat
				$this->Vente_model->log($retour['order_id'], $retour['amount'],$retour['pay_token'],$retour['status'], 1);
				//$this->load->view('membre/index_achat');
			}
		#################################################################
		
	}

	public function carte()
	{
		$_SESSION['id_vente'] = array();
		$_SESSION['id_vente'][] = $_GET['v'];
		$array = array();
		$array['id_agence_modif'] = $_GET['a'];

		$this->load->view('membre/loca_modif_produit', $array);
	}
	public function location_livraison()
	{
		$newpoint 	= substr($_POST['newpoint'],6); //Point(329.5, 199)
		$newpoint 	= substr($newpoint, 0, -1);
		$newlatlng 	= substr($_POST['newlatlng'],7); //LatLng(-21.46339, 47.10859)
		$newlatlng 	= substr($newlatlng, 0, -1);
		$id_agence 	= $_POST['id_agence'];
		if (!empty($_SESSION['id_vente'])) {
			//POSSIBLE PLUSIEURS PRODUITS POUR UNE COMMANDE
			foreach ($_SESSION['id_vente'] as $key => $id_vente) {
				//FRAIS
				$loca = $this->Vente_model->cevente_localisation($id_vente);
				$frais = $this->Parametres_model->select_val($loca['depart'],$id_agence);

				$this->Vente_model->location_livraison($id_vente, $newlatlng, $newpoint, $id_agence, $frais);

			}
			unset($_SESSION['id_vente']);
		}
		

	$this->load->view('membre/achat_produit');
	}
}
?>