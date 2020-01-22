<?php

class Process_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getConditionMaxCount(){
        $sql ="select count(*)as cnt,process_id from sf_process_condition group by process_id order by cnt desc limit 0,1 ";
        $query = $this->db->query($sql);
        $info = $query->row_array();
        return $info["cnt"];
    }
    
    public function getProcessList($page=0){
        $sql = "select * from sf_process order by process_id desc limit $page,25";
        $query = $this->db->query($sql);
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        { 
            $list[$i] = $row;
            $sql = "select * from sf_process_condition where process_id =  ".$row["process_id"]." order by number asc";
            $query2 = $this->db->query($sql);
            $list[$i]["condition"] = $query2->result_array();
            $i++;
        }
        return $list;
    }
    
    public function getProcess($process_id){
        $sql = "select * from sf_process where process_id = ".$process_id;
        $query = $this->db->query($sql);
        $info = $query->row_array();   
        
        $sql = "select * from sf_process_condition where process_id =  ".$process_id." order by number asc";
        $query = $this->db->query($sql);
        $info["condition"] = $query->result_array();
        return $info;
    }
    
    public function insertProcess($regr){
        $sql = "insert into sf_process set name = '".$regr["name"]."',
                content = '".$regr["content"]."', 
                date_added = NOW(), 
                date_modify = NOW()";
        $result = $this->db->query($sql);
        $process_id = $this->db->insert_id();
        for($i=0; $i<count($regr["condition"]); $i++){
            $sql ="insert into sf_process_condition set process_id = '".$process_id."',
                number = '".$i."',content='".$regr["condition"][$i]."'";
            $this->db->query($sql);
            
        }
        
        return $result;
    }
    
    public function updateProcess($regr){
        $sql = "update sf_process set name = '".$regr["name"]."',
                content = '".$regr["content"]."', 
                date_modify = NOW() where process_id =".$regr["process_id"];
        $result = $this->db->query($sql);
        $sql = "delete from sf_process_condition where process_id =".$regr["process_id"];
        $this->db->query($sql);
        
        for($i=0; $i<count($regr["condition"]); $i++){
            $sql ="insert into sf_process_condition set process_id = '".$regr["process_id"]."',
                number = '".$i."',content='".$regr["condition"][$i]."'";
            $this->db->query($sql);
            
        }
        return $result;
    }
    
    public function deleteProcess($process_id){
        $sql = "delete from sf_process_condition where process_id =".$process_id;
        $this->db->query($sql);
        $sql = "delete from sf_process where process_id =".$process_id;
        $result = $this->db->query($sql);
        return $result;
        
    }
    
    public function getProcessList2(){
        $sql = "select * from sf_process order by process_id asc limit 0,24";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getItemList(){
        $sql = "select * from sf_item order by item_id asc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getProcessItemList(){
        $sql = "select * from sf_process_item";
        $query = $this->db->query($sql);
        $list = array();
        foreach ($query->result_array() as $row)
        {
            $list[$row["item_id"]][$row["process_id"]] =$row["pcheck"];
        }
        return $list;
    }
    
    public function insertProcessItem($regr){ 
        
        for($i=0; $i<count($regr["item_id"]); $i++){
            for($j=0; $j<count($regr["process_id"]); $j++){
                if (array_key_exists($regr["item_id"][$i], $regr["process_item_id"])) {
                    if (array_key_exists($regr["process_id"][$j], $regr["process_item_id"][$regr["item_id"][$i]])) {
                        $val = $regr["process_item_id"][$regr["item_id"][$i]][$regr["process_id"][$j]];
                        if($val){
                            $sql ="select * from sf_process_item where item_id = ".$regr["item_id"][$i]." and process_id = ".$regr["process_id"][$j];
                            $query = $this->db->query($sql);
                            $info = $query->row_array();
                            if($info["process_item_id"]){
                                $sql = "update sf_process_item set pcheck = ".$val." where item_id = ".$regr["item_id"][$i]." and process_id = ".$regr["process_id"][$j];
                                $this->db->query($sql);
                            }else{
                                $sql = "insert into sf_process_item set pcheck = ".$val." , item_id = ".$regr["item_id"][$i].", process_id = ".$regr["process_id"][$j];
                                $this->db->query($sql);
                            }
                        }
                    }
                }
            }
        }
    }
    
}
