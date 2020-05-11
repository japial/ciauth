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

	public function authentication($email, $password){
		$user = $this->userByEmail($email);
		if($user && $user->password == md5($password)){
			return $this->find($user->id);
		}else{
			return FALSE;
		}
	}

	public function userByEmail($email)
	{
		$this->db->select('id, name, email, password');
		$this->db->from('users');
		$this->db->where('email', $email);
		return $this->db->get()->row();
	}

	public function isUserEmailAvailable($email)
	{
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('email', $email);
		$exist = $this->db->get()->row();
		if($exist){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function updateUserInfo($id, $data){
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	public function updateUserPassword($id, $data){
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	public function userRoles($userId){
		$this->db->select('role');
		$this->db->from('user_roles');
		$this->db->where('user_id', $userId);
		$roles = $this->db->get()->result();
		$userRoles = array();
		foreach ($roles as $role){
			$userRoles[] = $role->role;
		}
		return $userRoles;
	}

	public function createUser($userData, $role = 'user'){
		$this->db->insert('users', $userData);
		$userID = $this->db->insert_id();
		$this->createUserRole($userID, $role);
		return $userID;
	}

	public function createUserRole($userID, $role){
		$userRole['user_id'] = $userID;
		$userRole['role'] = $role;
		$this->db->insert('user_roles', $userRole);
	}
}
