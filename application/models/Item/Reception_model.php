<?php

class Reception_model extends CI_Model {

    function __construct() {
       
    }
    
    public function getTotalReception(){
        $sql = "select count(*) as total from sf_reception";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row["total"];
    }
    
    public function getReceptionList(){
        $sql = "select * from sf_reception order by reception_id desc ";
        $query = $this->db->query($sql);
        
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        {
            $list[$i] = $row;
            
            $sql = "select * from sf_customer where customer_id = ".$row["customer_id"];
            $query2 = $this->db->query($sql);
            $customer = $query2->row_array();
            $list[$i]["customer_name"] = $customer["name"];
            
            $sql = "select * from sf_request_form where request_form_id = ".$row["request_form_id"];
            $query3 = $this->db->query($sql);
            $request_form = $query3->row_array();
            $list[$i]["request_form_name"] = $request_form["name"]; //의뢰 형태
            
            $sql = "select * from sf_enclosure where enclosure_id = ".$row["enclosure_id"];
            $query4 = $this->db->query($sql);
            $enclosure = $query4->row_array();
            $list[$i]["enclosure_name"] = $enclosure["name"]; //동봉물
            
            $sql = "select * from sf_sex where sex_id = ".$row["sex_id"];
            $query4 = $this->db->query($sql);
            $sex = $query4->row_array();
            $list[$i]["sex_name"] = $sex["name"]; //성별
            
            $i++;
        }
        
        return $list;
    }
    
    public function SetClaim($reception_id){
        $sql ="update sf_reception set claim_chk = 1,claim_date = now() where reception_id = ".$reception_id;
        $this->db->query($sql);
    }
    
    
    
    //접수관리 관련 로드 항목
    public function getCustomers(){
        $sql = "select * from sf_customer order by customer_id asc";
        $query = $this->db->query($sql);
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        {
            $list[$i] = $row;
            $i++;
        }
        return $list;
    }
    public function getSexs(){
        $sql = "select * from sf_sex order by sex_id asc";
        $query = $this->db->query($sql);

        return $query->result_array();
    }
    
    public function getRequestForms(){
        $sql = "select * from sf_request_form order by request_form_id asc";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    public function getEnclosures(){
        $sql = "select * from sf_enclosure order by ord asc";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    public function getItemCategorys(){
        $sql = "select * from sf_item_category where item_category_id !=3  and item_category_id !=5  order by ord asc";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    public function getItems($item_category_id){
        $sql = "select * from sf_item where item_category_id =$item_category_id  order by item_id asc";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    public function InsertReception($regr){
        
        $reception_number = $this->createReceptionCode(); //의뢰번호
        
        $sql="insert into sf_reception set reception_number = '".$reception_number."',
        customer_id = '".$regr["customer_id"]."',
        patient_name = '".$regr["patient_name"]."',
        age = '".$regr["age"]."',
        sex_id = '".$regr["sex_id"]."',
        delivery_date = '".$regr["delivery_date"]."',
        request_form_id = '".$regr["request_form_id"]."',
        enclosure_id = '".$regr["enclosure_id"]."',
        reception_date = NOW() ";
        $query = $this->db->query($sql);
        $reception_id = $this->db->insert_id(); //접수아이디
        
        
        $sql = " select * from sf_customer where customer_id ='".$regr["customer_id"]."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $customer_code = $row["code"];
       
        //작업물 추가
        for($i=0; $i<count($regr["dental_formula"]); $i++){
            $dental_formula = $regr["dental_formula"][$i];
            $detail_number = $reception_number.$customer_code.$dental_formula; //품번
            
            $sql="insert into sf_reception_detail set reception_id = '".$reception_id."',
            reception_number = '".$reception_number."',
            detail_number = '".$detail_number."',
            dental_formula = '".$dental_formula."',
            item_category_id = '".$regr["item_category_id"][$i]."',
            item_id = '".$regr["item_id"][$i]."',
            mixed = '".$regr["mixed"][$i]."',
            surface = '".$regr["surface"][$i]."',
            shade = '',
            pontic = '".$regr["pontic"][$i]."',
            metal = '".$regr["metal"][$i]."'";
           
            $query = $this->db->query($sql);
            
            
        }
        
        
        
    }
    
    public function createReceptionCode(){
        $sql = " select * from sf_reception order by reception_number desc limit 0,1";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $c_it_id = "";
        if($row["reception_number"]){
            $it_id = $row["reception_number"];
            $it_id++;
            $it_id  =str_replace("1","A",$it_id);
            $c_it_id = $it_id;
        }else{
            $c_it_id = "P0000";
        }
        return $c_it_id;
    }
    
    
    public function getLotList($st_date,$ed_date,$customer_id){
        $sql_where ="";
        if($customer_id > 0){
            $sql_where = "customer_id = ".$customer_id." and ";
        }
        
        $sql = "select *,date_format(reception_date,'%Y-%m-%d') as reception_date2,
        date_format(shipping_date,'%Y-%m-%d') as shipping_date2, date_format(complete_date,'%Y-%m-%d') as complete_date2 from sf_reception where ".$sql_where." date_format(reception_date,'%Y-%m-%d') between '".$st_date."' and '".$ed_date."' order by reception_date desc";
        $query = $this->db->query($sql);
        
        $list = array();
        $i=0;
        foreach ($query->result_array() as $row)
        {
            $list[$i] = $row;
            
            $sql = "select * from sf_customer where customer_id = ".$row["customer_id"];
            $query2 = $this->db->query($sql);
            $customer = $query2->row_array();
            $list[$i]["customer_name"] = $customer["name"];
            
            $sql = "select * from sf_request_form where request_form_id = ".$row["request_form_id"];
            $query3 = $this->db->query($sql);
            $request_form = $query3->row_array();
            $list[$i]["request_form_name"] = $request_form["name"]; //의뢰 형태
            
            $sql = "select * from sf_enclosure where enclosure_id = ".$row["enclosure_id"];
            $query4 = $this->db->query($sql);
            $enclosure = $query4->row_array();
            $list[$i]["enclosure_name"] = $enclosure["name"]; //동봉물
            
            $sql = "select * from sf_sex where sex_id = ".$row["sex_id"];
            $query4 = $this->db->query($sql);
            $sex = $query4->row_array();
            $list[$i]["sex_name"] = $sex["name"]; //성별
            
            $i++;
        }
        
        return $list;
    }
    
    public function UpdateLot($regr){

        for($i=0; $i<count($regr["lot_check"]);$i++){
            $reception_id = $regr["lot_check"][$i];
            
            $request_shipping = 0;
            if($regr["request_shipping_".$reception_id]){
                $request_shipping =$regr["request_shipping_".$reception_id];
            }
            
            $claim_chk = "";
            if($regr["claim_chk_".$reception_id] == 1){
                $claim_chk =", claim_chk = 1 ,claim_date = now() ";
            }
            
            $review = "";
            
            if($regr["review_".$reception_id]){
                $review =", review = '".$regr["review_".$reception_id]."' ";
            }
            
            $sql = "update sf_reception set request_shipping = ".$request_shipping." $claim_chk $claim_chk where reception_id = ".$reception_id;
            $this->db->query($sql);
        }
    }
    
}
