<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Truncate extends CI_Controller {

	
	public function index()
	{
	

		 $tables = array();
				$tables[]="actualites";
				$tables[]="competences";
				$tables[]="competences_autres";
				$tables[]="contacts";
				$tables[]="entreprise";
				$tables[]="etablissementcarte";
				$tables[]="etablissement_prov";
				$tables[]="etre_competent";
				$tables[]="etudiant";
				$tables[]="etudier";
				$tables[]="evenement_etabl";
				$tables[]="experiences";
				$tables[]="interesser";
				$tables[]="media";
				$tables[]="mention";
				$tables[]="messages";
				$tables[]="motcle";
				$tables[]="offre";
				$tables[]="parcour";
				$tables[]="partenaire";
				$tables[]="partenariat_avec";
				$tables[]="publicites";
				$tables[]="publique";
				$tables[]="videos";
				
		foreach ($tables as $key => $value) {
			echo $value;
			$this->truncte($value);
		}

	}

	public function truncte($table)
	{
		$query= $this->db->query("truncate table ".$table);
		//return $query->result();
		return $query;
	}
	
}
?>