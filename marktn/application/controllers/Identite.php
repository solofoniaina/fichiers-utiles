<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Identite extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Redim_Sary');
	}
	public function updcin1()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else{
				//UPLOAD FILES
	        	$lien_p = "";
	           $photosload="true";
	           $file_size=$_FILES['cin1']['size'];

	           $lien_p = strtolower(str_replace(" ", "",$_FILES['cin1']['name']));
	           $lien_p = date('sdYmHi').$this->MesFonctions->lettre_tsotra($lien_p);
	           //Créer dossier photos/profil si n'existe pas
	             if(!file_exists('assets/identite/'.$_SESSION['session_membre'].'/')){
	     	
	              mkdir('assets/identite/'.$_SESSION['session_membre'].'/', 0777,true);
	           }

	           $add="assets/identite/".$_SESSION['session_membre']."/$lien_p"; // l'emplacement de l'image
	           $dest="assets/identite/".$_SESSION['session_membre']."/";

	           if((!empty($_FILES['cin1']['name'])) && (move_uploaded_file($_FILES['cin1']['tmp_name'], $add)))
	           {
	           		if ($this->Membre_model->cin1($_SESSION['session_membre'], $lien_p)) 
	           		{

						$this->load->view('membre/identite');
					}
	           }//FIN UPLOAD FILES SUCCESS
	           else
	           {
	           		$this->load->view('membre/identite');
	           }
		}	
	}

	public function updcin2()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else{
				//UPLOAD FILES
	        	$lien_p = "";
	           $photosload="true";
	           $file_size=$_FILES['cin2']['size'];

	           $lien_p = strtolower(str_replace(" ", "",$_FILES['cin2']['name']));
	           $lien_p = date('sdYmHi').$this->MesFonctions->lettre_tsotra($lien_p);
	           //Créer dossier photos/profil si n'existe pas
	             if(!file_exists('assets/identite/'.$_SESSION['session_membre'].'/')){
	     	
	              mkdir('assets/identite/'.$_SESSION['session_membre'].'/', 0777,true);
	           }

	           $add="assets/identite/".$_SESSION['session_membre']."/$lien_p"; // l'emplacement de l'image
	           $dest="assets/identite/".$_SESSION['session_membre']."/";

	           if((!empty($_FILES['cin2']['name'])) && (move_uploaded_file($_FILES['cin2']['tmp_name'], $add)))
	           {
	           		if ($this->Membre_model->cin2($_SESSION['session_membre'], $lien_p)) 
	           		{

						$this->load->view('membre/identite');
					}
	           }//FIN UPLOAD FILES SUCCESS
	           else
	           {
	           		$this->load->view('membre/identite');
	           }
		}	
	}

	public function updcin3()
	{
		if (empty($_SESSION['session_membre'])) {
			$this->load->view('connexion');
		}
		else{
				//UPLOAD FILES
	        	$lien_p = "";
	           $photosload="true";
	           $file_size=$_FILES['cin3']['size'];

	           $lien_p = strtolower(str_replace(" ", "",$_FILES['cin3']['name']));
	           $lien_p = date('sdYmHi').$this->MesFonctions->lettre_tsotra($lien_p);
	           //Créer dossier photos/profil si n'existe pas
	             if(!file_exists('assets/identite/'.$_SESSION['session_membre'].'/')){
	     	
	              mkdir('assets/identite/'.$_SESSION['session_membre'].'/', 0777,true);
	           }

	           $add="assets/identite/".$_SESSION['session_membre']."/$lien_p"; // l'emplacement de l'image
	           $dest="assets/identite/".$_SESSION['session_membre']."/";

	           if((!empty($_FILES['cin3']['name'])) && (move_uploaded_file($_FILES['cin3']['tmp_name'], $add)))
	           {
	           		if ($this->Membre_model->cin3($_SESSION['session_membre'], $lien_p)) 
	           		{

						$this->load->view('membre/identite');
					}
	           }//FIN UPLOAD FILES SUCCESS
	           else
	           {
	           		$this->load->view('membre/identite');
	           }
		}	
	}

}
?>