<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

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
	    $data["title"] = "사원 정보";
        $data["menu"] = "info";
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";	    
	    
	    $this->load->model('Info/Employee_model','employee');
	    $data["work"]= $this->employee->getEmployeeWorkList();
	    $data["process"]= $this->employee->getprocessList();
	    $page = 0*25;
	    $data["list"]= $this->employee->getEmployeeList(0);	  
	    
	    $this->load->view('info/employee',$data);
	}
	
	public function info(){
	    $this->load->model('Info/Employee_model','employee');
	    $json = array();
	    $employee_id = $this->input->post("employee_id");
	    $info = $this->employee->getEmployee($employee_id);
	    
	    $json["info"] = $info;
	    echo json_encode($json);
	    exit;
	}
	
	public function edit(){
	    $this->load->model('Info/Employee_model','employee');
	    $json = array();
	    $regr = $this->input->post();
	    
	    if($regr["w"] == "u"){
	        $result= $this->employee->updateEmployee($regr);
	    }else{
	        $result= $this->employee->insertEmployee($regr);
	    }
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
	public function delete(){
	    $this->load->model('Info/Employee_model','employee');
	    $json = array();
	    $regr = $this->input->post();
	    
	    $employee_id = $regr["employee_id"];
	    
	    $result= $this->employee->deleteEmployee($employee_id);
	    
	    $json["result"] = $result;
	    echo json_encode($json);
	    exit;
	}
	
}
