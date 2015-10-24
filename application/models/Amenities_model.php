<?php 

class Amenities_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_amenities_fieldnames(){
        $field_names = $this->db->list_fields('amenities');
        return $field_names;
    }

    function insert_amenities($amenities, $obra_id){
        $data  = array();
        foreach ($amenities as $amenity) {
            $data[$amenity] = 1 ; 
        }
        $data['obra_id'] = $obra_id;
        $this->db->insert('amenities', $data);   
    
    }

    function get_amenities_for_project($id){
        $result = array();
        $query = $this->db->get_where('amenities', array('obra_id'=> $id),1);
        $result_raw = $query->result_array();
        foreach ($result_raw[0] as $result_key => $result_val) {
            if ($result_key !='id' && $result_key != 'obra_id') {
                $result[$result_key] = $result_val;
            }           
        }
        return $result;

    }

    function update_amenity($amenities,$obra_id){
        // echo "<pre>";
        //             print_r($amenities);
        //             echo "</pre>";

        $data = array(
           'sum' => NULL ,
           'cocheras' => NULL ,
           'pileta' => NULL ,
           'gym' => NULL,
           'parrilla' => NULL,
        );
        $this->db->update('amenities', $data, array('id' => $obra_id));
        if ($amenities) {
            foreach ($amenities as $key) {
                $data[$key] = 1;
            }
        }
        

        $this->db->update('amenities', $data, array('obra_id' => $obra_id));
    }

    function delete_amenities($id){
        return $this->db->delete('amenities', array('obra_id' => $id));
    }

    
}
?>