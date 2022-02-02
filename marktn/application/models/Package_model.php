<?php
class Package_model extends CI_Model
{
	public function insert($nom_p, $prix_p, $description_p, $categ_p, $stock_p, $id_membre_p, $date_p, $image_p, $localisation_p, $etat_p, $type_p)
	{
		$data = array('nom_p'=>$nom_p, 'prix_p'=>$prix_p, 'description_p'=>$description_p, 'categ_p'=>$categ_p, 'stock_p'=>$stock_p, 'id_membre_p'=>$id_membre_p, 'date_p'=>$date_p, 'image_p'=>$image_p, 'localisation_p'=>$localisation_p, 'type_p'=>$type_p, 'etat_p'=>$etat_p);
		return($this->db->insert('package',$data));
	}
	public function update($nom_p, $prix_p, $description_p, $categ_p, $stock_p, $image_p, $localisation_p, $id_package)
	{
		$this->db->where('id_package',$id_package);
		$data = array('nom_p'=>$nom_p, 'prix_p'=>$prix_p, 'description_p'=>$description_p, 'categ_p'=>$categ_p, 'stock_p'=>$stock_p, 'image_p'=>$image_p, 'localisation_p'=>$localisation_p);
		return($this->db->update('package',$data));
	}
	public function updatenoimage($nom_p, $prix_p, $description_p, $categ_p, $stock_p, $localisation_p, $etat_p, $id_package)
	{
		$this->db->where('id_package',$id_package);
		$data = array('nom_p'=>$nom_p, 'prix_p'=>$prix_p, 'description_p'=>$description_p, 'categ_p'=>$categ_p, 'stock_p'=>$stock_p, 'localisation_p'=>$localisation_p, 'etat_p'=>$etat_p);
		return($this->db->update('package',$data));
	}
	public function delete($id_package)
	{
		
		if ($this->Produit_model->delete_by_package($id_package)) {
			$this->db->where('id_package',$id_package);
			return($this->db->delete('package'));
		}
	}
	public function reduire_stock($id_package, $nombre_achat)
	{
		$query= $this->db->query("
			UPDATE package
			SET stock_p = stock_p - $nombre_achat
			WHERE id_package = $id_package
			LIMIT 1
			");
		return $query;
	}
	public function ajouter_stock($id_package, $nombre)
	{
		$this->db->query("
			UPDATE package
			SET stock_p = stock_p + $nombre
			WHERE id_package = $id_package
			LIMIT 1
			");
		$query= $this->db->query("
			SELECT stock_p
			FROM package
			WHERE id_package = $id_package
			LIMIT 1");
		$res = $query->result_array();
		return $res[0]['stock_p'];
	}
	public function desactive($id_package)
	{
		
		if ($this->Produit_model->desactive_by_package($id_package)) {
			$this->db->where('id_package',$id_package);
			$data = array('active_p'=> 0);
			return($this->db->update('package', $data));
		}
		
	}

	public function package_membre($id_membre){
		$query= $this->db->query("
			SELECT 
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.image_p,
				P.categ_p,
				P.stock_p,
				A.nom_a,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			LEFT JOIN agence A ON A.id_agence = P.localisation_p
			WHERE M.id_membre = '".$id_membre."' AND P.active_p = 1 AND type_p = 0
			ORDER BY P.id_package desc
			");
		return $query->result_array();
	}
	public function est_mon_produit($id_package, $id_membre)
	{
		$query= $this->db->query("
			SELECT 
				P.id_package
			FROM package P
			WHERE P.id_membre_p = '".$id_membre."' 
			AND P.id_package = '".$id_package."' 
			AND P.active_p = 1 AND P.type_p = 1
			");
		$res = $query->result_array();
		if (count($res))
			return true;
		else return false;
	}
	public function package_membre_article($id_membre){
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
				P.etat_p,
				P.categ_p,
				P.stock_p,
				C.nom_c,
				A.nom_a,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m,
				P.active_p
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN categorie C ON P.categ_p = C.id_categorie
			LEFT JOIN agence A ON A.id_agence = P.localisation_p
			WHERE M.id_membre = '".$id_membre."' AND type_p = 1
			ORDER BY P.id_package desc
			");
		return $query->result_array();
	}
	public function toutpackage(){
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
				P.etat_p,
				P.categ_p,
				P.stock_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			WHERE P.active_p = 1
			ORDER BY P.id_package desc
			");
		return $query->result_array();
	}
	public function toutpackage_avec_prod(){
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
				P.categ_p,
				P.stock_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN produit PR ON PR.id_package_p = P.id_package

			WHERE P.active_p = 1  AND P.type_p = 0
			GROUP BY P.id_package
			ORDER BY RAND()
			");
		return $query->result_array();
	}
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
				P.etat_p,
				P.categ_p,
				P.stock_p,
				A.nom_a,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			LEFT JOIN agence A ON A.id_agence = P.localisation_p
			INNER JOIN produit PR ON PR.id_package_p = P.id_package

			WHERE P.active_p = 1 AND P.type_p = 1 AND P.stock_p > 0
			GROUP BY P.id_package
			ORDER BY RAND()
			");
		return $query->result_array();
	}

	
	public function searchpackage_avec_prod($critere){
		$tab_critere = explode(" ", $critere);
		$liste_criteres1 = "P.nom_p LIKE '%".$tab_critere[0]."%' "; 
		foreach ($tab_critere as $key => $value) 
		{
			if (!empty($value)) {
				if ($key > 0) {
					$liste_criteres1.= "OR P.nom_p LIKE '%".trim($value)."%' ";
				}
				$liste_criteres2.= "OR P.description_p LIKE '%".trim($value)."%' ";
			}
		}
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
				P.categ_p,
				P.stock_p,
				A.nom_a,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN produit PR ON PR.id_package_p = P.id_package
			LEFT JOIN agence A ON A.id_agence = P.localisation_p
			WHERE P.active_p = 1
			AND $liste_criteres1 $liste_criteres2
			GROUP BY P.id_package
			ORDER BY RAND()
			");
		return $query->result_array();
	}
	public function searchproduit($critere, $localisation, $etat_p, $categ_p){
		$tab_critere = explode(" ", $critere);
		$liste_criteres = "";
		foreach ($tab_critere as $key => $value) 
		{
			if (!empty($value)) {
				$liste_criteres .= "AND (P.description_p LIKE '%".trim($value)."%' OR P.nom_p LIKE '%".trim($value)."%')";
			}
		}
		if(!empty($localisation)) $liste_criteres .= "AND P.localisation_p = '".trim($localisation)."'";
		if(!empty($etat_p)) $liste_criteres .= "AND P.etat_p = '".trim($etat_p)."'";
		if(!empty($categ_p)) $liste_criteres .= "AND P.categ_p = '".trim($categ_p)."'";
		$query= $this->db->query("
			SELECT 
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.localisation_p,
				P.etat_p,
				A.nom_a,
				P.image_p,
				P.categ_p,
				P.stock_p,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			INNER JOIN produit PR ON PR.id_package_p = P.id_package
			LEFT JOIN agence A ON A.id_agence = P.localisation_p
			WHERE P.active_p = 1 AND P.type_p = 1
			$liste_criteres
			AND P.stock_p > 0
			GROUP BY P.id_package
			ORDER BY RAND()
			");
		return $query->result_array();
	}
	public function suggest_categorie($categ_p, $limite){
		$query= $this->db->query("
			SELECT 
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.localisation_p,
				P.etat_p,
				P.image_p,
				P.categ_p,
				P.stock_p
			FROM package P
			INNER JOIN produit PR ON PR.id_package_p = P.id_package
			WHERE P.active_p = 1 AND P.type_p = 1 
			AND P.stock_p > 0
			AND P.categ_p = '".trim($categ_p)."'
			GROUP BY P.id_package
			ORDER BY RAND()
			LIMIT $limite
			");
		return $query->result_array();
	}
	public function cepackage($id_package){
		$query= $this->db->query("
			SELECT
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.id_membre_p,
				P.date_p,
				P.image_p,
				P.active_p,
				P.localisation_p,
				P.etat_p,
				P.categ_p,
				P.stock_p,
				A.nom_a,
				M.nom_m,
				M.prenom_m,
				M.telephone_m,
				M.email_m,
				C.nom_c
			FROM package P
			INNER JOIN membres M ON P.id_membre_p = M.id_membre
			LEFT JOIN categorie C ON C.id_categorie = P.categ_p
			LEFT JOIN agence A ON A.id_agence = P.localisation_p
			WHERE P.id_package = '".$id_package."'
			ORDER BY P.id_package desc
			
			");
		return $query->result_array();
	}

	public function prixpackage($id_package){
		$query= $this->db->query("
			SELECT
				P.prix_p
			FROM package P
			WHERE P.id_package = '".$id_package."'
			");
		$res = $query->result_array();
		return $res[0]['prix_p'];
	}

	public function getalllocalisation(){
		$query= $this->db->query("
			SELECT
				A.id_agence,
				A.nom_a
			FROM agence A
			INNER JOIN package P ON P.localisation_p = A.id_agence
			GROUP BY A.id_agence
			ORDER BY nom_a
			");
		return $query->result_array();
	}
	public function localisation($id_agence)
	{
		$query= $this->db->query("
				SELECT
					nom_a
				FROM agence
				WHERE id_agence = $id_agence
				");
			$loca = $query->result_array();
			$loca = $loca[0]['nom_a'];
			if (!empty($loca)) {
				return $loca;
			}else return "Tsy voalaza";
			 ;
	}
	//localisation produit
	public function get_localisation($id_package)
	{
		$query= $this->db->query("
			SELECT
				P.localisation_p
			FROM package P
			WHERE P.id_package = '".$id_package."'
			");
		$res = $query->result_array();
		return $res[0]['localisation_p'];
	}

	//TOP PRODUIT
	public function top_produits($limite){
		$query= $this->db->query("
			SELECT
				P.id_package,
				P.nom_p,
				P.prix_p,
				P.description_p,
				P.image_p,
				P.etat_p,
				P.categ_p,
				P.stock_p,
				C.nom_c
			FROM package P
			LEFT JOIN categorie C ON C.id_categorie = P.categ_p
			WHERE P.active_p = 1 AND P.type_p = 1 
			ORDER BY RAND()
			LIMIT $limite
			");
		return $query->result_array();
	}
}
?>