<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

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
	    $data["title"] = "매입처 정보";
        $data["menu"] = "info";
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";	   
	    
	    $this->load->model('Info/Purchase_model','purchase');
	    $page = 0*25;
	    $data["list"]= $this->purchase->getPurchaseList(0);	    
	    
	    $this->load->view('info/purchase',$data);
	}
	
	public function info(){
	    $this->load->model('Info/Purchase_model','purchase');
	    $json = array();
	    $purchase_id = $this->input->post("purchase_id");
	    $info = $this->purchase->getPurchase($purchase_id);
	    
	    $json["info"] = $info;
	    echo json_encode($json);
	    exit;
	}
	
	public function edit(){
	    $this->load->model('Info/Purchase_model','purchase');
	    $json = array();
	    $regr = $this->input->post();
	    
	    if($regr["w"] == "u"){
	        $result= $this->purchase->updatePurchase($regr);
	    }else{
	        $result= $this->purchase->insertPurchase($regr);
	    }
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
	public function delete(){
	    $this->load->model('Info/Purchase_model','purchase');
	    $json = array();
	    $regr = $this->input->post();
	    
	    $purchase_id = $regr["purchase_id"];
	    
	    $result= $this->purchase->deletePurchase($purchase_id);
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
}
