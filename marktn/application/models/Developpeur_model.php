<?php
class Developpeur_model extends CI_Model
{
	public function candidat($email_d, $lien_d)
	{
		$data = array('email_d'=>$email_d, 'lien_d'=>$lien_d);
		return($this->db->insert('developpeur',$data));
	}
}
?>