<?php
class User_model extends CI_Model
{
	####### ROLE #########
	public function insert_role($nom_r)
	{
		$data = array('nom_r'=>$nom_r);
		return($this->db->insert('role',$data));
	}
	public function update_role($nom_r,$id_role)
	{
		$this->db->where('id_role', $id_role);
		$data = array('nom_r'=>$nom_r);
		return($this->db->update('role',$data));
	}
	public function delete_role($id_role)
	{
		$this->db->where('id_role', $id_role);
		return($this->db->delete('role'));
	}

	public function get_role(){
		$query= $this->db->query("
			SELECT 
				id_role,
				nom_r
			FROM role
			");
		return $query->result_array();
	}

	public function id_to_name_role($id_role){
		$query= $this->db->query("
			SELECT 
				nom_r
			FROM role 
			WHERE id_role = '".$id_role."'
			");
		$res = $query->result_array();
		return $res[0]['nom_r'];
	}


	#### USER ######
	public function insert($nom_a, $prenom_a, $login_a, $telephone_a, $password_a, $role_a)
	{
		$data = array('nom_a'=>$nom_a,'prenom_a'=>$prenom_a, 'login_a'=>$login_a, 'telephone_a'=>$telephone_a,'role_a'=>$role_a, 'password_a'=>$password_a);
		return($this->db->insert('admin',$data));
	}
	public function update($nom_a, $prenom_a, $login_a, $telephone_a, $password_a, $role_a,$id_admin)
	{
		$this->db->where('id_admin', $id_admin);
		$data = array('nom_a'=>$nom_a,'prenom_a'=>$prenom_a, 'login_a'=>$login_a, 'telephone_a'=>$telephone_a,'role_a'=>$role_a, 'password_a'=>$password_a);
		return($this->db->update('admin',$data));
	}

	public function get(){
		$query= $this->db->query("
			SELECT 
				A.nom_a,
				A.prenom_a,
				A.login_a,
				A.telephone_a,
				A.password_a,
				A.role_a,
				A.id_admin,
				R.nom_r
			FROM admin A
			LEFT JOIN role R ON R.id_role = A.role_a
			");
		return $query->result_array();
	}
	public function get_id($id_admin){
		$query= $this->db->query("
			SELECT 
				A.nom_a,
				A.prenom_a,
				A.login_a,
				A.telephone_a,
				A.password_a,
				A.role_a,
				A.id_admin,
				R.nom_r
			FROM admin A
			INNER JOIN role R ON R.id_role = A.role_a
			WHERE id_admin = '".$id_admin."'
			LIMIT 1
			");
		$res = $query->result_array();
		return $res[0];
	}
		public function delete($id_admin)
	{
		$this->db->where('id_admin', $id_admin);
		return($this->db->delete('admin'));
	}
}
?>