<?php
class Parametres_model extends CI_Model
{
	public function insert($dep_f_d,$arriv_f_d,$val_f_d)
	{
		$data = array('dep_f_d'=>$dep_f_d, 'arriv_f_d'=>$arriv_f_d,'val_f_d'=>$val_f_d);
		return($this->db->insert('frais_distance',$data));
	}
	public function update($dep_f_d,$arriv_f_d,$val_f_d)
	{
		$query= $this->db->query("
			UPDATE frais_distance
			SET 	val_f_d = $val_f_d
			WHERE (dep_f_d = '".$dep_f_d."' AND arriv_f_d = '".$arriv_f_d."') OR (dep_f_d = '".$arriv_f_d."' AND arriv_f_d = '".$dep_f_d."')
			LIMIT 1
			");
		return $query;
	}

	public function save_or_update_frais_distance($dep_f_d,$arriv_f_d,$val_f_d){
		$query= $this->db->query("
			SELECT 
				val_f_d
			FROM frais_distance 
			WHERE (dep_f_d = '".$dep_f_d."' AND arriv_f_d = '".$arriv_f_d."') OR (dep_f_d = '".$arriv_f_d."' AND arriv_f_d = '".$dep_f_d."')
			LIMIT 1
			");
		$res = $query->result_array();
		if (count($res)) {
			$this->update($dep_f_d,$arriv_f_d,$val_f_d);
		}
		else $this->insert($dep_f_d,$arriv_f_d,$val_f_d);

	}
	public function select_val($dep_f_d,$arriv_f_d){
		$query= $this->db->query("
			SELECT 
				val_f_d
			FROM frais_distance 
			WHERE (dep_f_d = '".$dep_f_d."' AND arriv_f_d = '".$arriv_f_d."') OR (dep_f_d = '".$arriv_f_d."' AND arriv_f_d = '".$dep_f_d."')
			LIMIT 1
			");
		$res = $query->result_array();
		return $res[0]['val_f_d'];
	}
	public function select_frais_dist(){
		$query= $this->db->query("
			SELECT 
				val_f_d,
				dep_f_d,
				arriv_f_d
			FROM frais_distance 
			");
		return $query->result_array();
	}
}
?>