<?php

class Defect_model extends CI_Model {

    function __construct() {
       
    }
    
    
    public function getTotalDefect($st_date,$ed_date){
        $sql = "select count(*) as total from sf_defect where DATE_FORMAT(add_date, '%Y-%m-%d') between '$st_date' and '$ed_date'";
        $query = $this->db->query($sql);
        $row = $query->row_array();  
        return $row["total"];
    }
    
    public function getDefectList($st_date,$ed_date){
        $sql = "select * from sf_defect where DATE_FORMAT(add_date, '%Y-%m-%d') between '$st_date' and '$ed_date' order by add_date desc ";
        $query = $this->db->query($sql);
        
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        {
            $list[$i] = $row;
            
            $sql = "select * from sf_employee where employee_id = ".$row["employee_id"];
            $query2 = $this->db->query($sql);
            $customer = $query2->row_array();  
            $list[$i]["employee_name"] = $customer["name"];
            
            $sql = "select * from sf_process where process_id = ".$row["process_id"];
            $query2 = $this->db->query($sql);
            $customer = $query2->row_array();  
            $list[$i]["process_name"] = $customer["name"];
            
            $i++;
        }
        
        return $list;
    }
    
    
    
}
