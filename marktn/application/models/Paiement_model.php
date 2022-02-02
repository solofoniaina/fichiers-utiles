<?php
class Paiement_model extends CI_Model
{
	public function insert($mode_pf, $id_vente_pf)
	{
		$data = array('mode_pf'=>$mode_pf,'id_vente_pf'=>$id_vente_pf);
		return($this->db->insert('paiement_facture',$data));
	}

	public function facture($id_paiement_facture){
		$query= $this->db->query("
			SELECT 
				PF.mode_pf,
				PF.id_vente_pf,
				V.paye_date_v,
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.prix_v,
				V.nombre_v,
				V.paye_v,
				V.frais_v,
				P.nom_p,
				P.description_p,
				Me.adresse_m,
				Me.telephone_m
			FROM paiement_facture PF 
			INNER JOIN vente V ON V.id_vente = PF.id_vente_pf
			INNER JOIN membres Me ON Me.id_membre = V.id_membre_v
			INNER JOIN package P ON P.id_membre_p = Me.id_membre
			INNER JOIN agence A ON V.id_agence = A.id_agence
			WHERE id_paiement_facture = $id_paiement_facture AND P.type_p = 1
			");
		$res = $query->result_array();
		return $res[0];
	}

	public function get_id_facture($id_vente){
		$query= $this->db->query("
			SELECT 
				id_paiement_facture
			FROM paiement_facture 
			WHERE id_vente_pf = '".$id_vente."'
			");
		$res = $query->result_array();
		return $res[0]['id_paiement_facture'];
	}
}
?>