<?php

class Menu_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getItemCategoryList(){
        $sql = "select * from sf_menu ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    
    
}
