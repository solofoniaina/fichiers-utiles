<?php
class Membre_model extends CI_Model
{
	public function s_inscrire($code_m, $nom_m, $prenom_m, $login_m, $password_m, $telephone_m, $email_m, $adresse_m, $date_m,$id_parrain)
	{
		$data = array('code_m'=>$code_m, 'nom_m'=>$nom_m, 'prenom_m'=>$prenom_m, 'login_m'=>$login_m, 'password_m'=>$password_m, 'telephone_m'=>$telephone_m, 'email_m'=>$email_m, 'adresse_m'=>$adresse_m, 'date_m'=>$date_m, 'id_parrain'=>$id_parrain);
		return($this->db->insert('membres',$data));
	}

	public function s_inscrire_achat($nom_m, $prenom_m, $password_m, $telephone_m, $date_m,$id_parrain)
	{
		$data = array('nom_m'=>$nom_m,'prenom_m'=>$prenom_m,'password_m'=>$password_m, 'telephone_m'=>$telephone_m,'date_m'=>$date_m, 'id_parrain'=>$id_parrain);
		if ($this->db->insert('membres',$data))
			return $this->db->insert_id();
	}

	public function recuperer_compte($email_m, $code_recup)
	{
		$this->db->where('email_m', $email_m);
		$data = array('code_recup'=>$code_recup);
		return($this->db->update('membres',$data));
	}

	public function changer_mdp($id_membre, $password_m)
	{
		$this->db->where('id_membre', $id_membre);
		$data = array('password_m'=>$password_m);
		return($this->db->update('membres',$data));
	}
	
	public function code_paiement($code)
	{
		$data = array('code'=>$code);
		$this->db->insert('code_paiement',$data);
		return $this->db->insert_id();
	}
	
	public function confirmer($id_membre)
	{
		$data = array('ekena_m'=>"1");
		$this->db->where('id_membre',$id_membre);
		return($this->db->update('membres',$data));
	}
	public function activer($id_membre)
	{
		$prochaine_activation = date('Y-m-d', strtotime(date('Y-m-d').' +1 month'));
		$data = array('active_m'=>$prochaine_activation);
		$this->db->where('id_membre',$id_membre);
		if($this->db->update('membres',$data));
		{	//LOGs des nouveaux abonnements
			$donnees = array('id_membre_log'=>$id_membre, 'date_log' => date("Y-m-d"));
			return $this->db->insert('log_activation',$donnees);
		}
	}
	public function get_parrain($id_membre)
	{
		$requete = $this->db->query("
			SELECT 
				id_parrain_m
			FROM membres
			WHERE id_membre = '".$id_membre."'
			");
		$res = $requete->result_array();
		return $res[0];
	}

	public function est_active($id_membre){
		$requete = $this->db->query("
			SELECT 
				active_m
			FROM membres
			WHERE id_membre = '".$id_membre."'
			AND active_m > NOW()
			");
		$res = $requete->result_array();
		return (count($res));
	}


	public function mail_existe($email_m)
	{
		$requete = $this->db->query("
			SELECT 
				email_m
			FROM membres
			WHERE email_m = '".$email_m."'
			LIMIT 1
			");
		$res = $requete->result_array();
		return (count($res));
	}

	public function tel_existe($telephone_m)
	{
		$requete = $this->db->query("
			SELECT 
				telephone_m
			FROM membres
			WHERE telephone_m = '".$telephone_m."'
			LIMIT 1
			");
		$res = $requete->result_array();
		return (count($res));
	}

	public function login_id($id_membre,$password_m)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre
			FROM membres
			WHERE id_membre = '".$id_membre."'
			AND password_m = '".$password_m."'
			");
		$res = $requete->result_array();
		return ($res[0]['id_membre']);

	}
	public function recuperer_id($code_m)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				ekena_m
			FROM membres
			WHERE code_m = '".$code_m."'
			");
		return($requete);
	}

	public function recuperer_id_recup($code_recup)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				ekena_m
			FROM membres
			WHERE code_recup = '".$code_recup."'
			");
		return $requete->result_array();
	}

	public function ref_paiement($id_membre)
	{
		$requete = $this->db->query("
			SELECT 
				code_paiement_m
			FROM membres
			WHERE id_membre = '".$id_membre."'
			");
		$nombre = $requete->num_rows();
		if ($nombre) {
			$row = $requete->row(0);
			return $row->code_paiement_m;
		}
		else
		{
			return "Une erreur est survenue";
		}
	}
	public function cemembre($id_membre)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				nom_m,
				prenom_m,
				login_m,
				password_m,
				telephone_m,
				adresse_m,
				email_m,
				code_m,
				ekena_m,
				date_m,
				dernier_niveau_membre,
				active_m,
				id_parrain,
				gain_referral_m,
				cin1,
				cin2,
				cin3
			FROM membres
			WHERE id_membre = '".$id_membre."'
			");
		return($requete->result_array());
	}

	public function tout_membre()
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				nom_m,
				prenom_m,
				date_m,
				active_m,
				telephone_m,
				email_m,
				id_parrain
			FROM membres
			WHERE ekena_m = 1
			");
		return($requete->result_array());
	}
	public function count_membre()
	{
		$requete = $this->db->query("
			SELECT 
				COUNT(id_membre) as nombre
			FROM membres
			WHERE ekena_m = 1
			");
		$res = $requete->result_array();
		return $res[0]['nombre'];
	}
	public function tout_membre_non_confirme()
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				nom_m,
				prenom_m,
				date_m,
				active_m,
				telephone_m,
				email_m,
				id_parrain,
				code_m
			FROM membres
			WHERE ekena_m = 0
			");
		return($requete->result_array());
	}

	public function referral($id_parrain)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				nom_m,
				prenom_m,
				date_m,
				email_m,
				active_m
			FROM membres
			WHERE id_parrain = '".$id_parrain."'
			AND ekena_m = 1
			");
		return($requete->result_array());
	}
	public function referral_act($id_parrain,$active_m)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				nom_m,
				prenom_m,
				date_m,
				active_m
			FROM membres
			WHERE id_parrain = '".$id_parrain."'
			AND active_m = '".$active_m."'
			");
		return($requete->result_array());
	}

	public function select_membre($id_membre)
	{
		$requete = $this->db->query("
			SELECT 
				id_membre,
				nom_m,
				prenom_m,
				login_m,
				password_m,
				telephone_m,
				adresse_m,
				email_m,
				code_m,
				ekena_m,
				date_m,
				dernier_niveau_membre,
				active_m
			FROM membres
			WHERE id_membre = '".$id_membre."'
			");
		return($requete);
	}
	public function cin1($id_membre, $cin1)
	{
		$this->db->where('id_membre', $id_membre);
		$data = array('cin1'=>$cin1, 'valide_cin'=> 1);
		return($this->db->update('membres',$data));
	}
	public function cin2($id_membre, $cin2)
	{
		$this->db->where('id_membre', $id_membre);
		$data = array('cin2'=>$cin2, 'valide_cin'=> 1);
		return($this->db->update('membres',$data));
	}
	public function cin3($id_membre, $cin3)
	{
		$this->db->where('id_membre', $id_membre);
		$data = array('cin3'=>$cin3, 'valide_cin'=> 1);
		return($this->db->update('membres',$data));
	}

}
?>