<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
    
    public function index() {
        $this->load->helper('url');
        $data = $this->session->userdata('logged_in');
        $this->load->view('index', $data);
    }
}
