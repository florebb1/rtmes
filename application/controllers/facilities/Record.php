<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller {

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
        $data["title"] = "설비 보전 이력";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
//         $data["menu"] = "facilities";
        $data["parent_menu"] = 3;
        $data["menu"] = 27;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        $this->load->view('facilities/record',$data);
    }

    public function info() {
        $this->load->model('Facilities/Record_model','record');
        $json = array();
        $data = $this->input->post();

        // query
        if($data['facilities'] == 0) {
            $result = $this->record->getRecord($data);
        }else {
            $result = $this->record->getSingleRecord($data);
        }
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }

    public function singleInfo() {
        $this->load->model('Facilities/Record_model','record');
        $json = array();
        $idx = $this->input->get('idx');
        $result = $this->record->getFacilitiesHistory($idx);
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }

    public function insert() {
        $this->load->model('Facilities/Record_model','record');
        $json = array();
        $data = $this->input->post();
        $result = $this->record->insertRecord($data);
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }

    public function getFacilities() {
        $this->load->model('Facilities/Record_model','record');
        $json = array();
        $result = $this->record->getFacilities();
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }

    public function update() {
        $this->load->model('Facilities/Record_model','record');
        $json = array();
        $data = $this->input->post();
        $count = count($data['datas']);
        for($i = 0; $i < $count; $i++) {
            $result = $this->record->updateRecord($data['datas'][$i]);
        }
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }
}
