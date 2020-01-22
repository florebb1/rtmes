<?php

class Stock_model extends CI_Model {

    function __construct() {

    }

    public function getStock($start, $end){
        $sql = "select ms.*, m.material_name, m.material_unit, m.material_count as apt_count, b.name as business_name from sf_material_stock as ms
                join sf_material as m on ms.material_id = m.material_id
                join sf_business as b on ms.business_id = b.business_id
                order by ms.material_incoming_day asc limit $start, $end";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getStockCount(){
        $sql = "select * from sf_material_stock";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}
