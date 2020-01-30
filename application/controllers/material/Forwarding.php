<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forwarding extends CI_Controller {

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
	    $data["title"] = "출고 관리";	    
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
    //    $data["menu"] = "material";
    
	    $data["parent_menu"] = 2;
	    $data["menu"] = 22;
	    
	    $this->load->model('Common/Menu_model','menu');
	    $menus = $this->menu->getMenus();
	    $data["menus"] = $menus;
	    
	    $this->load->view('material/forwarding',$data);
	}

    public function info() {
        $this->load->model('Material/forwarding_model','forwarding');
        $json = array();
        $page = $this->input->get('page');
        // pagenation
        $listSize = 25;
        $start = $listSize * ($page-1);
        $end = $listSize * $page;

        // query
        $result = $this->forwarding->getStock($start, $end);
        $count = $this->forwarding->getStockCount();

        $json["result"] = $result;
        $json["count"] = $count;
        echo json_encode($json);
        exit;
    }

    public function update() {
        $this->load->model('Material/forwarding_model','forwarding');
        $json = array();
        $data = $this->input->post();
        $count = $data["quotient"] - $data["value"];
        $update = $this->forwarding->updateStock($data, $count);
        $insert = $this->forwarding->insertOutcoming($data);
        $json["update"] = $update;
        $json["insert"] = $insert;
        echo json_encode($json);
        exit;
    }
}
