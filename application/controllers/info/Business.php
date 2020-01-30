<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends CI_Controller {

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
	{   $this->load->helper('url');
	    $data["base_url"] = base_url();	    
	    $data["title"] = "사업장 정보";	    
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
//        $data["menu"] = "info";
        $data["parent_menu"] = 1;
        $data["menu"] = 19;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        
        
	    $this->load->model('Info/Business_model','business');
	    $page = 0*25;
	    $data["list"]= $this->business->getBusinessList(0);	    
	    $this->load->view('info/business',$data);
	}
	
	public function info(){
	    $this->load->model('Info/Business_model','business');
	    $json = array();
	    $business_id = $this->input->post("business_id");
	    $info = $this->business->getBusiness($business_id);
	    
	    $json["info"] = $info;
	    echo json_encode($json);
	    exit;
	}
	
	public function edit(){
	    $this->load->model('Info/Business_model','business');
	    $json = array();
	    $regr = $this->input->post();
	    
	    if($regr["w"] == "u"){
	        $result= $this->business->updateBusiness($regr);
	    }else{
	        $result= $this->business->insertBusiness($regr);
	    }
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
}
