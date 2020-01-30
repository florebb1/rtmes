<?php

class Facilities_model extends CI_Model {

    function __construct() {

    }

    public function getFacilities($start, $end) {
        $sql = "select f.*, e.name as employee_name, p.name as process_name from sf_facilities as f
                join sf_employee as e on f.employee_id = e.employee_id
                join sf_process as p on f.process_id = p.process_id
                order by f.facilities_id desc limit $start,$end";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getFacilitiesCount() {
        $sql = "select * from sf_facilities_history";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getSingleFacilities($idx) {
        $sql = "select f.*, e.name as employee_name, p.name as process_name from sf_facilities as f
                join sf_employee as e on f.employee_id = e.employee_id
                join sf_process as p on f.process_id = p.process_id
                where f.facilities_id = $idx";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getEmployee() {
        $sql = "select * from sf_employee";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getProcess(){
        $sql = "select * from sf_process";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function insertFacilities($data){
        $sql = "insert into sf_facilities set facilities_name = '".$data["facilities_name"]."',
                facilities_serial_number = '".$data["facilities_serial_number"]."',
                facilities_model_name = '".$data["facilities_model_name"]."',
                facilities_size = '".$data["facilities_size"]."',
                facilities_buy_day = '".$data["facilities_buy_day"]."',
                employee_id = '".$data["employee_id"]."',
                process_id = '".$data["process_id"]."',
                facilities_location = '".$data["facilities_location"]."',
                facilities_ip = '".$data["facilities_ip"]."',
                create_datetime = now()";
        $result = $this->db->query($sql);
        return $result;
    }

    public function updateFacilities($data){
        $sql = "update sf_facilities set facilities_name = '".$data["facilities_name"]."',
                facilities_serial_number = '".$data["facilities_serial_number"]."',
                facilities_model_name = '".$data["facilities_model_name"]."',
                facilities_size = '".$data["facilities_size"]."',
                facilities_buy_day = '".$data["facilities_buy_day"]."',
                employee_id = '".$data["employee_id"]."',
                process_id = '".$data["process_id"]."',
                facilities_location = '".$data["facilities_location"]."',
                facilities_ip = '".$data["facilities_ip"]."'
                where facilities_id = '".$data["facilities_id"]."'";
        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteFacilities($idx){
        $sql = "delete from sf_facilities where facilities_id = '".$idx."'";
        $result = $this->db->query($sql);
        return $result;
    }

}
