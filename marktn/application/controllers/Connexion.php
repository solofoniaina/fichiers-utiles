<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Connexion extends CI_Controller {

	public function index()
	{
		$error = array();
		$error['erreur'] = "";
		$this->load->view('connexion',$error);
	}


	public function se_connecter()
	{
		$login 		= $_POST['login'];
		$password	= $_POST['password'];

		//SI ADRESSE EMAIL
		if (filter_var($login, FILTER_VALIDATE_EMAIL)) {

			
			if ($this->Connexion_model->verifierAdmin($login, $password)) 
			{
				$retour = $this->Connexion_model->getIdAdmin($login, $password);
				switch ($retour['role_a']) {
				 	case '3':
				 		$_SESSION['session_superadmin'] = $retour['id_admin'];
				 		$_SESSION['session_admin'] 		= $retour['id_admin'];
				 		break;
				 	case '1':
				 		$_SESSION['session_simpleadmin']= $retour['id_admin'];
				 		$_SESSION['session_admin'] 		= $retour['id_admin'];
				 		break;
				 	default:
				 		//Moderateur
				 		$_SESSION['session_admin'] 		= $retour['id_admin'];
				 		break;
				 }
				$this->load->view('admin/index');
			}
			elseif ($this->Connexion_model->verifierMembre($login, $password)) 
			{
				$_SESSION['session_membre'] = $this->Connexion_model->getIdMembre($login, $password);
				$this->load->view('membre/index');
			}
			else
			{
				$error = array();
				$error['erreur'] = "<span><rouge style='color: #f00;'>Vérifier votre mot de passe. </rouge></span>";
				$this->load->view('connexion',$error);
			}
		}
		// SI TELEPHONE => compte acheteur
		else
		{
			if ($this->Membre_model->tel_existe($login)) { //Vérif phone

				if ($this->Connexion_model->verifierMembre_achat($login, $password)) 
				{
					$_SESSION['session_acheteur'] = $this->Connexion_model->getIdMembre_achat($login, $password);
					$this->load->view('membre/index');
				}
				else
				{
					$error = array();
					$error['erreur'] = "<span><rouge style='color: #f00;'>Hamarino ny laharana na ny teny miafina</rouge></span>";
					$this->load->view('connexion',$error);
				}
			}
			else
			{
				$error = array();
				$error['erreur'] = "<span><rouge style='color: #f00;'>Hamarino ny laharana finday</rouge></span>";
				$this->load->view('connexion',$error);
			}
		}
 	}
 	public function se_connecter_achat()
	{
		$telephone_m 	= $_POST['telephone_m'];
		$password_m		= $_POST['password_m'];

		if ($this->Membre_model->tel_existe($telephone_m)) { //Vérif phone

			if ($this->Connexion_model->verifierMembre_achat($telephone_m, $password_m)) 
			{
				$id_acheteur = $this->Connexion_model->getIdMembre_achat($telephone_m, $password_m);
				echo $id_acheteur;
			}
			else
			{
				echo "Hamarino ny laharana na ny teny miafina";
			}
		}
		elseif ($this->Connexion_model->verifierMembre($telephone_m, $password_m)) 
		{
			$_SESSION['session_membre'] = $this->Connexion_model->getIdMembre($telephone_m, $password_m);
			echo $_SESSION['session_membre'];
		}
		else
		{
			echo "Hamarino ny laharana na adiresy email";
		}
 	}


	public function se_deconnecter_membre()
 	{
 		unset($_SESSION['session_membre']);
 		$error = array();
		$error['erreur'] = "";
		$this->load->view('connexion',$error);
 	}

 	public function se_deconnecter_admin()
 	{
 		unset($_SESSION['session_admin']);
 		$error = array();
		$error['erreur'] = "";
		$this->load->view('connexion',$error);
 	}
 	public function recuperation()
 	{
 		if (empty($_SESSION['session_membre'])) {
			$this->load->view('motdepasse_oublie');
		}
		else
		{
			$this->load->view('membre/compte');
		}
 	}

 	public function recuperer()
	{
		
		$kaody			= rand(1001,9999).date("YmdHis");
		$code_recup 		= md5($kaody);
		$email_m 		= $_POST['email'];
	
			if($this->Membre_model->recuperer_compte($email_m, $code_recup))
			{
		//-------------MAIL DE CONFIRMATION------------------------------------
				$objet = 'Mail de recuperation';
				$message = '<p>Bonjour,<br>Pour modifier votre mot de passe sur <b>Marketinona</b>, cliquez sur le lien ci-dessous:<br></p>';
				$lien_confirmation=base_url()."inscription/recuperation?v=".md5($kaody);

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
														' . $message .'<a class="link" href="'. $lien_confirmation .'">Recuperer mon compte</a>
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
				//$body = $this->email->full_html($objet, $body);

				$mail = new PHPMailer(true);
						$pass = "ejmeuqdtkhoxyszd";
						try {
						    //Server settings
						    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
						    $mail->isSMTP();  
						    //$mail->Mailer = "smtp";                                          //Send using SMTP
						    $mail->Host       = 'mail.mission-madagascar.mg';                     //Set the SMTP server to send through
						    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
						    $mail->Username   = 'no-reply@mission-madagascar.mg';  
						    $pass_encours      = ($pass = "ejmeuqdtkhoxyszd") ? "pawmjiecrnwmbvhz" : "ejmeuqdtkhoxyszd";            //SMTP username
						    $mail->Password   =    '/Yhalaibary003';                         //SMTP password
						    $pass = $pass_encours;
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
						    $mail->Subject = $objet;
						    $mail->MsgHTML($body);
						    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						    $mail->send();
						} catch (Exception $e) {
						   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}
				
				$email 			= array();
				$email['email'] = $email_m;
				$email['code'] = $kaody;
				$this->load->view('verification_recup',$email);
				//echo '<hr><a href="'. $lien_confirmation .'">'.$lien_confirmation.'</a>';
				/*var_dump($result);
				echo '<br />';
				echo $this->email->print_debugger();

				exit;*/
			
		//------------FIN MAIL DE CONFIRMATION
			}
			else
			{
				echo "<h3>Désolé, <br>Une erreur s'est produite, Veuillez réessayer plus tard.<h3>";
			}	
	}

	public function changer_mdp()
	{
		if (!empty($_POST['password']) && !empty($_POST['password1']) && $_POST['password1'] == $_POST['password']) {
			if (!empty($_POST['id_membre'])) {
				if ($this->Membre_model->changer_mdp($_POST['id_membre'],$_POST['password'])) {
					$_SESSION['session_membre'] = $_POST['id_membre'];
					$this->load->view('membre/index');
				}
			}
			else
			{
				$this->load->view('errors/html/error_inconnue');
			}
		}
		else
		{
			$mb['erreur'] = 'Vérifier vos mot de passe';
			$mb['id_membre'] = $_POST['id_membre'];
			$this->load->view('changer_mdp', $mb);
		}
	}
}
?>