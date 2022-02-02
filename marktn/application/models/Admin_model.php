<?php
class Admin_model extends CI_Model
{
	public function select_Admin($id_admin)
	{
		$requete = $this->db->query("
			SELECT 
				id_admini,
				nom_a
			FROM admini
			WHERE id_admini = '".$id_admin."'
			");
		return($requete);
	}
	public function update_parametres($gain_public, $gain_membre, $gain_referral, $gain_referral_free, $bonus_abonnement, $notre_commission, $droit_inscription, $minimum_retrait, $date_update, $heure_update)
	{
		$data = array('gain_public'=>$gain_public, 'gain_membre'=>$gain_membre, 'gain_referral'=>$gain_referral, 'gain_referral_free'=>$gain_referral_free, 'bonus_abonnement'=>$bonus_abonnement,'notre_commission'=>$notre_commission, 'droit_inscription'=>$droit_inscription, 'minimum_retrait'=>$minimum_retrait, 'date_update'=>$date_update, 'heure_update'=>$heure_update);
		return($this->db->update('parametres',$data));
	}
	public function get_parametres()
	{
		$requete = $this->db->query("
			SELECT 
				gain_public,
				gain_membre,
				gain_referral,
				gain_referral_free,
				notre_commission,
				droit_inscription,
				minimum_retrait,
				date_update,
				heure_update,
				bonus_abonnement
			FROM parametres
			");
		return($requete->result_array());
	}

	/* OPERATION SUR LES MEMBRES */
	public function membre_sans_parrain()
	{
		$requete = $this->db->query("
			SELECT 
				id_membre
			FROM membres
			WHERE id_parrain IS NULL
			AND active_m = 1
			");
		$res = $requete->result_array();
		return count($res);
	}
	public function membre_avec_parrain()
	{
		$requete = $this->db->query("
			SELECT 
				id_membre
			FROM membres
			WHERE id_parrain IS NOT NULL
			AND active_m = 1
			");
		$res = $requete->result_array();
		return count($res);
	}

	public function membre($active_m)
	{
		if ($active_m) {
			$condition = "active_m > NOW()";
		}
		else
		{
			$condition = "active_m <= NOW()";
		}
		$requete = $this->db->query("
			SELECT 
				id_membre,
				nom_m,
				prenom_m,
				date_m,
				active_m,
				id_parrain
			FROM membres
			WHERE $condition
			");
		return($requete->result_array());
	}

	/*OPERATIONS SUR LES VENTES 
	REGLES : 
		1- Avec id_parrain sans id_membre => 0%membre + -5% parrain + 20 % commission (membre non actif ou non membre)
		2- Avec id_parrain avec id_membre => 5% membre -10% parrain + 10 % commission (membre actif)
		3- sans id_parrain sans id_membre => 0% membre -0% parrain + 25% commission 			  => 0% parrain    + 20% commission ()
		4- sans id_parrain avec id_membre => 5% membre -0% parrain + 20% commission
	*/
	public function toutvente(){
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v,
				V.id_parrain_v,
				V.prix_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.recu_v,
				V.paye_date_v,
				V.livre_date_v,
				V.recu_date_v,
				V.com_appliquee,
				V.frais_v,
				P.nom_p
			FROM vente V
			INNER JOIN package P ON P.id_package = V.id_package_v
			WHERE V.paye_v = 1
			");
		return $query->result_array();
	}
	
	public function vente_periode($annee, $mois){
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
				V.id_parrain_v,
				V.prix_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.recu_v,
				V.paye_date_v,
				V.livre_date_v,
				V.recu_date_v,
				V.com_appliquee,
				V.frais_v,
				P.nom_p
			FROM vente V
			INNER JOIN package P ON P.id_package = V.id_package_v
			WHERE V.date_v LIKE '%".$critere."%'
			AND V.paye_v = 1

			");
		return $query->result_array();
	}

	/* RETRAITS */
	public function retrait($etat)
	{
		$requete = $this->db->query("
			SELECT 
				D.valeur_d,
				D.date_d,
				D.date_paiement_d
			FROM demande_paiement D
			WHERE D.etat_d = '".$etat."'
			");
		return ($requete->result_array());
	}
	/* fichiers PACKAGES */
	public function tout_package(){
		$query= $this->db->query("
			SELECT 
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.image_p,
				P.active_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			");
		return $query->result_array();
	}
	public function search_fichier($nom_p){
		$query= $this->db->query("
			SELECT 
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.image_p,
				P.active_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			WHERE p.nom_p LIKE '%".$nom_p."%'
			");
		return $query->result_array();
	}
	/* PRODUIT PACKAGE */
	
	public function toutpackage_article(){
		$query= $this->db->query("
			SELECT 
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.image_p,
				P.localisation_p,
				A.nom_a
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			LEFT JOIN agence A ON A.id_agence = P.localisation_p
			INNER JOIN produit PR ON PR.id_package_p = P.id_package

			WHERE P.active_p = 1 AND P.type_p = 1
			GROUP BY P.id_package
			ORDER BY P.id_package DESC
			");
		return $query->result_array();
	}
	public function produit_package($id_package_p){
		$query= $this->db->query("
			SELECT 
				P.id_produit,
				P.id_package_p,
				P.nom_p,
				P.lien_p,
				P.active_p
			FROM produit P
			WHERE P.id_package_p = '".$id_package_p."'
			");
		return $query->result_array();
	}

	/* GAIN REFERRAL */
	/* 
	* @param $type : 0 si inscription (free gain), 1 si activation (commission gain)
	* */
	public function gain_des_parrains($id_membre,$type)
	{
		$parametres = $this->get_parametres();
    	$p = $parametres[0];
    	if ($type) {
    		//POUR PAIEMENT D'ABONNEMENT
    		$somme = ($p['droit_inscription'] * $p['gain_referral'] / 100) - ($p['gain_referral_free'] / 2);
    		//GAGNER UN BONUS AU PAIEMENT de l'abonnement
    		$this->cumuler_gain_referral($id_membre, $p['bonus_abonnement']);
    	}
    	else
    	{
    		$somme = $p['gain_referral_free'] / 2;
    	}
    	
		$niveau = 0;
		while ( $niveau <= 10) {
			$id_parrain = $this->get_parrain($id_membre);
			if (empty($id_parrain)) {
				return $niveau;
			}
			//MEMBRE ACTIF = $somme
			if ($this->Membre_model->est_active($id_parrain)) {
				$a_cumuler = $somme;
			}
			//MEMBRE NON ACTIF = $somme / 2
			else
			{
				//floor : Arrondir à l'entier inférieur
				$a_cumuler = floor($somme / 2);
			}
			$this->cumuler_gain_referral($id_parrain, $a_cumuler);
			$id_membre = $id_parrain;
			//floor : Arrondir à l'entier inférieur
			$somme = floor($somme / 2);
			$niveau ++;
		}
		return true;
	}

		/** CUMUL DES GAINS PAR REFERRALS */

	public function cumuler_gain_referral($id_membre, $nouveau_gain)
	{
		$requete = $this->db->query("
				UPDATE membres
				SET gain_referral_m = gain_referral_m + $nouveau_gain
				WHERE id_membre = '".$id_membre."'
			");
		return $requete;
	}

	public function deduire_gain_referral($id_membre, $a_deduire)
	{
		$requete = $this->db->query("
				UPDATE membres
				SET gain_referral_m = gain_referral_m - $a_deduire
				WHERE id_membre = '".$id_membre."'
			");
		return $requete;
	}

	public function get_parrain($id_membre)
	{
		$requete = $this->db->query("
			SELECT 
				id_parrain
			FROM membres
			WHERE id_membre = '".$id_membre."'
			");
		$res = $requete->result_array();
		return $res[0]['id_parrain'];
	}

	//LOGS ACTIVATION 
	public function get_log_activation()
	{
		$requete = $this->db->query("
			SELECT 
				L.id_log_activation,
				L.date_log,
				L.id_membre_log,
				M.nom_m,
				M.prenom_m
			FROM log_activation L INNER JOIN membres M ON L.id_membre_log = M.id_membre
			WHERE L.etat_log = 0
			");
		return $requete->result_array();
	}

	//MARQUER "1" LES LOGS VERIFIEES
	public function marque_ok_log($id_log_activation)
	{
		$requete = $this->db->query("
			UPDATE log_activation
			SET etat_log = 1
			WHERE id_log_activation = '".$id_log_activation."'
			");
		return $requete;
	}

	//LOGS NOUVELLE INSCRIPTION 
	public function get_log_insc()
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				date_m,
				nom_m,
				prenom_m
			FROM membres
			WHERE log_gain_parrain_m = 0
			AND ekena_m = 1
			");
		return $requete->result_array();
	}

	//MARQUER "1" LES LOGS VERIFIEES
	public function marque_ok_log_insc($id_membre)
	{
		$requete = $this->db->query("
			UPDATE membres
			SET log_gain_parrain_m = 1
			WHERE id_membre = '".$id_membre."'
			");
		return $requete;
	}
	//LOG PAIEMENT MOOBIPAY
	public function paiement_by_order_id($order_id)
	{
		$requete = $this->db->query("
			SELECT 
				order_id,
				amount,
				pay_token,
				status,
				daty,
				type
			FROM paiement_moobi
			WHERE order_id = '".$order_id."'
			");
		$res = $requete->result_array();
		return $res[0];
	}
	//LOG PAIEMENT MOOBIPAY
	public function paiement_moobi()
	{
		$requete = $this->db->query("
			SELECT 
				order_id,
				amount,
				pay_token,
				status,
				daty,
				type
			FROM paiement_moobi
			WHERE status = 'success'
			");
		return $requete->result_array();
	}

	public function tout_membre_non_confirme_by_limit($debut, $limit)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				nom_m,
				prenom_m,
				date_m,
				active_m,
				telephone_m,
				email_m,
				id_parrain,
				code_m
			FROM membres
			WHERE ekena_m = 0
			LIMIT $debut, $limit
			");
		return($requete->result_array());
	}
	
	/****** PRODUIT **********/

	public function tout_commande()
	{
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.id_agence,
				V.latlng_v,
				A.coord_latlng_a
			FROM package P
			INNER JOIN vente V ON P.id_package = V.id_package_v
			INNER JOIN agence A ON V.id_agence = A.id_agence
			WHERE P.type_p = 1
			");
		return $query->result_array();
	}

public function commande_par_agence($id_agence)
	{
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v As id_membre_acheteur,
				V.id_parrain_v,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.id_agence,
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
			WHERE P.type_p = 1 AND V.id_agence = $id_agence
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	}
	public function commande_details($id_vente)
	{
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v As id_membre_acheteur,
				V.id_parrain_v,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.id_agence,
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
			WHERE P.type_p = 1 AND V.id_vente = $id_vente
			");
		return $query->result_array();
	}
	public function achat_article_paye_livre($paye_v, $livre_v, $recu_v)
	{
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v As id_membre_acheteur,
				V.id_parrain_v,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.paye_date_v,
				V.livre_date_v,
				V.recu_date_v,
				V.id_agence,
				V.frais_v,
				V.com_appliquee,
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
			WHERE P.type_p = 1 
			AND V.paye_v = $paye_v 
			AND V.livre_v = $livre_v
			AND V.recu_v = $recu_v
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	}
	public function search_achat_article_paye_livre($paye_v, $livre_v, $recu_v,$user,$produit)
	{
		$query= $this->db->query("
			SELECT 
				V.id_vente,
				V.id_package_v,
				V.id_membre_v As id_membre_acheteur,
				V.id_parrain_v,
				V.prix_v,
				V.nombre_v,
				V.date_v,
				V.paye_v,
				V.livre_v,
				V.paye_date_v,
				V.livre_date_v,
				V.recu_date_v,
				V.id_agence,
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
			WHERE P.type_p = 1 
			AND V.paye_v = $paye_v 
			AND V.livre_v = $livre_v
			AND V.recu_v = $recu_v
			AND ((M.nom_m LIKE '%".$user."%' OR M.prenom_m LIKE '%".$user."%' OR Me.nom_m LIKE '%".$user."%' OR Me.prenom_m LIKE '%".$user."%') AND (P.nom_p LIKE '%".$produit."%' OR V.id_vente = '".$produit."'))
			ORDER BY V.date_v desc
			");
		return $query->result_array();
	}
	
	public function produit_marquer_recu($id_vente)
	{
		$requete = $this->db->query("
				UPDATE vente
				SET recu_v = 1,
					recu_date_v = '".date("Y-m-d")."'
				WHERE id_vente = '".$id_vente."'
				LIMIT 1
			");
		return $requete;
	}
	public function produit_marquer_livrer($id_vente)
	{
		$requete = $this->db->query("
				UPDATE vente
				SET livre_v = 1,
					livre_date_v = '".date("Y-m-d")."'
				WHERE id_vente = '".$id_vente."'
				LIMIT 1
			");
		return $requete;
	}
	public function produit_marquer_rejeter($id_vente)
	{
		$requete = $this->db->query("
				UPDATE vente
				SET livre_v = 2,
					livre_date_v = '".date("Y-m-d")."'
				WHERE id_vente = '".$id_vente."'
				LIMIT 1
			");
		return $requete;
	}

	public function produit_marquer_payer($id_vente, $com_appliquee)
	{
		$requete = $this->db->query("
				UPDATE vente
				SET paye_v = 1,
					com_appliquee = $com_appliquee,
					paye_date_v =  '".date("Y-m-d")."'
				WHERE id_vente = '".$id_vente."'
				LIMIT 1
			");
		return $requete;
	}
}
?>