<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processprovision extends CI_Controller {

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
	    $data["title"] = "공정 제공 관리";
//         $data["menu"] = "process";
	    $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";	    
	    
	    $data["parent_menu"] = 4;
	    $data["menu"] = 30;
	    
	    $this->load->model('Common/Menu_model','menu');
	    $menus = $this->menu->getMenus();
	    $data["menus"] = $menus;
	    
	    $this->load->model('Info/Process_model','process');
	    $data["process"]= $this->process->getProcessList2();
	    
	    $this->load->view('process/processprovision',$data);
	}
	
	
}
