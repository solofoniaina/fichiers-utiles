<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/produit_paiement');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function recapitulatif()
	{
		if (isset($_SESSION['session_simpleadmin']) || isset($_SESSION['session_superadmin'])) 
		{
			$this->load->view('admin/recapitulatif');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function rapport()
	{
		if (isset($_SESSION['session_simpleadmin']) || isset($_SESSION['session_superadmin'])) 
		{
			$this->load->view('admin/rapport');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function produits()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/produits');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function categories()
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
	public function fichiers()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/fichiers');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function parametres()
	{
		if (isset($_SESSION['session_superadmin'])) 
		{
			$error = array();
			$error['error'] = "";
			$this->load->view('admin/parametres', $error);
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function membre_actif()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/membre_liste_actif');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function membre_non()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/membre_liste_non');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function membre_tout()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/membre_liste_tout');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	//PAS CONFIRME SON EMAIL
	public function membre_non_confirme()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/membre_liste_non_confirme');
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function update_parametres()
	{
		if (!empty($_SESSION['session_admin'])) 
		{
			if (!empty($_POST['gain_public']) && !empty($_POST['gain_membre']) && !empty($_POST['gain_referral']) && !empty($_POST['gain_referral_free']) && !empty($_POST['notre_commission']) && !empty($_POST['droit_inscription']) && !empty($_POST['minimum_retrait'])) {
				if ($this->Admin_model->update_parametres($_POST['gain_public'], $_POST['gain_membre'], $_POST['gain_referral'], $_POST['gain_referral_free'], $_POST['bonus_abonnement'], $_POST['notre_commission'], $_POST['droit_inscription'], $_POST['minimum_retrait'], date('d/m/Y'), date("H:i:s"))) {
					$error = array();
					$error['error'] = "Paramètres mis à jour ce ". date('d/m/Y') ." à ". date("H:i:s");
					$this->load->view('admin/parametres', $error);
				}
			}
			else 
			{
				$error = array();
				$error['error'] = "Vérifier les champs vides";
				$this->load->view('admin/parametres', $error);
			}
		}
		else $this->load->view('connexion');	
	}


	public function payer_vanilla()
	{
		if (!empty($_SESSION['session_admin'])) 
		{
			if (!empty($_POST['id_demande_paiement'])) 
			{
				if($this->Retrait_model->payer_vanilla($_POST['id_demande_paiement'],date('Y-m-d')))
				{
					echo "Paiement envoyé";
				}
			}
			else
			{
				echo "Echec";
			}	
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function chercher_reference()
	{
		$donnee = array();
		$donnee['code_paiement_m'] = $_POST['code_paiement_m'];
		$this->load->view('admin/ajax/ajax_compte_a_valider',$donnee);
	}
	public function retrait_demande()
	{
		$this->load->view('admin/retrait_demande');
	}
	public function retrait_liste()
	{
		$this->load->view('admin/retrait_liste');
	}

	public function script_referral()
	{
		$this->load->view('admin/log_activation');
	}
	public function script_parrain()
	{
		$this->load->view('admin/log_inscription');
	}
	public function log_moobi()
	{
		$this->load->view('admin/log_paiement_moobi');
	}
	public function activation_manuel()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/activation_manuel');
		}
		else
		{
			$this->load->view('connexion');
		}
		
	}
	public function activer_manuel()
	{

		if($this->Membre_model->activer($_POST['id_membre']))
		{
			$this->load->view('admin/activation_manuel');
		}
		else
		{

		}
	}

	public function activation_sms()
	{
		echo "initial";
		$donnees = json_decode(file_get_contents('php://input'), TRUE);
		$from = $donnees['from'];
		$msg = $donnees['msg'];
		$data = array('frm'=>$from, 'msg'=>$msg);
		if($this->db->insert('sms',$data))
		{
			echo "mande";
		}
		exit();
		//
		
		if($this->Membre_model->activer($_POST['id_membre']))
		{
			echo "MANDEHA";
		}
		else
		{
			echo "TSY MANDEHA";
		}
	}

	public function suppr_package()
	{
		$id_package = $_POST['id_package'];
		//Si quelqu'un a déjà acheté ce package => peut pas supprimer
		if ($this->Vente_model->dejaachete($id_package)) {
			$this->Package_model->desactive($id_package);
			echo "Produit désactivé : " .$id_package;
		}
		else
		{
			$this->Package_model->delete($id_package);	
			echo "Produit supprimé : " .$id_package;
		}
	}
	/****** PRODUIT **********/
	public function paiement_produit()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/produit_paiement');
		}
		else
		{
			$this->load->view('connexion');
		}
		
	}
	public function livraison_produit()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/produit_livraison');
		}
		else
		{
			$this->load->view('connexion');
		}	
	}
	public function reception_produit()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/produit_reception');
		}
		else
		{
			$this->load->view('connexion');
		}	
	}
	public function rejet_produit()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/produit_rejet');
		}
		else
		{
			$this->load->view('connexion');
		}	
	}
	public function recu_produit()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$this->load->view('admin/produit_recu');
		}
		else
		{
			$this->load->view('connexion');
		}	
	}
	# Marquer le produit payé
	public function produit_marquer_payer()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			$parametres = $this->Admin_model->get_parametres();
            $p = $parametres[0];
            //Enregistrer la valeur de "notre commission" appliquée sur cette opération pour ne pas changer les valeurs après.
			if ($this->Admin_model->produit_marquer_payer($_POST['id_vente'], $p['notre_commission'])) {
				//12 01 2022 - ENREGISTRER PAIEMENT POUR FACTURATION 
				$this->Paiement_model->insert(0, $_POST['id_vente']);
				//ENVOI MAIL NOTIFICATION AU VENDEUR ------------------------------------------------------
					#GET EMAIL
				$cevente = $this->Vente_model->cevente($_POST['id_vente']);
				$v = $cevente[0];
				$email = $v['email_m'];

					#ENVOI MAIL
				$objet = 'Nouvelle commande reçue sur Marketinona.com';
						$message = '<p>Bonjour,<br>Vous venez de recevoir une nouvelle commande sur <b>Marketinona</b>, connectez-vous pour voir les détails de la commande<br></p>';
						$lien_confirmation=base_url()."compte";

						// Get full html:
						$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
									<html xmlns="http://www.w3.org/1999/xhtml">
									<head>
									<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
									<title>' . html_escape($objet) . '</title>
									<style type="text/css">
										.lien {
										    text-decoration: none;
										    background-color: #c1002a;
										    padding: 15px;
										    font-size: 20px;
										    color: #fff;
										    font-weight: bold;
										}
										.fond,body{
											background-color: #00b8ff;
											font-family: Arial, Verdana, Helvetica, sans-serif;
										}
										.prim {
										    background-color: #fff;
										    margin: 40px;
										    margin-top:60px;
										    padding: 40px;
										    border-radius: 8px;
										    box-shadow: 8px 8px #00000026;
										}
										.message{
											padding-left: 50px;
											padding-right: 50px;
											
											line-height: 25px;
											text-align: justify;
										}
										.sender{
											color: #333333c7;

										}
										.footer {
										    color: #fff;
										}
										.titre{
											font-weight: bold;
											margin-bottom: 15px;
											margin-top: 15px;
										}
										a.vert{
											color: #fff;
											text-decoration: none;
										}
										a.rouge{
											color: #fff;
											text-decoration: none;
										}
										.link{
											display: inline-block;
											padding: 6px 12px;
											margin-bottom: 0;
											font-size: 14px;
											font-weight: 400;
											line-height: 1.42857143;
											text-align: center;
											white-space: nowrap;
											vertical-align: middle;
											-ms-touch-action: manipulation;
											touch-action: manipulation;
											cursor: pointer;
											-webkit-user-select: none;
											-moz-user-select: none;
											-ms-user-select: none;
											user-select: none;
											background-image: none;
											border: 1px solid transparent;
											border-radius: 4px;
											color: #fff;
											background-color: #00b8ff;
											border-color: #ffffff;
											text-decoration: none;
										}
									</style>
									<body>
										<div class="fond">
											<div class="prim" align="center">
												
												<div class="corps" align="left">
													<div class="message">
														<br>
														' . $message .'<a class="link" href="'. $lien_confirmation .'">Accéder à mon compte</a>
													</div>
												</div>
												<hr>
												<img style="height: 70px;" src="'.base_url().'/assets/images/logo.png">
											</div>
											<div class="footer" align="center">
												Ce message a été envoyé par <a class="vert" href="https://marketinona.com"> marketinona.com </a>
												<br>
											</div>
										</div>
									</body>
								</html>';
						// Also, for getting full html you may use the following internal method:
						$body = $this->email->full_html($objet, $body);

						###################################################################

						$mail = new PHPMailer(true);
						$pass = "ejmeuqdtkhoxyszd";
						try {
						    //Server settings
						    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
						    $mail->isSMTP();  
						    //$mail->Mailer = "smtp";                                          //Send using SMTP
						    
							$mail->Host       = 'smtp-relay.sendinblue.com';                     //Set the SMTP server to send through
						    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
						    $mail->Username   = 'rjsolofoniaina@gmail.com';            //SMTP username
						    $mail->Password   =    '5cCxzpTbXsDSUMqt'; 
		/*
						    $mail->Host       = 'mail.mission-madagascar.mg';                     //Set the SMTP server to send through
						    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
						    $mail->Username   = 'no-reply@mission-madagascar.mg';              //SMTP username
						    $mail->Password   =    '/Yhalaibary003'; 

		*/
						    $mail->SMTPSecure = 'tls';//PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
						    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

						    //Recipients
						   
						    	
						    $mail->setFrom('no-reply@mission-madagascar.mg', "Marketinona");
						    $mail->addAddress($email);     //Add a recipient
						   /* $mail->addAddress('ellen@example.com');               //Name is optional
						    $mail->addReplyTo('info@example.com', 'Information');
						    $mail->addCC('cc@example.com');
						    $mail->addBCC('bcc@example.com');

						    //Attachments
						    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
						    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
							*/
						    //Content
						    $mail->isHTML(true);                                  //Set email format to HTML
						    $mail->Subject = $objet;
						    $mail->MsgHTML($body);
						    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						    $mail->send();
						} catch (Exception $e) {
						   //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}
						###################################################################
						/*echo $body;
						var_dump($result);
						echo '<br />';*/
						/*echo $this->email->print_debugger();
						exit;*/

				//FIN MAIL NOTIFICATION VENDEUR ------------------------------------------------------------

				echo '1';
			}
			else echo '0';
		}
		else
		{
			$this->load->view('connexion');
		}
	}

	public function produit_marquer_livrer()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			if ($this->Admin_model->produit_marquer_livrer($_POST['id_vente'])) {
				echo '1';
			}
			else echo '0';
		}
		else
		{
			$this->load->view('connexion');
		}
	}
		public function produit_marquer_rejeter()
	{
		if (isset($_SESSION['session_admin'])) 
		{
			if ($this->Admin_model->produit_marquer_rejeter($_POST['id_vente'])) {
				echo '1';
			}
			else echo '0';
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function produit_marquer_recu()
	{
		//L'acheteur peut marquer "reçu"
		if (isset($_SESSION['session_admin']) || isset($_SESSION['session_membre']) || isset($_SESSION['session_acheteur'])) 
		{
			if ($this->Admin_model->produit_marquer_recu($_POST['id_vente'])) {
				echo '1';
			}
			else echo '0';
		}
		else
		{
			$this->load->view('connexion');
		}
	}
	public function update_parametres_frais_distance()
	{
		$parm = explode("&",file_get_contents('php://input'));
		foreach ($parm as $key => $value) {
			$val = explode("=", $value);
			$params[$key] = $val[1];
		}
		//Misy valeur 3 isany (dep_0,arriv_0,val_0);
		$nombre = count($params);
		for ($i=0; $i < $nombre ; $i++) { 
			//Enregistrement de chaque ligne
			$this->Parametres_model->save_or_update_frais_distance($params[$i],$params[$i+2],$params[$i+1]);
			// 3 pas
			$i+=2;
		}
		$this->load->view("admin/parametres_frais_distance");
	}
	public function cherche_comandes_periode()
	{
		$array = array();
		$array['annee'] = $_POST['annee'];
		$array['mois'] = $_POST['mois'];
		$this->load->view("admin/ajax/ajax_cherche_comandes_periode", $array);
	}
	/* PRODUITS */
	public function ajax_modal_modif()
	{
		$array = array();
		$array['id_package'] = $_POST['id_package'];
		$this->load->view('admin/ajax/ajax_modal_modif_article', $array);
	}
		public function update_article()
	{
		if (empty($_SESSION['session_admin'])) {
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
					$this->load->view('admin/index_article');
				}// FIN UPDATE NO IMAGE
			}
			else
			{
				$this->load->view('admin/index_article');
			}
		}			
	}

	//FICHIER
	public function chercher_fichier()
	{
		$array = array();
		$array['nom'] = $_POST['search'];
		$this->load->view('admin/ajax/ajax_cherche_fichiers', $array);
	}
}


?>