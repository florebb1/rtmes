<?php

class Standard_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getCustmerList(){
        $sql = "select * from sf_customer order by customer_id asc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getItemList($page=0){
        $sql = "select * from sf_item order by item_id asc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getStandardNumberList(){
        $sql = "select * from sf_standard_number";
        $query = $this->db->query($sql);
        $list = array();
        foreach ($query->result_array() as $row)
        {
            $list[$row["customer_id"]][$row["item_id"]] =$row["number"];
        }
        return $list;
    }
    public function getStandardPriceList(){
        $sql = "select * from sf_standard_price";
        $query = $this->db->query($sql);
        $list = array();
        foreach ($query->result_array() as $row)
        {
            $list[$row["customer_id"]][$row["item_id"]] =$row["price"];
        }
        return $list;
    }
    
    public function insertStandardNumber($regr){
        
        for($i=0; $i<count($regr["customer_id"]); $i++){
            for($j=0; $j<count($regr["item_id"]); $j++){
                if (array_key_exists($regr["customer_id"][$i], $regr["standard"])) {
                    if (array_key_exists($regr["item_id"][$j], $regr["standard"][$regr["customer_id"][$i]])) {
                        $val = $regr["standard"][$regr["customer_id"][$i]][$regr["item_id"][$j]];
                        if($val){
                            $sql ="select * from sf_standard_number where customer_id = ".$regr["customer_id"][$i]." and item_id = ".$regr["item_id"][$j];
                            $query = $this->db->query($sql);
                            $info = $query->row_array();   
                            if($info["standard_number_id"]){
                                $sql = "update sf_standard_number set number = ".$val." where customer_id = ".$regr["customer_id"][$i]." and item_id = ".$regr["item_id"][$j];
                                $this->db->query($sql);
                            }else{
                                $sql = "insert into sf_standard_number set number = ".$val." , customer_id = ".$regr["customer_id"][$i].", item_id = ".$regr["item_id"][$j];
                                $this->db->query($sql);
                            }
                        }
                    }
                }
            }
        }
    }
    
    public function insertStandardPrice($regr){
        
        for($i=0; $i<count($regr["customer_id"]); $i++){
            for($j=0; $j<count($regr["item_id"]); $j++){
                if (array_key_exists($regr["customer_id"][$i], $regr["standard"])) {
                    if (array_key_exists($regr["item_id"][$j], $regr["standard"][$regr["customer_id"][$i]])) {
                        $val = $regr["standard"][$regr["customer_id"][$i]][$regr["item_id"][$j]];
                        if($val){
                            $sql ="select * from sf_standard_price where customer_id = ".$regr["customer_id"][$i]." and item_id = ".$regr["item_id"][$j];
                            $query = $this->db->query($sql);
                            $info = $query->row_array();   
                            if($info["standard_price_id"]){
                                $sql = "update sf_standard_price set price = ".$val." where customer_id = ".$regr["customer_id"][$i]." and item_id = ".$regr["item_id"][$j];
                                $this->db->query($sql);
                            }else{
                                $sql = "insert into sf_standard_price set price = ".$val." , customer_id = ".$regr["customer_id"][$i].", item_id = ".$regr["item_id"][$j];
                                $this->db->query($sql);
                            }
                        }
                    }
                }
            }
        }
    }
    
    
   
    
    
}
