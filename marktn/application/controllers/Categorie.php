<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorie extends CI_Controller {

	public function index()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/categories');
		}
		else
		{
			$this->load->view('connexion');
		}
	}

	public function ajouter_categorie()
	{
		if (isset($_SESSION['session_superadmin'])) 
		{
			$nom_c = $_POST['nom_c'];
			$id_categorie 		= $_POST['id_categorie'];
			if (empty($id_categorie)) {
				if ($this->Categorie_model->insert_categorie($nom_c)) {
					$this->load->view('admin/ajax/ajax_categorie');
				}
			}
			else
			{
				if ($this->Categorie_model->update_categorie($nom_c, $id_categorie)) {
					$this->load->view('admin/ajax/ajax_categorie');
				}

			}
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function supprimer_categorie()
	{
		if (isset($_SESSION['session_superadmin'])) 
		{
			$id_categorie 		= $_POST['id_categorie'];
			if (!empty($id_categorie)) {
				if ($this->Categorie_model->delete_categorie($id_categorie)) {
					$this->load->view('admin/ajax/ajax_categorie');
				}
			}
		}
		else
		{
			$this->load->view('connexion');
		}
	}
}
?>