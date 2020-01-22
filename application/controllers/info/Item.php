<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

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
	    $data["title"] = "품목 정보";
        $data["menu"] = "info";
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";	   
	    $this->load->model('Info/Item_model','item');
	    $data["categorys"]= $this->item->getItemCategoryList();	
	    $data["purchases"]= $this->item->getItemPurchaseList();
	    
	    $page = 0*25;
	    $data["list"]= $this->item->getItemList(0);	
	    $this->load->view('info/item',$data);
	}
	
	public function info(){
	    $this->load->model('Info/Item_model','item');
	    $json = array();
	    $item_id = $this->input->post("item_id");
	    $info = $this->item->getItem($item_id);
	    
	    $json["info"] = $info;
	    echo json_encode($json);
	    exit;
	}
	
	public function edit(){
	    $this->load->model('Info/Item_model','item');
	    $json = array();
	    $regr = $this->input->post();
	    
	    if($regr["w"] == "u"){
	        $result= $this->item->updateItem($regr);
	    }else{
	        $result= $this->item->insertItem($regr);
	    }
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
	public function delete(){
	    $this->load->model('Info/Item_model','item');
	    $json = array();
	    $regr = $this->input->post();
	    
	    $item_id = $regr["item_id"];
	    
	    $result= $this->item->deleteItem($item_id);
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
	
}
