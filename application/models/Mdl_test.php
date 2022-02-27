<?php 
class Mdl_test extends CI_Model{

    function _constructs(){
        parent::_constructs();
    }    

    function dataget(){
       
        $this->db->select('*')->from('student');
        $query = $this->db->get();         
        return $query->result();   
    }

    function insertData($descriptionText,$titleText,$imageUrl){
           
        $this->db->insert('student', array('title' => $titleText,'description' => $descriptionText,'image_url'=>$imageUrl));
    }
       

}


