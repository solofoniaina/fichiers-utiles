<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Compte extends CI_Controller {

	
	public function index()
	{
		if (!empty($_SESSION['session_membre'])) {
			$this->load->view('membre/compte');
		}
		elseif(!empty($_SESSION['session_acheteur']))
		{
			$this->load->view('membre/achat_produit');
		}
		elseif(!empty($_SESSION['session_admin']))
		{
			$this->load->view('admin/index');
		}
		else
		{
			$this->load->view('connexion');
		}	
	}
	public function principal()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/compte');
		}	
	}
	public function referrals()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/referral');
		}	
	}

	public function compte_niveau()
	{
		$donnee = array();
		$donnee['etape'] = $_POST['id_niveau_i'];
		$this->load->view('membre/ajax/ajax_compte',$donnee);
	}
	public function activation()
	{
		$this->load->view('membre/compte_activation');
	}

	//ATTENTION !! ACTIVATION APRES DEPOT DE FRAIS D'INSCRIPTION
	public function active_acc()
	{
		if ($this->Membre_model->activer($_SESSION['session_membre'])) {
			$this->load->view('membre/compte');
		}
	}

	public function password()
	{
		
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/changer_mdp');
		}	
		
	}

	public function changer_mdp()
	{
		$resultat = $this->Membre_model->login_id($_SESSION['session_membre'],$_POST['password0']);
		if (empty($_POST['password0']) || empty($resultat) ) {
				$mb = array();
				$mb['erreur'] = 'Vérifier votre mot de passe actuel';
				$this->load->view('membre/changer_mdp', $mb);
		}
		else
		{
			if (!empty($_POST['password']) && !empty($_POST['password1']) && $_POST['password1'] == $_POST['password']) {

				if ($this->Membre_model->changer_mdp($_SESSION['session_membre'],$_POST['password'])) {
					$this->load->view('membre/index');
				}
			}
			else
			{
				$mb = array();
				$mb['erreur'] = 'Vérifier vos nouveaux mot de passe';
				$this->load->view('membre/changer_mdp', $mb);
			}
		}
	}
	public function identite()
	{
		
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/identite');
		}	
	}

	public function id_corps()
	{
		
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/identite_corps');
		}	
	}
	public function cherche_comandes_periode()
	{
		$array = array();
		$array['annee'] = $_POST['annee'];
		$array['mois'] = $_POST['mois'];
		$this->load->view("membre/ajax/ajax_cherche_comandes_periode", $array);
	}
	
}
?>