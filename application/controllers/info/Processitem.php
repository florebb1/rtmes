<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processitem extends CI_Controller {

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
	    $data["title"] = "품목별 공정 정보";
        $data["menu"] = "info";
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";	    
	    $this->load->model('Info/Process_model','process');
	    $data["process"]= $this->process->getProcessList2();
	    $data["item"]= $this->process->getItemList();
	    $data["list"]= $this->process->getProcessItemList();
	    
	    $this->load->view('info/processitem',$data);
	}
	
	public function edit(){
	    $this->load->model('Info/Process_model','process');
	    $json = array();
	    $regr = $this->input->post();
	    
	    $result= $this->process->insertProcessItem($regr);
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
}
