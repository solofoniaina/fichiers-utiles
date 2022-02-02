<?php
class Validation_model extends CI_Model
{


	public function recherche_user_produit($user,$produit)
	{
		$query= $this->db->query("
			SELECT 
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.localisation_p,
				A.nom_a,
				P.active_p
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			LEFT JOIN agence A ON A.id_agence = P.localisation_p
			INNER JOIN produit PR ON PR.id_package_p = P.id_package

			WHERE P.type_p = 1
			AND ((M.nom_m LIKE '%".$user."%' OR M.prenom_m LIKE '%".$user."%') AND (P.nom_p LIKE '%".$produit."%' OR P.id_package = '".$produit."'))
			GROUP BY P.id_package
			");
		return $query->result_array();
	}
	public function user_produit_non_valide($valide_cin)
	{
		$query= $this->db->query("
			SELECT 
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.localisation_p,
				A.nom_a,
				P.active_p
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			LEFT JOIN agence A ON A.id_agence = P.localisation_p
			INNER JOIN produit PR ON PR.id_package_p = P.id_package

			WHERE P.type_p = 1
			AND M.valide_cin = $valide_cin
			GROUP BY P.id_package
			");
		return $query->result_array();
	}

	public function valider_invalider($id_package, $active_p)
	{
		$query= $this->db->query("
			UPDATE package
			SET active_p = '".$active_p."'
			WHERE id_package = '".$id_package."'
			AND active_p <> '".$active_p."'
		");
		return $query;
	}

	public function user_validation($valide_cin)
	{
		$query= $this->db->query("
			SELECT 
				nom_m,
				prenom_m,
				id_membre
			FROM membres
			WHERE valide_cin = $valide_cin
			");
		return $query->result_array();
	}

	public function valider_cin($id_membre)
	{
		$query= $this->db->query("
			UPDATE membres
			SET valide_cin = '2'
			WHERE id_membre = '".$id_membre."'
			AND valide_cin = '1'
		");
		return $query;
	}

}
?>