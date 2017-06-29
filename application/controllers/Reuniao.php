<?php

class Reuniao extends CI_Controller {
    function __construct(){
        parent::__construct();
    }

    function index(){
        $data['session'] = $this->session->userdata('logged_in');
        $this->load->view('reuniao', $data);
    }

}
