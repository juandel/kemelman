<?php 

class Works_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_works()
    {
        $query = $this->db->get('works');
        return $query->result_array();
    }

    function get_work($id)
    {
        $query = $this->db->get_where('works', array('id'=> $id),1);
        return $query->result_array();
    }

    function check_title_exists($title, $limit = 1){
        $query = $this->db->get_where('works', array('title' => $title), $limit);
        if( $query->result_array()){
            return TRUE;
        }
    }

    function insert_work($title, $description, $location, $category, $superficie, $lat=NULL, $lng=NULL)
    {
            $data = array(
               'title' => $title ,
               'description' => $description ,
               'location' => $location,
               'category' => $category,
               'superficie' => $superficie,
               'lat' => $lat,
               'lng' => $lng
            );

        $this->db->insert('works', $data);
        return $this->db->insert_id();
    }

    function update_work($title, $description, $category, $location,$superficie,$lat=1,$lng, $id)
    {
        $data = array(
           'title' => $title ,
           'description' => $description ,
           'category' => $category ,
           'location' => $location,
           'superficie' => $superficie,
           'lat' => $lat,
           'lng' => $lng
        );

        $this->db->update('works', $data, array('id' => $id));
    }
    function delete_works($id)
    {
        return $this->db->delete('works', array('id' => $id));

    }

}
?>