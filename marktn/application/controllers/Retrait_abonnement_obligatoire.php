<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Retrait extends CI_Controller {

	
	public function index()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			if($this->Membre_model->est_active($_SESSION['session_membre']))
			{
				$error = array();
				$error['error'] = '';
				$this->load->view('membre/demande', $error);
			}
			else
			{
				$parametres = $this->Admin_model->get_parametres();
            	$p = $parametres[0];

				$total_comm = $this->MesFonctions->total_gain($_SESSION['session_membre']);
				$retrait_now = $this->MesFonctions->retirable($_SESSION['session_membre'],$total_comm);
				$difference = $retrait_now - $p['droit_inscription'];
				$error = array();
				$error['error'] = 'Vous n\'avez pas encore payé votre abonnement.<br>';
				if ($difference > 0) {
					$error['error'] .= "Vous pouvez retirer seulement ". $difference ." MGA en continuant la demande, dont ".$p['droit_inscription']. " MGA pour régler l'abonnement d'1 mois";
					$this->load->view('membre/demande', $error);
				}
				else
				{
					$error = array();
					$error['error'] = 'Votre solde est inférieur au minimum de retrait';
					$this->load->view('membre/demande', $error);

				}

			}
			
		}	
	}
	public function demander()
	{
		$parametres = $this->Admin_model->get_parametres();
        $p = $parametres[0];
            					
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			if (empty($_POST['number1']) || empty($_POST['number2']) || $_POST['number1'] != $_POST['number2'] || strlen($_POST['number1']) != 10 || substr($_POST['number1'], 0,2) != "03") {

				substr($_POST['number1'], 0,2);
				$error = array();
				$error['error'] = 'Vérifier vos numeros de téléphone';
				$this->load->view('membre/demande', $error);
			}
			elseif (empty($_POST['password'])) {
				$error = array();
				$error['error'] = 'Vérifier votre mot de passe';
				$this->load->view('membre/demande', $error);
			}
			else
			{
				if ($this->Membre_model->login_id($_SESSION['session_membre'],$_POST['password'])) {

					if($this->Membre_model->est_active($_SESSION['session_membre']))
					{
						$total_comm = $this->MesFonctions->total_gain($_SESSION['session_membre']);
						$retrait_now = $this->MesFonctions->retirable($_SESSION['session_membre'],$total_comm);
						if ($retrait_now > 0) {
							$code_paiement = date("sYmdHi");
							$cp = array();
							$cp['code_paiement'] = $code_paiement;
							$resultat = $this->Retrait_model->demander($_SESSION['session_membre'],$retrait_now,date("Y-m-d"), $code_paiement, $_POST['number1']);
							if ($resultat == 1) 
							{
								$this->load->view('membre/demande_success',$cp);
							}
							else // Erreur inconnue
							{
								$this->load->view('membre/demande_fail',$resultat);
							}
						}
						else //TSY RETIRABLE
						{
							$error = array();
							$error['error'] = 'Votre solde est inférieur au minimum de retrait';
							$this->load->view('membre/demande', $error);
						}
					}//FIN ACTIVE
					else
					{
						$parametres = $this->Admin_model->get_parametres();
            			$p = $parametres[0];
						$total_comm = $this->MesFonctions->total_gain($_SESSION['session_membre']);
						$retrait_now = $this->MesFonctions->retirable($_SESSION['session_membre'],$total_comm);
						$difference = $retrait_now - $p['droit_inscription'];
						if ($difference > 0) {
							$code_paiement = date("sYmdHi");
							$cp = array();
							$cp['code_paiement'] = $code_paiement;
							
							//ACTIVER MEMBRE PUIS DEDUCTION DROIT D'ABONNEMENT
							if ($this->Membre_model->activer($_SESSION['session_membre'])) {
								$this->Admin_model->deduire_gain_referral($_SESSION['session_membre'], $p['droit_inscription']);
							}
							

							$resultat = $this->Retrait_model->demander($_SESSION['session_membre'],$difference,date("Y-m-d"), $code_paiement, $_POST['number1']);
							if ($resultat == 1) 
							{
								$this->load->view('membre/demande_success',$cp);
							}
							else // Erreur inconnue
							{
								$this->load->view('membre/demande_fail',$resultat);
							}
						}
						else //TSY RETIRABLE
						{
							$error = array();
							$error['error'] = 'Votre solde est inférieur au minimum de retrait';
							$this->load->view('membre/demande', $error);
						}

					}
					
				}
				else
				{
					$error = array();
					$error['error'] = 'Vérifier votre mot de passe';
					$this->load->view('membre/demande', $error);
				}
			}
		}	
	}

	
}
?>