<?php 

class Images_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_image_names()
    {
        $this->db->select('name');
        $query = $this->db->get('images');
        return $query->result_array();
    }

    function check_filename_exists($filename, $limit = 1){
    	$query = $this->db->get_where('images', array('name' => $filename), $limit);
    	if( $query->result_array()){
    		return TRUE;
    	}
    }

    function insert_image($name, $path,$work_id)
    {
       $data = array(
		   'name' => $name ,
		   'path' => $path ,
           'work_id'=> $work_id
		);

        $this->db->insert('images', $data);
    }

    function get_image_works($work_id)
    {
        $query = $this->db->get_where('images', array('work_id' => $work_id));
        return $query->result_array();
    }

    function remove_work_id($image){
        // Delete from DB
        $this->db->where('name', $image);
        $this->db->delete('images'); 

        // Remove from Directory
        $ext = explode('.', $image);
        $filename_ext = "./img/uploads/".$ext[0]."_thumb.".$ext[1];
        $filename = "./img/uploads/".$image;

        if (is_file($filename)) {
            @unlink($filename);
            @unlink($filename_ext);
            return "<p>the file was deleted succesfully</p>";

        }else{
            return "<p>the filename: ".$filename." is not a file. Can't erase</p>";
        }
    }

    function delete_images($id)
    {
        return $this->db->delete('images', array('work_id' => $id));

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