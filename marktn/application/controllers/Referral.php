<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends CI_Controller {

	
	public function script_referral()
	{
		$id_log_activation = $_POST['id_log_activation'];
		$id_membre_log = $_POST['id_membre_log'];
		//Type : 1 pour paiement abonnement
		if($this->Admin_model->gain_des_parrains($id_membre_log, 1))
		{
			return ($this->Admin_model->marque_ok_log($id_log_activation));
		}
		//MET COMME CA POUR L'INSTANT
		else
		{
			return ($this->Admin_model->marque_ok_log($id_log_activation));
		}
	}
	public function script_parrain()
	{
		$id_membre = $_POST['id_membre'];
		//Type : 0 pour nouvelle inscription
		if($this->Admin_model->gain_des_parrains($id_membre, 0))
		{
			return ($this->Admin_model->marque_ok_log_insc($id_membre));
		}
		//MET COMME CA POUR L'INSTANT
		else
		{
			return ($this->Admin_model->marque_ok_log_insc($id_membre));
		}
	}
}
?>