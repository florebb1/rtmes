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
        $data["title"] = "공정 불량 관리";
        $data["menu"] = "quality";
        $data["root"] = $_SERVER['DOCUMENT_ROOT']."/application/views";

        $this->load->view('quality/defect',$data);
    }

}
