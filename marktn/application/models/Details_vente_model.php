<?php
class Details_vente_model extends CI_Model
{
	public function insert($id_membre_d,$id_package_d,$id_produit_d, $date_d)
	{
		$data = array('id_membre_d'=>$id_membre_d, 'id_package_d'=>$id_package_d,'id_produit_d'=>$id_produit_d, 'date_d' => $date_d);
		return($this->db->insert('details_vente',$data));
	}

	public function details_achat_package_membre($id_membre_d, $id_package_d, $date_d){
		$query= $this->db->query("
			SELECT 
				P.nom_p,
				P.lien_p
			FROM produit P
			INNER JOIN details_vente D ON P.id_produit = D.id_produit_d
			WHERE D.id_membre_d = '".$id_membre_d."'
			AND D.id_package_d = '".$id_package_d."'
			AND D.date_d = '".$date_d."'
			GROUP BY P.id_produit
			");
		return $query->result_array();
	}
}
?>