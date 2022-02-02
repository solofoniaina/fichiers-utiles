<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		if (isset($_SESSION['session_superadmin'])) 
		{
			$this->load->view('admin/user');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function role()
	{
		if (isset($_SESSION['session_superadmin'])) 
		{
			$this->load->view('admin/role');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function ajouter_role()
	{
		if (isset($_SESSION['session_superadmin'])) 
		{
			$nom_r = $_POST['nom_r'];
			$id_role 		= $_POST['id_role'];
			if (empty($id_role)) {
				if ($this->User_model->insert_role($nom_r)) {
					$this->load->view('admin/ajax/ajax_role');
				}
			}
			else
			{
				if ($this->User_model->update_role($nom_r, $id_role)) {
					$this->load->view('admin/ajax/ajax_role');
				}

			}
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function supprimer_role()
	{
		if (isset($_SESSION['session_superadmin'])) 
		{
			$id_role 		= $_POST['id_role'];
			if (!empty($id_role)) {
				if ($this->User_model->delete_role($id_role)) {
					$this->load->view('admin/ajax/ajax_role');
				}
			}
		}
		else
		{
			$this->load->view('connexion');
		}
	}
		public function ajouter_user()
	{
		if (isset($_SESSION['session_superadmin'])) 
		{
			$nom_a 		= $_POST['nom_a'];
			$prenom_a 	= $_POST['prenom_a'];
			$login_a 	= $_POST['login_a'];
			$telephone_a= $_POST['telephone_a'];
			$role_a 	= $_POST['role_a'];
			$password_a = $_POST['password_a'];
			$id_admin 	= $_POST['id_admin'];
			if (empty($id_admin)) {
				if ($this->User_model->insert($nom_a, $prenom_a, $login_a, $telephone_a, $password_a, $role_a)) {
					$this->load->view('admin/ajax/ajax_user');
				}
			}
			else
			{
				if ($this->User_model->update($nom_a, $prenom_a, $login_a, $telephone_a, $password_a, $role_a,$id_admin)) {
					$this->load->view('admin/ajax/ajax_user');
				}

			}
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function supprimer_user()
	{
		if (isset($_SESSION['session_superadmin'])) 
		{
			$id_admin 		= $_POST['id_admin'];
			if (!empty($id_admin)) {
				if ($this->User_model->delete($id_admin)) {
					$this->load->view('admin/ajax/ajax_user');
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