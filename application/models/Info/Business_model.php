<?php

class Business_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getBusinessList($page=0){
        $sql = "select * from sf_business order by business_id desc limit $page,25";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getBusiness($business_id){
        $sql = "select * from sf_business where business_id = ".$business_id;
        $query = $this->db->query($sql);
        $info = $query->row_array();   
        return $info;
    }
    
    public function insertBusiness($regr){
        $sql = "insert into sf_business set name = '".$regr["name"]."',
                representative = '".$regr["representative"]."', 
                business_number = '".$regr["business_number"]."', 
                item = '".$regr["item"]."', 
                business = '".$regr["business"]."', 
                tel = '".$regr["tel"]."', 
                fax = '".$regr["fax"]."', 
                addr = '".$regr["addr"]."', 
                date_added = NOW(), 
                date_modify = NOW()";
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function updateBusiness($regr){
        $sql = "update sf_business set name = '".$regr["name"]."',
                representative = '".$regr["representative"]."', 
                business_number = '".$regr["business_number"]."', 
                item = '".$regr["item"]."', 
                business = '".$regr["business"]."', 
                tel = '".$regr["tel"]."', 
                fax = '".$regr["fax"]."', 
                addr = '".$regr["addr"]."', 
                date_modify = NOW() where business_id =".$regr["business_id"];
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function deleteCustomer($business_id){
        $sql = "delete from sf_business where business_id =".$business_id;
        $result = $this->db->query($sql);
        return $result;
        
    }
}
