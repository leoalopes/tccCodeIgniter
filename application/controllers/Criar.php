<?php
class Criar extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('projetos_model');
    $this->load->model('grupos_model');
  }

  function projeto(){
    $this->form_validation->set_rules('nome', 'nome', 'trim|required|min_length[3]|max_length[20]|xss_clean|callback_check_database');

    if($this->form_validation->run() == FALSE){
      $data['session'] = $this->session->userdata('logged_in');
      $data['projetos'] = $this->projetos_model->listProjects();
      $data['id'] = explode('@', $data['session']['email'])[0];
      $this->form_validation->set_error_delimiters('', '');
      $this->load->view('user/index', $data);
    } else {
      $this->projetos_model->cadastro();
      $user = explode('@', $this->session->userdata('logged_in')['email'])[0];
      $projeto = $this->input->post('nome');
      redirect("$user/projeto/$projeto");
    }
  }

  function check_database(){
    if($this->projetos_model->naocadastrado()){
      return true;
    }
    $this->form_validation->set_message('check_database', 'Você já possui um projeto com esse nome.');
    return false;
  }

  function grupo(){
    $nome = $this->input->post('nome');
    $usuarios = $this->input->post('usuarios');

    if(strlen($nome) < 3){
      echo "O nome deve ter no mínimo 3 caracteres.";
      return;
    }

    if(strlen($nome) > 60){
      echo "O nome deve ter no máximo 60 caracteres.";
      return;
    }

    $this->grupos_model->inserir($nome, $usuarios);
    echo "";
  }
}
