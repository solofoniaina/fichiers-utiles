<?php
class Services_model extends CI_Model
{
	public function renseigner($email_s, $lien_s)
	{
		$data = array('email_s'=>$email_s, 'lien_s'=>$lien_s, 'date_s'=>date("Y-m-d"));
		return($this->db->insert('services',$data));
	}
}
?>