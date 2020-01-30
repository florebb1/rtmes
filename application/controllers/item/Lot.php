<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lot extends CI_Controller {
    
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
        $data["title"] = "로트 관리";
//         $data["menu"] = "item";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";

        $data["parent_menu"] = 5;
        $data["menu"] = 32;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        
        $this->load->model('Item/Reception_model','reception');
        
        if ($this->input->get('st_date')) {
            $st_date = $this->input->get('st_date');
        } else {
            $st_date = date('Y-m-d', time());
        }
        
        if ($this->input->get('ed_date')) {
            $ed_date = $this->input->get('ed_date');
        } else {
            $ed_date = date('Y-m-d', time());
        }
        
        if ($this->input->get('customer')) {
            $customer = $this->input->get('customer');
        } else {
            $customer = 0;
        }
        
        $data["st_date"] = $st_date;
        $data["ed_date"] = $ed_date;
        $data["customer"] = $customer;
        
        $data["customers"]= $this->reception->getCustomers(); //고객사 리스트
        $data["list"]= $this->reception->getLotList($st_date,$ed_date,$customer); //lot 리스트
        
        $this->load->view('item/lot',$data);
    }
    
    public function update(){
        $this->load->model('Item/Reception_model','reception');
        $regr = $this->input->post();
        
        $this->reception->UpdateLot($regr); //접수 등록
        
        redirect("/item/lot?st_date=".$regr["st_date"]."&ed_date=".$regr["ed_date"]."&customer=".$regr["customer"]);
    }
    
    
}
