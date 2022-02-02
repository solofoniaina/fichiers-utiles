<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Facture extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->add_package_path( APPPATH . 'third_party/fpdf');
        $this->load->library('pdf');
    }
	public function impr($id_vente)
	{
		$id_vente = htmlspecialchars(trim($id_vente));
		$id_paiement =  $this->Paiement_model->get_id_facture($id_vente);

		if (!empty($id_paiement)) {
			$array = array();
			$array['id_paiement'] = $id_paiement;
			$this->load->view('membre/print/facture', $array);
		}
	}
}
?>