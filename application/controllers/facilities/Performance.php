<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance extends CI_Controller {

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
        $data["title"] = "설비 가동 실적";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
//         $data["menu"] = "facilities";
        $data["parent_menu"] = 3;
        $data["menu"] = 26;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        $this->load->view('facilities/performance',$data);
    }

    public function info() {
        $this->load->model('Facilities/Performance_model','performance');
        $json = array();
        $data = $this->input->post();

        // pagenation
        $listSize = 10;
        $start = $listSize * ($data['page']-1);
        $end = $listSize * $data['page'];

        $result = $this->performance->getPerformance($start, $end, $data);
        $count = $this->performance->getPerformanceCount($data);
        $json["result"] = $result;
        $json["count"] = $count;
        echo json_encode($json);
        exit;
    }
}
