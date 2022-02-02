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
				$error = array();
				$error['error'] = 'Vous n\'avez pas encore payé votre abonnement.<br>';
				$this->load->view('membre/demande', $error);

			}
			
		}	
	}
	public function demander()
	{
		$parametres = $this->Admin_model->get_parametres();
        $p = $parametres[0];
        $min_retrait_gratuit = $p['minimum_retrait'] * 2;
            					
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			if (empty($_POST['number1']) || empty($_POST['number2']) || $_POST['number1'] != $_POST['number2'] || strlen($_POST['number1']) != 10 || substr($_POST['number1'], 0,3) != "034") {

				substr($_POST['number1'], 0,2);
				$error = array();
				$error['error'] = 'Vérifier vos numeros de téléphone Mvola';
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
						if ($retrait_now > $p['minimum_retrait']) {
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
						$total_comm = $this->MesFonctions->total_gain($_SESSION['session_membre']);
						$retrait_now = $this->MesFonctions->retirable($_SESSION['session_membre'],$total_comm);
						if ($retrait_now >= $min_retrait_gratuit) {
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