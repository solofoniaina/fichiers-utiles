<?php
class Messages_model extends CI_Model
{

	public function envoyer($corps_m, $fichier_m, $id_projet_m, $id_client_m, $direction_m, $date_m)
	{
		$data = array('corps_m'=>$corps_m, 'fichier_m'=>$fichier_m, 'id_projet_m'=>$id_projet_m, 'id_client_m'=>$id_client_m, 'direction_m'=>$direction_m, 'date_m'=>$date_m);
		return($this->db->insert('messages',$data));
	}

	public function getMessages($id_projet_m)
	{

		$query= $this->db->query("SELECT 
										corps_m,
										fichier_m,
										id_projet_m,
										id_client_m,
										direction_m,
										date_m
									FROM messages 
									WHERE id_projet_m = '".$id_projet_m."' ");	
		return $query;	
	}
}
?>
