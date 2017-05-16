<?php

class Userpages extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('projetos_model');
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

    public function user($user) {
        if($this->user_model->isUser($user)){
            $data['session'] = $this->session->userdata('logged_in');
            $email = explode('@', $data['session']['email'], 2);
            if($user === $email[0]){
                return true;
            } else {
                redirect('home', 'refresh');
            }
        } else {
            redirect('home', 'refresh');
        }
    }

    public function home($user){
        if($this->user($user)){
          $data['session'] = $this->session->userdata('logged_in');
          $data['projetos'] = $this->projetos_model->listProjects();
          $this->load->view('user/index', $data);
        }
    }

    public function projects($user, $project){
        if($this->user($user)){
          if($this->projetos_model->project($project)){
            $data['session'] = $this->session->userdata('logged_in');
            $data['projeto'] = $project;
            $this->load->view('projeto/singleproject', $data);
          } else {
            redirect($user, 'refresh');
          }
        }
    }

    public function groups($user, $group){

    }
}
?>
