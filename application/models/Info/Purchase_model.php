<?php

class Purchase_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getPurchaseList($page=0){
        $sql = "select * from sf_purchase limit $page,25";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getPurchase($purchase_id){
        $sql = "select * from sf_purchase where purchase_id = ".$purchase_id;
        $query = $this->db->query($sql);
        $info = $query->row_array();   
        return $info;
    }
    
    public function insertPurchase($regr){
        $sql = "insert into sf_purchase set name = '".$regr["name"]."',
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
    
    public function updatePurchase($regr){
        $sql = "update sf_purchase set name = '".$regr["name"]."',
                representative = '".$regr["representative"]."',
                business_number = '".$regr["business_number"]."',
                tel = '".$regr["tel"]."',
                email = '".$regr["email"]."',
                business = '".$regr["business"]."',
                fax = '".$regr["fax"]."',
                addr = '".$regr["addr"]."',
                date_modify = NOW() where purchase_id =".$regr["purchase_id"];
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function deletePurchase($purchase_id){
        $sql = "delete from sf_purchase where purchase_id =".$customer_id;
        $result = $this->db->query($sql);
        return $result;
        
    }
    
    
}
