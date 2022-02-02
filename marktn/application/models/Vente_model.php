<?php
class Vente_model extends CI_Model
{
	public function insert($id_package_v,$id_membre_v,$id_parrain_v,$active_parrain_v, $prix_v,$nombre_v, $date_v)
	{
		//enregistrer tous les produits dans chaque package
		$produits = $this->Produit_model->id_produit_package($id_package_v);
		if (count($produits)) {
			foreach ($produits as $key => $prod) {
				$this->Details_vente_model->insert($id_membre_v,$id_package_v,$prod['id_produit'],$date_v);
			}

			$data = array('id_package_v'=>$id_package_v, 'id_membre_v'=>$id_membre_v,'id_parrain_v'=>$id_parrain_v,'active_parrain_v'=>$active_parrain_v, 'prix_v'=>$prix_v,'nombre_v'=>$nombre_v, 'date_v'=>$date_v);
		if($this->db->insert('vente',$data))
		{
			return $this->db->insert_id();
		}
	}
		else return true;
		
	}

	// LOGs DES PAIEMENTS EFFECTUES
	public function log($order_id, $amount,$pay_token,$status, $type )
	{
		$data = array('order_id'=>$order_id, 'amount'=>$amount, 'pay_token'=>$pay_token, 'status'=>$status, 'daty'=>date("Y-m-d"), 'type'=>$type);
		return($this->db->insert('paiement_moobi',$data));
	}

/*SCRIPT UPDATE PRIX dans table VENTE */
	public function update_tout_prix_vente()
	{
	$query= $this->db->query("
			SELECT 
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.image_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			WHERE P.active_p = 1");
		$res = $query->result_array();
		foreach ($res as $key => $result) {
			$this->db->where('id_package_v',$result['id_package']);
			$data = array('prix_v'=>$result['prix_p']);
		$this->db->update('vente',$data);
		}
	}

	public function vente_membre($id_membre){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.id_parrain_v,
				V.prix_v,
				V.date_v,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.date_p,
				P.image_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m,
				A.id_agence,
				A.nom_a
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN vente V ON P.id_package = V.id_package_v
			LEFT JOIN membres Me ON V.id_membre_v = Me.id_membre
			INNER JOIN agence A ON V.id_agence = A.id_agence
			WHERE M.id_membre = '".$id_membre."'
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	}
	public function vente_membre_article($id_membre){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.id_parrain_v,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.date_p,
				P.image_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m,
				Me.id_membre As id_membre_acheteur,
				A.id_agence,
				A.nom_a
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN vente V ON P.id_package = V.id_package_v
			LEFT JOIN membres Me ON V.id_membre_v = Me.id_membre
			INNER JOIN agence A ON V.id_agence = A.id_agence
			WHERE M.id_membre = '".$id_membre."' AND P.type_p = 1 AND V.paye_v = 1 AND V.livre_v = 0
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	} 

	public function vente_membre_article_livre($id_membre){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.id_parrain_v,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				V.retire_argent_v,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.date_p,
				P.image_p,
				A.id_agence,
				A.nom_a
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN vente V ON P.id_package = V.id_package_v
			LEFT JOIN membres Me ON V.id_membre_v = Me.id_membre
			INNER JOIN agence A ON V.id_agence = A.id_agence
			WHERE M.id_membre = '".$id_membre."' AND P.type_p = 1 AND V.livre_v = 1 AND V.paye_v = 1
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	}
	public function achat_membre($id_membre){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.id_parrain_v,
				V.prix_v,
				V.date_v,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.date_p,
				P.image_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN vente V ON P.id_package = V.id_package_v
			LEFT JOIN membres Me ON V.id_membre_v = Me.id_membre
			WHERE V.id_membre_v = '".$id_membre."' AND P.type_p = 0 
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	}
	public function achat_membre_article($id_membre){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.recu_v,
				V.paye_date_v,
				V.livre_date_v,
				V.recu_date_v,
				V.frais_v,
				P.nom_p,
				P.description_p,
				P.image_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m,
				M.adresse_m,
				A.nom_a,
				A.id_agence
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN vente V ON P.id_package = V.id_package_v
			LEFT JOIN membres Me ON V.id_membre_v = Me.id_membre
			INNER JOIN agence A ON V.id_agence = A.id_agence
			WHERE V.id_membre_v = '".$id_membre."' AND P.type_p = 1
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	}
	
	public function commandes_recu_membre_article($id_membre){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				P.nom_p,
				P.description_p,
				P.image_p,
				Me.nom_m,
				Me.prenom_m,
				Me.telephone_m,
				Me.email_m,
				Me.adresse_m,
				A.nom_a,
				A.id_agence
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN vente V ON P.id_package = V.id_package_v
			LEFT JOIN membres Me ON V.id_membre_v = Me.id_membre
			INNER JOIN agence A ON V.id_agence = A.id_agence
			WHERE P.id_membre_p = '".$id_membre."'
			AND V.paye_v = 1 AND V.livre_v = 1
			AND P.type_p = 1
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	}
	public function nouveau_commandes_recu_membre_article($id_membre){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				P.nom_p,
				P.description_p,
				P.image_p,
				Me.nom_m,
				Me.prenom_m,
				Me.telephone_m,
				Me.email_m,
				Me.adresse_m,
				A.nom_a,
				A.id_agence
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN vente V ON P.id_package = V.id_package_v
			LEFT JOIN membres Me ON V.id_membre_v = Me.id_membre
			INNER JOIN agence A ON V.id_agence = A.id_agence
			WHERE P.id_membre_p = '".$id_membre."'
			AND V.paye_v = 1 AND V.livre_v = 0
			AND P.type_p = 1
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	}
	public function nouveau_commandes_recu_vendeur($id_membre){
		$query= $this->db->query("
			SELECT 
				V.id_vente
			FROM package P
			INNER JOIN vente V ON P.id_package = V.id_package_v
			WHERE P.id_membre_p = '".$id_membre."'
			AND V.paye_v = 1 AND V.livre_v = 0
			AND P.type_p = 1
			");
		return $query->result_array();
	}
	public function nouveau_commandes_recu(){
		$query= $this->db->query("
			SELECT 
				V.id_vente
			FROM package P
			INNER JOIN vente V ON P.id_package = V.id_package_v
			WHERE V.paye_v = 0
			AND P.type_p = 1
			");
		return $query->result_array();
	}
	public function vente_parrain($id_parrain_v){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.id_parrain_v,
				V.active_parrain_v,
				V.prix_v,
				V.date_v,
				M.active_m
			FROM vente V 
			LEFT JOIN membres M ON M.id_membre = V.id_membre_v
			WHERE V.id_parrain_v = '".$id_parrain_v."'
			");
		return $query->result_array();
	}
	public function toutvente(){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.id_parrain_v,
				V.prix_v,
				V.date_v,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.date_p,
				P.image_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN vente V ON P.id_package = V.id_package_v
			LEFT JOIN membres M ON V.id_membre_v = M.id_membre
			WHERE P.type_p = 1
			ORDER BY V.date_v desc

			");
		return $query->result_array();
	}
	public function cevente($id_vente){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.id_parrain_v,
				V.prix_v,
				V.date_v,
				V.id_agence,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.date_p,
				P.image_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m,
				Me.nom_m As nom_m_ach,
				Me.prenom_m As prenom_m_ach,
				Me.telephone_m As telephone_m_ach,
				Me.email_m As email_m_ach

			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN vente V ON P.id_package = V.id_package_v
			LEFT JOIN membres Me ON V.id_membre_v = Me.id_membre
			WHERE V.id_vente = '".$id_vente."'
			
			");
		return $query->result_array();
	}
	public function cevente_localisation($id_vente){
		$query= $this->db->query("
			SELECT 	
				V.id_agence As arrivee,
				P.localisation_p As depart
			FROM package P
			INNER JOIN vente V ON P.id_package = V.id_package_v
			WHERE V.id_vente = '".$id_vente."'
			LIMIT 1
			
			");
		$res = $query->result_array();
		return $res[0];
	}
	public function dejaachete($id_package_v)
	{
		$query= $this->db->query("
			SELECT 
				id_vente
			FROM vente
			WHERE id_package_v = '".$id_package_v."'
			");
		$res = $query->result_array();
		if(count($res)) 
		{
			return true;
		}
		else 
		{
		return false;
		}
	}
	public function location_livraison($id_vente, $latlng_v, $point_v, $id_agence, $frais_v)
	{
		$this->db->where('id_vente',$id_vente);
		$data = array('latlng_v'=>$latlng_v, 'point_v'=>$point_v, 'id_agence'=>$id_agence, 'frais_v'=>$frais_v);
		return($this->db->update('vente',$data));
	}
	public function get_prix_vente($id_vente)
	{
		$query= $this->db->query("
			SELECT
				V.prix_v
			FROM vente V
			WHERE V.id_vente = $id_vente
			LIMIT 1
			");
		$res = $query->result_array();
		return $res[0];
	}
	public function mesventes($id_membre){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.prix_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.recu_v,
				V.paye_date_v,
				V.livre_date_v,
				V.recu_date_v,
				V.com_appliquee,
				P.nom_p
			FROM package P
			INNER JOIN vente V ON P.id_package = V.id_package_v
			WHERE P.id_membre_p = '".$id_membre."'
			AND V.paye_v = 1 AND V.livre_v = 1
			AND P.type_p = 1
			");
		return $query->result_array();
	}
	public function mesvente_periode($annee, $mois,$id_membre){
		$critere = "";
		if (!empty($annee)) {
			$critere = "$annee-";
			if (!empty($mois)) {
				$critere .= "$mois-";
			}
		}
		else
		{
			if (!empty($mois)) {
				$critere = "-$mois-";
			}
		}
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.prix_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.recu_v,
				V.paye_date_v,
				V.livre_date_v,
				V.recu_date_v,
				V.com_appliquee,
				P.nom_p
			FROM vente V
			INNER JOIN package P ON P.id_package = V.id_package_v
			WHERE V.date_v LIKE '%".$critere."%'
			AND V.paye_v = 1
			AND V.id_membre_v = $id_membre
			AND P.type_p = 1

			");
		return $query->result_array();
	}

}
?>