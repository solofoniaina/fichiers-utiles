<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Mailing extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}
	public function test()
	{
	}
	public function script_confirmation()
	{

		$email_sent = array();
		$email_not_sent = array();
		$membre = $this->Admin_model->tout_membre_non_confirme_by_limit($_POST['debut'],$_POST['limit']);
		//$membre = $this->Admin_model->tout_membre_non_confirme_by_limit(0,1);
		foreach ($membre as $key => $m) {
			$code_m 		= $m['code_m'];
			$email_m 		= $m['email_m'];
	//-------------MAIL DE CONFIRMATION------------------------------------
			$objet = 'Relance Mail de confirmation';
			$message = '<p>Bonjour,<br>Vous n\'avez pas encore confirmé votre adresse e-mail.<br>
			Pour valider votre compte sur <b>Marketinona</b>, cliquez sur le lien ci-dessous:<br></p>';
			$lien_confirmation=base_url()."inscription/confirmation?v=".$code_m;

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
											' . $message .'<a class="link" href="'. $lien_confirmation .'">Confirmer mon e-mail</a>
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
		###################################### PHP MAILER ###########################

		$mail = new PHPMailer(true);
		$pass = "ejmeuqdtkhoxyszd";
		try {
		    //Server settings
		    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		    $mail->isSMTP();  
		    //$mail->Mailer = "smtp";   
		    #####################SENDINGBLUE YAhooko
		    $mail->Host       = 'smtp-relay.sendinblue.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'rsjosue@yahoo.fr';            //SMTP username
		    $mail->Password   =    'gqJ9Z8xpyMv4sTIY';  
		    ####################SENDING BLUE gmailko                                      //Send using SMTP
		    /*$mail->Host       = 'smtp-relay.sendinblue.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'rjsolofoniaina@gmail.com';            //SMTP username
		    $mail->Password   =    '5cCxzpTbXsDSUMqt'; */
		   ###################GMAIL
		    /*$mail->Host       = 'mail.mission-madagascar.mg';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'no-reply@mission-madagascar.mg';            //SMTP username
		    $mail->Password   =    '/Yhalaibary003'; */

		    $mail->SMTPSecure = 'tls';//PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		    //Recipients
		   
		    	
		    $mail->setFrom('support@marketinona.com', "Marketinona");
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
		    $email_sent[] = $email_m;
		} catch (Exception $e) {
			$email_not_sent[] = $email_m;
		   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

		###################################### PHP MAILER ###########################
		}
		echo "EMAIL SENT:<hr>";
		echo "<pre>";
			print_r($email_sent);
		echo "</pre>";
		echo "<hr>";
		echo "EMAIL NOT SENT:";
		echo "<pre>";
			print_r($email_not_sent);
		echo "</pre>";
				
	}

}
?>