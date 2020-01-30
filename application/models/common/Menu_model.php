<?php

class Menu_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getMenus(){
        $sql = "select * from sf_menu where parent=0 order by ord asc ";
        $query = $this->db->query($sql);
        
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        {
            $list[$i] = $row;
            $list[$i]["sub"] =array();
            $sql = "select * from sf_menu where parent=".$row["menu_id"]." order by ord asc ";
            $query2 = $this->db->query($sql);
            $list[$i]["sub"]  = $query2->result_array();
            $i++;
        }
        
        return $list;
    }
    
    
    
}
