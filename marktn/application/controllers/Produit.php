<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Redim_Sary');
	}
	public function insert()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
				{
				if (!empty($_POST['id_produit'])) {
					$this->update();
				}
				else
				{ 
					$date_p			= date('Y-m-d');
				
					//UPLOAD FILES
		        	$lien_p = "";
		           $photosload="true";
		           $file_size=$_FILES['lien_p']['size'];

		          // $lien_p=date('sdYmHi').$this->MesFonctions->replaceSpecialChar($_FILES['lien_p']['name']);
		           $lien_p = strtolower(str_replace(" ", "",$_FILES['lien_p']['name']));
		           $lien_p = date('sdYmHi').$this->MesFonctions->lettre_tsotra($lien_p);
		           //Créer dossier photos/profil si n'existe pas
		             if(!file_exists('assets/files/'.$_POST["id_package_p"].'/')){
		     	
		              mkdir('assets/files/'.$_POST["id_package_p"].'/', 0777,true);
		           }

		           $add="assets/files/".$_POST["id_package_p"]."/$lien_p"; // l'emplacement de l'image
		           $dest="assets/files/".$_POST["id_package_p"]."/";

		           if((!empty($_FILES['lien_p']['name'])) && (move_uploaded_file($_FILES['lien_p']['tmp_name'], $add)))
		           {
		           		if ($this->Produit_model->insert($_POST["id_package_p"], $lien_p, $date_p)) 
		           		{
		           			$prod = array();
		           			$prod['id_package'] = $_POST["id_package_p"];

							$this->load->view('membre/ajax/ajax_produit',$prod);
						}
		           }//FIN UPLOAD FILES SUCCESS
		           else
		           {
		           		$this->load->view('membre/ajax/ajax_produit');
		           }
		    }//Fin if modif
		}	
	}
	public function insert_image()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
				{
				if (!empty($_POST['id_produit'])) {
					$this->update();
				}
				else
				{ 
					$date_p			= date('Y-m-d');
				
					//UPLOAD FILES
		        	$lien_p = "";
		           $photosload="true";
		           $file_size=$_FILES['lien_p']['size'];

		          // $lien_p=date('sdYmHi').$this->MesFonctions->replaceSpecialChar($_FILES['lien_p']['name']);
		           $lien_p = strtolower(str_replace(" ", "",$_FILES['lien_p']['name']));
		           $lien_p = date('sdYmHi').$this->MesFonctions->lettre_tsotra($lien_p);
		           //Créer dossier photos/profil si n'existe pas
		             if(!file_exists('assets/files/'.$_POST["id_package_p"].'/')){
		     	
		              mkdir('assets/files/'.$_POST["id_package_p"].'/', 0777,true);
		           }

		           $add="assets/files/".$_POST["id_package_p"]."/$lien_p"; // l'emplacement de l'image
		           $dest="assets/files/".$_POST["id_package_p"]."/";

		           if((!empty($_FILES['lien_p']['name'])) && (move_uploaded_file($_FILES['lien_p']['tmp_name'], $add)))
		           {
		           		if ($this->Produit_model->insert($_POST["id_package_p"], $lien_p, $date_p)) 
		           		{
		           			$prod = array();
		           			$prod['id_package'] = $_POST["id_package_p"];

							$this->load->view('membre/ajax/ajax_image_article',$prod);
						}
		           }//FIN UPLOAD FILES SUCCESS
		           else
		           {
		           		$this->load->view('membre/ajax/ajax_image_article');
		           }
		    }//Fin if modif
		}	
	}
	//Download membre
	public function alaivo($id_package,$file)
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$file = urldecode($file);

			if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
	        $filepath = "assets/files/" . $id_package . "/" . $file;

	        // Process download
	        if(file_exists($filepath)) {
	            header('Content-Description: File Transfer');
	            header('Content-Type: application/octet-stream');
	            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
	            header('Expires: 0');
	            header('Cache-Control: must-revalidate');
	            header('Pragma: public');
	            header('Content-Length: ' . filesize($filepath));
	            flush(); // Flush system output buffer
	            readfile($filepath);
	            $prod = array();
				$prod['id_package'] = $id_package;
	            $this->load->view('membre/produit', $prod);
	        } else {
	            echo "Fichier introuvable";
	        }
	    } else {
	        die("Fichier introuvable!");
	    }

		}
	}
	//download public
	public function download($id_package,$file)
	{
		
		$file = urldecode($file);
	        $filepath = "assets/files/$id_package/" . $file;

	        // Process download
	        if(file_exists($filepath)) {
	            header('Content-Description: File Transfer');
	            header('Content-Type: application/octet-stream');
	            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
	            header('Expires: 0');
	            header('Cache-Control: must-revalidate');
	            header('Pragma: public');
	            header('Content-Length: ' . filesize($filepath));
	            flush(); // Flush system output buffer
	            readfile($filepath);
	            $this->load->view('magasin/paiement_success');
	        } else {
	            echo "Fichier introuvable";
	        }
	}

	
	public function delete()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$id_produit 	= $_POST['id_produit'];
			
			if ($this->package_model->delete($id_produit)) {
				$this->load->view('membre/ajax/ajax_package');
			}
		}	
	}

	public function details()
	{
		if (!empty($_POST['id_produit'])) {
			$package = $this->package_model->cepackage($_POST['id_produit']);
			echo "
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<h4 class='modal-title' id='myModalLabel'>".$package[0]['nom_p']."</h4>
					</div>
					<div class='modal-body'>
					".$package[0]['description_p']."
					</div>
					<div class='modal-footer'>
					<button type='button' class='btn btn-default' data-dismiss='modal'>Fermer</button>
				</div>
			";
		}
		else
		{
			echo "
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<h4 class='modal-title' id='myModalLabel'>Fichier introuvable</h4>
					</div>
					<div class='modal-body'>
					Un problème est survenu, nous ne pouvons pas trouver ce fichier
					</div>
					<div class='modal-footer'>
					<button type='button' class='btn btn-default' data-dismiss='modal'>Fermer</button>
				</div>
			";
		}
	}
	public function ajouterpanier()
	{
		if (!empty($_POST['id_package'])) {
			if(empty($_SESSION['session_membre']))
			{
				if (empty($_SESSION['panier'])) {
					$_SESSION['panier'] = array();
				}
				$_SESSION['panier'][] = array("id_package" => $_POST['id_package'], "nombre_achat" => $_POST['nombre_achat']);
				echo count($_SESSION['panier']);
			}
			elseif(!$this->Package_model->est_mon_produit($_POST['id_package'],$_SESSION['session_membre']))
			{
				if (empty($_SESSION['panier'])) {
					$_SESSION['panier'] = array();
				}
				$_SESSION['panier'][] = array("id_package" => $_POST['id_package'], "nombre_achat" => $_POST['nombre_achat']);
				echo count($_SESSION['panier']);
			} 
			else echo 0;	
		}
		else echo 0;
	}
	public function removepanier()
	{

		unset($_SESSION['panier'][$_POST['key']]);
		$this->load->view('magasin/ajax/ajax_panier');
	}
	public function upd($id_produit)
	{
		$array = array();
		$array['id_produit'] = $id_produit;
		$this->load->view('membre/packages', $array);

	}
	public function del($id_package,$id_produit)
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$prod = array();
			$prod['id_package'] = $id_package;
			//Si quelqu'un a déjà acheté ce package => peut pas supprimer
			if ($this->Vente_model->dejaachete($id_package)) {
				$this->Produit_model->desactive($id_produit);
				$this->load->view('membre/produit',$prod);
			}
			else
			{
				$this->Produit_model->delete($id_produit);
				$this->load->view('membre/produit',$prod);
			}
		}
	}
	public function delete_image()
	{
		$id_package = $_POST['id_package'];
		$id_produit = $_POST['id_produit'];
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			//Si quelqu'un a déjà acheté ce package => peut pas supprimer
			if ($this->Vente_model->dejaachete($id_package)) {
				$this->Produit_model->desactive($id_produit);
				echo "ok";
			}
			else
			{
				$this->Produit_model->delete($id_produit);
				echo "ok";
			}
		}
	}
	public function mes_ventes()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/vente');
		}
	}

	public function mes_achats()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/achat');
		}
	}
	public function mes_achats_article()
	{
		if (empty($_SESSION['session_membre']) && empty($_SESSION['session_acheteur'])) {
			$this->load->view('connexion');
		}
		else
		{
			$this->load->view('membre/achat_produit');
		}
	}

	public function apercu_image()
	{
		$array = array();
		$array['id_package'] = $_POST['id_package'];
		$array['lien_p'] 	= $_POST['lien_p'];
		$this->load->view("article/ajax/ajax_apercu_image", $array);
	}
}
?>