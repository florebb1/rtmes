<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reception extends CI_Controller {
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data["base_url"] = base_url();
        $data["title"] = "접수 관리";
  //      $data["menu"] = "item";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
        
        $data["parent_menu"] = 5;
        $data["menu"] = 31;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        
        
        $this->load->model('Item/Reception_model','reception');
        
        $data["list"]= $this->reception->getReceptionList();
        
        $this->load->view('item/reception',$data);
    }
    
    public function edit()
    {
        $data["base_url"] = base_url();
        $data["title"] = "접수 관리 폼";
//         $data["menu"] = "item";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
        
        $data["parent_menu"] = 5;
        $data["menu"] = 31;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        

        
        $this->load->model('Item/Reception_model','reception');
        
        $w="";
        $reception_id=0;
        if($this->input->post("w")){
            $W = $this->input->post("w");
        }
        
        if($this->input->post("reception_id")){
            $reception_id = $this->input->post("reception_id");
        }
        
        $data["customers"]= $this->reception->getCustomers(); //고객사 리스트
        $data["sexs"]= $this->reception->getSexs(); //성별 리스트
        $data["requestform"]= $this->reception->getRequestForms(); //의뢰형태 리스트
        $data["enclosures"]= $this->reception->getEnclosures(); //동봉물 리스트
       
        
        $this->load->view('item/reception_form',$data);
    }
    
    
    public function update(){
        $this->load->model('Item/Reception_model','reception');
        $regr = $this->input->post();
        if($regr["w"] ==""){
            $this->reception->InsertReception($regr); //접수 등록
        }
        redirect("/item/reception");
    }
    
    public function addform(){
        
        $this->load->model('Item/Reception_model','reception');
        $data["categorys"]= $this->reception->getItemCategorys(); //동봉물 리스트
        $this->load->view('item/reception_add_form',$data);
    }
    
    public function loaditems(){
        
        $this->load->model('Item/Reception_model','reception');
        $item_category_id = 0;
        if($this->input->post("item_category_id")){
            $item_category_id = $this->input->post("item_category_id");
        }
        
        
        $list = $this->reception->getItems($item_category_id); //품목 리스트
        
        echo json_encode($list);
        exit;
    }
    
}
