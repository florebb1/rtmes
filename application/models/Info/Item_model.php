<?php

class Item_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getItemCategoryList(){
        $sql = "select * from sf_item_category order by ord asc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getItemPurchaseList(){
        $sql = "select * from sf_purchase order by purchase_id asc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getItemList($page=0){
        $sql = "select a.*,b.name_ko,c.name as purchase_name from sf_item as a left join sf_item_category as b on a.item_category_id = b.item_category_id 
                left join sf_purchase as c on a.purchase_id = c.purchase_id order by item_id desc limit $page,25";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getItem($item_id){
        $sql = "select * from sf_item where item_id = ".$item_id;
        $query = $this->db->query($sql);
        $info = $query->row_array();   
        return $info;
    }
    
    public function insertItem($regr){
        $sql = "insert into sf_item set name = '".$regr["name"]."',
                item_category_id = '".$regr["item_category_id"]."',
                purchase_id = '".$regr["purchase_id"]."',
                standard = '".$regr["standard"]."',
                unit = '".$regr["unit"]."',
                material = '".$regr["material"]."',
                weight = '".$regr["weight"]."',
                date_added = NOW(), 
                date_modify = NOW()";
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function updateItem($regr){
        $sql = "update sf_item set name = '".$regr["name"]."',
                item_category_id = '".$regr["item_category_id"]."',
                purchase_id = '".$regr["purchase_id"]."',
                standard = '".$regr["standard"]."',
                unit = '".$regr["unit"]."',
                material = '".$regr["material"]."',
                weight = '".$regr["weight"]."',
                date_modify = NOW() where item_id =".$regr["item_id"];
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function deleteItem($item_id){
        $sql = "delete from sf_item where item_id =".$item_id;
        $result = $this->db->query($sql);
        return $result;
        
    }
    
    
}
