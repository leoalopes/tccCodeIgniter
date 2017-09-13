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
          $data['grupo'] = $grupo[0];
          $data['projetos'] = $this->grupos_model->listProjects($idgrupo);
          $this->load->view('grupo/home', $data);
        } else {
          redirect($user, 'refresh');
        }
      }
  }

  public function projeto($user, $idgrupo, $projeto){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $grupo = $this->grupos_model->isMember($idgrupo, $data['session']['id_usuario']);
        if($grupo){
          $proj = $this->grupos_model->isProject($grupo[0]['id_grupo'], $projeto);
          if($proj){
            $data['id'] = $user;
            $data['grupo'] = $grupo[0];
            $data['projeto'] = $proj;
            $this->load->view('grupo/projeto.php', $data);
          } else {
            redirect("$user/grupo/$idgrupo", 'refresh');
          }
        } else {
          redirect($user, 'refresh');
        }
      }
  }

  public function criarProjeto(){
      $projeto = $this->input->post('nome');
      $grupo = $this->input->post('id_grupo');
      if(strlen($projeto) > 3 && strlen($projeto) <= 60){
        if($this->grupos_model->naoCadastrado($projeto, $grupo)){
          echo '';
        } else {
          echo 'O grupo já possui um projeto com esse nome.';
        }
      } else {
        echo 'O nome deve possuir entre 3 e 60 caracteres.';
      }
  }
}
