<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

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
	    $data["title"] = "자재 등록";	    
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
        $data["menu"] = "material";
	    $this->load->view('material/material',$data);
	}

    public function info() {
        $this->load->model('Material/Material_model','material');
        $json = array();
        $page = $this->input->get('page');

        // pagenation
        $listSize = 25;
        $start = $listSize * ($page-1);
        $end = $listSize * $page;

        // query
        $info = $this->material->getMaterial($start, $end);
        $count = $this->material->getMaterialCount();

        $json["info"] = $info;
        $json["count"] = $count;
        echo json_encode($json);
        exit;
    }

    public function insert() {
        $this->load->model('Material/Material_model','material');
        $json = array();
        $regr = $this->input->post();

        $result = $this->material->insertMaterial($regr);
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }

    public function delete() {
        $this->load->model('Material/Material_model','material');
        $json = array();
        $arrayData = $_POST['arrayData'];
        print_r($arrayData);
        foreach ($arrayData as $value) {
            $result = $this->material->deleteMaterial($value);
        }
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }
}
