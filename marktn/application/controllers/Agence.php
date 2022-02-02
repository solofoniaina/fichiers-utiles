<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Agence extends CI_Controller {

	public function index()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/agence');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function ajouter()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$nom_a = $_POST['nom_a'];
			$coord_point_a 	= substr($_POST['coord_point_a'],6); //Point(329.5, 199)
			$coord_point_a 	= substr($coord_point_a, 0, -1);
			$coord_latlng_a = substr($_POST['coord_latlng_a'],7); //LatLng(-21.46339, 47.10859)
			$coord_latlng_a 	= substr($coord_latlng_a, 0, -1);
			$id_agence 		= $_POST['id_agence'];
			if (empty($id_agence)) {
				if ($this->Agence_model->insert($nom_a,$coord_point_a,$coord_latlng_a, $_POST['niveau_a'])) {
					$array = array();
					$array['coord_latlng_a'] = $coord_latlng_a;
					$array['nom_a'] = $nom_a;
					$this->load->view('admin/ajax/ajax_agence', $array);
				}
			}
			else
			{
				if ($this->Agence_model->update($nom_a,$coord_point_a,$coord_latlng_a, $id_agence)) {
					$array = array();
					$array['coord_latlng_a'] = $coord_latlng_a;
					$array['nom_a'] = $nom_a;
					$this->load->view('admin/ajax/ajax_agence', $array);
				}
			}
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function supprimer()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			if (!empty($_POST['id_agence'])) {
				$this->Agence_model->delete($_POST['id_agence']);
			}
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function frais_distance()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/parametres_frais_distance');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
}
?>