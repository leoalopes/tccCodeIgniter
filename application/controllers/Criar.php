<?php
class Criar extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('projetos_model');
  }

  function projeto(){
    $this->form_validation->set_rules('nome', 'nome', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean|callback_inserir_projeto');

    if($this->form_validation->run() == FALSE){
      redirect('home');
    } else {
      $this->projetos_model->cadastro();
      $user = explode('@', $this->session->userdata('logged_in')['email'])[0];
      $projeto = $this->input->post('nome');
      redirect("$user/projeto/$projeto");
    }
  }

  function inserir_projeto(){
    if($this->projetos_model->naocadastrado()){
      return true;
    }
    $this->form_validation->set_message('checar_banco', 'Você já possui um projeto com esse nome');
    return false;
  }

  function grupo(){

  }


}
