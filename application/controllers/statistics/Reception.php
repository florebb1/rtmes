<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reception extends CI_Controller {
    
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
        $data["title"] = "접수현황";
       // $data["menu"] = "statistics";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
        
        $data["parent_menu"] = 9;
        $data["menu"] = 44;
        
        $this->load->model('Common/Menu_model','menu');
        $menus = $this->menu->getMenus();
        $data["menus"] = $menus;
        
        $current_date = date("Y-m-d",time());
        
        if($this->input->get("date")){
            $current_date = $this->input->get("date");
        }
        
        $this->load->model('Statistics/Statistics_model','statistics');
       
        $data["list"] = $this->statistics->getReceptionList($current_date);
        
        $data["current_date"] = $current_date;
        $data["prev_date"] = date("Y-m-d", strtotime($current_date." -1 day"));
        $data["next_date"] = date("Y-m-d", strtotime($current_date." +1 day"));
        
        
        $this->load->view('statistics/reception',$data);
    }
    
}
