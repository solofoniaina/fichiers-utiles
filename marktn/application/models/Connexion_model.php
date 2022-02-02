<?php
class Connexion_model extends CI_Model
{

	public function verifierMembre($login, $mdp)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre
			FROM membres
			WHERE email_m = '".$login."'
			AND password_m = '".$mdp."'
			AND ekena_m = 1
			");
		$nombre = $requete->num_rows();
		if ($nombre > 0) 
		{
			return true;
		}
		else return false;
	}
	public function verifierMembre_achat($telephone_m, $password_m)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre
			FROM membres
			WHERE telephone_m = '".$telephone_m."'
			AND password_m = '".$password_m."'
			AND ekena_m = 0
			");
		$nombre = $requete->num_rows();
		if ($nombre > 0) 
		{
			return true;
		}
		else return false;
	}

	public function verifierAdmin($login, $mdp)
	{
		$requete = $this->db->query("
			SELECT 
				id_admin
			FROM admin
			WHERE login_a = '".$login."'
			AND password_a = '".$mdp."'
			");
		$nombre = $requete->num_rows();
		if ($nombre > 0) 
		{
			return true;
		}
		else return false;
	}

	public function getIdMembre($login, $mdp)
	{
		$id_membre = "";
		$requete = $this->db->query("
			SELECT 
				id_membre
			FROM membres
			WHERE email_m = '".$login."'
			AND password_m = '".$mdp."'
			");
		$nombre = $requete->num_rows();
		if ($nombre > 0) 
		{
			$row = $requete->row(0);
			$id_membre = $row->id_membre;
		}
		return($id_membre);
	}

		public function getIdMembre_achat($telephone_m, $password_m)
	{
		$id_membre = "";
		$requete = $this->db->query("
			SELECT 
				id_membre
			FROM membres
			WHERE telephone_m = '".$telephone_m."'
			AND password_m = '".$password_m."'
			");
		$nombre = $requete->num_rows();
		if ($nombre > 0) 
		{
			$row = $requete->row(0);
			$id_membre = $row->id_membre;
		}
		return($id_membre);
	}

	public function getIdAdmin($login, $mdp)
	{
		$id_admin = "";
		$requete = $this->db->query("
			SELECT 
				id_admin,
				role_a
			FROM admin
			WHERE login_a = '".$login."'
			AND password_a = '".$mdp."'
			");
		$admin = $requete->result_array();
		
		return($admin[0]);
		
	}

}
?>