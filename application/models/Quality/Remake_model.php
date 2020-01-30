<?php

class Remake_model extends CI_Model {

    function __construct() {
       
    }
    
    
    public function getTotalRemake($st_date,$ed_date){
        $sql = "select count(*) as total from sf_reception where request_form_id=2 and DATE_FORMAT(reception_date, '%Y-%m-%d') between '$st_date' and '$ed_date'";
        $query = $this->db->query($sql);
        $row = $query->row_array();  
        return $row["total"];
    }
    
    public function getRemakeList($st_date,$ed_date){
        $sql = "select * from sf_reception where request_form_id=2 and  DATE_FORMAT(reception_date, '%Y-%m-%d') between '$st_date' and '$ed_date' order by reception_date desc ";
        $query = $this->db->query($sql);
        
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        {
            $list[$i] = $row;
            
            $sql = "select * from sf_customer where customer_id = ".$row["customer_id"];
            $query2 = $this->db->query($sql);
            $customer = $query2->row_array();  
            $list[$i]["customer_name"] = $customer["name"];
            
            $i++;
        }
        
        return $list;
    }
    
    
    
}
