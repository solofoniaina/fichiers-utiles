<?php
class Referral_model extends CI_Model
{
	
	public function select_membre($id_membre)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				nom_m,
				prenom_m,
				login_m,
				password_m,
				telephone_m,
				adresse_m,
				email_m,
				code_m,
				ekena_m,
				date_m,
				dernier_niveau_membre,
				active_m
			FROM membres
			WHERE id_membre = '".$id_membre."'
			");
		return($requete);
	}

}
?>