<?php

class Employee_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getEmployeeWorkList(){
        $sql ="select * from sf_employee_work order by work_level asc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getprocessList(){
        $sql ="select * from sf_process order by process_id desc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    
    public function getEmployeeList($page=0){
        $sql = "select a.*,b.name as work_name from sf_employee as a left join sf_employee_work as b on a.work_id = b.work_id order by a.employee_id desc limit $page,25";
        $query = $this->db->query($sql);
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        {
            $list[$i] = $row;
            $sql = "select a.*,b.name from sf_employee_process as a left join sf_process as b on a.process_id = b.process_id where a.employee_id =  ".$row["employee_id"]." order by employee_process_id asc";
            $query2 = $this->db->query($sql);
            $list[$i]["process"] = $query2->result_array();
            $i++;
        }
        return $list;
    }
    
    public function getEmployee($employee_id){
        $sql = "select * from sf_employee where employee_id = ".$employee_id;
        $query = $this->db->query($sql);
        $info = $query->row_array();   

        $sql = "select a.*,b.name from sf_employee_process as a left join sf_process as b on a.process_id = b.process_id where a.employee_id =  ".$employee_id." order by a.employee_process_id asc";
        $query2 = $this->db->query($sql);
        $info["process"] = $query2->result_array();
        
        return $info;
    }
    
    public function insertEmployee($regr){
        $sql = "insert into sf_employee set name = '".$regr["name"]."',
                employee_number = '".$regr["employee_number"]."', 
                work_id = '".$regr["work_id"]."', 
                business = '".$regr["business"]."', 
                department = '".$regr["department"]."', 
                position = '".$regr["position"]."', 
                tel = '".$regr["tel"]."', 
                email = '".$regr["email"]."', 
                addr = '".$regr["addr"]."',
                date_added = NOW(), 
                date_modify = NOW()";
        $result = $this->db->query($sql);
        $employee_id = $this->db->insert_id();
        for($i=0; $i<count($regr["process_id"]); $i++){
            $sql ="insert into sf_employee_process set employee_id = '".$employee_id."',
                process_id='".$regr["process_id"][$i]."'";
            $this->db->query($sql);
            
        }
        
        return $result;
    }
    
    public function updateEmployee($regr){
        $sql = "update sf_employee set name = '".$regr["name"]."',
                employee_number = '".$regr["employee_number"]."', 
                work_id = '".$regr["work_id"]."', 
                business = '".$regr["business"]."', 
                department = '".$regr["department"]."', 
                position = '".$regr["position"]."', 
                tel = '".$regr["tel"]."', 
                email = '".$regr["email"]."', 
                addr = '".$regr["addr"]."', 
                date_modify = NOW() where employee_id =".$regr["employee_id"];
        $result = $this->db->query($sql);
        
        $sql = "delete from sf_employee_process where employee_id =".$regr["employee_id"];
        $this->db->query($sql);
        
        for($i=0; $i<count($regr["process_id"]); $i++){
            $sql ="insert into sf_employee_process set employee_id = '".$regr["employee_id"]."',
                process_id='".$regr["process_id"][$i]."'";
            $this->db->query($sql);
            
        }
        
        
        return $result;
    }
    
    public function deleteEmployee($employee_id){
        $sql = "delete from sf_employee_process where employee_id =".$employee_id;
        $this->db->query($sql);
        
        $sql = "delete from sf_employee where employee_id =".$employee_id;
        $result = $this->db->query($sql);
        return $result;
        
    }
    
    
}
