<?php 

class Team_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_team_members()
    {
        $query = $this->db->get('team');
        return $query->result_array();
    }

    function get_team_member($id)
    {
        $query = $this->db->get_where('team', array('id'=> $id),1);
        $singleQuery = $query->result_array();
        return $singleQuery[0];
    }


    function add_team_member($name, $position, $facebook, $linkedin, $image_path){
         $data = array(
           'name' => $name,
           'position' => $position,
           'facebook' => $facebook,
           'linkedin' => $linkedin,
           'image_path' => $image_path
        );

        $this->db->insert('team', $data);
        return $this->db->insert_id();
    }

    function update_team_member($name, $position, $facebook, $linkedin, $image_path, $id)
    {
        $data = array(
           'name' => $name ,
           'position' => $position ,
           'facebook' => $facebook ,
           'linkedin' => $linkedin,
           'image_path' => $image_path
        );

        $this->db->update('team', $data, array('id' => $id));
    }


}
?>