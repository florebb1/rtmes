<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standardnumber extends CI_Controller {

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
	    $data["title"] = "표준 수가 정보";
        $data["menu"] = "info";
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";	    
	    $this->load->model('Info/Standard_model','standard');
	    $data["customer"] = $this->standard->getCustmerList();
	    $data["item"] = $this->standard->getItemList();
	    $data["list"] = $this->standard->getStandardNumberList();
	    $this->load->view('info/standardnumber',$data);
	}
	
	public function edit(){
	    $this->load->model('Info/Standard_model','standard');
	    $json = array();
	    $regr = $this->input->post();
	    
	    $result= $this->standard->insertStandardNumber($regr);
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
}
