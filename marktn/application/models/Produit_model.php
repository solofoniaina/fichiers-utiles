<?php
class Produit_model extends CI_Model
{
	public function insert($id_package_p, $lien_p, $date_p)
	{
		$data = array('id_package_p'=>$id_package_p, 'lien_p'=>$lien_p, 'date_p'=>$date_p);
		return($this->db->insert('produit',$data));
	}
	public function update($id_produit, $nom_p)
	{
		$this->db->where('id_produit',$id_produit);
		$data = array('nom_p'=>$nom_p);
		return($this->db->update('produit',$data));
	}
	public function delete($id_produit)
	{
		$this->db->where('id_produit',$id_produit);
		return($this->db->delete('produit'));
	}
	public function delete_by_package($id_package_p)
	{
		$this->db->where('id_package_p',$id_package_p);
		return($this->db->delete('produit'));
	}
	public function desactive($id_produit)
	{
		$this->db->where('id_produit',$id_produit);
		$data = array('active_p'=> 0);
		return($this->db->update('produit', $data));
	}
	public function desactive_by_package($id_package_p)
	{
		$this->db->where('id_package_p',$id_package_p);
		$data = array('active_p'=> 0);
		return($this->db->update('produit', $data));
	}
	public function produit_package($id_package_p){
		$query= $this->db->query("
			SELECT 
				P.id_produit,
				P.id_package_p,
				P.nom_p,
				P.lien_p
			FROM produit P
			WHERE P.id_package_p = '".$id_package_p."'
			AND P.active_p = 1
			");
		return $query->result_array();
	}

	public function id_produit_package($id_package_p)
	{
		$query= $this->db->query("
			SELECT 
				P.id_produit
			FROM produit P
			WHERE P.id_package_p = '".$id_package_p."'
			AND P.active_p = 1
			");
		return $query->result_array();
	}

	public function toutproduit(){
		$query= $this->db->query("
			SELECT 
				P.id_produit,
				P.id_package_p,
				P.nom_p,
				P.lien_p
			FROM produit P
			INNER JOIN package Pa ON Pa.id_package = P.id_package_p
			WHERE P.active_p = 1
			ORDER BY P.id_produit desc
			");
		return $query->result_array();
	}
	public function ceproduit($id_produit){
		$query= $this->db->query("
			SELECT 
				P.id_produit,
				P.id_package_p,
				P.nom_p,
				P.lien_p
			FROM produit P
			INNER JOIN package Pa ON Pa.id_package = P.id_package_p
			WHERE P.id_produit = '".$id_produit."'
			ORDER BY P.id_produit desc
			
			");
		return $query->result_array();
	}
}
?>