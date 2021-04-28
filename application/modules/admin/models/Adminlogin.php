<?php
class Adminlogin extends CI_Model { 

	public function __construct() { 
		parent::__construct(); 
	}	
	/*
	Name : loginCheck
	Purpose : to authentication
	Parameter : username and password
	Return : query;
	*/
	public function loginCheck($username,$password) 
	{
		$this->db->select('*');
		$this->db->from('ds_users');
		$this->db->where(array('email' => $username, 'password' => $password, 'role_id' => '0'  ));		
		$query = $this->db->get(); 
		return $query;
	} /* end of login check function */	
} /* end of class */
?>