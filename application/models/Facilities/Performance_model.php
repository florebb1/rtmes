<?php

class Performance_model extends CI_Model {

    function __construct() {

    }

    // 가동시간은 가동시간이 존재하는 테이블을 join한 후, from에 서브쿼리를 추가하고 계산하시면됩니다.
    public function getPerformance($start, $end, $data){
        $sql = "select f.*, e.name as employee_name, p.name as process_name from sf_facilities as f
                join sf_employee as e on f.employee_id = e.employee_id
                join sf_process as p on f.process_id = p.process_id
                where f.create_datetime between date('".$data["startDate"]."') and date('".$data["endDate"]."')
                order by f.facilities_id desc limit $start,$end";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getPerformanceCount($data){
        $sql = "select f.*, e.name as employee_name, p.name as process_name from sf_facilities as f
                join sf_employee as e on f.employee_id = e.employee_id
                join sf_process as p on f.process_id = p.process_id
                where f.create_datetime between date('".$data["startDate"]."') and date('".$data["endDate"]."')";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    // 월별 기준 select(해당 가동시간에 대하여 월별 통계 - 가동시간이 필드가 따로 존재한다는 가정하에 해당 쿼리를 이용한다.)
    public function getMonth(){
        $sql = "SELECT DATE_FORMAT(`/* 가동날짜필드 */`,'%Y-%m') AS `date`, sum(`/* 가동시간필드 */`) as amount FROM /* 테이블이름*/  GROUP BY `date`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // 년별 기준 select
    public function getYear(){
        $sql = "SELECT DATE_FORMAT(`/* 가동날짜필드 */`,'%Y') AS `date`, sum(`/* 가동시간필드 */`) as amount FROM /* 테이블이름*/  GROUP BY `date`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
