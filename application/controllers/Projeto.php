<?php

class Projeto extends CI_Controller{
  function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('projetos_model');
      $this->load->model('documentos_model');
  }

  public function view($user, $project){
      if($this->user_model->user($user)){
        $data['session'] = $this->session->userdata('logged_in');
        $project = $this->projetos_model->projeto($project, $data['session']['id_usuario']);
        if($project){
          $data['projeto'] = $project[0];
          $data['id'] = $user;
          $data['documentacoes'] = $this->documentos_model->listar($data['projeto']['nome'], $data['session']['id_usuario']);
          $this->load->view('projeto/home', $data);
        } else {
          redirect($user, 'refresh');
        }
      }
  }

  public function delete(){
      $idprojeto = $this->input->post('idprojeto');
      $this->projetos_model->excluir($idprojeto);
  }

  public function edit(){
      $idprojeto = $this->input->post('idprojeto');
      $nome = $this->input->post('nome');
      if(strlen($nome) >= 3 && strlen($nome) <= 60){
        if($this->projetos_model->naocadastrado()){
          $this->projetos_model->atualizar($nome, $idprojeto);
          echo '';
        } else {
          echo "Você já possui um projeto com esse nome.";
        }
      } else {
        echo 'O nome deve possuir entre 3 e 60 caracteres.';
      }
  }
}
