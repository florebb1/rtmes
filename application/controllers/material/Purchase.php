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
	public function index() {
	    $this->load->helper('url');
	    $data["base_url"] = base_url();	    
	    $data["title"] = "입고 관리";	    
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
        $data["menu"] = "material";
	    $this->load->view('material/purchase',$data);
	}

    public function info() {
        $this->load->model('Material/Purchase_model','purchase');
        $json = array();
        $data = $this->input->post();
        // pagenation
        $listSize = 25;
        $start = $listSize * ($data["page"]-1);
        $end = $listSize * $data["page"];

        // query
        $result = $this->purchase->getPurchase($start, $end, $data);
        $count = $this->purchase->getPurchaseCount($data);

        $json["result"] = $result;
        $json["count"] = $count;
        echo json_encode($json);
        exit;
    }

    public function insert() {
        $this->load->model('Material/Purchase_model','purchase');
        $json = array();
        $regr = $this->input->post();
        $result = $this->purchase->insertPurchase($regr);
        $this->purchase->insertStock($regr);
        $json["result"] = $result;
        echo json_encode($json);
        exit;
    }

    public function modalInfo() {
        $this->load->model('Material/Purchase_model','purchase');
        $json = array();
        $material = $this->purchase->getMaterialList();
        $business = $this->purchase->getBusinessList();
        $json["material"] = $material;
        $json["business"] = $business;
        echo json_encode($json);
    }
}
