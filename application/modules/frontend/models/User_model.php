<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*
      Name : loginCheck
      Purpose : to authentication
      Parameter : username and password
      Return : query;
     */

    public function loginCheck($email, $password) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('u_email' => $email, 'u_password' => $password));
        $query = $this->db->get();
        return $query;
    }

/* end of login check function */

    public function registerGemeenteen($data) {
        $this->db->set($data);
        $query = $this->db->insert('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function registerVerenigingen($data) {
        $this->db->set($data);
        $query = $this->db->insert('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

}

/* end of class */
?>