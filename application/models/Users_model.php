<?php 
class Users_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function create_user($data){
    	$this->db->insert('users',$data);
    }

    function login($username, $password){
    	$query = $this->db->get_where('users', array('username' => $username, 'password' => $password),1);
    	return $query->first_row('array');
    }

    function check_user_exists($username){
        $query = $this->db->get_where('users', array('username' => $username));
        if ($query->result_array()) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
    
 ?>