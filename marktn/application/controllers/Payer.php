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
			$amount = 0;
			if (!empty($_SESSION['panier'])) {
				foreach ($_SESSION['panier'] as $key => $id_package) {
					$amount += $this->Package_model->prixpackage($id_package);
				}
			}

			$adresseip = $_SERVER['REMOTE_ADDR'];

			$order_id = date("mYdHis");
			$order_label = date("siH");
			//CREER SESSION POUR RAPPORT APRES PAIEMENT
			$_SESSION['order_id'] = $order_id;
			

			$client_id = "TCboomsnuFOMciHSojRdEjhulrbNFGyu";
			$client_secret = "WwtLbynhlXwtBOdy";
			$authorization_code = "VENib29tc251Rk9NY2lIU29qUmRFamh1bHJiTkZHeXU6V3d0TGJ5bmhsWHd0Qk9keQ==";
			$service = "mv";
			$this->load->library('util');

			$params = array("service"=>$service, "client_id"=>$client_id, "client_secret"=>$client_secret, "authorization_code"=>$authorization_code);

			$this->load->library('paiement',$params);
			$paiement = new Paiement($params);


			$paiement->initPaiement($order_id,$order_label,$amount);
	}
	public function payment_moobipay() {
			$parametres = $this->Admin_model->get_parametres();
    		$p = $parametres[0];
			$amount = $p['droit_inscription'];

			$adresseip = $_SERVER['REMOTE_ADDR'];

			$order_id = date("mYdHis")."I";
			$order_label = date("siH");
			//CREER SESSION POUR RAPPORT APRES PAIEMENT
			$_SESSION['order_id'] = $order_id;
			

			$client_id = "TCboomsnuFOMciHSojRdEjhulrbNFGyu";
			$client_secret = "WwtLbynhlXwtBOdy";
			$authorization_code = "VENib29tc251Rk9NY2lIU29qUmRFamh1bHJiTkZHeXU6V3d0TGJ5bmhsWHd0Qk9keQ==";
			$service = "mv";
			$this->load->library('util');

			$params = array("service"=>$service, "client_id"=>$client_id, "client_secret"=>$client_secret, "authorization_code"=>$authorization_code);

			$this->load->library('paiement',$params);
			$paiement = new Paiement($params);


			$paiement->initPaiement($order_id,$order_label,$amount);
			
	}

	public function payment_mon_num()
	{
			$parametres = $this->Admin_model->get_parametres();
    		$p = $parametres[0];
			$amount = $p['droit_inscription'];

			$adresseip = $_SERVER['REMOTE_ADDR'];

			$order_id = date("mYdHis")."I";
			$order_label = date("siH");
			//CREER SESSION POUR RAPPORT APRES PAIEMENT
			$_SESSION['order_id'] = $order_id;

			$this->load->view('membre/my_paiement_mobile');
	}
	public function payment_mon_compte()
	{
		$parametres = $this->Admin_model->get_parametres();
		$p = $parametres[0];
		$total_comm = $this->MesFonctions->total_gain($_SESSION['session_membre']);
		$retrait_now = $this->MesFonctions->retirable($_SESSION['session_membre'],$total_comm);
		
		if ($retrait_now >= $p['droit_inscription']) {

			//ACTIVER MEMBRE PUIS DEDUCTION DROIT D'ABONNEMENT
			if ($this->Membre_model->activer($_SESSION['session_membre'])) {
				$this->Admin_model->deduire_gain_referral($_SESSION['session_membre'], $p['droit_inscription']);
			}
		
		}
		$this->load->view('membre/index');
	}
}