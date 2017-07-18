<?php

class Documento extends CI_Controller{
  function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('projetos_model');
      $this->load->model('documentos_model');
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

  public function form(){
    $titulo = $this->input->post('titulo');
    $conteudo = $this->input->post('conteudo');
    $projeto = $this->input->post('projeto');
    $id = $this->input->post('id');

    if(strlen($titulo) < 3){
      echo "O título deve ter no mínimo 3 caracteres.";
      return;
    }

    if(strlen($titulo) > 100){
      echo "O título deve ter no máximo 100 caracteres.";
      return;
    }

    $idprojeto = $this->projetos_model->projeto($projeto, $this->session->userdata('logged_in')['id_usuario'])[0]['id_projeto'];
    if($this->documentos_model->inserir($idprojeto, $projeto, $titulo, $conteudo)){
      echo "Sucesso.";
    } else {
      echo "Erro! Tente novamente mais tarde.";
    }

  }
}
