<?php

class Documentacao extends CI_Controller{
  function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('projetos_model');
  }

  public function cadastro($user, $project){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        if($this->projetos_model->projeto($project, $data['session']['id_usuario'])){
          $data['projeto'] = $project;
          $data['id'] = $user;
          $this->load->view('documentacao/cadastro', $data);
        } else {
          redirect($user, 'refresh');
        }
      }
  }
}
