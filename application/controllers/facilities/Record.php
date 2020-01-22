<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller {

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
    {   $this->load->helper('url');
        $data["base_url"] = base_url();
        $data["title"] = "설비 보전 이력";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";
        $data["menu"] = "facilities";
        $this->load->view('facilities/record',$data);
    }
}
