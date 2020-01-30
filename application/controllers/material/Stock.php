<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

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
	    $data["title"] = "재고 현황";	    
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
  //      $data["menu"] = "material";
  
	    $data["parent_menu"] = 2;
	    $data["menu"] = 23;
	    
	    $this->load->model('Common/Menu_model','menu');
	    $menus = $this->menu->getMenus();
	    $data["menus"] = $menus;
	    
	    $this->load->view('material/stock',$data);
	}

    public function info() {
        $this->load->model('Material/Stock_model','stock');
        $json = array();
        $page = $this->input->get('page');
        // pagenation
        $listSize = 25;
        $start = $listSize * ($page-1);
        $end = $listSize * $page;

        // query
        $result = $this->stock->getStock($start, $end);
        $count = $this->stock->getStockCount();

        $json["result"] = $result;
        $json["count"] = $count;
        echo json_encode($json);
        exit;
    }
}
