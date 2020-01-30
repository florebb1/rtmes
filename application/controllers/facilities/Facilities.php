<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilities extends CI_Controller {

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
    public function index() {
        $this->load->helper('url');
        $data["base_url"] = base_url();
        $data["title"] = "설비 등록/설정";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
 //       $data["menu"] = "facilities";
        
        $data["parent_menu"] = 3;
        $data["menu"] = 24;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        
        $this->load->view('facilities/facilities',$data);
    }

    public function info() {
        $this->load->model('Facilities/Facilities_model','facilities');
        $json = array();
        $page = $this->input->get('page');

        // pagenation
        $listSize = 25;
        $start = $listSize * ($page-1);
        $end = $listSize * $page;

        // query
        $info = $this->facilities->getFacilities($start, $end);
        $count = $this->facilities->getFacilitiesCount();

        $json["info"] = $info;
        $json["count"] = $count;
        echo json_encode($json);
        exit;
    }

    public function singleInfo() {
        $this->load->model('Facilities/Facilities_model','facilities');
        $json = array();
        $idx = $this->input->get('idx');

        // query
        $result = $this->facilities->getSingleFacilities($idx);

        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }

    public function insertModal() {
        $this->load->model('Facilities/Facilities_model','facilities');
        $json = array();
        $employee = $this->facilities->getEmployee();
        $process = $this->facilities->getProcess();
        $json["employee"] = $employee;
        $json["process"] = $process;
        echo json_encode($json);
        exit;
    }

    public function insert() {
        $this->load->model('Facilities/Facilities_model','facilities');
        $json = array();
        $data = $this->input->post();
        $result = $this->facilities->insertFacilities($data);
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }

    public function update() {
        $this->load->model('Facilities/Facilities_model','facilities');
        $json = array();
        $data = $this->input->post();
        $result = $this->facilities->updateFacilities($data);
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }

    public function delete() {
        $this->load->model('Facilities/Facilities_model','facilities');
        $json = array();
        $idx = $this->input->get('idx');
        $result = $this->facilities->deleteFacilities($idx);
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }
}
