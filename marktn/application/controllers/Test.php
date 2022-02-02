<?php
//session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('util');
	}
	//TEST PHP MAILER
	public function index()
	{
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'smtp.mail.yahoo.fr';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'rsjosue@yahoo.fr';                     //SMTP username
		    $mail->Password   = 'pawmjiecrnwmbvhz';                               //SMTP password
		    $mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		    //Recipients
		   
		    	
		    $mail->setFrom('rsjosue@yahoo.fr', "EXEMPLE DE MAIL");
		    $mail->addAddress('support@marketinona.com', 'Ianao');     //Add a recipient
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
		    $mail->Subject = 'BONJOUR';
		    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	public function curl_test()
	{
		$param = array(
			"status" => "success",
			"order_id" => "54885555",
			"amount" => "500",
			"pay_token" => "ksuyusejfrsefksef"
		);
        $json = $this->util->sendCurl("https://marketinona.com/achat/succes","POST",array('Content-Type:application/json'),$param);

        var_dump($json);
	}
}
?>