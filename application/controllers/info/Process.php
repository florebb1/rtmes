<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {

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
	    $data["title"] = "공정정보";
        $data["menu"] = "info";
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";	   
	    
	    $this->load->model('Info/Process_model','process');
	    $page = 0*25;
	    $data["list"]= $this->process->getProcessList(0);	
	    $data["condition_count"]= $this->process->getConditionMaxCount();	
	    $this->load->view('info/process',$data);
	}
	
	public function info(){
	    $this->load->model('Info/Process_model','process');
	    $json = array();
	    $process_id = $this->input->post("process_id");
	    $info = $this->process->getProcess($process_id);
	    
	    $json["info"] = $info;
	    echo json_encode($json);
	    exit;
	}
	
	public function edit(){
	    $this->load->model('Info/Process_model','process');
	    $json = array();
	    $regr = $this->input->post();
	    
	    if($regr["w"] == "u"){
	        $result= $this->process->updateProcess($regr);
	    }else{
	        $result= $this->process->insertProcess($regr);
	    }
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
}
