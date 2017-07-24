<?php

class Grupo extends CI_Controller{
  function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('grupos_model');
      $this->load->model('documentos_model');
  }

  public function view($user, $idgrupo){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          $data['id'] = $user;
          $data['grupo'] = $grupo;
          $this->load->view('grupo/home', $data);
        } else {
          redirect($user, 'refresh');
        }
      }
  }
}
