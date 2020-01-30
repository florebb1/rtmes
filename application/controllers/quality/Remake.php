<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remake extends CI_Controller {

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
        $data["title"] = "리메이크 관리";
   //     $data["menu"] = "quality";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
        
        $data["parent_menu"] = 7;
        $data["menu"] = 39;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        
        $this->load->model('Quality/Remake_model','remake');
        
        $st_date = date("Y-m-d",time());
        $ed_date = date("Y-m-d",time());
        if($this->input->get("st_date")){
            $st_date = $this->input->get("st_date");
        }
        
        if($this->input->get("ed_date")){
            $ed_date = $this->input->get("ed_date");
        }
        
        $data["st_date"] = $st_date;
        $data["ed_date"] = $ed_date;
        $data["list"]= $this->remake->getRemakeList($st_date,$ed_date);
        
        
        
        $this->load->view('quality/remake',$data);
    }

}
