<?php


class UsersModel extends CI_Model
{

	public function find($id)
	{
		$this->db->select('id, name, email');
		$this->db->from('users');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	public function userByEmail($email)
	{
		$this->db->select('id, name, email, password');
		$this->db->from('users');
		$this->db->where('email', $email);
		return $this->db->get()->row();
	}

	public function authentication($email, $password){
		$user = $this->userByEmail($email);
		if($user && $user->password == md5($password)){
			return $this->find($user->id);
		}else{
			return FALSE;
		}
	}

	public function userRoles($userId){
		$this->db->select('roles.name');
		$this->db->from('user_roles');
		$this->db->join('roles','roles.id = user_roles.role_id');
		$this->db->where('user_roles.user_id', $userId);
		$roles = $this->db->get()->result();
		$userRoles = array();
		foreach ($roles as $role){
			$userRoles[] = $role->name;
		}
		return $userRoles;
	}

	public function createUser($userData, $role = 1){
		$this->db->insert('users', $userData);
		$userID = $this->db->insert_id();
		$this->createUserRole($userID, $role);
		return $userID;
	}

	public function createUserRole($userID, $role){
		$userRole['user_id'] = $userID;
		$userRole['role_id'] = $role;
		$this->db->insert('user_roles', $userRole);
	}
}
