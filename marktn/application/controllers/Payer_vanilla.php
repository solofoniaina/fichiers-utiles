<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Payer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
	
	}


	public function payment_mobile() {
			//CALCUL MONTANT
			$montant = 0;
			if (!empty($_SESSION['panier'])) {
				foreach ($_SESSION['panier'] as $key => $id_package) {
					$montant += $this->Package_model->prixpackage($id_package);
				}
			}
			//RECUP NOM & EMAIL
			if (empty($_SESSION['session_membre'])) {
				$nom = $_POST['nom_acheteur'];
				$email = $_POST['email_acheteur'];
			}
			else
			{
				$membre = $this->Membre_model->cemembre($_SESSION['session_membre']);
				$m = $membre[0];
				$nom = $m['nom_m'];
				$email = $m['email_m'];

			}


			$adresseip = $_SERVER['REMOTE_ADDR'];

			$idpanier = date("mYdHis");
			$reference = date("siH");
			
			$cle_prive = "7e9c80328e0a2bc5bae111dc39d6bf7df5d0219160ad8dfea8";
			$cle_public = "862c3a0d105be14d91335ec27aa59e19c83d2a5a2dcd192e6b";
			$CLIEN_ID = "271_4ow3yhzuevmsc4kggogw88wssoogk48k4kgco8ccc8wsowckgk";
			$CLIENT_SECRET = "1gpmg996930kcwwo8sowkcwocwccg4404gcocccksccw8kso44";
			$this->load->library('util');
			$this->load->library('crypt');
			$this->load->library('des_crypt');

			$params = array("public_key"=>$cle_public, "private_key"=>$cle_prive, "client_id"=>$CLIEN_ID, "client_secret"=>$CLIENT_SECRET);

			$this->load->library('paiement',$params);
			$paiement = new Paiement($params);

			//echo $montant ." - ". $nom ."-".$email."-".$idpanier."-".$reference."-".$adresseip; exit();


			$paiement->initPaie($idpanier,$montant,$nom,$reference,$adresseip,$email);
	}
	public function payment_vanilla() {
			$parametres = $this->Admin_model->get_parametres();
    		$p = $parametres[0];
			$montant = $p['droit_inscription'];

			//RECUP NOM & EMAIL
			$membre = $this->Membre_model->cemembre($_SESSION['session_membre']);
			$m = $membre[0];
			$nom = $m['nom_m'];
			$email = $m['email_m'];

			$adresseip = $_SERVER['REMOTE_ADDR']; 

			$idpanier = date("ImYdHis");
			$reference = date("siH");
			
			$cle_prive = "8985624be8a69c898020dd7e4587f23e804ce7497f476b7c5e";
			$cle_public = "f4842b362049e8a20a0d48e0979685c4126c85add9f1ffc5e4";
			$CLIEN_ID = "271_4ow3yhzuevmsc4kggogw88wssoogk48k4kgco8ccc8wsowckgk";
			$CLIENT_SECRET = "1gpmg996930kcwwo8sowkcwocwccg4404gcocccksccw8kso44";
			$this->load->library('util');
			$this->load->library('crypt');
			$this->load->library('des_crypt');

			$params = array("public_key"=>$cle_public, "private_key"=>$cle_prive, "client_id"=>$CLIEN_ID, "client_secret"=>$CLIENT_SECRET);

			$this->load->library('paiement',$params);
			$paiement = new Paiement($params);

			//echo $montant ." - ". $nom ."-".$email."-".$idpanier."-".$reference."-".$adresseip; exit();


			$paiement->initPaie($idpanier,$montant,$nom,$reference,$adresseip,$email);
			
	}
}