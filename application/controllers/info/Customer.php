<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

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
	    $data["title"] = "고객사 정보";	    
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
//	    $data["menu"] = "info";
        $data["parent_menu"] = 1;
        $data["menu"] = 10;
        
	    $this->load->model('Common/Menu_model','menu');
	    $menus = $this->menu->getMenus();	
	    $data["menus"] = $menus;
	    
	    
	    $this->load->model('Info/Customer_model','customer');
	    $page = 0*25;
	    $data["list"]= $this->customer->getCustmerList(0);	    
	    $this->load->view('info/customer',$data);
	}
	public function info(){
	    $this->load->model('Info/Customer_model','customer');
	    $json = array();
	    $customer_id = $this->input->post("customer_id");
	    $info = $this->customer->getCustomer($customer_id);
	    
	    $json["info"] = $info;
	    echo json_encode($json);
	    exit;
	}
	
	public function edit(){
	    $this->load->model('Info/Customer_model','customer');
	    $json = array();
	    $regr = $this->input->post();
	    
	    if($regr["w"] == "u"){
	        $result= $this->customer->updateCustomer($regr);
	    }else{
	        $result= $this->customer->insertCustomer($regr);
	    }
	   
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
	public function delete(){
	    $this->load->model('Info/Customer_model','customer');
	    $json = array();
	    $regr = $this->input->post();
	    
	    $customer_id = $regr["customer_id"];
	    
	    $result= $this->customer->deleteCustomer($customer_id);
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
	public function chkcode(){
	    $this->load->model('Info/Customer_model','customer');
	    $code="";
	    $result =false;
	    if($this->input->post("code")){
	       $code = $this->input->post("code");
	       $cnt = $this->customer->ChkCode($code);
	       if($cnt == 0){
	           $result =true;
	       }
	    }
	    
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	    
	}
}
