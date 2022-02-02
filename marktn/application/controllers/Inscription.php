<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscription extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}
	public function index()
	{
		$this->load->view('inscription');
	}
	public function s_inscrire()
	{
		
		if (!empty($_SESSION['id_parrain'])) {
			$id_parrain = $_SESSION['id_parrain'];
		}
		
		//echo $id_parrain;exit();
		$kaody			= rand(1001,9999).date("YmdHis");
		$code_m 		= md5($kaody);
		$nom_m 			= $_POST['nom_m'];
		$prenom_m 		= $_POST['prenom_m'];
		$login_m 		= $_POST['login_m'];
		$password_m 	= $_POST['password_m'];
		$password_m1 	= $_POST['password_m1'];
		$telephone_m 	= $_POST['telephone_m'];
		$email_m 		= $_POST['email_m'];
		$adresse_m 		= $_POST['adresse_m'];
		$date_m 		= date("Y-m-d");
		if(!empty($nom_m) && !empty($prenom_m) && !empty($login_m) && !empty($password_m) && !empty($email_m) && !empty($adresse_m))
		{
			if ($password_m1 == $password_m) { //Verif password
				if (!$this->Membre_model->mail_existe($email_m) && filter_var($email_m, FILTER_VALIDATE_EMAIL)) { //Vérif email

					if($this->Membre_model->s_inscrire($code_m, $nom_m, $prenom_m, $login_m, $password_m, $telephone_m, $email_m, $adresse_m,$date_m,$id_parrain))
					{
				//-------------MAIL DE CONFIRMATION------------------------------------
						$objet = 'Mail de confirmation';
						$message = '<p>Bonjour,<br>Pour confirmer votre inscription sur <b>Marketinona</b>, cliquez sur le lien ci-dessous:<br></p>';
						$lien_confirmation=base_url()."inscription/confirmation?v=".md5($kaody);

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
														' . $message .'<a class="link" href="'. $lien_confirmation .'">CONFIRMER MON E-MAIL</a>
													</div>
												</div>
												<br>
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
						    $mail->addAddress($email_m);     //Add a recipient
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
						     $mail->CharSet = 'utf-8';
						    $mail->Subject = $objet;
						    $mail->MsgHTML($body);
						    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						    $mail->send();
						} catch (Exception $e) {
						   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}
						###################################################################
						
						$email 			= array();
						$email['email'] = $email_m;
						$email['code'] = $kaody;
						$this->load->view('verification',$email);
						//echo $body;
						/*echo '<br><a href="'. $lien_confirmation .'">'.$lien_confirmation.'</a>';
						var_dump($result);
						echo '<br />';
						echo $this->email->print_debugger();
						exit;*/
					
				//------------FIN MAIL DE CONFIRMATION
					}
					else
					{
						echo "<h3>Désolé, <br>Une erreur d'inscription se produite, Veuillez réessayer votre inscription.<h3>";
					}
				}
				else
				{
					$error = array();
					$error['nom_m'] = $nom_m;
					$error['prenom_m'] = $prenom_m;
					$error['login_m'] = $login_m;
					$error['password_m'] = "";
					$error['password_m1'] = "";
					$error['telephone_m'] = $telephone_m;
					$error['email_m'] = $email_m;
					$error['adresse_m'] = $adresse_m;
					$error['error'] = "Adresse e-mail déjà utilisée ou incorrecte";
					$this->load->view('accueil', $error);
				}
			}
			else
			{
				$error = array();
				$error['nom_m'] = $nom_m;
				$error['prenom_m'] = $prenom_m;
				$error['login_m'] = $login_m;
				$error['password_m'] = "";
				$error['password_m1'] = "";
				$error['telephone_m'] = $telephone_m;
				$error['email_m'] = $email_m;
				$error['adresse_m'] = $adresse_m;
				$error['error'] = "Les mots de passe ne sont pas identiques";
				$this->load->view('accueil', $error);
			}
		}
		else
		{
			$error = array();
			$error['nom_m'] = $nom_m;
			$error['prenom_m'] = $prenom_m;
			$error['login_m'] = $login_m;
			$error['password_m'] = $password_m;
			$error['password_m1'] = $password_m1;
			$error['telephone_m'] = $telephone_m;
			$error['email_m'] = $email_m;
			$error['adresse_m'] = $adresse_m;
			$error['error'] = "Veuillez compléter tous les champs obligatoires";
			$this->load->view('accueil', $error);
		}			
	}
	public function s_inscrire_achat()
	{
		
		if (!empty($_SESSION['id_parrain'])) {
			$id_parrain = $_SESSION['id_parrain'];
		}
		
		//echo $id_parrain;exit();
		$nom_m 			= $_POST['nom_m'];
		$prenom_m 		= $_POST['prenom_m'];
		$password_m 	= $_POST['password_m'];
		$password_m1 	= $_POST['password_m1'];
		$telephone_m 	= $_POST['telephone_m'];
		$telephone_m1 	= $_POST['telephone_m1'];
		$date_m 		= date("Y-m-d");
		if (!empty($nom_m) && !empty($prenom_m)) {
			
			if(!empty($password_m) && !empty($telephone_m))
			{
				if ($password_m1 == $password_m) 
				{ 
					if ($telephone_m == $telephone_m1)
					{
					//Verif password
						if (!$this->Membre_model->tel_existe($telephone_m)) { //Vérif phone

							if($id_acheteur = $this->Membre_model->s_inscrire_achat($nom_m, $prenom_m, $password_m, $telephone_m,$date_m,$id_parrain))
							{
								echo $id_acheteur;
							}
							else
							{
								echo "<h3>Désolé, <br>Une erreur d'inscription se produite, Veuillez réessayer votre inscription.<h3>";
							}
						}
						else
						{
							
							echo "Efa misy mampiasa io finday io";
						}
				
					}
					else
					{
						
						echo "Hamarino laharan'ny finday";
					}
				}
				else
				{
					
					echo "Hamarino ny teny miafina";
				}
			}
			else
			{
				echo  "Fenoy ny banga rehetra";
			}
		}
		else
		{
			echo  "Hamarino ny anaranao";
		}			
	}
	public function confirmation()
	{
		$code_conf = $_GET['v'];
		
		# Récupérer l'ID_CLIENT qui correspond au code de confirmation
		$requete = $this->Membre_model->recuperer_id($code_conf);
		$nombre = $requete->num_rows();
		if ($nombre > 0) 
		{
			$row = $requete->row(0);
			$id_membre = $row->id_membre;
			$ekena = $row->ekena_m;
			if ($ekena == 0) {
				$this->Membre_model->confirmer($id_membre);
				$_SESSION['session_membre'] = $id_membre;
				$this->load->view('membre/index');
			}
			else
			{
				$this->load->view('errors/html/error_confirmation');
			}
			
		}
		else
		{
			$this->load->view('errors/html/error_confirmation');
			//echo "probleme";
		}
	}

	public function recuperation()
	{
		$code_conf = $_GET['v'];
		
		# Récupérer l'ID_CLIENT qui correspond au code de recuperation
		$requete = $this->Membre_model->recuperer_id_recup($code_conf);
		$nombre = count($requete);
		if ($nombre) 
		{
			$id_membre = $requete[0]['id_membre'];
			$ekena = $requete[0]['ekena_m'];
			if ($ekena == 0) {
				$this->Membre_model->confirmer($id_membre);
				$mb = array();
			}
			$mb['id_membre'] = $id_membre;
			$mb['erreur'] = '';
			$this->load->view('changer_mdp', $mb);
			
		}
		else
		{
			$this->load->view('errors/html/error_recuperation');
			//echo "probleme";
		}
	}
}
?>