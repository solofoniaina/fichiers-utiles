<?php
class Bord_model extends CI_Model
{

	/* OPERATION SUR LES MEMBRES */
	public function membre_active_annee($annee)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				date_m,
				active_m
			FROM membres
			WHERE date_m LIKE '%".$annee."%'
			AND ekena_m = 1
			");
		
		return $requete->result_array();
	}
	public function membre_noactive_annee($annee)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				date_m
			FROM membres
			WHERE date_m LIKE '%".$annee."%'
			AND ekena_m = 0
			");
		
		return $requete->result_array();
	}
	/* OPERATION SUR LES VENTES */
	public function toutvente(){
		$query= $this->db->query("
			SELECT 
				V.paye_v,
				V.livre_v,
				V.recu_v,
				V.date_v
			FROM vente V 
			");
		return $query->result_array();
	}
}
?>