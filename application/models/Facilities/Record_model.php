<?php

class Record_model extends CI_Model {

    function __construct() {

    }

    public function getRecord($data){
        $sql = "select fh.*, f.facilities_name, f.facilities_buy_day from sf_facilities_history as fh
                join sf_facilities as f on fh.facilities_id = f.facilities_id
                where fh.create_datetime between date('".$data["startDate"]."') and date('".$data["endDate"]."')
                order by fh.facilities_history_id desc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getSingleRecord($data){
        $sql = "select fh.*, f.facilities_name, f.facilities_buy_day from sf_facilities_history as fh
                join sf_facilities as f on fh.facilities_id = f.facilities_id
                where fh.create_datetime between date('".$data["startDate"]."') and date('".$data["endDate"]."')
                and fh.facilities_id = '".$data["facilities"]."'
                order by fh.facilities_history_id desc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getFacilities(){
        $sql = "select * from sf_facilities";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getFacilitiesHistory($idx){
        $sql = "select * from sf_facilities_history where facilities_history_id = $idx";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function updateRecord($data){
        $sql = "update sf_facilities_history set failure_flag = '".$data["failure_flag"]."',
                fix_history = '".$data["fix_history"]."',
                fix_day = '".$data["fix_day"]."',
                facilitie_manage = '".$data["facilitie_manage"]."',
                management = '".$data["management"]."',
                update_datetime = now()
                where facilities_history_id =".$data["facilities_history_id"];
        $result = $this->db->query($sql);
        return $result;
    }

    public function insertRecord($data){
        $sql = "insert into sf_facilities_history set facilities_id = '".$data["facilities_id"]."',
                failure_comment = '".$data["failure_comment"]."',
                failure_content = '".$data["failure_content"]."',
                create_datetime = now()";
        $result = $this->db->query($sql);
        return $result;
    }

}
