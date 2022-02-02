<?php
class Agence_model extends CI_Model
{
	public function insert($nom_a,$coord_point_a,$coord_latlng_a, $niveau_a)
	{
		$data = array('nom_a'=>$nom_a, 'coord_point_a'=>$coord_point_a,'coord_latlng_a'=>$coord_latlng_a,'niveau_a'=>$niveau_a);
		return($this->db->insert('agence',$data));
	}
	public function update($nom_a,$coord_point_a,$coord_latlng_a,$id_agence)
	{
		$this->db->where('id_agence', $id_agence);
		$data = array('nom_a'=>$nom_a, 'coord_point_a'=>$coord_point_a,'coord_latlng_a'=>$coord_latlng_a);
		return($this->db->update('agence',$data));
	}
	public function delete($id_agence)
	{
		$this->db->where('id_agence', $id_agence);
		return($this->db->delete('agence'));
	}

	public function select_all(){
		$query= $this->db->query("
			SELECT 
				id_agence,
				nom_a,
				coord_latlng_a,
				coord_point_a
			FROM agence
			");
		return $query->result_array();
	}
	public function select_by_id($id_agence){
		$query= $this->db->query("
			SELECT 
				id_agence,
				nom_a,
				coord_latlng_a,
				coord_point_a
			FROM agence 
			WHERE id_agence = '".$id_agence."'
			");
		return $query->result_array();
	}
	public function id_to_name($id_agence){
		$query= $this->db->query("
			SELECT 
				nom_a
			FROM agence 
			WHERE id_agence = '".$id_agence."'
			");
		$res = $query->result_array();
		return $res[0]['nom_a'];
	}
	public function get_latlng($id_agence){
		$query= $this->db->query("
			SELECT 
				coord_latlng_a
			FROM agence 
			WHERE id_agence = '".$id_agence."'
			");
		$res = $query->result_array();
		return $res[0]['coord_latlng_a'];
	}
}
?>