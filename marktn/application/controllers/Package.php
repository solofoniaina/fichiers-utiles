<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {
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
				if (!empty($_POST['id_package'])) {
					$this->update();
				}
				else
				{ 
				if (!empty($_POST['nom_p']) && !empty($_POST['prix_p']) && !empty($_POST['description_p'])) {	
					$nom_p 	 		= $_POST['nom_p'];
					$prix_p 		= $_POST['prix_p'];
					$description_p 	= $_POST['description_p'];
					$id_membre_p 	= $_POST['id_membre_p'];
					$date_p			= date('Y-m-d');

	           		//UPLOAD IMAGE
					$image_p = "";
					$photosload="true";
					$photos_size=$_FILES['image_p']['size'];

					$file_name="reel".urlencode($_FILES['image_p']['name']);
					$file_name_redim="prd".md5(rand(1001,9999) * rand(20,100)).".jpg";
					//Créer dossier photos/profil si n'existe pas
					 if(!file_exists('assets/images/membre/'.$id_membre_p.'/')){

					  mkdir('assets/images/membre/'.$id_membre_p.'/', 0777,true);
					}

					$add="assets/images/membre/$id_membre_p/$file_name"; // l'emplacement de l'image
					$dest="assets/images/membre/$id_membre_p/";

					if($photosload=="true")
					{
					   if(move_uploaded_file($_FILES['image_p']['tmp_name'], $add))
					   {
					   		//manao redimensionnement moyenne qualité @zay
					   		if($this->redim_sary->akelezo(500,500,$dest,$file_name_redim,$dest,$file_name))
					   		{
					   			$image_p = $file_name_redim;
					   		}
					   		else
					   		{
					   			$image_p = $file_name;
					   		}
					   		$nom_image=$file_name;
					   }
					}
					if ($this->Package_model->insert($nom_p, $prix_p, $description_p, $id_membre_p, $date_p, $image_p,0, 0)) {
						$this->load->view('membre/ajax/ajax_package');
					}// FIN UPLOAD IMAGE SUCCESS
		        }//FIN NON VIDE
		        else
		        {
		        	$this->load->view('membre/ajax/ajax_package');
		        }
		    }//Fin if modif
		}	
	}
	public function ajouterstock()
	{
		echo $this->Package_model->ajouter_stock($_POST['id_package'],$_POST['nombre_ajout']);
	}
	public function insert_article()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			if (!empty($_POST['id_package'])) {
				$this->update_article();
			}
			else
			{ 
				if (!empty($_POST['nom_p']) && !empty($_POST['prix_p']) && !empty($_POST['description_p'])) {	
					$nom_p 	 		= $_POST['nom_p'];
					$prix_p 		= $_POST['prix_p'];
					$description_p 	= $_POST['description_p'];
					$localisation_p	= $_POST['localisation_p'];
					$id_membre_p 	= $_POST['id_membre_p'];
					$etat_p 		= $_POST['etat_p'];
					$categ_p 		= $_POST['categ_p'];
					$stock_p 		= $_POST['stock_p'];
					$date_p			= date('Y-m-d');
					
					if ($this->Package_model->insert($nom_p, $prix_p, $description_p,$categ_p,$stock_p, $id_membre_p, $date_p, "",$localisation_p,$etat_p, 1)) {
						$this->load->view('membre/index_article');

					}// FIN UPLOAD IMAGE SUCCESS
		        }//FIN NON VIDE
		        else
		        {
		        	$this->load->view('membre/index_article');
		        }
		    }//Fin if modif
		}	
	}
	//Download membre
	public function alaivo($file)
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$file = urldecode($file);

			if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
	        $filepath = "assets/files/" . $file;

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
	            $this->load->view('membre/package');
	        } else {
	            echo "Fichier introuvable";
	        }
	    } else {
	        die("Fichier introuvable!");
	    }

		}
	}
	//download public
	public function download($file)
	{
		
		$file = urldecode($file);
	        $filepath = "assets/files/" . $file;

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

	public function update()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			if (!empty($_POST['id_package']) && !empty($_POST['nom_p']) && !empty($_POST['prix_p']) && !empty($_POST['description_p'])) 
			{	
				$id_package 	= $_POST['id_package'];
				$nom_p 	 		= $_POST['nom_p'];
				$prix_p 		= $_POST['prix_p'];
				$description_p 	= $_POST['description_p'];
				$id_membre_p	= $_POST['id_membre_p'];
				$categ_p 	= $_POST['categ_p'];
				$stock_p	= $_POST['stock_p'];


	           		//UPLOAD FILIES SUCCES =>
	           			//UPLOAD IMAGE
				$image_p = "";
				$photosload="true";
				$photos_size=$_FILES['image_p']['size'];
				if (empty($_FILES['image_p']['name'])) {
					if ($this->Package_model->updatenoimage($nom_p, $prix_p, $description_p, $categ_p, $stock_p, 0, $id_package)) 
					{
						$this->load->view('membre/ajax/ajax_package');
					}// FIN UPDATE NO IMAGE
				}
				else
				{ 
					$file_name="reel".$_FILES['image_p']['name'];
					$file_name_redim="prd".md5(rand(1001,9999) * rand(20,100)).".jpg";
					//Créer dossier photos/profil si n'existe pas
					 if(!file_exists('assets/images/membre/'.$id_membre_p.'/')){

					  mkdir('assets/images/membre/'.$id_membre_p.'/', 0777,true);
					}

					$add="assets/images/membre/$id_membre_p/$file_name"; // l'emplacement de l'image
					$dest="assets/images/membre/$id_membre_p/";

					if($photosload=="true")
					{
					   if(move_uploaded_file($_FILES['image_p']['tmp_name'], $add))
					   {
					   		//manao redimensionnement moyenne qualité @zay
					   		if($this->redim_sary->akelezo(500,500,$dest,$file_name_redim,$dest,$file_name))
					   		{
					   			$image_p = $file_name_redim;
					   		}
					   		else
					   		{
					   			$image_p = $file_name;
					   		}
					   		$nom_image=$file_name;
					   }
					}

					if ($this->Package_model->update($nom_p, $prix_p, $description_p, $categ_p, $stock_p, $image_p, $id_package)) {
						$this->load->view('membre/ajax/ajax_package');
					}// FIN UPLOAD IMAGE SUCCESS
				}//FIN IF NO IMAGE

			}
			else
			{
				$this->load->view('membre/ajax/ajax_package');
			}
		}			
	}
	public function update_article()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			if (!empty($_POST['id_package']) && !empty($_POST['nom_p']) && !empty($_POST['prix_p']) && !empty($_POST['description_p'])) 
			{	
				$id_package 	= $_POST['id_package'];
				$nom_p 	 		= $_POST['nom_p'];
				$prix_p 		= $_POST['prix_p'];
				$description_p 	= $_POST['description_p'];
				$localisation_p = $_POST['localisation_p'];
				$id_membre_p	= $_POST['id_membre_p'];
				$etat_p			= $_POST['etat_p'];

				$categ_p 		= $_POST['categ_p'];
				$stock_p 		= $_POST['stock_p'];
  	
				if ($this->Package_model->updatenoimage($nom_p, $prix_p, $description_p, $categ_p, $stock_p, $localisation_p, $etat_p, $id_package)) 
				{
					$this->load->view('membre/index_article');
				}// FIN UPDATE NO IMAGE
			}
			else
			{
				$this->load->view('membre/index_article');
			}
		}			
	}
	public function delete()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			$id_package 	= $_POST['id_package'];
			
			if ($this->Package_model->delete($id_package)) {
				$this->load->view('membre/ajax/ajax_package');
			}
		}	
	}

	public function details()
	{
		if (!empty($_POST['id_package'])) {
			$package = $this->Package_model->cepackage($_POST['id_package']);
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
			if (empty($_SESSION['panier'])) {
				$_SESSION['panier'] = array();
			}
			$_SESSION['panier'][] = $_POST['id_package'];
			echo count($_SESSION['panier']);
		}
	}
	public function removepanier()
	{

		unset($_SESSION['panier'][$_POST['key']]);
		$this->load->view('magasin/ajax/ajax_panier');
	}
	public function upd($id_package)
	{
		$array = array();
		$array['id_package'] = $id_package;
		$this->load->view('membre/package', $array);

	}
	public function del($id_package)
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else
		{
			//Si quelqu'un a déjà acheté ce package => peut pas supprimer
			if ($this->Vente_model->dejaachete($id_package)) {
				$this->Package_model->desactive($id_package);
				$this->load->view('membre/package');
			}
			else
			{
				$this->Package_model->delete($id_package);
				$this->load->view('membre/package');
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
}
?>