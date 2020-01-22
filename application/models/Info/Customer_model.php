<?php

class Customer_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getCustmerList($page=0){
        $sql = "select * from sf_customer  order by customer_id desc limit $page,25";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getCustomer($customer_id){
        $sql = "select * from sf_customer where customer_id = ".$customer_id;
        $query = $this->db->query($sql);
        $info = $query->row_array();   
        return $info;
    }
    
    public function insertCustomer($regr){
        $sql = "insert into sf_customer set name = '".$regr["name"]."',
                code = '".$regr["code"]."', 
                representative = '".$regr["representative"]."', 
                business_number = '".$regr["business_number"]."', 
                tel = '".$regr["tel"]."', 
                email = '".$regr["email"]."', 
                business = '".$regr["business"]."', 
                fax = '".$regr["fax"]."', 
                addr = '".$regr["addr"]."', 
                date_added = NOW(), 
                date_modify = NOW()";
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function updateCustomer($regr){
        $sql = "update sf_customer set name = '".$regr["name"]."',
                code = '".$regr["code"]."',
                representative = '".$regr["representative"]."',
                business_number = '".$regr["business_number"]."',
                tel = '".$regr["tel"]."',
                email = '".$regr["email"]."',
                business = '".$regr["business"]."',
                fax = '".$regr["fax"]."',
                addr = '".$regr["addr"]."',
                date_modify = NOW() where customer_id =".$regr["customer_id"];
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function deleteCustomer($customer_id){
        $sql = "delete from sf_customer where customer_id =".$customer_id;
        $result = $this->db->query($sql);
        return $result;
        
    }
    
    
}
