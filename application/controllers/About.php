<?php

class About extends CI_Controller {
    function __construct(){
        parent::__construct();
    }

    public function index() {
        $data = $this->session->userdata('logged_in');
        if(isset($data) and $data['email']!='') {
            redirect('home', 'refresh');
        } else {
            $this->load->helper('url');
            $this->load->view('index');
        }
    }
}
