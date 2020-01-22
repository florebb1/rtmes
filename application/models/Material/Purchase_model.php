<?php

class Purchase_model extends CI_Model {

    function __construct() {

    }

    public function getPurchase($start, $end, $data){
        $sql = "select mi.*, m.material_name, m.material_unit, m.material_count as apt_count, b.name as business_name from sf_material_incoming as mi
                join sf_material as m on mi.material_id = m.material_id
                join sf_business as b on mi.business_id = b.business_id
                where mi.material_incoming_day between date('".$data["startDate"]."') and date('".$data["endDate"]."')
                order by mi.material_incoming_day asc
                limit $start, $end";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getPurchaseCount($data){
        $sql = "select * from sf_material_incoming where material_incoming_day between date('".$data["startDate"]."') and date('".$data["endDate"]."')";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function insertPurchase($regr){
        $sql = "insert into sf_material_incoming set material_id = '".$regr["material_id"]."',
                business_id = '".$regr["business_id"]."',
                material_amount = '".$regr["material_amount"]."',
                material_count = '".$regr["material_count"]."',
                material_incoming_day = '".$regr["material_incoming_day"]."',
                create_datetime = now()";
        $result = $this->db->query($sql);
        return $result;
    }

    public function insertStock($regr){
        $sql = "insert into sf_material_stock set material_id = '".$regr["material_id"]."',
                business_id = '".$regr["business_id"]."',
                material_amount = '".$regr["material_amount"]."',
                material_count = '".$regr["material_count"]."',
                material_incoming_count = '".$regr["material_count"]."',
                material_incoming_day = '".$regr["material_incoming_day"]."',
                create_datetime = now()";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getMaterialList(){
        $sql = "select * from sf_material";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getBusinessList(){
        $sql = "select * from sf_business";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
