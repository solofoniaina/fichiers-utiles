<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TRPaiement extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			
		$this->load->library('user_agent');
		
	}
	
	public function echec() {
		
	}

	public function succes() {
		log_message('error', 'success');
		log_message('error', json_encode($_SERVER['REQUEST_URI']));
		$this->load->library('PHPTdes');
		$this->load->library('Paiement');
		$tdes = new pHPTdes();
		$util = new Util();
		$parts = parse_url($_SERVER['REQUEST_URI']);
		parse_str($parts['query'], $query);
		

		$idpanier = $util->decrypter('f09ca6914d91e48aef3d3946b64f14ea2a8c8127134e5beb64', $query['idpanier']);		
		$idpaiement = $util->decrypter('f09ca6914d91e48aef3d3946b64f14ea2a8c8127134e5beb64', $query['idpaiement']);		
		$ref_arn = $util->decrypter('f09ca6914d91e48aef3d3946b64f14ea2a8c8127134e5beb64', $query['ref_arn']);		
		$code_arn = $util->decrypter('f09ca6914d91e48aef3d3946b64f14ea2a8c8127134e5beb64', $query['code_arn']);		
		$nomPayeur = $util->decrypter('f09ca6914d91e48aef3d3946b64f14ea2a8c8127134e5beb64', $query['nom']);		
		
	}
	public function retour() {
		echo "il est de retour";
	}
}