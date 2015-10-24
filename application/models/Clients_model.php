<?php 

class Clients_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function set_client($email, $name, $location)
    {
       $data = array(
		   'email' => $email ,
		   'name' => $name ,
           'location'=> $location
		);

        $this->db->insert('clients', $data);
    }

    // function update_entry()
    // {
    //     $this->title   = $_POST['title'];
    //     $this->content = $_POST['content'];
    //     $this->date    = time();

    //     $this->db->update('entries', $this, array('id' => $_POST['id']));
    // }

}
?>