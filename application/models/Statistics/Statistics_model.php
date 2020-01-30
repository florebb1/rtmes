<?php

class Statistics_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getDefectList($current_year,$prev_year){
        $list = array();
        
        for($i=0; $i<12; $i++){
            $month = sprintf('%02d',$i+1);
            $current_date = $current_year."-".$month;
            $sql ="select count(*)as cnt from sf_defect where date_format(add_date,'%Y-%m') = '".$current_date."'";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $list[$i][$current_year] = $row["cnt"];
            
            $prev_date = $prev_year."-".$month;
            
            $sql ="select count(*)as cnt from sf_defect where date_format(add_date,'%Y-%m') = '".$prev_date."'";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $list[$i][$prev_year] = $row["cnt"];
        }
        return $list;
    }
    
    public function getReceptionList($date){
        $sql = "select * from sf_customer order by customer_id asc ";
        $query = $this->db->query($sql);
        
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        {
            $list[$i]["name"] = $row["name"];
            $sql = "select count(*) as total from sf_reception where customer_id = ".$row["customer_id"]." and DATE_FORMAT(reception_date, '%Y-%m-%d') = '$date'";
            $query2 = $this->db->query($sql);
            $reception = $query2->row_array();  
            $list[$i]["total"] = $reception["total"];
            $i++;
        }
        
        return $list;
    }
    
    public function getRequestList($date,$type){
        $sql = "select * from sf_customer order by customer_id asc ";
        $query = $this->db->query($sql);
        
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        {
            $list[$i]["name"] = $row["name"];
            if($type == 1){ //월별
                $sql = "select count(*) as total from sf_reception where customer_id = ".$row["customer_id"]." and request_form_id =1 and DATE_FORMAT(reception_date, '%Y-%m') = '$date'";
                $query2 = $this->db->query($sql);
                $reception = $query2->row_array();
                $list[$i]["normal_total"] = $reception["total"];
                $sql = "select count(*) as total from sf_reception where customer_id = ".$row["customer_id"]." and request_form_id =2 and DATE_FORMAT(reception_date, '%Y-%m') = '$date'";
                $query2 = $this->db->query($sql);
                $reception = $query2->row_array();
                $list[$i]["remake_total"] = $reception["total"];
            }else{ //년도별
                $sql = "select count(*) as total from sf_reception where customer_id = ".$row["customer_id"]." and request_form_id =1 and DATE_FORMAT(reception_date, '%Y') = '$date'";
                $query2 = $this->db->query($sql);
                $reception = $query2->row_array();
                $list[$i]["normal_total"] = $reception["total"];
                $sql = "select count(*) as total from sf_reception where customer_id = ".$row["customer_id"]." and request_form_id =2 and DATE_FORMAT(reception_date, '%Y') = '$date'";
                $query2 = $this->db->query($sql);
                $reception = $query2->row_array();
                $list[$i]["remake_total"] = $reception["total"];
            }
            $i++;
        }
        
        return $list;
    }
    
}
