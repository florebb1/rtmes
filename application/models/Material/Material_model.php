<?php

class Material_model extends CI_Model {

    function __construct() {

    }

    public function getMaterial($start, $end){
        $sql = "select * from sf_material order by material_id desc limit $start,$end";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getMaterialCount(){
        $sql = "select * from sf_material";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function insertMaterial($regr){
        $sql = "insert into sf_material set material_name = '".$regr["material_name"]."',
                material_unit = '".$regr["material_unit"]."',
                material_count = '".$regr["material_count"]."',
                create_datetime = now()";
        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteMaterial($material_id){
        $sql = "delete from sf_material where material_id =".$material_id;
        $result = $this->db->query($sql);
        return $result;
    }
}
