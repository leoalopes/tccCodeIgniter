<?php

class Contas extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        redirect('/conta/login', 'refresh');
    }

	public function view($page) {
        if ( ! file_exists(APPPATH.'views/conta/'.$page.'.php')) {
            show_404();
        }
        
        $data['title'] = ucfirst($page);
        
        $this->load->helper(array('form'));
        $this->load->view('conta/'.$page, $data);
    }
}