<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
    
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
        $data["title"] = "의뢰 분류 추이";
      //  $data["menu"] = "statistics";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
        
        $data["parent_menu"] = 9;
        $data["menu"] = 46;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        
        $type = 1;
        if($this->input->get("type")){
            $type = $this->input->get("type");
        }
        
        if($type == 1){
            $current_date = date("Y-m",time());
        }else{
            $current_date = date("Y",time());
        }
        echo $current_date;
        
        if($this->input->get("date")){
            $current_date = $this->input->get("date");
        }
        echo $current_date;
        $this->load->model('Statistics/Statistics_model','statistics');
        
        $data["list"] = $this->statistics->getRequestList($current_date,$type);
        $data["current_date"] = $current_date;
        if($type == 1){
            $data["prev_date"] = date("Y-m", strtotime($current_date." -1 month"));
            $data["next_date"] = date("Y-m", strtotime($current_date." +1 month"));
        }else{
            $data["prev_date"] = date("Y", strtotime($current_date." -12 month"));
            $data["next_date"] = date("Y", strtotime($current_date." +12 month"));
            echo $data["next_date"];
        }
        $data["type"] = $type;
        $this->load->view('statistics/request',$data);
    }
    
}
