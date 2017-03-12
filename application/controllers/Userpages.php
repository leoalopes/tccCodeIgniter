<?php

class Userpages extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function index() {
        $data = $this->session->userdata('logged_in');
        if(isset($data) and $data['email']!='') {
            $array = explode('@', $data['email'], 2);
            redirect($array[0], 'refresh');
        } else {
            redirect('about', 'refresh');
        }
    }
    
    public function view($user) {
        if($this->user_model->isUser($user)){
            $data['session'] = $this->session->userdata('logged_in');
            $email = explode('@', $data['session']['email'], 2);
            if($user === $email[0])
                $this->load->view('user/index', $data);
            else
                redirect('home', 'refresh');
        } else {
            redirect('home', 'refresh');
        }
    }
}
?>