<?php
class Categorie_model extends CI_Model
{
	####### categorie #########
	public function insert_categorie($nom_c)
	{
		$data = array('nom_c'=>$nom_c);
		return($this->db->insert('categorie',$data));
	}
	public function update_categorie($nom_c,$id_categorie)
	{
		$this->db->where('id_categorie', $id_categorie);
		$data = array('nom_c'=>$nom_c);
		return($this->db->update('categorie',$data));
	}
	public function delete_categorie($id_categorie)
	{
		$this->db->where('id_categorie', $id_categorie);
		return($this->db->delete('categorie'));
	}

	public function get_categorie(){
		$query= $this->db->query("
			SELECT 
				id_categorie,
				nom_c
			FROM categorie
			ORDER BY nom_c 
			");
		return $query->result_array();
	}

	public function id_to_name_categorie($id_categorie){
		$query= $this->db->query("
			SELECT 
				nom_c
			FROM categorie 
			WHERE id_categorie = '".$id_categorie."'
			");
		$res = $query->result_array();
		return $res[0]['nom_c'];
	}


}
?>