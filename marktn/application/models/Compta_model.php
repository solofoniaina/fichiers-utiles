<?php
class Compta_model extends CI_Model
{
	public function insert($vendeur_c_v,$comm_c_v,$frais_c_v, $id_vente_c_v)
	{
		$data = array('vendeur_c_v'=>$vendeur_c_v, 'comm_c_v'=>$comm_c_v,'frais_c_v'=>$frais_c_v,'id_vente_c_v'=>$id_vente_c_v);
		return($this->db->insert('compta_vente',$data));
	}

	public function select_all(){
		$query= $this->db->query("
			SELECT 
				CV.id_compta_vente,
				CV.vendeur_c_v,
				CV.comm_c_v,
				CV.frais_c_v,
				CV.id_vente_c_v
			FROM compta_vente CV
			INNER JOIN vente V ON V.id_vente = CV.id_vente_c_v
			");
		return $query->result_array();
	}
	public function select_by_vente($id_vente){
		$query= $this->db->query("
			SELECT 
				CV.id_compta_vente,
				CV.vendeur_c_v,
				CV.comm_c_v,
				CV.frais_c_v,
				CV.id_vente_c_v
			FROM compta_vente CV
			INNER JOIN vente V ON V.id_vente = CV.id_vente_c_v
			WHERE V.id_vente = '".$id_vente."'
			");
		return $query->result_array();
	}
}
?>