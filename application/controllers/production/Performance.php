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
    public function index()
    {
        $data["base_url"] = base_url();
        $data["title"] = "생산 실적 내역";
      //  $data["menu"] = "production";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
        $data["parent_menu"] = 6;
        $data["menu"] = 35;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        $this->load->view('production/performance',$data);
    }

}
