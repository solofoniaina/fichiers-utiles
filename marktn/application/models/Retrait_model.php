<?php
class Retrait_model extends CI_Model
{
	public function demander($id_membre_d, $valeur_d, $date_d, $code_paiement_d, $numero_d)
	{

		$requete = $this->db->query("
			SELECT 
				valeur_d,
				date_d,
				code_paiement_d,
				numero_d
			FROM demande_paiement
			WHERE etat_d = 0
			AND id_membre_d = '".$id_membre_d."'
			");
		$res = $requete->result_array();
		if (count($res)) {
			return ($res[0]);
		}
		else
		{
			$data = array('id_membre_d'=>$id_membre_d, 'valeur_d'=>$valeur_d, 'date_d'=>$date_d, 'code_paiement_d' => $code_paiement_d, 'numero_d'=> $numero_d);
			if($this->db->insert('demande_paiement',$data))
			{
				return 1;
			}
		}
		
	}
	public function code_paiement($code)
	{
		
	}
	
	public function payer_vanilla($id_demande_paiement,$date_paiement_d)
	{
		$data = array('etat_d'=>1, 'date_paiement_d' => $date_paiement_d);
		$this->db->where('id_demande_paiement',$id_demande_paiement);
		return($this->db->update('demande_paiement',$data));
	}
	

	public function en_attente()
	{
		$requete = $this->db->query("
			SELECT 
				D.id_demande_paiement,
				D.id_membre_d,
				D.valeur_d,
				D.date_d,
				D.date_paiement_d,
				D.etat_d,
				D.code_paiement_d,
				D.numero_d,
				M.nom_m,
				M.prenom_m
			FROM demande_paiement D
			INNER JOIN membres M ON M.id_membre = D.id_membre_d
			WHERE etat_d = 0
			ORDER BY D.id_demande_paiement
			");
		return ($requete->result_array());
	}
	public function payee()
	{
		$requete = $this->db->query("
			SELECT 
				D.id_demande_paiement,
				D.id_membre_d,
				D.valeur_d,
				D.date_d,
				D.date_paiement_d,
				D.etat_d,
				D.code_paiement_d,
				D.numero_d,
				M.nom_m,
				M.prenom_m
			FROM demande_paiement D
			INNER JOIN membres M ON M.id_membre = D.id_membre_d
			WHERE etat_d = 1
			");
		return ($requete->result_array());
	}
	public function retrait_membre($id_membre_d)
	{
		$requete = $this->db->query("
			SELECT 
				D.id_demande_paiement,
				D.valeur_d,
				D.date_paiement_d,
				D.etat_d,
				D.code_paiement_d,
				D.numero_d
			FROM demande_paiement D
			WHERE id_membre_d = '".$id_membre_d."'
			");
		return ($requete->result_array());
	}
}
?>