<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	
	public function index()
	{
			$this->load->view('article/article');
		
	}
	public function details($id_package)
	{
		$pack = array();
		$pack['id_package'] = $id_package;
			$this->load->view('article/details_package',$pack);
		
	}
	public function search()
	{
		$search = array();
		$search['s_key'] = "";
		$search['id_agence'] = "";
		$search['cat'] = "";
		$search['etat'] = "";
		if (!empty($_GET['key'])) {
			$search['s_key'] = htmlspecialchars($_GET['key']);
		}

		if (!empty($_GET['localisation'])) {
			$search['id_agence'] = htmlspecialchars($_GET['localisation']);
		}
		if (!empty($_GET['cat'])) {
			$search['cat'] = htmlspecialchars($_GET['cat']);
		}
		if (!empty($_GET['etat'])) {
			$search['etat'] = htmlspecialchars($_GET['etat']);
		}

		$this->load->view('article/article',$search);
		
	}
	public function panier()
	{
			$this->load->view('article/panier');
		
	}
	public function mes_packages()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/package_article');
		}
	}

	public function packages($id_package)
	{
		
		$prod = array();
		$prod['id_package'] = $id_package;
		$this->load->view('membre/article',$prod);	
	}

	public function mes_ventes_attente()
	{
		
		$this->load->view('membre/vente_en_attente');	
	}

	public function mes_ventes_realisees()
	{
		$this->load->view('membre/vente_realisee');	
	}

	public function ajax_modal_modif()
	{
		$array = array();
		$array['id_package'] = $_POST['id_package'];
		$this->load->view('membre/ajax/ajax_modal_modif_article', $array);
	}
	public function ajax_modal_image()
	{
		$array = array();
		$array['id_package'] = $_POST['id_package']; 
		$this->load->view('membre/ajax/ajax_modal_image', $array);
	}
	public function ajax_image()
	{
		$array = array();
		$array['id_package'] = $_POST['id_package'];
		$this->load->view('membre/ajax/ajax_image_article', $array);
	}
	public function mes_commandes()
	{
		if (!empty($_SESSION['session_membre'])) {
			$this->load->view('membre/mes_commandes_produit');
		}
		elseif(!empty($_SESSION['session_acheteur']))
		{
			$this->load->view('membre/achat_produit');
		}
		else
		{
			$this->load->view('connexion');
		}
	}

	public function new_mes_commandes()
	{
		if (!empty($_SESSION['session_membre'])) {
			$this->load->view('membre/mes_commandes_nouveau_produit');
		}
		elseif(!empty($_SESSION['session_acheteur']))
		{
			$this->load->view('membre/achat_produit');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	
}
?>