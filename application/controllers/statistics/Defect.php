<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Defect extends CI_Controller {

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
	    $data["title"] = "제조 불량률";	    
   //     $data["menu"] = "statistics";
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
	    
	    $data["parent_menu"] = 9;
	    $data["menu"] = 42;
	    
	    $this->load->model('Common/Menu_model','menu');
	    $menus = $this->menu->getMenus();
	    $data["menus"] = $menus;
	    
	    $this->load->model('Statistics/Statistics_model','statistics');
	    
	    $current_year = date("Y",time());
	    $prev_year = date("Y", strtotime($current_year." -12 month"));
	    
	    $data["current_year"] = $current_year;
	    $data["prev_year"] = $prev_year;
	    
	    $data["list"] = $this->statistics->getDefectList($current_year,$prev_year);
	    
	    
	    $this->load->view('statistics/defect',$data);
	}

}
