<?php
//session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Scripta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('util');
	}
	//TEST PHP MAILER
	public function del_fake_mail()
	{			
				$fake_mail = array();
				$membre_no = $this->Membre_model->tout_membre_non_confirme();
				foreach ($membre_no as $key => $m) {
					if (!filter_var($m['email_m'], FILTER_VALIDATE_EMAIL)) {
						$fake_mail[$m['id_membre']] = $m['email_m'];
					}
				}
				//var_dump($fake_mail);
				foreach ($fake_mail as $id_membre => $email) {
					$this->db->where('id_membre',$id_membre);
					$this->db->delete('membres');
				}

				//APRES
				$membre_no = $this->Membre_model->tout_membre_non_confirme();
				foreach ($membre_no as $key => $m) {
					if (!filter_var($m['email_m'], FILTER_VALIDATE_EMAIL)) {
						$fake_mail[$m['id_membre']] = $m['email_m'];
					}
				}
				var_dump($fake_mail);
	}
}
?>